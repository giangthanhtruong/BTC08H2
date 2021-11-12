<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categorys.list', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categorys.create', compact('categories'));
    }

    public function edit(Request $request , $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index');
    }

    public function update($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categorys.update', compact('category'));
    }

    public function delete(Request $request)
    {
        try {
            $categoryId = $request->categoryId;
            Category::destroy($categoryId);
            $data = [
                'status' => 'success',
                'message' => 'Xoá thành công!'
            ];
        }catch (\Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => 'Lỗi hệ thống!'
            ];
        }

        return response()->json($data);
    }

}
