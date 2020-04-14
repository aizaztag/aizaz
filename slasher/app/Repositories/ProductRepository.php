<?php
namespace App\Repositories;

use App\Contracts\ProductContract;
use App\Product;
use App\Traits\UploadAble;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class ProductRepository implements ProductContract {

    use UploadAble;

    protected $model;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->model->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCategoryById(int $id)
    {
        try {
            return $this->model->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createCategory(array $params)
    {
        try {
            $collection = collect($params);
            $image = null;

            if ($collection->has('image') && ($params['image'])) {
                $image = $this->uploadOne($params['image'], 'products');
            }

            $description = $collection['description'];
            $title = $collection['title'];
            $code = $collection['code'];

            $merge = $collection->merge(compact('title', 'image', 'description' , 'code'));

            $category = new Product($merge->all());

            $category->save();

            return $category;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory(array $params)
    {
        $category = $this->model->findCategoryById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('image') && ($params['image'])) {

            if ($category->image != null) {
                $this->model->deleteOne($category->image);
            }

            $image = $this->model->uploadOne($params['image'], 'categories');
        }

        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;

        $merge = $collection->merge(compact('menu', 'image', 'featured'));

        $category->update($merge->all());

        return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCategory($id)
    {
        $category = $this->model->findCategoryById($id);

        if ($category->image != null) {
            $this->model->deleteOne($category->image);
        }

        $category->delete();

        return $category;
    }

    /**
     * @return mixed
     */
    public function treeList()
    {
        return Product::orderByRaw('-name ASC')
            ->get()
            ->nest()
            ->setIndent('|–– ')
            ->listsFlattened('name');
    }

    public function findBySlug($slug)
    {
        return Product::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }


}