<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prodi::query();
        if ($request->has('keywords')) {
            $keywords = $request->get('keywords');
            $query->where('name', 'like', "%$keywords%");
        }
        $paginate = $query->paginate(10);
        return view('pages.admin.prodi.index', compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdiRequest $request)
    {
        try {
            Prodi::create($request->validated());
            return Redirect::route('admin.prodi.index')->with(['success' => 'Data Prodi berhasil disimpan']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $model)
    {
        return view('pages.admin.prodi.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdiRequest $request, Prodi $model)
    {
        try {
            $model->update($request->validated());
            return Redirect::route('admin.prodi.index')->with(['success' => 'Data Prodi berhasil diubah']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $model)
    {
        try {
            $model->delete();
            return Redirect::route('admin.prodi.index')->with(['success' => 'Data Prodi berhasil dihapus']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }
}
