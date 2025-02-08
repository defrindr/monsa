<?php

namespace App\Http\Controllers\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\StoreKelasMatkulRequest;
use App\Http\Requests\StoreMatkulRequest;
use App\Http\Requests\UpdateMatkulRequest;
use App\Models\Dosen;
use App\Models\DosenMatakuliah;
use App\Models\Kelas;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KelasMatkulController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Kelas $model)
    {
        $matkuls = Matkul::query()->whereNotIn(
            'id',
            DosenMatakuliah::query()
                ->where('kelas_id', '=', $model->id)
                ->select('matakuliah_id')
        )->get();
        $dosens = Dosen::get();
        return view('pages.admin.kelas.matkul.create', compact('model', 'matkuls', 'dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasMatkulRequest $request, Kelas $model)
    {
        try {
            $payload = $request->validated();
            $payload['kelas_id'] = $model->id;

            // Check if matkul already assigned to the kelas
            $exists = DosenMatakuliah::where([
                'kelas_id' => $model->id,
                'matakuliah_id' => $payload['matakuliah_id'],
            ])->exists();
            if ($exists) {
                return Redirect::back()->withInput()->with(['error' => 'Mata kuliah sudah ada di kelas ini']);
            }

            DosenMatakuliah::create($payload);
            return Redirect::route('admin.kelas.show', compact('model'))
                ->with(['success' => 'Data Mata kuliah berhasil ditambahkan']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $model, DosenMatakuliah $matkul)
    {
        try {
            $matkul->delete();
            return Redirect::route('admin.kelas.show', compact('model'))
                ->with(['success' => 'Data Mata kuliah berhasil dihapus']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }
}
