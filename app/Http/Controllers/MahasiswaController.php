<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        if ($request->has('keywords')) {
            $keywords = $request->get('keywords');
            $query->where('nrp', 'like', "%$keywords%")
                ->orWhere('name', 'like', "%$keywords%");
        }
        $paginate = $query->paginate(10);
        return view('pages.admin.mahasiswa.index', compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request)
    {
        try {
            Mahasiswa::create($request->validated());
            return Redirect::route('admin.mahasiswa.index')->with(['success' => 'Data Mahasiswa berhasil disimpan']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $model)
    {
        return view('pages.admin.mahasiswa.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $model)
    {
        try {
            $model->update($request->validated());
            return Redirect::route('admin.mahasiswa.index')->with(['success' => 'Data Mahasiswa berhasil diubah']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $model)
    {
        try {
            $model->delete();
            return Redirect::route('admin.mahasiswa.index')->with(['success' => 'Data Mahasiswa berhasil dihapus']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }
}
