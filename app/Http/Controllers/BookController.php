<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('books.create', compact('categories', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $fileName = $request->file('thumbnail')->hashName();

        $request->thumbnail->storeAs('public/image/thumbnail-book', $fileName);

        $book = new Book;
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->thumbnail = $fileName;
        $book->description = $request->description;
        $book->category_id = $request->categories;
        $book->author_id = $request->author;
        $book->publisher_id = $request->publisher;
        $book->save();

        return to_route('books.index')->with('message', [
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
    public function edit($book)
    {
        $book = Book::with('category', 'author', 'publisher')->where('id', $book)->first();
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('books.edit', compact('book', 'categories', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $fileName = $book->thumbnail;
        $title = $book->title;

        // proses meupdate thumbnail buku

        if ($request->file('thumbnail')) {
            $fileName = $request->file('thumbnail')->hashName();
            $path = storage_path('public/image/thumbnail-book/' . $book->thumbnail);
            if ($path) {
                Storage::delete($path);
            }
            $request->thumbnail->storeAs('public/image/thumbnail-book', $fileName);
        }

        $book->thumbnail = $fileName;
        $book->description = $request->description;
        $book->category_id = $request->categories;
        $book->author_id = $request->author;
        $book->publisher_id = $request->publisher;

        if ($book->isDirty()) {
            $book->save();

            return to_route('books.show', $book->id)->with('message', [
                'title' => "Berhasil!",
                'text' => "Berhasil meupdate buku $title"
            ]);
        } else {
            return to_route('books.show', $book->id)->with('message', [
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
        return to_route('books.index')->with('message', [
            'title' => "Berhasil",
            'text' => "Berhasil mehapus buku " . $title
        ]);
    }


    // ! mengatur komentar
    public function commentStore(Request $request, Comment $comment)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'comment_value' => "required|string|max:2000",
            'rating' => "required|integer|max:5"
        ]);

        $buku = Book::where('id', $request->book_id)->first();

        $comment->user_id = User::where('name', Auth::user()->name)->first()->id;
        $comment->book_id = $buku->id;
        $comment->comment_value = $request->comment_value;
        $comment->rating = $request->rating;
        $comment->save();

        return redirect()->back()->with('message', [
            'title' => "Berhasil!",
            'text' => "Berhsail Berkomentar pada buku {$buku->title}"
        ]);
    }

    public function commentUpdate(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|integer|exists:comments,book_id',
            'comment_value' => 'required|string|max:2000',
            'rating' => 'required|integer|max:5',
        ]);

        if ($validator->fails()) {
            $err = '';
            foreach ($validator->errors()->all() as $i => $error) {
                $err .= ++$i . " $error ";
            }
            return redirect()->back()->with('message', [
                'icon' => 'error',
                'title' => "Gagal",
                'text' => "Gagal karena validasi: " . $err
            ]);
        }

        // Perbarui data komentar
        $comment->comment_value = $request->comment_value;
        $comment->rating = $request->rating;

        if ($comment->isDirty(['comment_value', 'rating'])) {
            $comment->save();
            return redirect()->back()->with('message', [
                'title' => "Berhasil!",
                'text' => "Berhasil meupdate komentar"
            ]);
        } else {
            return redirect()->back()->with('message', [
                'info' => "info",
                'title' => "Tidak ada perubahan!",
                'text' => "Anda tidak melakukan perubahan pada komentar anda!"
            ]);
        }
    }

    public function commentDelete(Comment $comment)
    {
        $comment_value = $comment->comment_value;
        $comment_book = $comment->book->title;

        $comment->delete();
        return redirect()->back()->with('message', [
            'title' => "Berhasil!",
            'text' => "Berhasil menghapus komentar pada buku $comment_book dengan isi komentar $comment_value"
        ]);
    }
}