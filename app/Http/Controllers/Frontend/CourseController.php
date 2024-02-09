<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
   public function all_courses()
   {
    $courses = Course::with(['category','image'])->Active()->ActiveCategory()->Publish()->latest()->paginate(9);

     return view('frontend.courses.courses',compact('courses'));

   }

   public function getCourseCategory($slug)
    {

        $category = Category::with('courses')->whereSlug($slug)->orWhere('id', $slug)->Active()->CourseType()->first();

        if ($category) {
            $courses = Course::with(['category','image'])
                ->whereCategoryId($category->id)
                ->Active()
                ->Publish()
                ->latest()
                ->paginate(9);

          return view('frontend.courses.courses',compact('courses'));

        }else{
            abort(404);
        }



    }

     // get content of course
     public function course_content(Request $request,$slug)
     {
         $course= Course::with(['category','image'])
         ->whereSlug($slug)->ActiveCategory()->Publish()->orderBy('id','desc')->firstOrFail();

             $randomCourses = course::with('image')->whereNotIn('id', [$course->id])->ActiveCategory()->Active()->Publish()->inRandomOrder()->paginate(3);


         return view('frontend.courses.course_content',compact('course','randomCourses'));
     }

}