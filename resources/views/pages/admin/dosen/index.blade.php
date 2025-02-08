@extends('layouts.admin.main')

@section('title', 'List Dosen')
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    {{-- tombol --}}
                    <a class="btn btn-primary" href="{{ route('admin.dosen.create') }}">
                        <i class="fa fa-plus"></i>
                        Tambah
                    </a>
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
                                <th>{{ __('NIP') }}</th>
                                <th>{{ __('Nama Dosen') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th style="width: 150px">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($paginate->count() === 0)
                                <tr>
                                    <td colspan="3" class="text-center">Data Dosen kosong</td>
                                </tr>
                            @else
                                @foreach ($paginate as $item)
                                    <tr>
                                        <td>{{ ($paginate->currentPage() - 1) * $paginate->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->user?->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.dosen.edit', $item) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.dosen.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger  btn-sm"><i class="fas fa-trash"></i></button>
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
