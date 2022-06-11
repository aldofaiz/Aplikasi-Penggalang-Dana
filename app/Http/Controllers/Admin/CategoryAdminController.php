<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.content.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.content.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
    
        Category::create($request->all());
     
        return redirect()->route('admin.category.index')->with('success','Berhasil Membuat Kategori.');
    }

    public function show(Category $category)
    {
        return view('admin.content.category.show',compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.content.category.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
    
        $category->update($request->all());
    
        return redirect()->route('admin.category.index')->with('success','Berhasil Memperbarui Kategori.');
    }

    public function destroy(Category $category)
    {
        $category->delete();    
        return redirect()->route('admin.category.index')->with('success','Berhasil Menghapus Kategori.');
    }
}
