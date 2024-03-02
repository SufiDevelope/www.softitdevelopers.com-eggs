<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\CmsController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\YelpController;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('project.home');
// });

Route::get('/',[projectController::class,'index'])->name('index');
Route::get('/about_us', function () {
    return view('project.about');
});
Route::get('/signin', function () {
    return view('project.signin');
});
Route::get('/signup', function () {
    return view('project.signup');
});


// Route::get('/fetch-yelp-data', function () {
//     try {
//         $response = Http::get('https://www.yelp.com/writeareview/search?find_desc=&find_loc=Providence%2C+RI');
//         return $response->body();
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Error fetching data from Yelp API'], 500);
//     }
// });

Route::get('/yelp-recent-reviews', function () {
    try {
        $response = Http::get('https://www.yelp.com/writeareview/biz/FX6rwBH71KYtERbrMxPhFg?review_origin=writeareview-search');
        return $response->body();
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error fetching recent reviews from Yelp'], 500);
    }
});

Route::post('/signup',[projectController::class,'signup'])->name('signup');
Route::post('/signin',[projectController::class,'signin'])->name('signin');
Route::get('/logout',[projectController::class,'logout'])->name('logout');
Route::get('/review',[projectController::class,'review'])->name('review');
Route::post('/review',[projectController::class,'review'])->name('review');
Route::get('/editUserProfile',[projectController::class,'editUserProfile'])->name('editUserProfile');
Route::post('/editUserProfile',[projectController::class,'editUserProfile'])->name('editUserProfile');

Route::get('/review2',[projectController::class,'review2'])->name('review2');
Route::post('/review2',[projectController::class,'review2'])->name('review2');

Route::get('/add_review',[projectController::class,'add_review'])->name('add_review');
Route::post('/add_review',[projectController::class,'add_review'])->name('add_review');

// Route::get('/single_api/{place_id}', [projectController::class ,'singleApi'])->name('single_api');

// Route::get('/single-card/{id}', [projectController::class,'singleCard'])->name('single-card');

Route::get('verify/{token}',[projectController::class,'verify']);
Route::get('api/',[projectController::class,'api_data'])->name('api');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/single-card/{id}', [projectController::class,'singleCard'])->name('single-card');

Route::middleware('customer')->group(function(){
    Route::get('/single-card/{id}', [projectController::class,'singleCard'])->name('single-card');
    Route::get('/single_api/{place_id}', [projectController::class ,'singleApi'])->name('single_api');
});


Route::middleware('admin')->group(function(){
    Route::get('/admin/dashboard',[adminController::class,'index'])->name('index');
    Route::get('/update_password',[adminController::class,'update_password'])->name('update_password');
    Route::post('/update_password',[adminController::class,'update_password'])->name('update_password');
    Route::get('/admin/logout',[adminController::class,'logout'])->name('logout');
    Route::post('admin/check_password',[adminController::class,'check_password']);
    Route::get('/admin/admin_details',[adminController::class,'admin_details'])->name('admin_details');
    Route::post('/admin/admin_details',[adminController::class,'admin_details'])->name('admin_details');

    // Get data Cmspage 
    Route::get('/cms_pages',[CmsController::class,'index'])->name('index');
    Route::post('/admin/update-cms-pages-status',[CmsController::class,'update'])->name('update');
    Route::get('/admin/add-edit-cms-page/{id?}',[CmsController::class,'edit'])->name('edit');
    Route::post('/admin/add-edit-cms-page/{id?}',[CmsController::class,'edit'])->name('edit');
    Route::get('/admin/delete-cms-page/{id?}',[CmsController::class,'destroy'])->name('destroy');
    Route::get('/admin/subadmin',[adminController::class,'subadmin'])->name('subadmin');
    // customers
    Route::get('/admin/customers',[adminController::class,'customers'])->name('customers');
    // add- edit customers
    Route::get('/admin/customers/add_customers/{id?}',[adminController::class,'AddUpdateCustomer'])->name('AddUpdateCustomer');
    Route::post('/admin/customers/add_customers/{id?}',[adminController::class,'AddUpdateCustomer'])->name('AddUpdateCustomer');
    // update status
    Route::post('/admin/update-customer-status',[adminController::class,'CustomerStatus'])->name('CustomerStatus');
    // delete
    Route::get('/admin/delete-customer/{id?}',[adminController::class,'destroy'])->name('destroy');

    Route::get('/admin/add-edit-subadmin/{id?}',[adminController::class,'AddUpdateSubAdmin'])->name('AddUpdateSubAdmin');
    Route::post('/admin/add-edit-subadmin/{id?}',[adminController::class,'AddUpdateSubAdmin'])->name('AddUpdateSubAdmin');
    Route::post('/admin/update-subadmin-status',[adminController::class,'updateSubadminStatus'])->name('updateSubadminStatus');
    Route::get('/admin/delete-subadmin/{id?}',[adminController::class,'destroySubadmin'])->name('destroySubadmin');
    Route::get('/update-role/{id}',[adminController::class,'updateRole'])->name('updateRole');
    Route::post('/update-role/{id}',[adminController::class,'updateRole'])->name('updateRole');
    Route::get('admin/categories',[categoryController::class,'showCategory'])->name('showCategory');

    Route::post('/admin/update-category-status',[categoryController::class,'categoryStatus'])->name('categoryStatus');
    Route::get('/admin/delete-category/{id?}',[categoryController::class,'destroy'])->name('destroy');
    
    Route::get('/admin/add-edit-category/{id?}',[categoryController::class,'edit'])->name('edit');
    Route::post('/admin/add-edit-category/{id?}',[categoryController::class,'edit'])->name('edit');

    Route::get('/admin/reviews',[adminController::class,'show_reviews'])->name('show_reviews');

    Route::get('/admin/delete-review/{id?}',[adminController::class,'destroyReview'])->name('destroyReview');

});

Route::get('/admin/documentation',[adminController::class,'documentation'])->name('documentation');

Route::get('/admin/login',[adminController::class,'login'])->name('login');
Route::post('/admin/login',[adminController::class,'login'])->name('login');

require __DIR__.'/auth.php';
