<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Category;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\Gallery\GalleryRequest;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = GalleryImage::withCount('images')->latest()->get();
        return view('admin.galleries.index',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('galleries')->whereCategoryType(Category::TYPE[2])->get(['id','name']);
        return view('admin.galleries.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {

        $validated = $request->validated();

           $data['title']                = $request->title;
           $data['category_id']          = $request->category_id;
           $data['status']               = $request->status;

          $gallery = GalleryImage::create($data);

          if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $image) {
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Gallery/', $img , 'upload_attachments');

             $gallery->images()->create([
                    'file_name' => $img,
                ]);

                $i++;
        }
    }

    $success=[
        'message'=>trans('messages.stored'),
        'alert-type'=>'success'
    ];

    return redirect()->route('admin.gallery.index')->with($success);
 }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = GalleryImage::findOrFail($id);
        $items = $model->images()->latest()->get();
        return view('admin.galleries.show',compact('model','items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = GalleryImage::findOrFail($id);
        $categories = Category::with('galleries')->whereCategoryType(Category::TYPE[2])->get(['id','name']);
        return view('admin.galleries.edit',compact('model','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, $id)
    {

         $request->validated();
        $gallery = GalleryImage::findOrFail($id);

        $data['title']                = $request->title;
        $data['category_id']          = $request->category_id;
        $data['status']               = $request->status;



     $gallery->update($data);

       if ($request->images && count($request->images) > 0) {
         $i = $gallery->images()->count() +1;
         foreach ($request->images as $image) {
            $img = $image->getClientOriginalName();
            $image->storeAs('image/Gallery/', $img , 'upload_attachments');

          $gallery->images()->create([
                 'file_name' => $img,
             ]);

             $i++;
     }
 }


        $success=[
        'message'=>trans('messages.updated'),
        'alert-type'=>'success'
        ];

        return redirect()->route('admin.gallery.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryImage $gallery)
    {
        if($gallery->images()->count() > 0)
        {
            foreach($gallery->images as $image)
            {
                if(File::exists('Files/image/Gallery/'.$image->file_name))
                {
                     unlink('Files/image/Gallery/'.$image->file_name);
                }
                $image->delete();
            }
        }
        $gallery->delete();

        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'error'
        ];

        return redirect()->route('admin.gallery.index')->with($success);
    }
    public function remove_image(Request $request)
    {

        //dd($request->all());
        $gallery = GalleryImage::findOrFail($request->gallery_id);

        $image = $gallery->images()->whereId($request->image_id)->first();
         if(File::exists('Files/image/Gallery/'.$image->file_name))
        {
             unlink('Files/image/Gallery/'.$image->file_name);
        }
        $image->delete();
        return true;

    }
    public function caption(Request $request,$id)
    {
       // dd($request->update_all_id);
        $update_all_id = explode(',' ,$request->update_all_id);
       // dd($update_all_id);
         $gallery = GalleryImage::findOrFail($id);

         $images = Image::where('imageable_type','App\Models\GalleryImage')->where('imageable_id',$id)->get();

             foreach($images as $key=>$image)
             {
        //dd($update_all_id[$key]);
            if($update_all_id[$key] != null  )
            {
                $image->update(['description'=>$update_all_id[$key]]);

            }else{
                $image->update(['description'=>Null]);

            }

           }

            $success=[
                'message'=>trans('messages.updated'),
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.gallery.index')->with($success);



    }
}