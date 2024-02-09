<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactUs::latest()->get();
        return view('admin.contacts.index',compact('contacts'));
    }


    public function destroy(string $id)
    {
        ContactUs::findOrFail($id)->delete();
        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'error'
        ];

        return redirect()->route('admin.contact-us.index')->with($success);
   }

}