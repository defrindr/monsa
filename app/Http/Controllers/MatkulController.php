<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatkulRequest;
use App\Http\Requests\UpdateMatkulRequest;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Matkul::query();
        if ($request->has('keywords')) {
            $keywords = $request->get('keywords');
            $query->where('name', 'like', "%$keywords%");
        }
        $paginate = $query->paginate(10);
        return view('pages.admin.matkul.index', compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.matkul.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMatkulRequest $request)
    {
        try {
            Matkul::create($request->validated());
            return Redirect::route('admin.matkul.index')->with(['success' => 'Data Mata kuliah berhasil disimpan']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matkul $model)
    {
        return view('pages.admin.matkul.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMatkulRequest $request, Matkul $model)
    {
        try {
            $model->update($request->validated());
            return Redirect::route('admin.matkul.index')->with(['success' => 'Data Mata kuliah berhasil diubah']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matkul $model)
    {
        try {
            $model->delete();
            return Redirect::route('admin.matkul.index')->with(['success' => 'Data Mata kuliah berhasil dihapus']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }
}
