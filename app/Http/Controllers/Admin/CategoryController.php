<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    function index(){
        return view('admin.category.index');
    }

    function create(){
        return view('admin.category.create');
    }

    function store(CategoryFormRequest $request){
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keywords = $validatedData['meta_keywords'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true ? '1': '0';
        $category->save();
        return redirect('admin/category')->with('message','Category Added Successfully');

    }
}
