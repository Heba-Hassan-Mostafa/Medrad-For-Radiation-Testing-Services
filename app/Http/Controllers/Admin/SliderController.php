<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\Sliders\SliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.sliders.index',compact('sliders'));
    }

    public function livewire_index()
    {
        $sliders = Slider::get();
        return view('admin.sliders.livewire_index',compact('sliders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request , Slider $slider)
    {
        $request->validated();

        $last =$slider->max('order_position') + 1;

        $slider = new Slider();
        $slider->title =['en' => $request->title_en , 'ar' => $request->title];
        // $slider->link = $request->link;
        $slider->status = $request->status;
        // $slider->description=['en'=>$request->description_en , 'ar'=>$request->description];
        $slider->order_position = $last;
          //upload image
          if($request->hasFile('image'))
          {
              if($slider_image= $request->file('image'))
              {
                  $img_slider = $slider_image->getClientOriginalName();
                  $slider_image->storeAs('Slider/', $img_slider , 'upload_attachments');


              }

              $slider->image = $img_slider;
          }

        $slider->save();


        $success=[
            'message'=>trans('messages.stored'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.sliders.index')->with($success);
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
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $validated = $request->validated();
        $slider = Slider::findOrFail($id);

         $data['title']     = ['ar' => $request->title, 'en' => $request->title_en];
         //$data['link']      = $request->link;
         $data['status']     = $request->status;
        //  $data['description'] = ['ar' => $request->description, 'en' => $request->description_en];

         $slider->update($data);

         if($request->hasFile('image'))
        {
             //delete old image
             if ($slider->image != '')
             {
                if (File::exists('Files/Slider/' . $slider->image))
                {
                    unlink('Files/Slider/' . $slider->image);
                }
             }
            if($request->hasFile('image'))
        {

            if($slider_image= $request->file('image'))
            {
                $img_slider = $slider_image->getClientOriginalName();
                $slider_image->storeAs('Slider/', $img_slider , 'upload_attachments');

            }

            $slider->image = $img_slider;
        }

        }


        $slider->save();



        $success=[
            'message'=>trans('messages.updated'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.sliders.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        if(!empty($slider->image))
        {
            if(File::exists('Files/Slider/'.$slider->image))
            {
                unlink('Files/Slider/'.$slider->image);
            }
        }

        $slider->delete();

        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.sliders.index')->with($success);
    }

    public function change_status(Request $request)
    {

        $slider = Slider::findOrFail($request->id);
        $slider->status = $request->status;

        $slider->save();


        return response()->json(['success'=>'Status change successfully.']);



    }

}