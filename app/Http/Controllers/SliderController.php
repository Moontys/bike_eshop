<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SliderController extends Controller
{


    public function allSliders(): View
    {
        $sliders = Slider::All();

        return view('admin.all_sliders')->with('allSliders', $sliders);
    }


    public function addSlider(): View
    {
        return view('admin.add_slider');
    }


    public function saveAddedSlider(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
        [
            'slider_description1' => 'required',
            'slider_description2' => 'required',
            'slider_image' => 'image|nullable|max:199999|required',
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


    public function editSlider(int $id)
    {
        $sliderById = Slider::find($id);

        return view('admin.edit_slider')->with('sliderByUrlId', $sliderById);
    }


    public function updateEditedSlider(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
        [
            'slider_description1' => 'required',
            'slider_description2' => 'required',
            'slider_image' => 'image|nullable|max:1999999',
        ]);

        $updateSliderByHiddenId = Slider::find($request->input('id'));    // finds hidden "id" in the "edit_slider.blade.php"

        $updateSliderByHiddenId->slider_description1 = $request->input('slider_description1');
        $updateSliderByHiddenId->slider_description2 = $request->input('slider_description2');

        if ($request->hasFile('slider_image'))
            {
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

            Storage::delete('public/slider_images/' . $updateSliderByHiddenId->slider_image);

            $updateSliderByHiddenId->slider_image = $fileNameToStore;
        }
        $updateSliderByHiddenId->update();

        return redirect('/all-sliders')->with('status', 'The Slider Updated Successfully');
    }



    public function deleteSlider(int $id): RedirectResponse
    {
        $deleteSliderByUrlId = Slider::find($id);

        Storage::delete('public/slider_images/' . $deleteSliderByUrlId->slider_image);

        $deleteSliderByUrlId->delete();

        return redirect('/all-sliders')->with('status', 'The Slider Deleted Successfully');
    }



    public function activateSlider(int $id): RedirectResponse
    {
        $activateSliderByUrlId = Slider::find($id);

        $activateSliderByUrlId->slider_status = 1;

        $activateSliderByUrlId->update();

        return back()->with('status', 'The Slider Activated Successfully');
    }




    public function unactivateSlider(int $id): RedirectResponse
    {
        $unactivateSliderByUrlId = Slider::find($id);

        $unactivateSliderByUrlId->slider_status = 0;

        $unactivateSliderByUrlId->update();

        return back()->with('status', 'The Slider Unactivated Successfully');
    }
}



