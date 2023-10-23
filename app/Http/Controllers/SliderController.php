<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SliderController extends Controller
{


    public function allSliders()
    {
        $allSliders = Slider::All();

        return view('admin.all_sliders')->with('allSlidersFromTable', $allSliders);
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
            'slider_image' => 'image|nullable|max:199999|required'
        ]);

        $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('slider_image')->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
        // Upload image
        $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

        $newSlider = new Slider();
        $newSlider->slider_description1 = $request->input('slider_description1');
        $newSlider->slider_description2 = $request->input('slider_description2');
        $newSlider->slider_image = $fileNameToStore;
        $newSlider->slider_status = 1;
    
        $newSlider->save();
    
        return back()->with('status', 'The Slider Added Successfully');
    }


    public function editSlider($id)
    {
        $sliderFromTable = Slider::find($id);

        return view('admin.edit_slider')->with('sliderFromTableById', $sliderFromTable);
    }



    public function updateEditedSlider(Request $request)
    {
        $this->validate($request, [
            'slider_description1' => 'required',
            'slider_description2' => 'required',
            'slider_image' => 'image|nullable|max:1999999'
        ]);

        $sliderFromTable = Slider::find($request->input('id'));

        $sliderFromTable->slider_description1 = $request->input('slider_description1');
        $sliderFromTable->slider_description2 = $request->input('slider_description2');

        if ($request->hasFile('slider_image'))
            {
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

            Storage::delete('public/slider_images/' . $sliderFromTable->slider_image);

            $sliderFromTable->slider_image = $fileNameToStore;
        }
        $sliderFromTable->update();

        return redirect('/all-sliders')->with('status', 'The Slider Updated Successfully');
    }



    public function deleteSlider($id)
    {
        $sliderFromTable = Slider::find($id);

        Storage::delete('public/slider_images/' . $sliderFromTable->slider_image);

        $sliderFromTable->delete();

        return redirect('/all-sliders')->with('status', 'The Slider Deleted Successfully');
    }



    public function activateSlider($id)
    {
        $sliderFromTable = Slider::find($id);

        $sliderFromTable->slider_status = 1;

        $sliderFromTable->update();

        return back()->with('status', 'The Slider Activated Successfully');
    }




    public function unactivateSlider($id)
    {
        $sliderFromTable = Slider::find($id);

        $sliderFromTable->slider_status = 0;

        $sliderFromTable->update();

        return back()->with('status', 'The Product Unactivated Successfully');
    }

}



