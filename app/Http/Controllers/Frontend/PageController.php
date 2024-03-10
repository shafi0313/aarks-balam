<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class PageController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::whereIsActive(1)->get();
        $data['categories'] = Category::whereIsActive(1)->get();
        return view('frontend.index', $data);
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }
}
