<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Auth;

class ProductController extends Controller
{
    public function index(Request $request){
        $category = CategoryModel::all()->pluck('category_name', 'id');
        return view('product.list', compact('category'));
    }

    
    public function store(Request $request){
        
        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'product_code' => 'required|string|max:255|unique:product,product_code',
            'product_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        ProductModel::create($validated);
        return response()->json(['message' => 'Product created successfully']);
        
    }

    public function fetchProducts(Request $request){
        $products = ProductModel::with('category')->get();
        return response()->json(['data' => $products]);
    }

    public function edit($id){
        $product = ProductModel::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:category,id', // Fixed table name (usually plural)
        'product_code' => 'required|string|max:255|unique:product,product_code,'.$id, // Added comma
        'product_name' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'purchase_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'discount' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    $product = ProductModel::findOrFail($id);
    $product->update($validated);
    
    return response()->json(['message' => 'Product updated successfully']);
}

    public function destroy($id){
        $product = ProductModel::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
            
            /* public function getCategories(Request $request){
                $categories = CategoryModel::all();
                return response()->json(['data' => $categories], 200);
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
    } */
}
