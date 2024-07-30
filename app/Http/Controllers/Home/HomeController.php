<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function HomePage(){
        $products = Product::all();
        return Inertia::render('Home/HomePage', ['products' => $products]);
    }
}
