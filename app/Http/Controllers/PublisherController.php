<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publisher.create');
    }

    public function search(Request $publisher_name)
    {
        $publishers = Publisher::where('name', 'LIKE', '%' . $publisher_name->query()['query'] . '%')->get();
        return view('publisher.search', compact('publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublisherRequest $request)
    {
        $publisher = new Publisher;
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->email = $request->email;
        $publisher->phone = $request->phone;
        $publisher->website = $request->website;

        // tambah gambar
        $fileName = time() . "-" . $request->logo->getClientOriginalName();
        $request->logo->move('image/logo-publisher', $fileName);

        $publisher->logo = $fileName;
        $publisher->since = $request->since;
        $publisher->description = $request->description;
        $publisher->save();

        return redirect()->route('publisher.index')->with('message', [
            'title' => "Berhasil!",
            'text' => "Berhasil menambah Penerbit: " . $request->name
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $publisher = Publisher::with('book')->findOrFail($id);
        return view('publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        $name = $publisher->name;
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->email = $request->email;
        $publisher->phone = $request->phone;
        $publisher->website = $request->website;

        if (is_null($request->logo)) {
            $fileName = $publisher->logo;
        } else {
            $fileName = time() . "-" . $request->logo->getClientOriginalName();
            $path = public_path('image/logo-publisher/' . $publisher->logo);
            if (file_exists($path)) {
                unlink($path);
            }
            $request->logo->move('image/logo-publisher', $fileName);
        }

        $publisher->logo = $fileName;
        $publisher->since = $request->since;
        $publisher->description = $request->description;

        if ($publisher->isDirty()) {
            $publisher->save();
            return redirect()->route('publisher.index')->with('message', [
                'title' => "Berhasil!",
                'text' => "Berhasil meupdate Penerbit: $name"
            ]);
        } else {
            return redirect()->route('publisher.index')->with('message', [
                'icon' => 'info',
                'title' => "Tidak ada perubahan!",
                'text' => "Anda tidak melakukan perubahan pada Penerbit: " . $name
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $name = $publisher->name;

        if ($publisher->book()->exists()) {
            return redirect()->route('publisher.show', $publisher->id)->with('message', [
                'icon' => 'error',
                'title' => "Gagal!",
                'text' => "Penerbit $name masih terhubung dengan data lain."
            ]);
        }

        $publisher->delete();
        return redirect()->route('publisher.index')->with('message', [
            'title' => "Berhasil!",
            'text' => "Berhasil menghapus Penerbit $name"
        ]);
    }
}