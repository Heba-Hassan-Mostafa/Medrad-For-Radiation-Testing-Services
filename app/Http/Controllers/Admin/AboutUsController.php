<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(About $about)
    {
        if ($about->all()->count() > 0) {

            $about = About::first();
        }

        return view('admin.about_us.about_us',compact('about'));
    }


    public function update(Request $request, string $id)
    {
        if (About::all()->count() > 0) {
            $data['about_us'] = ['ar' => $request->about_us, 'en' => $request->about_us_en];
            $data['home_about_us'] = ['ar' => $request->home_about_us, 'en' => $request->home_about_us_en];
            $data['vision'] = ['ar' => $request->vision, 'en' => $request->vision_en];
            $data['mission'] = ['ar' => $request->mission, 'en' => $request->mission_en];

            About::find(1)->update($data);
        }



            $success=[
                'message'=>trans('messages.updated'),
                'alert-type'=>'success'
            ];

            return redirect()->back()->with($success);
    }


}