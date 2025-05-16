<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Import model Book
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    // Method untuk menampilkan semua buku
    public function index()
    {
        $books = Book::latest()->paginate(5); // Ambil 5 data terbaru
        return view('books.index', compact('books')); // Kirim data ke view
        dd($books);
    }
        

    // Method untuk menampilkan form tambah buku
    public function create()
    {
        return view('books.create'); // Tampilkan form tambah buku
    }

    // Method untuk menyimpan buku baru
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

    // Method untuk menampilkan detail buku
    public function show(string $id)
    {
        $book = Book::findOrFail($id); // Ambil data buku berdasarkan ID
        return view('books.show', compact('book')); // Tampilkan detail buku
    }

    // Method untuk menampilkan form edit buku
    public function edit(string $id)
    {
        $book = Book::findOrFail($id); // Ambil data buku berdasarkan ID
        return view('books.edit', compact('book')); // Tampilkan form edit buku
    }

    // Method untuk memperbarui data buku
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'publisher' => 'nullable|string|max:100',
            'year' => 'required|integer|min:1900|max:'.date('Y'),
            'isbn' => [
                'required',
                'string',
                Rule::unique('books')->ignore($book->id)
            ],
            'stock' => 'required|integer|min:1'
        ]);

        // Debug data sebelum update
        logger()->info('Data sebelum update:', $book->toArray());
        logger()->info('Data validasi:', $validatedData);

        $book->update($validatedData);

        // Debug data setelah update
        $updatedBook = Book::find($book->id);
        logger()->info('Data setelah update:', $updatedBook->toArray());

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui!'); // Redirect ke halaman index
    }

    // Method untuk menghapus buku`
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')
        ->with('success', 'Buku berhasil dihapus!');
    }
}
