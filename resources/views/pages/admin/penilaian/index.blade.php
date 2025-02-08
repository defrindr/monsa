@extends('layouts.admin.main')

@section('title', 'List Mata Kuliah di Ampu')
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{-- Form Search --}}
                    <div class="row justify-content-end">
                        <div class="col-md-6">
                            <form action="">
                                <div class="d-flex gap-2 justify-content-center items-center mb-3" style="gap:1rem">
                                    <input type="text" class="form-control" id="keywords" name="keywords"
                                        value="{{ old('keywords', request('keywords')) }}" placeholder="Cari ...">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50px">{{ __('No') }}</th>
                                <th>{{ __('Matakuliah') }}</th>
                                <th>{{ __('Kelas') }}</th>
                                <th style="width: 150px">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($paginate->count() === 0)
                                <tr>
                                    <td colspan="4" class="text-center">Daftar matakuliah kosong</td>
                                </tr>
                            @else
                                @foreach ($paginate as $item)
                                    <tr>
                                        <td>{{ ($paginate->currentPage() - 1) * $paginate->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $item->matakuliah->name }}</td>
                                        <td>{{ $item->kelas->fullName }}</td>
                                        <td>
                                            <a href="{{ route('admin.penilaian.nilai', $item) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
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
