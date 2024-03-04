<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subCategories = SubCategory::with(['category']);
            return DataTables::of($subCategories)
                ->addIndexColumn()
                ->addColumn('is_active', function ($row) {
                    return view('button', ['type' => 'is_active', 'route' => route('admin.sub_categories.is_active', $row->id), 'row' => $row->is_active]);

                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.sub-categories.edit', $row->id), 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.sub-categories.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['image', 'is_active', 'action'])
                ->make(true);
        }
        $categories = Category::where('is_active', 1)->pluck('name', 'id')->prepend('Select Category', '')->toArray();
        return view('admin.sub-category.index', compact('categories'));
    }

    function status(SubCategory $subCategory)
    {
        $subCategory->is_active = $subCategory->is_active  == 1 ? 0 : 1;
        try {
            $subCategory->save();
            return response()->json(['message' => 'The status has been updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $data = $request->validated();

        try {
            SubCategory::create($data);
            return response()->json(['message' => 'The information has been inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again.'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SubCategory $subCategory)
    {
        if ($request->ajax()) {
            $modal = view('admin.sub-category.edit')->with(['subCategory' => $subCategory])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $data = $request->validated();
        try {
            $subCategory->update($data);
            return response()->json(['message' => 'The information has been updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();
            return response()->json(['message' => 'The information has been deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again'], 500);
        }
    }
}
