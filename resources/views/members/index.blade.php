@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Daftar Anggota</h3>
            <a href="{{ route('members.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> Tambah Anggota
            </a>
        </div>

        <div class="card-body">
            
            <!-- Members Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>ID Anggota</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Tanggal Bergabung</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                        <tr>
                            <td>{{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}</td>
                            <td>{{ $member->member_id }}</td>
                            <td>{{ $member->name }}</td>
                            <td>
                                <span class="badge bg-{{ [
                                    'siswa' => 'info',
                                    'mahasiswa' => 'primary',
                                    'guru' => 'success',
                                    'staff' => 'warning',
                                    'umum' => 'secondary'
                                ][$member->type] }}">
                                    {{ ucfirst($member->type) }}
                                </span>
                            </td>
                            <td>{{ $member->join_date->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus anggota ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('members.show', $member->id) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data anggota</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $members->firstItem() }} sampai {{ $members->lastItem() }} 
                    dari {{ $members->total() }} anggota
                </div>
                
                <nav aria-label="Page navigation">
                    {{ $members->links('vendor.pagination.bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection