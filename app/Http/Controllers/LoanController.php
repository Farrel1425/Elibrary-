<?php

namespace App\Http\Controllers;

use App\Models\{Loan, Member, Book};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // Hanya tampilkan ke petugas/admin
    public function __construct()
    {
        $this->middleware('can:isLibrarianOrAdmin');
    }

    // Form peminjaman
    public function create()
    {
        $members = Member::all();
        $books = Book::where('stock', '>', 0)->get(); // Hanya tampilkan buku yang tersedia
        return view('loans.create', compact('members', 'books'));
    }

    // Proses peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        // Kurangi stok buku
        $book = Book::find($request->book_id);
        $book->decrement('stock');

        // Catat peminjaman
        Loan::create([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'librarian_id' => Auth::id(), // Petugas yang login
            'loan_date' => now(),
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil!');
    }

    // Proses pengembalian buku
    public function returnBook(Loan $loan)
    {
        // Update status dan tanggal pengembalian
        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        // Kembalikan stok buku
        $loan->book->increment('stock');

        // Hitung denda jika terlambat (contoh: Rp1000/hari)
        if ($loan->due_date < now()) {
            $daysLate = now()->diffInDays($loan->due_date);
            $loan->update(['fine' => $daysLate * 1000]);
        }

        return back()->with('success', 'Buku telah dikembalikan!');
    }
}

