<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends BaseController
{

    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository){
        $this->productRepository = $productRepository;
    }


    #get
    public function index(){
        $products = $this->productRepository->index();
        $result = ProductResource::collection($products);
        //  dd($result);
        return $this->success($result, "Successfully Product Data get", 200);
    }

    #show
    public function show($id){
        $products = $this->productRepository->show($id);
        $result = new ProductResource($products);
        return $this->success($result, "Successfully Specific Product Data get", 200);
    }


    #store
    public function store(Request $request){

        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'image' => 'required',
            'category_id' => 'required',
            // 'status' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->error("Validation Error", $validation->errors(), 422);
        }

        if ($request->hasFile('image'))
        {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('productImages'), $imageName);

        }

        // $validation['status'] = $request->has('status') ? true : false;

        $product =$this->productRepository->store([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' =>$imageName,
            'price' => $request->price,
            'status' => $request->has('status') ? true : false,
        ]);


        return $this->success($product, "Category created successfully", 201);
    }

    # update
    public function update(Request $request, $id){

        $product = $this->productRepository->show($id);

        if (!$product) {
            return $this->error("Product not found", [], 404);
        }



        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->error("Validation Error", $validation->errors(), 422);
        }


        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' =>$imageName,
            'price' => $request->price,
            'status' => $request->has('status') ? true : false,
        ]);


        return $this->success($product, "Product updated successfully", 200);

    }

    #Delete
     public function delete($id){
        // dd('here');
        $products = $this->productRepository->show($id);
        if (!$products) {
            return $this->error("Product not found to delete", [], 404);
        }

        $products->delete();

        return $this->success($products, "Successfully Delete Product Data", 200);


    }
}
