<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Http\Requests\StoreBorrowerRequest;
use App\Http\Requests\UpdateBorrowerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $borrowers = Borrower::with('book', 'user')->whereHas('user', function ($query) {
        //     $query->where('name', Auth::user()->name);
        // })->get();
        $borrowers = Borrower::with('book', 'user')->get();
        return view('borrowers.index', compact('borrowers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinjam' => 'required|numeric|gt:0',
            'return_date' => 'required|date|after:today|before_or_equal:' . date('Y-m-d', strtotime('+1 month')),
        ]);

        $bookId = $request->input('book_id');
        $borId = $request->input('bor_id');
        $borId = User::where('name', $borId)->first()->id;
        $pinjam = $request->input('pinjam');
        $returnDate = $request->input('return_date');

        $borrower = new Borrower;
        $borrower->borrow_date = now('Asia/Jakarta');
        $borrower->loan_amount = $pinjam;
        $borrower->return_date = $returnDate;
        $borrower->book_id = $bookId;
        $borrower->user_id = $borId;
        $borrower->save();

        return response()->json(['message' => 'Peminjam berhasil ditambahkan'], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Borrower $borrower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrower $borrower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowerRequest $request, Borrower $borrower)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrower $borrower)
    {
        $nameUser = $borrower->user->name;
        $pinjamnya = $borrower->book->title;
        $borrower->delete();

        return redirect()->route('borrower.index')->with('message', [
            'title' => "Berhasil!",
            'text' => "Berhasil mengapus Peminjam: $nameUser yang meminjam buku $pinjamnya"
        ]);
    }
}