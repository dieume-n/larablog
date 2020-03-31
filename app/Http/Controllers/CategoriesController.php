<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store()
    {
        Category::create($this->validateCategory());
        session()->flash('success', 'Category created successfully');
        return redirect(route('categories.index'));
    }

    public function edit(Category $category)
    {
        return view('categories.create', compact('category'));
    }

    public function update(Category $category)
    {
        $category->update($this->validateCategory());
        session()->flash('success', 'Category updated successfully.');
        return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'Category deleted successfully.');
        return redirect(route('categories.index'));
    }

    protected function validateCategory()
    {
        return request()->validate([
            'name' => 'required|unique:categories'
        ]);
    }
}
