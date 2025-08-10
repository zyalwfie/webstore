<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Data\ProductData;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product = ProductData::fromModel($product);
        return view('product.show', compact('product'));
    }
}
