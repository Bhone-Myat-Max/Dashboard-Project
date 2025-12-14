<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class CategoryController extends BaseController
{

    #get
    public function index(){

        $categories=Category::get();
        $result = CategoryResource::collection($categories);

        return $this->success($result, 'Category data success', 200);
    }

    #show
    public function show($id){
        $categories=Category::find($id);
        $result = new CategoryResource($categories);
        return $this->success($categories, 'Category show success', 200);
    }

    #store
     public function store(Request $request)
    {
        // dd($request->all());

        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->error("Validation Error", $validation->errors(), 422);
        }

        if ($request->hasFile('image'))
        {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('categoryImages'), $imageName);
        }

        $category = Category::create([
            'name' => $request->name,
            'image' => $imageName,


        ]);


        return $this->success($category, "Category created successfully", 201);
    }

    # update
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->error("Category not found", [], 404);
        }

        $validation = Validator::make($request->all(), [
            'name'  => 'required|string',
            'image' => 'nullable|image',
        ]);

        if ($validation->fails()) {
            return $this->error("Validation Error", $validation->errors(), 422);
        }

        // Update name
        $category->name = $request->name;

        // Update image if exists
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('categoryImages'), $imageName);

            $category->image = $imageName;
        }

        $category->save();

        return $this->success($category, "Category updated successfully", 200);
    }


     #Delete
     public function delete($id){
        // dd('here');
        $category = Category::find($id);
        if (!$category) {
            return $this->error("Category not found to delete", [], 404);
        }

        $category->delete();

        return $this->success($category, "Successfully Delete Category Data", 200);


    }
}
