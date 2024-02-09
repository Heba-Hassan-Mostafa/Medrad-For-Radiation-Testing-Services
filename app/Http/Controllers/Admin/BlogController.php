<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Image;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Admin\Blogs\BlogRequest;
use App\Notifications\SendSubscriberBlogs;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('image')->latest()->get();
        return view('admin.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $request->validated();
        $blog = new Blog();
        $blog->title =['en' => $request->title_en , 'ar' => $request->title];
        $blog->slug = Str::slug($request->title_en, '-');
        $blog->status = $request->status;
        $blog->publish_date = $request->publish_date;
        $blog->content=['en'=>$request->content_en , 'ar'=>$request->content];
        $blog->content_home=['en'=>$request->content_home_en , 'ar'=>$request->content_home];
        $blog->keywords = $request->keywords;
        $blog->description = $request->description;

        $blog->save();

        $photo = new Image();
        if($image= $request->file('image'))
        {
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Blogs/', $img , 'upload_attachments');

                $photo->file_name = $img;

            }

        $blog->image()->create([
            'file_name'=>$photo->file_name,
        ]);

        $subscribers=Subscriber::all();

        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->subscriber_email)
            ->notify(new SendSubscriberBlogs($blog,$subscriber));
        }

        $success=[
            'message'=>trans('messages.stored'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.blogs.index')->with($success);
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
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        $validated = $request->validated();
        $blog = Blog::findOrFail($id);

         $data['title'] = ['ar' => $request->title, 'en' => $request->title_en];
         $data['slug']  = Str::slug($request->title_en, '-');
         $data['status']       = $request->status;
         $data['publish_date'] = $request->publish_date;
         $data['content'] = ['ar' => $request->content, 'en' => $request->content_en];
         $data['content_home'] = ['ar' => $request->content_home, 'en' => $request->content_home_en];
         $data['keywords'] = $request->keywords;
         $data['description'] = $request->description;

         $blog->update($data);

         $blog->save();


        if($image= $request->file('image'))
        {
            if(!empty($blog->image->file_name)){

                if(File::exists('Files/image/Blogs/'. $blog->image->file_name))
                {
                unlink('Files/image/Blogs/'. $blog->image->file_name);
                }
            }
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Blogs/', $img , 'upload_attachments');

                $blog->image->file_name = $img;

            }

        $blog->image()->update([
            'file_name'=>$blog->image->file_name,
        ]);

        $success=[
            'message'=>trans('messages.updated'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.blogs.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->image->delete();
        if(!empty($blog->image->file_name)){

            if(File::exists('Files/image/Blogs/'. $blog->image->file_name))
            {
            unlink('Files/image/Blogs/'. $blog->image->file_name);
            }
        }
        $blog->delete();
        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.blogs.index')->with($success);
    }

}