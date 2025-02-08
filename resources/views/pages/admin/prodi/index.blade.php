@extends('layouts.admin.main')

@section('title', 'List Program Pendidikan')
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    {{-- tombol --}}
                    <a class="btn btn-primary" href="{{ route('admin.prodi.create') }}">
                        <i class="fa fa-plus"></i>
                        Tambah
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50px">{{ __('No') }}</th>
                                <th>{{ __('Nama Program') }}</th>
                                <th style="width: 150px">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($paginate->count() === 0)
                                <tr>
                                    <td colspan="3" class="text-center">Data Program Pendidikan kosong</td>
                                </tr>
                            @else
                                @foreach ($paginate as $program)
                                    <tr>
                                        <td>{{ ($paginate->currentPage() - 1) * $paginate->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $program->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.prodi.edit', $program) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.prodi.destroy', $program) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger  btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $paginate->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
