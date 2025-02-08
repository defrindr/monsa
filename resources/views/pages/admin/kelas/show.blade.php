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
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title float-left">Daftar Matakuliah</h4>
                    <a href="{{ route('admin.kelas.matkul.create', $model) }}" class="btn btn-primary float-right">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15px">No</th>
                                <th>Matakuliah</th>
                                <th>Dosen Pengampu</th>
                                <th style="width: 50px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matkulPaginate->items() as $key => $matkul)
                                <tr>
                                    <td>{{ ($matkulPaginate->currentPage() - 1) * $matkulPaginate->perPage() + $loop->index + 1 }}
                                    <td>{{ $matkul->matakuliah->name }}</td>
                                    <td>{{ $matkul->dosen->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.kelas.matkul.destroy', [$model, $matkul]) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $matkulPaginate->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Daftar Mahasiswa</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
@endsection
