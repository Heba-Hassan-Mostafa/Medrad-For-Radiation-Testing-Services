<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $quotes = Quote::latest()->get();

       return view("admin.quotes.index", compact("quotes"));
    }


    public function destroy(string $id)
    {
       Quote::findOrFail($id)->delete();

       $success=[
        'message'=>trans('messages.deleted'),
        'alert-type'=>'success'
    ];

    return redirect()->back()->with($success);
    }
}
