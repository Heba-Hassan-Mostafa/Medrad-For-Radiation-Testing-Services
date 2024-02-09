<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\Users\UserRequest;
use App\Http\Requests\Admin\Users\UpdateProfileRequest;
use App\Http\Requests\Admin\Users\UpdatePasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::latest()->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(['id','name']);

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user = User::create($request->validated());

        $photo = new Image();
        if($image= $request->file('image'))
        {
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Users/', $img , 'upload_attachments');

                $photo->file_name = $img;

        }

        $user->image()->create([
            'file_name'=>$photo->file_name,
        ]);


       $user->markEmailAsVerified();  //to make email_verified_at
       $user->assignRole($request->input('roles'));


       $success=[
        'message'=>trans('messages.stored'),
        'alert-type'=>'success'
        ];
        return redirect()->route('admin.users.index')->with($success);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get(['id','name']);
        $userRole = $user->roles->pluck('id','name')->toArray();
        return view('admin.users.edit' , compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $user = User::findOrFail($id);

        $user->update($request->validated());


            if($image= $request->file('image'))
            {
            if(!empty($user->image->file_name)){

                if(File::exists('Files/image/Users/'. $user->image->file_name))
                {
                unlink('Files/image/Users/'. $user->image->file_name);
                }
            }
                $img = $image->getClientOriginalName();
                $image->storeAs('image/Users/', $img , 'upload_attachments');

                $user->image->file_name = $img;

            }

        $user->image()->update([
            'file_name'=>$user->image->file_name,
        ]);

       DB::table('model_has_roles')->where('model_id',$id)->delete();
       $user->assignRole($request->input('roles'));

       $success=[
        'message'=>trans('messages.updated'),
        'alert-type'=>'success'
    ];

    return redirect()->route('admin.users.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $success=[
            'message'=>trans('messages.deleted'),
            'alert-type'=>'error'
        ];

        return redirect()->route('admin.users.index')->with($success);

    }


    public function change_status(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->status = $request->status;

        $user->save();


        return response()->json(['success'=>'Status change successfully.']);

   }

   public function change_password()
   {
       return view('admin.users.change-password' );
   }

   public function update_password(UpdatePasswordRequest $request)
   {


       if(!Hash::check($request->old_password, auth()->user()->password)){
        return back()->with("error", trans('messages.password-not-match'));
        }

        User::whereId(auth()->user()->id)->update([
            'password' => bcrypt($request->new_password)
        ]);

           $success=[
            'message'=>trans('messages.updated'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.dashboard')->with($success);

   }

   public function profile()
   {
       return view('admin.users.profile');
   }



   public function update_profile(UpdateProfileRequest $request)
   {

    $user = User::findOrFail(auth()->id());

    $user->update($request->validated());


    if($image= $request->file('image'))
    {
    if(!empty($user->image->file_name)){

        if(File::exists('Files/image/Users/'. $user->image->file_name))
        {
        unlink('Files/image/Users/'. $user->image->file_name);
        }
    }
        $img = $image->getClientOriginalName();
        $image->storeAs('image/Users/', $img , 'upload_attachments');

        $user->image->file_name = $img;

    }

        $user->image()->update([
            'file_name'=>$user->image->file_name,
        ]);


       if ($user) {
        $success=[
            'message'=>trans('messages.updated'),
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.dashboard')->with($success);
       }
   }
}