<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePenilaianRequest;
use App\Models\DosenMatakuliah;
use App\Models\MahasiswaNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $query = DosenMatakuliah::query()->with(['kelas', 'matakuliah']);

        if ($request->filled('keywords')) {
            $keywords = $request->get('keywords');
            $query
                ->whereHas('kelas', function ($q) use ($keywords) {
                    $q->with(['prodi'])
                        ->where('name', 'like', "%$keywords%")
                        ->orWhere('year', 'like', "%$keywords%")
                        ->orWhereHas('prodi', function ($q) use ($keywords) {
                            $q->where('name', 'like', "%$keywords%");
                        });
                })
                ->orWhereHas('matakuliah', function ($q) use ($keywords) {
                    $q->where('name', 'like', "%$keywords%");
                });
        }


        $paginate = $query->paginate(10);

        return view('pages.admin.penilaian.index', compact('paginate'));
    }

    public function nilai(DosenMatakuliah $model)
    {
        $this->_generateNilaiMahasiswa($model);

        $listPenilaianDetail = MahasiswaNilai::where([
            'kelas_id' => $model->kelas_id,
            'matkul_id' => $model->matakuliah_id,
        ])->get();
        return view('pages.admin.penilaian.nilai', compact('model', 'listPenilaianDetail'));
    }

    private function _generateNilaiMahasiswa(DosenMatakuliah $model)
    {
        $mahasiswas = $model->kelas->mahasiswas;
        DB::beginTransaction();
        foreach ($mahasiswas as $mahasiswa) {
            // generate nilai
            $payload = [
                'kelas_id' => $model->kelas_id,
                'matkul_id' => $model->matakuliah_id,
                'mahasiswa_id' => $mahasiswa->id,
            ];
            $mahasiswaNilai = MahasiswaNilai::where($payload)->first();

            if (!$mahasiswaNilai) {
                MahasiswaNilai::create($payload);
            }
        }
        DB::commit();
    }

    public function update(UpdatePenilaianRequest $request, DosenMatakuliah $model)
    {
        DB::beginTransaction();
        $payload = $request->validated();
        foreach ($payload['penilaian'] as $id => $values) {
            $mahasiswaNilai = MahasiswaNilai::find($id);
            $nilaiTotal = array_sum(array_values($values));
            $values['nilai_akhir'] = $nilaiTotal;
            $mahasiswaNilai->update($values);
        }
        DB::commit();
        return Redirect::route('admin.penilaian.index')->with(['success' => 'Data Penilaian berhasil diubah']);
    }
}
