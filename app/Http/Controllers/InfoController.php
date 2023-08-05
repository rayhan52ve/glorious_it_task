<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = Info::get();
        return view('Backend.modules.info.index',compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.modules.info.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2|string',
            ]
            );
        
            if($request->isMethod('post')){
                if ($request->hasFile('photo')) {
                    $image_tmp = $request->file('photo');
    
                    if ($image_tmp->isValid()) {
                        // Upload Images after Resize
                        $image_name = $image_tmp->getClientOriginalName();
                        // $extension = $image_tmp->getClientOriginalExtension();
                        // $fileName = $image_name . '-' . rand(111, 99999) . '.' . $extension;
                        $image_path = 'uploads/info' . '/' . $image_name;
    
                        Image::make($image_tmp)->resize(1000, 700)->save($image_path);
    
                    }
                }
    
                $info = new Info;
                $info->name = $request->name;
                $info->email = $request->email;
                $info->phone = $request->phone;
                $info->address = $request->address;
                $info->photo = $image_path;
                $info->save();
            }
        

        session()->flash('msg','Info Added Successfully');
        session()->flash('cls','success');
        return redirect()->route('info.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Info $info)
    {
        return view('Backend.modules.info.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Info $info)
    {
        $this->validate($request,[
            'name'=>'required|max:100|min:2|string',
            
            
            ],

            $message=[
                'name.required' => 'Please write a category name.',                
            ]
        );

        if($request->isMethod('PUT')){
            // $info  = Info::find($id);
            if ($request->hasFile('photo')) {
                $image_tmp = $request->file('photo');

                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    @unlink(public_path('uploads/info' .$info->photo));
                    $image_name = $image_tmp->getClientOriginalName();
                    // $extension = $image_tmp->getClientOriginalExtension();
                    // $fileName = $image_name . '-' . rand(111, 99999) . '.' . $extension;
                    $image_path = 'uploads/info' . '/' . $image_name;

                    Image::make($image_tmp)->resize(1000, 700)->save($image_path);

                } 
            }elseif($info->photo){
                $image_path = $info->photo;
            }

            
            $info->name = $request->name;
            $info->email = $request->email;
            $info->phone = $request->phone;
            $info->address = $request->address;
            $info->photo = $image_path;
            $info->update();
        }
        
        session()->flash('msg','Info Updated Successfully.');
        session()->flash('cls','success');
        return redirect()->route('info.index');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        // $info = Info::find($id);
        $image_path = public_path('uploads/info/' .$info->photo);
        if(file_exists($image_path))
        {
            unlink($image_path);
        }
        $info->delete();
        session()->flash('msg','Deleted Successfully.');
        session()->flash('cls','info');
        return redirect()->back();
    }
}
