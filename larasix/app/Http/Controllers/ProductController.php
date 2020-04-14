<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;


class ProductController extends Controller
{
    public function create()
    {

        return view('product.create');
    }

    public function store(SaveProductRequest $request)
    {
        $product = Product::create($request->validated());

        return ProductResource::make($product);
    }

    public function ss(SaveProductRequest $request)
    {
        $product = Product::create($request->validated());

        return ProductResource::make($product);
    }
}
