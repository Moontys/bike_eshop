<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{


    public function allSliders()
    {
        return view('admin.all_sliders');
    }



    public function addSlider()
    {
        return view('admin.add_slider');
        
    }



    public function saveAddedSlider(Request $request)
    {
        $this->validate($request, [
            'slider_description1' => 'required',
            'slider_description2' => 'required',
            'slider_image' => 'image|nullable|max:1999|required'
        ]);

        $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('slider_image')->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
        // Upload image
        $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

    
        $slider = new Slider();
        $slider->slider_description1 = $request->input('slider_description1');
        $slider->slider_description2 = $request->input('slider_description2');
        $slider->slider_image = $fileNameToStore;
        $slider->slider_status = 1;
    
        $slider->save();
    
        return back()->with('status', 'The Slider Added Successfully');
    }

}
