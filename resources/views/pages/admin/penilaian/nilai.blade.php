@extends('layouts.admin.main')

@section('title', 'List Mata Kuliah di Ampu')
@php
    $oldNilai = old('penilaian');
    if (!$oldNilai) {
        $oldNilai = [];
        foreach ($listPenilaianDetail as $det) {
            $oldNilai[$det->id] = [
                'nilai_tugas' => $det->nilai_tugas ?? '',
                'nilai_uts' => $det->nilai_uts ?? '',
                'nilai_uas' => $det->nilai_uas ?? '',
            ];
        }
    }
@endphp
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <a class="btn btn-secondary" href="{{ route('admin.penilaian.index') }}">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="form-penilaian" action="{{ route('admin.penilaian.update', $model) }}" method="post">
                        @csrf
                        @method('PUT')
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NRP</th>
                                    <th>Mahasiswa</th>
                                    <th>Nilai Tugas</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    {{-- <th class="bg-danger text-white">Nilai Total</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPenilaianDetail as $index => $penilaian)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $penilaian->mahasiswa->nrp }}</td>
                                        <td>{{ $penilaian->mahasiswa->name }}</td>
                                        <td>
                                            <input name="penilaian[{{ $penilaian->id }}][nilai_tugas]" type="number"
                                                class="form-control" value="{{ $oldNilai[$penilaian->id]['nilai_tugas'] }}">
                                        </td>
                                        <td>
                                            <input name="penilaian[{{ $penilaian->id }}][nilai_uts]" type="number"
                                                class="form-control" value="{{ $oldNilai[$penilaian->id]['nilai_uts'] }}">
                                        </td>
                                        <td>
                                            <input name="penilaian[{{ $penilaian->id }}][nilai_uas]" type="number"
                                                class="form-control" value="{{ $oldNilai[$penilaian->id]['nilai_uas'] }}">
                                        </td>
                                        {{-- <th class="bg-danger text-white" id="penilaian_{{ $penilaian->id }}_total"></th> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="btn-penilaian" type="submit" class="btn btn-primary">
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
        $('#btn-penilaian').on('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah anda yakin ingin menyimpan nilai penilaian?')) {
                $('#form-penilaian').submit();
            }
        });
    </script>

@endsection
