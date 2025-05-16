@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit Anggota: {{ $member->name }}</h3>
        </div>
        
        <div class="card-body">
            <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="member_id" class="form-label">ID Anggota <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="member_id" name="member_id" 
                                   value="{{ old('member_id', $member->member_id) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $member->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $member->email) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="{{ old('phone', $member->phone) }}" required
                                   pattern="^08[0-9]{9,}$">
                            <small class="text-muted">Format: 08xxxxxxxxxx</small>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Anggota <span class="text-danger">*</span></label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="siswa" {{ old('type', $member->type) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="mahasiswa" {{ old('type', $member->type) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="guru" {{ old('type', $member->type) == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="staff" {{ old('type', $member->type) == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="umum" {{ old('type', $member->type) == 'umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="join_date" class="form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="join_date" name="join_date" 
                                   value="{{ old('join_date', $member->join_date->format('Y-m-d')) }}" 
                                   max="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $member->address) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            @if($member->photo_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="Foto Profil" class="img-thumbnail" width="100">
                                    <small class="d-block text-muted">Foto saat ini</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection