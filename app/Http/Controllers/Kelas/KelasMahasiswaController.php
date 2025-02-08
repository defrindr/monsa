<?php

namespace App\Http\Controllers\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\StoreKelasMahasiswaRequest;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Redirect;

class KelasMahasiswaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Kelas $model)
    {
        $listMahasiswa = Mahasiswa::query()->whereNotIn(
            'id',
            KelasMahasiswa::query()
                ->where('kelas_id', '=', $model->id)
                ->select('mahasiswa_id')
        )->get();
        return view('pages.admin.kelas.mahasiswa.create', compact('model', 'listMahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasMahasiswaRequest $request, Kelas $model)
    {
        try {
            $payload = $request->validated();
            $payload['kelas_id'] = $model->id;

            // Check if matkul already assigned to the kelas
            $exists = KelasMahasiswa::where([
                'kelas_id' => $model->id,
                'mahasiswa_id' => $payload['mahasiswa_id'],
            ])->exists();
            if ($exists) {
                return Redirect::back()->withInput()->with(['error' => 'Mahasiswa sudah ada di kelas ini']);
            }

            KelasMahasiswa::create($payload);
            return Redirect::route('admin.kelas.show', compact('model'))
                ->with(['success' => 'Data Mahasiswa berhasil ditambahkan']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $model, KelasMahasiswa $mahasiswa)
    {
        try {
            $mahasiswa->delete();
            return Redirect::route('admin.kelas.show', compact('model'))
                ->with(['success' => 'Data Mahasiswa berhasil dihapus']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }
}
