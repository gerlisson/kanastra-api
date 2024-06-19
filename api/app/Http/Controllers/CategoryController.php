<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct(private Category $category)
    {
    }

    public function index()
    {
        return response()->json($this->category->all());
    }

    public function show($id)
    {
        $category = $this->category->find($id);

        return response()->json($category);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json([
            'message' => 'Category created successfully', 
            'data' => $category
        ], 201);
    }

    public function update($id, Request $request)
    {
        $category = $this->category->find($id);

        $category->update($request->all());

        return response()->json([
            'message' => 'Category updated successfully', 
            'data' => $category
        ], 200);
    }

    public function destroy($id, Request $request)
    {
        $category = $this->category->find($id);

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
