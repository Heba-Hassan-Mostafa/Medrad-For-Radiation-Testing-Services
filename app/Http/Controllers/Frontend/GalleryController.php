<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Image;
use App\Models\Category;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class GalleryController extends Controller
{
    //get all categories of images
  public function getGalleryCategory($slug)
  {

   $categories = Category::Active()->GalleryType()->latest()->get();
   $category = Category::whereSlug($slug)->orWhere('id', $slug)->Active()->GalleryType()->first();

   if ($category) {
      $images = Image::whereHasMorph('imageable',[GalleryImage::class],
      function (Builder $query) use($category) {
              $query->Active()->ActiveCategory()->whereCategoryId($category->id);
          })->latest()->paginate(12);

   return view('frontend.gallery-images.gallery',compact('categories','images'));

   }else{
            abort(404);
        }

  }

  public function gallery()
  {
      $categories = Category::Active()->GalleryType()->latest()->get();

     $images = Image::whereHasMorph('imageable',[GalleryImage::class],
      function (Builder $query) {
              $query->Active()->ActiveCategory();
          })->latest()->paginate(12);

      return view('frontend.gallery-images.gallery',compact('categories','images'));
  }

}