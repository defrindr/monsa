@extends('layouts.admin.main')
@section('title', 'Tambah Mata Kuliah')
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    {{-- tombol --}}
                    <a class="btn btn-secondary" href="{{ route('admin.kelas.show', $model) }}">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="form-data" action="{{ route('admin.kelas.mahasiswa.store', $model) }}" method="POST">
                        @csrf
                        @include('pages.admin.kelas.mahasiswa.form')
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button class="btn btn-primary" id="btn-submit">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $('#btn-submit').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to trigger this action?')) {
                $('#form-data').submit();
            }
        });
    </script>
@endsection
