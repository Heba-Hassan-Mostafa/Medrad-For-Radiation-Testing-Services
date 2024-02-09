<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\TeamManagment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\TeamRequest;

class TeamManagmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = TeamManagment::latest()->get();
        return view("admin.team-managment.index", compact("members"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        $request->validated();
        $member = new TeamManagment();
        $member->name = $request->name;
        $member->position = $request->position;
        $member->gender = $request->gender;
        $member->save();

        $photo = new Image();
        if($image= $request->file('image'))
        {
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Team/', $img , 'upload_attachments');

                $photo->file_name = $img;

            }

        $member->image()->create([
            'file_name'=>$photo->file_name,
        ]);

        $success=[
            'message'=>trans('messages.stored'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.team_managment.index')->with($success);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, string $id)
    {
        $request->validated();
        $member = TeamManagment::findOrFail($id);

         $data['name']     = $request->name;
         $data['position'] = $request->position;
         $data['gender']   = $request->gender;

         $member->update($data);

         $member->save();

        if($image= $request->file('image'))
        {
            if(!empty($member->image->file_name)){

                if(File::exists('Files/image/Team/'. $member->image->file_name))
                {
                unlink('Files/image/Team/'. $member->image->file_name);
                }
            }
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Team/', $img , 'upload_attachments');

                $member->image->file_name = $img;

            }

        $member->image()->update([
            'file_name'=> $member->image->file_name,
        ]);

        $success=[
            'message'=>trans('messages.updated'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.team_managment.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = TeamManagment::findOrFail($id);
        $member->image->delete();
        if(!empty($member->image->file_name)){

            if(File::exists('Files/image/Team/'. $member->image->file_name))
            {
            unlink('Files/image/Team/'. $member->image->file_name);
            }
        }
        $member->delete();

        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.team_managment.index')->with($success);
    }

    public function change_status(Request $request)
    {

        $comment = TeamManagment::findOrFail($request->id);
        $comment->status = $request->status;

        $comment->save();


        return response()->json(['success'=>'Status change successfully.']);



    }
}
