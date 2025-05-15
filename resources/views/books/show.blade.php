@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Detail Buku</h3>
        </div>
        
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Judul Buku:</div>
                <div class="col-md-8">{{ $book->title }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Pengarang:</div>
                <div class="col-md-8">{{ $book->author }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Penerbit:</div>
                <div class="col-md-8">{{ $book->publisher ?? '-' }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Tahun Terbit:</div>
                <div class="col-md-8">{{ $book->year ?? '-' }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">ISBN:</div>
                <div class="col-md-8">{{ $book->isbn }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Stok Tersedia:</div>
                <div class="col-md-8">{{ $book->stock }}</div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                
                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus buku ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Buku
        </a>
    </div>
</div>
@endsection