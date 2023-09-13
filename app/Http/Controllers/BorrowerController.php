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
    public function store(Request $request)
    {
        $request->validate([
            'pinjam' => 'required|numeric|gt:0',
            'return_date' => 'required|date|before_or_equal:' . date('Y-m-d', strtotime('+1 month')),
        ]);
        try {
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
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Ada masalah saat meminjam buku!'], 500);
        }
    }

    public function update(UpdateBorrowerRequest $request, Borrower $borrower)
    {
        $request->validate([
            'pinjam' => 'required|numeric|gt:0',
            'return_date' => 'required|date|before_or_equal:' . date('Y-m-d', strtotime('+1 month')),
        ]);
        try {
            $bookName = $borrower->book->title;


            $bookId = $request->input('book_id');
            $borId = $request->input('bor_id');
            $borId = User::where('name', $borId)->first()->id;
            $pinjam = $request->input('pinjam');
            $returnDate = $request->input('return_date');

            $borrower->borrow_date = now('Asia/Jakarta');
            $borrower->loan_amount = $pinjam;
            $borrower->return_date = $returnDate;
            $borrower->book_id = $bookId;
            $borrower->user_id = $borId;

            if ($borrower->isDirty()) {
                $borrower->save();
                return response()->json(['message' => "Berhasil meupdate peminjaman buku $bookName"], 200);
            } else {
                return response()->json(['message' => 'Anda tidak melakukan perubahan apaun pada data peminjaman anda'], 204);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Ada kegagalan saat meupdate peminjaman'], 500);
        }
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