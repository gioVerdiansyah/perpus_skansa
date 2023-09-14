<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
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
}