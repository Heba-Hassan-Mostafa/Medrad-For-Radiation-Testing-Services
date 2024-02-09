<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
   public function get_blogs()
   {
    $blogs = Blog::with('image')->Active()->Publish()->latest()->paginate(9);

     return view('frontend.blogs.blog',compact('blogs'));

   }


     // get content of blog
     public function blog_content(Request $request,$slug)
     {
         $blog= Blog::with('image')->whereSlug($slug)->Publish()->latest()->firstOrFail();

        $randomBlogs = blog::with('image')->whereNotIn('id', [$blog->id])->Active()->inRandomOrder()->paginate(3);


         return view('frontend.blogs.blog_content',compact('blog','randomBlogs'));
     }

}