<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function addSlider()
    {
        return view('admin.add_slider');
        
    }

    public function allSliders()
    {
        return view('admin.all_sliders');
    }
}
