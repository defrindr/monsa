@extends('layouts.admin.main')

@section('title', 'Detail Kelas')
@section('main-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card card-default">
                <div class="card-header">
                    {{-- tombol --}}
                    <a class="btn btn-secondary" href="{{ route('admin.kelas.index') }}">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama Kelas</th>
                                <td>{{ $model->fullName }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Ajaran</th>
                                <td>{{ $model->year }}</td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td>{{ $model->prodi->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            @include('pages.admin.kelas.matkul.index')
        </div>

        <div class="col-md-6 mb-4">
            @include('pages.admin.kelas.mahasiswa.index')
        </div>
    </div>
@endsection
