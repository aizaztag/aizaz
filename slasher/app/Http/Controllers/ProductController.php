<?php

namespace App\Http\Controllers;

use App\Contracts\ProductContract;
use App\Http\Requests\ProductStoreRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect,Response;

class ProductController extends BaseController
{


    /**
     * @var ProductContract
     */
    protected $productRepository;

    /**
     * ProductController constructor.
     * @param ProductContract $productRepository
     */
    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->getFlashMessage);
        $successMessages = [];
        //\Session::put('success', ['dfdfdfdfdf']);
        //session()->flash('warning','dfdf');
        //session()->forget('success');
       //  dd(\session()->get('success'));


        $products = $this->productRepository->listCategories();
        //   dd($products);
         if(request()->ajax()) {
            return datatables()->of($products)
            //return datatables()->of(Product::select('*'))
                ->addColumn('action', 'action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('list');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $file = $request->file('image');
        $request->validated();
        $params = $request->except('_token');
        $product =   $this->productRepository->createCategory($params);

        if (!$product) {
              $this->responseRedirectBack('Error occurred while creating Product.', 'error', true, true);
        }else  $this->responseRedirect('product.index', 'Product added successfully' ,'success',false, false);

        $flashMessage = [
        'error' => Session::get('error'),
        'success' => Session::get('success'),
        'info' => Session::get('info'),
        'warnings' => Session::get('warning')];

        return Response::json(['product' => $product , 'message' => $flashMessage]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $product  = Product::where($where)->first();

        return Response::json($product);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$id)->delete();

        return Response::json($product);
    }
}