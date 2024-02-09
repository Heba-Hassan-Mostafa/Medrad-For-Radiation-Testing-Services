<?php

use Illuminate\Support\Facades\Auth;
use Spatie\Feed\Http\FeedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ServiceController;
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



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

    ], function(){

Route::group(['as' => 'website.'], function () {

        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::post('/add-quote',         [IndexController::class, 'quote'])->name('quote');
        Route::post('/add-quote-index',         [IndexController::class, 'quoteIndex'])->name('quote_index');

        Route::post('/add-subscriber',    [IndexController::class, 'addSubscribe'])->name('subscribe');
        Route::post('/add-comment',       [IndexController::class, 'addComment'])->name('comment');
        Route::get('/about-us',           [IndexController::class, 'about_us'])->name('about-us');
        Route::get('/contact-us',         [IndexController::class, 'contact_us'])->name('contact-us');
        Route::post('/add-contact-us',        [IndexController::class, 'add_contact_us'])->name('add-contact-us');

        Route::group(['prefix' =>'services' , 'as'=>'services.'],function(){
            Route::get('/category/{slug}/service',         [ServiceController::class, 'getServiceCategory'])->name('category.services');
            Route::get('/all-services',                    [ServiceController::class, 'all_services'])->name('all-services');
            Route::get('/{service}',                       [ServiceController::class, 'service_content'])->name('service_content');

        });

        Route::group(['prefix' =>'courses' , 'as'=>'courses.'],function(){
            Route::get('/category/{slug}/course',         [CourseController::class, 'getCourseCategory'])->name('category.courses');
            Route::get('/all-courses',                    [CourseController::class, 'all_courses'])->name('all-courses');
            Route::get('/{course}',                       [CourseController::class, 'course_content'])->name('course_content');

        });
        Route::group(['prefix' =>'gallery' , 'as'=>'gallery.'],function(){
            Route::get('/category/{slug}',             [GalleryController::class, 'getGalleryCategory'])->name('category');
            Route::get('/images',                      [GalleryController::class, 'gallery'])->name('images');
        });

        Route::group(['prefix' =>'blog' , 'as'=>'blog.'],function(){
            Route::get('/blog',                         [BlogController::class, 'get_blogs'])->name('blog');
            Route::get('/{blog}',                       [BlogController::class, 'blog_content'])->name('blog_content');

        });


        });
        Route::feeds();
});