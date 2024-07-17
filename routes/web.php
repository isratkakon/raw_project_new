<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home/HomePage', [
        
    ]);
});




Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    //category

    Route::get('admin/categories', [CategoryController::class,'Index'])->name('admin.categories');
    Route::get('admin/category/create', [CategoryController::class, 'CategoryCreate'])->name('category.create');
    Route::post('admin/category/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('admin/category/edit/{category}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::put('admin/category/update/{category}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::delete('admin/category/delete/{category}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');


    //subcategory

    Route::get('admin/subcategories', [SubCategoryController::class, 'Index'])->name('admin.subcategories');
    Route::get('admin/subcategory/create', [SubCategoryController::class, 'SubCategoryCreate'])->name('subcategory.create');
    Route::post('admin/subcategory/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('admin/subcategory/edit/{subcategory}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::put('admin/subcategory/update/{subcategory}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::delete('admin/subcategory/delete/{subcategory}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');
});



Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
});

//category




require __DIR__.'/auth.php';
