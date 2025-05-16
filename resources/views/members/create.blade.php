<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Tambah Anggota Baru</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('members.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="member_id" class="form-label">ID Anggota</label>
                            <input type="text" class="form-control" id="member_id" name="member_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Anggota</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="siswa">Siswa</option>
                                <option value="guru">Guru</option>
                                <option value="staff">Staff</option>
                                <option value="umum">Umum</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="join_date" class="form-label">Tanggal Bergabung</label>
                            <input type="date" class="form-control" id="join_date" name="join_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                </div>
                <!-- Tambahkan field lainnya -->
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection