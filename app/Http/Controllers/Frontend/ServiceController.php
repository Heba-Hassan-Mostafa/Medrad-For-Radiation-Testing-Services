<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
   public function all_services()
   {
    $services = Service::with(['category','image'])->Active()->ActiveCategory()->latest()->paginate(9);

     return view('frontend.services.services',compact('services'));

   }

   public function getServiceCategory($slug)
    {

        $category = Category::with('services')->whereSlug($slug)->orWhere('id', $slug)->Active()->ServiceType()->first();

        if ($category) {
            $services = Service::with(['category','image'])
                ->whereCategoryId($category->id)
                ->Active()
                ->latest()
                ->paginate(9);

         return view('frontend.services.services',compact('services'));

        }else{
            abort(404);
        }



    }

     // get content of service
     public function service_content(Request $request,$slug)
     {
         $service= Service::with(['category','image'])
         ->whereSlug($slug)->ActiveCategory()->orderBy('id','desc')->firstOrFail();

             $randomServices = Service::with('image')->whereNotIn('id', [$service->id])->ActiveCategory()->Active()->inRandomOrder()->paginate(3);


         return view('frontend.services.service_content',compact('service','randomServices'));
     }

}