<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Notifications\SendSubscriberCourses;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Admin\Courses\CourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['category','image'])->latest()->get();
        return view('admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereCategoryType(Category::TYPE[1])->get(['id','name']);
        return view('admin.courses.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $request->validated();
        $course = new Course();
        $course->name =['en' => $request->name_en , 'ar' => $request->name];
        $course->slug = Str::slug($request->name_en, '-');
        $course->category_id = $request->category_id;
        $course->status = $request->status;
        $course->publish_date = $request->publish_date;
        $course->content=['en'=>$request->content_en , 'ar'=>$request->content];
        $course->content_home=['en'=>$request->content_home_en , 'ar'=>$request->content_home];
        $course->keywords = $request->keywords;
        $course->description = $request->description;

        $course->save();

        $photo = new Image();
        if($image= $request->file('image'))
        {
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Courses/', $img , 'upload_attachments');

                $photo->file_name = $img;

            }

        $course->image()->create([
            'file_name'=>$photo->file_name,
        ]);

        $subscribers=Subscriber::all();
        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->subscriber_email)
            ->notify(new SendSubscriberCourses($course,$subscriber));
            // sleep(5);
        }
        $success=[
            'message'=>trans('messages.stored'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.courses.index')->with($success);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::whereCategoryType(Category::TYPE[1])->get(['id','name']);
        return view('admin.courses.edit',compact('categories','course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        $validated = $request->validated();
        $course = Course::findOrFail($id);

         $data['name'] = ['ar' => $request->name, 'en' => $request->name_en];
         $data['slug'] = Str::slug($request->name_en, '-');
         $data['category_id'] = $request->category_id;
         $data['status']       = $request->status;
         $data['publish_date'] = $request->publish_date;
         $data['content'] = ['ar' => $request->content, 'en' => $request->content_en];
         $data['content_home'] = ['ar' => $request->content_home, 'en' => $request->content_home_en];
         $data['keywords'] = $request->keywords;
         $data['description'] = $request->description;
         $course->update($data);

         $course->save();


        if($image= $request->file('image'))
        {
            if(!empty($course->image->file_name)){

                if(File::exists('Files/image/Courses/'. $course->image->file_name))
                {
                unlink('Files/image/Courses/'. $course->image->file_name);
                }
            }
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Courses/', $img , 'upload_attachments');

                $course->image->file_name = $img;

            }

        $course->image()->update([
            'file_name'=>$course->image->file_name,
        ]);

        $success=[
            'message'=>trans('messages.updated'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.courses.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->image->delete();
        if(!empty($course->image->file_name)){

            if(File::exists('Files/image/Courses/'. $course->image->file_name))
            {
            unlink('Files/image/Courses/'. $course->image->file_name);
            }
        }
        $course->delete();
        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.courses.index')->with($success);
    }

}