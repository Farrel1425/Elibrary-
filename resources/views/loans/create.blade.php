@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Peminjaman Buku Baru</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('loans.store') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="book_id" class="form-label">Buku <span class="text-danger">*</span></label>
                            <select class="form-select" id="book_id" name="book_id" required>
                                <option value="">Pilih Buku</option>
                                @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} (Stok: {{ $book->stock }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="member_id" class="form-label">Anggota <span class="text-danger">*</span></label>
                            <select class="form-select" id="member_id" name="member_id" required>
                                <option value="">Pilih Anggota</option>
                                @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->member_id }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="due_date" name="due_date" 
                                   value="{{ old('due_date', Carbon\Carbon::today()->addWeek()->format('Y-m-d')) }}"
                                   min="{{ Carbon\Carbon::today()->addDay()->format('Y-m-d') }}" required>
                            <small class="text-muted">Minimal 1 hari dari sekarang</small>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Peminjaman
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection