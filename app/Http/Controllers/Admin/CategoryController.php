<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::query();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $path = imagePath('category', $row->image);
                    return '<img src="' . $path . '" width="70px" alt="image">';
                })
                ->addColumn('is_active', function ($row) {
                    return view('button', ['type' => 'is_active', 'route' => route('admin.categories.is_active', $row->id), 'row' => $row->is_active]);

                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.categories.edit', $row->id), 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.categories.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['image', 'is_active', 'action'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    function status(Category $category)
    {
        $category->is_active = $category->is_active  == 1 ? 0 : 1;
        try {
            $category->save();
            return response()->json(['message' => 'The status has been updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = imgWebpStore($request->image, 'category', [150, null]);
        }

        try {
            Category::create($data);
            return response()->json(['message' => 'The information has been inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again.'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $category)
    {
        if ($request->ajax()) {
            $modal = view('admin.category.edit')->with(['category' => $category])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $image = $category->image;
        if ($request->hasFile('image')) {
            $data['image'] = imgWebpUpdate($request->image, 'category', [150, null], $image);
        }
        try {
            $category->update($data);
            return response()->json(['message' => 'The information has been updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            imgUnlink('category', $category->image);
            SubCategory::where('category_id', $category->id)->delete();
            $category->delete();
            return response()->json(['message' => 'The information has been deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again'], 500);
        }
    }
}
