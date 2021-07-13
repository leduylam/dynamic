<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\AddBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::where('status', 1)->get();
        $banners = json_decode(json_encode($banners));
        // echo "<pre>"; print_r($banners); die;
        return view('backend.banner.index', compact('banners'));
    }

    public function create(){
        return view('backend.banner.create');
    }
    public function store(AddBannerRequest $request){
        $data = $request->all();
        // dd($data);
        if(!empty($data['image'])){
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            
            $filepath = $name;
            \Storage::disk('s3')->put('banner/'.$filepath, file_get_contents($file));
            $image = $name;
        }

        $data['image'] = !empty($image) ? $image : null;
        $data['status'] = 1;
        Banner::create($data);

        return redirect()->route('admin.banner.index')->with('success', 'Banner created successfully.');
        // echo "<pre>"; print_r($data); die;
    }
}
