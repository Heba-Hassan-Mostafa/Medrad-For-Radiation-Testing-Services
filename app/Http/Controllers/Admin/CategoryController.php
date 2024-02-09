<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index',compact('categories'));
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
    public function store(CategoryRequest $request)
    {
        try {
            $request->validated();

           $category = new Category();
           $category->name =['en' => $request->name_en , 'ar' => $request->name];
           $category->slug  =  $request->name_en;
           $category->status = $request->status;
           $category->category_type = $request->category_type;

           $category->save();
             $success=[
                 'message'=>trans('messages.stored'),
                 'alert-type'=>'success'
             ];

             return redirect()->route('admin.categories.index')->with($success);

         }  catch (Exception $e) {
             return redirect()->back()->with(['error' => $e->getMessage()]);
        }
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
    public function update(CategoryRequest $request, string $id)
    {
        try {
               $request->validated();
            $category = Category::findOrFail($id);

            $data['name'] = ['ar' => $request->name, 'en' => $request->name_en];
            $data['slug'] =  $request->name_en;
            $category->status = $request->status;
            $category->category_type = $request->category_type;

          $category->update($data);
          $category->save();

            $success=[
                'message'=>trans('messages.updated'),
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.categories.index')->with($success);

        }  catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Category::findOrFail($id)->delete();
       $success=[
        'message'=>trans('messages.deleted'),
        'alert-type'=>'success'
    ];

    return redirect()->route('admin.categories.index')->with($success);
    }
}