@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Edit Data Buku</h3>
                <span class="badge bg-light text-dark fs-6">
                    ID: {{ $book->id }}
                </span>
            </div>
        </div>
        
        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" method="POST" id="bookForm">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $book->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Pengarang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                   id="author" name="author" value="{{ old('author', $book->author) }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="publisher" class="form-label">Penerbit</label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror" 
                                   id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}">
                            @error('publisher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                   id="year" name="year" value="{{ old('year', $book->year) }}" 
                                   min="1900" max="{{ date('Y') }}">
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                                   id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" name="stock" value="{{ old('stock', $book->stock) }}" min="1" required>
                                <span class="input-group-text">buku</span>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                    <div>
                        <button type="reset" class="btn btn-warning me-2">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span id="submitText">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </span>
                            <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');

    form.addEventListener('submit', function(e) {
        submitText.classList.add('d-none');
        loadingSpinner.classList.remove('d-none');
        submitBtn.disabled = true;
    });

    // Auto-format ISBN input
    const isbnInput = document.getElementById('isbn');
    if (isbnInput) {
        isbnInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9-]/g, '');
        });
    }
});
</script>
@endpush
@endsection