<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Models\Kelas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::with('prodi') // Eager load prodi to reduce queries
            ->select('id', 'name', 'year', 'prodi_id');

        if ($request->filled('keywords')) {
            $keywords = $request->get('keywords');

            $query->where(function ($q) use ($keywords) {
                $q->where('year', 'like', "%$keywords%")
                    ->orWhere('name', 'like', "%$keywords%")
                    ->orWhereHas('prodi', function ($q) use ($keywords) {
                        $q->where('name', 'like', "%$keywords%");
                    });
            });
        }

        // Fetch paginated results (prevents excessive data load)
        $paginate = $query->paginate(10);
        return view('pages.admin.kelas.index', compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listProdi = Prodi::get();
        return view('pages.admin.kelas.create', compact('listProdi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        try {
            Kelas::create($request->validated());
            return Redirect::route('admin.kelas.index')->with(['success' => 'Data Kelas berhasil disimpan']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $model)
    {
        $listProdi = Prodi::get();
        return view('pages.admin.kelas.edit', compact('model', 'listProdi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $model)
    {
        try {
            // Check duplicates
            $exists = Kelas::where($request->validated())->exists();
            if ($exists && $model->id != $request->input('id')) {
                return Redirect::back()->withInput()->with(['error' => 'Data Kelas sudah ada']);
            }

            $model->update($request->validated());
            return Redirect::route('admin.kelas.index')->with(['success' => 'Data Kelas berhasil diubah']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $model)
    {
        try {
            $model->delete();
            return Redirect::route('admin.kelas.index')->with(['success' => 'Data Kelas berhasil dihapus']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }
}
