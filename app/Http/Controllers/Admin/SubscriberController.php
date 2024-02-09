<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscribers.index',compact('subscribers'));
    }


    public function destroy(string $id)
    {
        Subscriber::findOrFail($id)->delete();
        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'error'
        ];

        return redirect()->route('admin.subscribers.index')->with($success);
    }
    public function delete_all(Request $request)
    {
        $delete_all_id = explode(',' ,$request->delete_all_id);

        Subscriber::whereIn('id',$delete_all_id)->delete();

        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'error'
        ];

        return redirect()->route('admin.subscribers.index')->with($success);

    }
}