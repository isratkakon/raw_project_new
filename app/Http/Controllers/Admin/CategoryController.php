<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;


class CategoryController extends Controller
{
    public function Index(){
        $categories = Category::latest()->get();
        return Inertia::render('Admin/Category/Index', ['categories' => $categories]);
    }

    public function CategoryCreate(){
        return Inertia::render('Admin/Category/Create');
    }

    public function CategoryStore(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => ['nullable', 'image'],
            'category_name' => ['required', 'min:3'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('category_images', $uniqueName);
            
            Category::create([
               'category_name' => $request->category_name,
               'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
               'image' => 'category_images/' .$uniqueName
           ]);
   
            return Redirect::route('admin.categories')->with('message', 'Category created successfully.');
        }
    }


    public function CategoryEdit(Category $category){
        return Inertia::render('Admin/Category/Edit', ['category' => $category]);
    }


    public function CategoryUpdate(Request $request, Category $category) {
        $imagePath = $category->image;
    
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $image = $request->file('image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category_images'), $uniqueName);
            $imagePath = 'category_images/' . $uniqueName;
        }
    
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'image' => $imagePath
        ]);
    
        return Redirect::route('admin.categories')->with('message', 'Category updated successfully.');
    }

    public function CategoryDelete(Category $category){

        $image = $category->image;
        if (File::exists($image)) {
            File::delete($image);
        }
        $category->delete();
        return Redirect::route('admin.categories')->with('message', 'Category deleted successfully.');
    }

}
