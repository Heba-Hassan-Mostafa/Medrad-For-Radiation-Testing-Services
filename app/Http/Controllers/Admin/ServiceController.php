<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Service;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendSubscriberServices;
use App\Http\Requests\Admin\Services\ServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with(['category','image'])->latest()->get();
        return view('admin.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereCategoryType(Category::TYPE[0])->get(['id','name']);
        return view('admin.services.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $request->validated();

        $service = new Service();
        $service->name =['en' => $request->name_en , 'ar' => $request->name];
        $service->slug = Str::slug($request->name_en, '-');
        $service->category_id = $request->category_id;
        $service->status = $request->status;
        $service->publish_date = $request->publish_date;
        $service->content=['en'=>$request->content_en , 'ar'=>$request->content];
        $service->content_home=['en'=>$request->content_home_en , 'ar'=>$request->content_home];
        $service->keywords = $request->keywords;
        $service->description = $request->description;

        $service->save();

        $photo = new Image();
        if($image= $request->file('image'))
        {
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Services/', $img , 'upload_attachments');

                $photo->file_name = $img;

        }

        $service->image()->create([
            'file_name'=>$photo->file_name,
        ]);

        $subscribers=Subscriber::all();

        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->subscriber_email)
            ->notify(new SendSubscriberServices($service,$subscriber));
            // sleep(5);
        }


        $success=[
            'message'=>trans('messages.stored'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.services.index')->with($success);
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
        $service = Service::findOrFail($id);
        $categories = Category::whereCategoryType(Category::TYPE[0])->get(['id','name']);
        return view('admin.services.edit',compact('categories','service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        $validated = $request->validated();
        $service = Service::findOrFail($id);

         $data['name'] = ['ar' => $request->name, 'en' => $request->name_en];
         $data['slug'] = Str::slug($request->name_en, '-');
         $data['category_id'] = $request->category_id;
         $data['status']       = $request->status;
         $data['publish_date'] = $request->publish_date;
         $data['content'] = ['ar' => $request->content, 'en' => $request->content_en];
         $data['content_home'] = ['ar' => $request->content_home, 'en' => $request->content_home_en];
         $data['keywords'] = $request->keywords;
         $data['description'] = $request->description;

         $service->update($data);

         $service->save();

        if($image= $request->file('image'))
        {
            if(!empty($service->image->file_name)){

                if(File::exists('Files/image/Services/'. $service->image->file_name))
                {
                unlink('Files/image/Services/'. $service->image->file_name);
                }
            }
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Services/', $img , 'upload_attachments');

                $service->image->file_name = $img;

            }

        $service->image()->update([
            'file_name'=>$service->image->file_name,
        ]);

        $success=[
            'message'=>trans('messages.updated'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.services.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->image->delete();
        if(!empty($service->image->file_name)){

            if(File::exists('Files/image/Services/'. $service->image->file_name))
            {
            unlink('Files/image/Services/'. $service->image->file_name);
            }
        }
        $service->delete();
        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.services.index')->with($success);
    }


   public function change_show_home(Request $request)
    {
        $service = Service::findOrFail($request->id);
        $service->show_in_home = $request->show_in_home;
        $service->save();

        return response()->json(['success'=>'show changed successfully.']);
    }



}