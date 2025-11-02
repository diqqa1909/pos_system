<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Auth;

class CategoryController extends Controller
{
    public function index(Request $request){
        return view('category.list');
    }

    public function getCategories(Request $request){
        $categories = CategoryModel::all();
        return response()->json(['data' => $categories], 200);
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = new CategoryModel();
        $category->category_name = $request->input('category_name');
        $category->save();

        return response()->json(['success' => 'Category created successfully'], 201);
    }

    public function edit($id){
        $category = CategoryModel::find($id);
        if(!$category){
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json(['data' => $category], 200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = CategoryModel::find($id);
        if(!$category){
            return response()->json(['error' => 'Category not found'], 404);
        }

        $category->category_name = $request->input('category_name');
        $category->save();

        return response()->json(['success' => 'Category updated successfully'], 200);
    }

    public function delete($id){
        $category = CategoryModel::find($id);
        if(!$category){
            return response()->json(['error' => 'Category not found'], 404);
        }

        $category->delete();
        return response()->json(['success' => 'Category deleted successfully'], 200);
    }
}
