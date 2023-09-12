<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = new Author;
        $author->name = $request->name;
        $author->email = $request->email;
        $author->address = $request->address;
        $author->save();

        return redirect()->route('author.index')->with('message', [
            'title' => "Berhasil",
            'text' => "Berhasil menambah Penulis: " . $request->name
        ]);
    }

    public function search(Request $author_name)
    {
        $authors = Author::where('name', 'LIKE', '%' . $author_name->query()['query'] . '%')->get();
        return view('authors.search', compact('authors'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $name = $author->name;
        $author->name = $request->name;
        $author->email = $request->email;
        $author->address = $request->address;

        if ($author->isDirty()) {
            $author->save();
            return redirect()->route('author.show', $author->id)->with('message', [
                'title' => "Berhasil",
                'text' => "Berhasil meupdate Penulis $name menjadi $author->name"
            ]);
        } else {
            return redirect()->route('author.show', $author->id)->with('message', [
                'icon' => 'info',
                'title' => "Tidak Ada Perubahan!",
                'text' => "Anda tidak melakukan perubahan pada Penulis " . $name
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $name = $author->name;

        if ($author->book()->exists()) {
            return redirect()->route('author.show', $author->id)->with('message', [
                'icon' => 'error',
                'title' => "Gagal!",
                'text' => "Penerbit $name masih terhubung dengan data lain."
            ]);
        }

        $author->delete();
        return redirect()->route('author.index')->with('message', [
            'title' => "Berhasil",
            'text' => "Berhasil mehapus Penulis " . $name
        ]);
    }
}