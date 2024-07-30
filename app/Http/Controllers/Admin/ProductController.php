<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function Index(){

        $products = Product::with('category', 'subcategory')->get();

        return Inertia::render('Admin/Product/Index', compact('products'));
    }

    public function ProductCreate(){
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
       return Inertia::render('Admin/Product/Create', compact('categories', 'subcategories'));
    }

    public function ProductStore( Request $request){
        $validator = Validator::make($request->all(),[

            'product_name'=>['required', 'min:3'],
            'category_id' =>['required', 'min:1'],
            'subcategory_id' =>['required', 'min:1'],
            'product_url' =>['nullable'],
            'product_details' =>['nullable', 'min:5'],
            'image' =>['nullable','image','mimes:jpeg,png,jpg,webp','max:2048'],
            'video' =>['nullable','file','mimes:mp4,webm','max:10240000'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $imageName =null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('product_images', $imageName);
            
        }
        $videoName =null;
        if($request->hasFile('video')){
            $video = $request->file('video');
            $videoName = time() . '-' . Str::random(10) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('product_videos'), $videoName);
            
        }
        $product = Product::create([
            'product_name'=> $request->product_name,
            'category_id' => $request->category_id,
            'subcategory_id' =>$request->subcategory_id,
            'product_url' =>$request->product_url,
            'product_details' =>$request->product_details,
            'image' => 'product_images/'.$imageName,
            'video' =>'product_videos/'. $videoName,

        ]);

        return Redirect::route('admin.products')->with('message', 'Product Created Successfully.');
    }

    public function ProductEdit(Product $product){
        $categories =Category::all();
        $subcategories =Subcategory::all();
        return Inertia::render('Admin/Product/Edit',compact('product','categories','subcategories'));
    }

    public function ProductUpdate(Request $request, Product $product){

        $validator = Validator::make($request->all(),[
            'image' =>['nullable','image','mimes:jpeg,png,jpg,webp','max:20480'],
            'product_video' =>['nullable','file','mimes:mp4,webm','max:10240000'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        
        $imagePath = $product->image;
        if($request->hasFile('image')){
            if($product->image && file_exists(public_path($product->image))){
                unlink(public_path($product->image));
            }
            $image =$request->file('image');
            $uniqueName = time(). '-' . Str::random(10) . '.'. 
            $image->getClientOriginalExtension();
            $image->move(public_path('product_images'), $uniqueName);
            $imagePath = 'product_images/'.$uniqueName;
        }
        
        $videoPath = $product->video;
        if($request->hasFile('video')){
            if($product->video && file_exists(public_path($product->video))){
                unlink(public_path($product->video));
            }
            $video =$request->file('video');
            $uniqueName = time(). '-' . Str::random(10) . '.'. 
            $video->getClientOriginalExtension();
            $video->move(public_path('product_videos'), $uniqueName);
            $videoPath = 'product_videos/'.$uniqueName;
        }

        $product->update([
            'product_name'=> $request->product_name,
            'category_id' => $request->category_id,
            'subcategory_id' =>$request->subcategory_id,
            'product_url' =>$request->product_url,
            'product_details' =>$request->product_details,
            'image' => $imagePath,
            'video' =>$videoPath,
        ]);

        return Redirect::route('admin.products')->with('message', 'Product Update Successfully.');
    }

    public function ProductDelete(Product $product){
        $image = $product->image;
        if(File::exists($image)){
            File::delete($image);
        }
        $video = $product->video;
        if(File::exists($video)){
            File::delete($video);
        }
        $product->delete();
        return Redirect::route('admin.products')->with('message','Product Deleted Successfully.');
    }
}
