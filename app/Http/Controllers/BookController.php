<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate(['nama', 'penulis', 'harga', 'rating', 'gambar', 'type']);

        $getGambar = $request->file('gambar');
        $gambar = time() . '.' . $getGambar->getClientOriginalExtension();
        $getGambar->move(public_path('upload'), $gambar);

        $buku = new book();
        $buku->nama = $request->nama;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->type = $request->type;
        $buku->kualitas = $request->rating;
        $buku->gambar = $gambar;
        $buku->save();

        if ($buku->save()) {
            return back()->with('success', 'Produk berhasil Ditambahkan.');
        }
        return back()->with('gagal', 'produk gagal di tambahkan.');

        // dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, book $book)
    {
        $request->validate(['nama', 'penulis', 'harga', 'rating', 'gambar', 'type']);

        // $buku = book::findOrFail($book);

        // Update fields
        $book->nama = $request->nama;
        $book->penulis = $request->penulis;
        $book->harga = $request->harga;
        $book->type = $request->type;
        $book->kualitas = $request->rating;

        // Handle image upload if a new image is provided
        if ($request->hasFile('gambar')) {

            if ($book->gambar && file_exists(public_path('upload/' . $book->gambar))) {
                unlink(public_path('upload/' . $book->gambar));
            }

            $getGambar = $request->file('gambar');
            $gambar = time() . '.' . $getGambar->getClientOriginalExtension();
            $getGambar->move(public_path('upload'), $gambar);
            $book->gambar = $gambar;
        }
        $book->save();

        return back()->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(book $book)
    {
        // $book = Book::findOrFail($id);
        if (file_exists(public_path('upload/' . $book->gambar))) {
            unlink(public_path('upload/' . $book->gambar));
        }
        $book->delete();

        return back()->with('success', 'Item ini berhasil dihapus.');
    }
}
