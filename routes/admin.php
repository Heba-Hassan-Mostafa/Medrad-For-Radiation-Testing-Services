<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\TeamManagmentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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



Auth::routes();

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

    ], function(){

    Route::group(['middleware'=>['auth','auto-check-permission'] ,'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('/roles'                   ,RoleController::class);

    Route::get('/users/profile',            [UserController::class,'profile'])->name('users.profile');
    Route::put('/users/profile',            [UserController::class,'update_profile'])->name('users.update-profile');
    Route::get('/users/change-password',    [UserController::class,'change_password'])->name('users.change-password');
    Route::put('/users/change-password',    [UserController::class,'update_password'])->name('users.update-password');
    Route::get('/users/change-status',      [UserController::class,'change_status'])->name('users.change_status');
    Route::resource('/users'                ,UserController::class);

    //categories
     Route::resource('/categories'              , CategoryController::class);
    //services
     Route::get('/services/change_show_home'    , [ServiceController::class,'change_show_home'])->name('services.change_show_home');
     Route::resource('/services'                , ServiceController::class);
    //courses
     Route::resource('/courses'                 , CourseController::class);
    //sliders
     Route::get('/sliders/change_status'        , [SliderController::class,'change_status'])->name('sliders.change_status');
     Route::get('/sliders/sort_slider',           [SliderController::class,'livewire_index'])->name('sliders.sort_slider');
     Route::resource('/sliders'                  ,SliderController::class);
     //subscribers
     Route::post('/subscribers/delete_all'      , [SubscriberController::class,'delete_all'])->name('subscribers.delete_all');
     Route::resource('/subscribers'              ,SubscriberController::class);
     //comments
     Route::get('/comments/change_status'        , [CommentController::class,'change_status'])->name('comments.change_status');
     Route::resource('/comments'                 ,CommentController::class);

     //about_us
     Route::resource('/about_us'                 ,AboutUsController::class);

     //team managments
     Route::get('/team_managment/change_status'  , [TeamManagmentController::class,'change_status'])->name('team_managment.change_status');
     Route::resource('/team_managment'           ,TeamManagmentController::class);

     //Quote
     Route::resource('/quotes'                   ,QuoteController::class);

      //Quote
    Route::resource('/settings'                   ,SettingController::class);

    //gallery
    Route::post('gallery/caption/{id}'           , [GalleryImageController::class,'caption'])->name('gallery.caption');
    Route::post('gallery/remove-image'         , [GalleryImageController::class,'remove_image'])->name('gallery.remove_image');
    Route::resource('/gallery'                   ,GalleryImageController::class);

    //blogs
    Route::resource('/blogs'                   ,BlogController::class);

     //contact-us
     Route::resource('/contact-us'                   ,ContactUsController::class);

     Route::get('/activity-log', [DashboardController::class , 'activity_log'])->name('activity-log');

});
});