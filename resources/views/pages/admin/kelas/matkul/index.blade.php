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
                @if ($matkulPaginate->count() === 0)
                    <tr>
                        <td colspan="4" class="text-center">Data Mata Kuliah kosong</td>
                    </tr>
                @endif
                @foreach ($matkulPaginate->items() as $key => $matkul)
                    <tr>
                        <td>{{ ($matkulPaginate->currentPage() - 1) * $matkulPaginate->perPage() + $loop->index + 1 }}
                        <td>{{ $matkul->matakuliah->name }}</td>
                        <td>{{ $matkul->dosen->name }}</td>
                        <td>
                            <form action="{{ route('admin.kelas.matkul.destroy', [$model, $matkul]) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
