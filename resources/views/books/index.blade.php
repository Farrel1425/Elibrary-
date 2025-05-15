@extends('layouts.app')

@section('content')
 <div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Daftar Buku</h3>
            <a href="{{ route('books.create') }}" class="btn btn-light">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

     <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th width="100">Tahun</th>
                            <th width="100">Stok</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                            <td>
                                <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                                    {{ Str::limit($book->title, 40) }}
                                </a>
                            </td>
                            <td>{{ Str::limit($book->author, 20) }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->year }}</td>
                            <td>
                                <span class="badge bg-{{ $book->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $book->stock }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus buku ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                   <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $books->firstItem() }} sampai {{ $books->lastItem() }} dari {{ $books->total() }} buku
                    </div>
                    <div>
                        {{ $books->links('vendor.pagination.bootstrap-5') }}
                    </div>


        </div>
    </div>

   
    </div>
  </div>
@endsection
