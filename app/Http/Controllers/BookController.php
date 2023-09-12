<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category', 'author', 'publisher')->get();

        return view('books.index', ['books' => $books]);
    }

    public function search(Request $book_name)
    {
        $books = Book::where('title', 'LIKE', '%' . $book_name->query()['query'] . '%')->get();
        return view('books.search', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // Cari penulis berdasarkan nama
        $author = Author::where('name', $request->author)->first();
        $category = Category::where('name', $request->categories)->first();
        $publisher = Publisher::where('name', $request->publisher)->first();

        // mengirim file buku dengan mengganti namanya dengan nama buku yang baru saja di inputkannya
        $fileName = time() . "-" . $request->thumbnail->getClientOriginalName();

        $request->thumbnail->move('image/thumbnail-book', $fileName);

        // Simpan buku dengan author_id yang sudah diproses
        $book = new Book;
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->thumbnail = $fileName;
        $book->description = $request->description;
        $book->category_id = $category->id;
        $book->author_id = $author->id;
        $book->publisher_id = $publisher->id;
        $book->save();

        return redirect()->route('books.index')->with('message', [
            'title' => 'Sukses',
            'text' => "Berhasil menambah buku " . $request->title
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->isbn = $request->isbn;
        $book->title = $request->title;

        $title = $book->title;
        // proses meupdate thumbnail buku


        if (is_null($request->thumbnail)) {
            $fileName = $book->thumbnail;
        } else {
            $fileName = time() . "-" . $request->thumbnail->getClientOriginalName();
            $path = public_path('image/thumbnail-book/' . $book->thumbnail);
            if (file_exists($path)) {
                unlink($path);
            }
            $request->thumbnail->move(public_path('image/thumbnail-book'), $fileName);
        }

        $book->thumbnail = $fileName;
        $book->description = $request->description;

        $category = Category::where('name', $request->categories)->first();
        $book->category_id = $category->id;

        $author = Author::where('name', $request->author)->first();
        $book->author_id = $author->id;

        $publisher = Publisher::where('name', $request->publisher)->first();
        $book->publisher_id = $publisher->id;

        // Memeriksa apakah ada perubahan pada model
        if ($book->isDirty()) {
            $book->save();

            // Redirect ke halaman tampilan buku yang diperbarui
            return redirect()->route('books.show', $book->id)->with('message', [
                'title' => "Berhasil!",
                'text' => "Berhasil meupdate buku $title"
            ]);
        } else {
            // Tidak ada perubahan, kembalikan respons tanpa menyimpan data
            return redirect()->route('books.show', $book->id)->with('message', [
                'icon' => 'info',
                'title' => "Tidak ada Perubahan!",
                'text' => "Anda tidak melakukan perubahan pada buku " . $title
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $title = $book->title;
        unlink(public_path('image/thumbnail-book/' . $book->thumbnail));
        $book->delete();
        return redirect()->route('books.index')->with('message', [
            'title' => "Berhasil",
            'text' => "Berhasil mehapus buku " . $title
        ]);
    }
}