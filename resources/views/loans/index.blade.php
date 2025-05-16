@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Daftar Peminjaman</h3>
            <a href="{{ route('loans.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> Peminjaman Baru
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->member->name }}</td>
                            <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                            <td class="{{ Carbon\Carbon::today()->gt($loan->due_date) && !$loan->return_date ? 'text-danger fw-bold' : '' }}">
                                {{ $loan->due_date->format('d/m/Y') }}
                            </td>
                            <td>
                                @if($loan->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @elseif($loan->status == 'terlambat')
                                    <span class="badge bg-danger">Terlambat</span>
                                @else
                                    <span class="badge bg-success">Kembali</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($loan->status == 'dipinjam')
                                <form action="{{ route('loans.return', $loan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pengembalian?')">
                                        <i class="fas fa-book"></i> Kembalikan
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection