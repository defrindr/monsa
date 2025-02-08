@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Program Pendidikan') }}</h1>

    <div class="row">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ __('List') }} {{ __('Program Pendidikan') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('No') }}</th>
                            <th>{{ __('Nama Program') }}</th>
                            <th>{{ __('Aksi') }}</th>
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
                                    <td>{{ ($paginate->currentPage() - 1) * $paginate->perPage() + $loop->index + 1 }}</td>
                                    <td>{{ $program->nama_program }}</td>
                                    <td>
                                        <a href="{{ route('admin.program.edit', $program) }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.program.destroy', $program) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
        </div>
    </div>
    </div>
@endsection
