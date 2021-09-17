<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product=Product::latest()->get();

        return response()->json(['products'=>$product]);
    }

    public function store(Request $req)
    {
       $product=new Product();
       $product->title=$req->title;
       $product->description=$req->description;
       $product->photo = $req->photo;
       $product->save();
       
    }

    public function update(Request $req , $id)
    {
        $product = Product::find($id);
        $product->title = $req->title;
        $product->description = $req->description;
        $product->photo = $req->photo;
        $product->save();
        
    }
    public function destroy($id)
    {
        Product::find($id)->delete();
    }

    public function show($id)
    {
        $product=Product::find($id);
        return response()->json(['product'=>$product]);

    }
}
