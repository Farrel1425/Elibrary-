<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Import model Book


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(5); // Ambil 5 data terbaru
        return view('books.index', compact('books')); // Kirim data ke view
        dd($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create'); // Tampilkan form tambah buku
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|unique:books,isbn',
            'stock' => 'required|integer|min:0',
        ]);

        Book::create($validated); // Simpan data buku baru
        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!'); // Redirect ke halaman index
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id); // Ambil data buku berdasarkan ID
        return view('books.show', compact('book')); // Tampilkan detail buku
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id); // Ambil data buku berdasarkan ID
        return view('books.edit', compact('book')); // Tampilkan form edit buku
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|unique:books,isbn,' . $id,
            'stock' => 'required|integer|min:0',
        ]);

        $book = Book::findOrFail($id); // Ambil data buku berdasarkan ID
        $book->update($validated); // Update data buku
        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui!'); // Redirect ke halaman index
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id); // Ambil data buku berdasarkan ID
        $book->delete(); // Hapus data buku
        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!'); // Redirect ke halaman index
    }
}
