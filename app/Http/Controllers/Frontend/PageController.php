<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::whereIsActive(1)->get();
        $data['categories'] = Category::whereIsActive(1)->get();
        $data['productCategories'] = Category::with([
            'products' => fn ($q) => $q->select('category_id', 'name', 'image', 'price')
        ])->select('id', 'name')->where('is_active', 1)->get();
        $data['products'] = Product::where('is_active', 1)->limit(8)->get();
        return view('frontend.index', $data);
    }

    public function subCategory($catId)
    {
        $subCategories = SubCategory::whereCategoryId($catId)->get();
        return view('frontend.sub-category', compact('subCategories'));
    }

    public function productBySubCategory($subCatId)
    {
        $products = Product::whereSubCategoryId($subCatId)->get();
        return view('frontend.product-by-sub-category', compact('products'));
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
