<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.comments.index',compact('comments'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::findOrFail($id)->delete();
       $success=[
        'message'=>trans('messages.deleted'),
        'alert-type'=>'success'
    ];

    return redirect()->back()->with($success);
    }

    public function change_status(Request $request)
    {

        $comment = Comment::findOrFail($request->id);
        $comment->status = $request->status;

        $comment->save();

        return response()->json(['success'=>'Status change successfully.']);

    }

}