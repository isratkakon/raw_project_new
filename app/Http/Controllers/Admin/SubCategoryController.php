<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function Index(){
        $subcategories = SubCategory::with('category')->paginate(5);
        return Inertia::render('Admin/SubCategory/Index', [
            'subcategories' => $subcategories,
        ]);
    }
    

    public function SubCategoryCreate(){
        $categories = Category::all();
        // dd($categories);
        return Inertia::render('Admin/SubCategory/Create', compact('categories'));
    }

    public function SubCategoryStore(Request $request){
        $validator = Validator::make($request->all(), [
            'subcategory_name' => ['required', 'min:3'],
            'category_id' => ['required', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);
    
         if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('subcategory_images', $uniqueName);
            $subcateogyImg = 'subcategory_images/' .$uniqueName;
            
            SubCategory::create([
               'subcategory_name' => $request->subcategory_name,
               'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
               'category_id' => $request -> category_id,
               'image' => $subcateogyImg
           ]);
   
            return Redirect::route('admin.subcategories')->with('message', 'SubCategory created successfully.');
         }
    }

    public function SubCategoryEdit(SubCategory $subcategory){
        $categories = Category::all();
        return Inertia::render('Admin/SubCategory/Edit', compact('categories' , 'subcategory'));
    }


  public function SubCategoryUpdate(Request $request, SubCategory $subcategory) {
    $imagePath = $subcategory->image;

    if ($request->hasFile('image')) {
        if ($subcategory->image && file_exists(public_path($subcategory->image))) {
            unlink(public_path($subcategory->image));
        }
        $image = $request->file('image');
        $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('subcategory_images'), $uniqueName);
        $imagePath = 'subcategory_images/' . $uniqueName;
    }

    $subcategory->update([
               'subcategory_name' => $request->subcategory_name,
               'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
               'category_id' => $request -> category_id,
               'image' => $imagePath
    ]);

    return Redirect::route('admin.subcategories')->with('message', 'SubCategory updated successfully.');
}

public function SubCategoryDelete(SubCategory $subcategory){

    $image = $subcategory->image;
    if (File::exists($image)) {
        File::delete($image);
    }
    $subcategory->delete();
    return Redirect::route('admin.subcategories')->with('message', 'SubCategory deleted successfully.');
   }
   
}