<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class ProductController extends BaseController
{
    #get
    public function index(){
        $products = Product::get();
        $result = ProductResource::collection($products);
        return $this->success($result, "Successfully Product Data get", 200);
    }

    #show
    public function show($id){
        // dd('here');
        $products = Product::find($id);
        $result = new ProductResource($products);
        return $this->success($result, "Successfully Specific Product Data get", 200);
    }


    #store
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
        ]);

        if ($validation->fails()) {
            return $this->error("Validation Error", $validation->errors(), 422);
        }


        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);


        return $this->success($product, "Category created successfully", 201);
    }

    # update
    public function update(Request $request, $id){

        $product = Product::find($id);

        if (!$product) {
            return $this->error("Product not found", [], 404);
        }



        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
        ]);

        if ($validation->fails()) {
            return $this->error("Validation Error", $validation->errors(), 422);
        }


        $product->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,
        ]);


        return $this->success($product, "Product updated successfully", 200);

    }

    #Delete
     public function delete($id){
        // dd('here');
        $products = Product::find($id);
        if (!$products) {
            return $this->error("Product not found to delete", [], 404);
        }

        $products->delete();

        return $this->success($products, "Successfully Delete Product Data", 200);


    }
}
