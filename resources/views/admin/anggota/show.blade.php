@extends('layouts.master')

@section('title', 'Detail Anggota - SIPERPUS')

@section('content')
<div class="content-wrapper">
    <section class="content-header pt-4 pb-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold text-dark">Profil Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">Data Pengguna</a></li>
                        <li class="breadcrumb-item active">Detail Profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Kolom Kiri: Kartu Profil -->
                <div class="col-md-4">
                    <div class="card card-primary card-outline shadow-sm">
                        <div class="card-body box-profile">
                            <div class="text-center mb-3">
                                @if($anggota->foto)
                                    <img class="profile-user-img img-fluid img-circle shadow-sm" src="{{ asset('storage/' . $anggota->foto) }}" alt="User profile picture" style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="profile-user-img img-fluid img-circle shadow-sm bg-light d-flex justify-content-center align-items-center mx-auto" style="width: 120px; height: 120px;">
                                        <i class="fas fa-user text-secondary" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                            </div>

                            <h3 class="profile-username text-center font-weight-bold">{{ $anggota->name }}</h3>
                            <p class="text-muted text-center mb-4">
                                {{ strtoupper($anggota->role) }} 
                                @if($anggota->tipe_anggota) - {{ ucfirst($anggota->tipe_anggota) }} @endif
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Status</b> 
                                    <span class="float-right badge 
                                        {{ $anggota->status == 'aktif' ? 'badge-success' : ($anggota->status == 'nonaktif' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ ucfirst($anggota->status) }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Bergabung Sejak</b> <span class="float-right text-muted">{{ $anggota->created_at->format('d M Y') }}</span>
                                </li>
                            </ul>

                            <a href="{{ route('admin.anggota.edit', $anggota->id) }}" class="btn btn-primary btn-block font-weight-bold"><b><i class="fas fa-edit mr-1"></i> Edit Profil</b></a>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Detail Informasi -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header p-2 bg-white">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active font-weight-bold" href="#informasi" data-toggle="tab"><i class="fas fa-info-circle mr-1"></i> Informasi Lengkap</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="informasi">
                                    <table class="table table-sm table-borderless">
                                        <tbody>
                                            <tr>
                                                <th style="width: 30%" class="text-muted">Username</th>
                                                <td>: {{ $anggota->username }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Email</th>
                                                <td>: {{ $anggota->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">NIS / NIP</th>
                                                <td>: {{ $anggota->nis_nip ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Jenis Kelamin</th>
                                                <td>: {{ $anggota->jenis_kelamin == 'L' ? 'Laki-Laki' : ($anggota->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Kelas</th>
                                                <td>: {{ $anggota->kelas ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">No. Telepon/WA</th>
                                                <td>: {{ $anggota->no_telepon ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Alamat</th>
                                                <td>: {{ $anggota->alamat ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-2">
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-default shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
            </div>
        </div>
    </section>
</div>
@endsection