<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // search
    public function search(Request $category_name)
    {
        $categories = Category::where('name', 'LIKE', '%' . $category_name->query()['query'] . '%')->get();
        return view('categories.search', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('message', [
            'title' => "Berhasil!",
            'text' => "Berhasil menambah kategori " . $request->name
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $categories = Category::with('book')->findOrFail($id);
        return view('categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        $name = $category->name;
        $category->name = $request->name;

        if ($category->isDirty()) {
            $category->save();
            return redirect()->route('categories.show', $category->id)->with('message', [
                'title' => "Berhasil",
                'text' => "Berhasil meupdate kategori $name menjadi $request->name"
            ]);
        } else {
            return redirect()->route('categories.show', $category->id)->with('message', [
                'icon' => 'info',
                'title' => "Tidak ada perubahan!",
                'text' => "Anda tidak melakukan perubahan pada kategori " . $name
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $name = $category->name;

        if ($category->book()->exists()) {
            return redirect()->route('categories.show', $category->id)->with('message', [
                'icon' => 'error',
                'title' => "Gagal!",
                'text' => "Penerbit $name masih terhubung dengan data lain."
            ]);
        }

        $category->delete();
        return redirect()->route('categories.index')->with('message', [
            'title' => "Berhasil",
            'text' => "Berhasil mehapus kategori " . $name
        ]);
    }
}