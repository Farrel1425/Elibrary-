@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Detail Anggota</h3>
                <span class="badge bg-light text-dark fs-6">
                    {{ strtoupper($member->type) }}
                </span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3 text-center">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 150px; height: 150px; margin: 0 auto; font-size: 3rem;">
                        <i class="fas fa-user text-secondary"></i>
                    </div>
                    <h5 class="mt-3">{{ $member->name }}</h5>
                    <p class="text-muted mb-0">ID: {{ $member->member_id }}</p>
                </div>
                
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">Informasi Kontak</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        {{ $member->email }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-phone me-2 text-primary"></i>
                                        {{ $member->phone }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        {{ $member->address }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">Informasi Keanggotaan</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                        Bergabung pada: {{ $member->join_date->format('d F Y') }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-clock me-2 text-primary"></i>
                                        Status: 
                                        <span class="badge bg-success">Aktif</span>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-book me-2 text-primary"></i>
                                        Total Peminjaman: 15 buku
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="mt-4">
                <h5 class="mb-3">Riwayat Peminjaman Terakhir</h5>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Judul Buku</th>
                                <th>Status</th>
                                <th>Dikembalikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15 Jan 2023</td>
                                <td>Pemrograman Laravel</td>
                                <td><span class="badge bg-success">Dikembalikan</span></td>
                                <td>20 Jan 2023</td>
                            </tr>
                            <!-- Data riwayat lainnya -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between">
                <a href="{{ route('members.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div>
                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus anggota ini?')">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection