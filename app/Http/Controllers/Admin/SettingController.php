<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;

class SettingController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        return view('admin.settings.index', $setting);
    }


    public function update(Request $request)
    {
        try{
            $info = $request->except('_token', '_method', 'logo','icon');
            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

//            $key = array_keys($info);
//            $value = array_values($info);
//            for($i =0; $i<count($info);$i++){
//                Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
//            }

            if($request->hasFile('logo')) {
                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]);
                $this->uploadFile($request,'logo','Settings');
            }
            if($request->hasFile('logo_footer')) {
                $logo_footer_name = $request->file('logo_footer')->getClientOriginalName();
                Setting::where('key', 'logo_footer')->update(['value' => $logo_footer_name]);
                $this->uploadFile($request,'logo_footer','Settings');
            }
            if($request->hasFile('icon')) {
                $icon_name = $request->file('icon')->getClientOriginalName();
                Setting::where('key', 'icon')->update(['value' => $icon_name]);
                $this->uploadFile($request,'icon','Settings');
            }

            if($request->hasFile('default_slider')) {
                $icon_name = $request->file('default_slider')->getClientOriginalName();
                Setting::where('key', 'default_slider')->update(['value' => $icon_name]);
                $this->uploadFile($request,'default_slider','Settings');
            }

            $success=[
                'message'=>trans('messages.updated'),
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.settings.index')->with($success);
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

}