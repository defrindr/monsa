<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dosen::query()->with(['user']);

        if ($request->filled('keywords')) {
            $keywords = $request->get('keywords');

            $query->where(function ($q) use ($keywords) {
                $q->where('name', 'like', "%$keywords%")
                    ->orWhere('nip', 'like', "%$keywords%")
                    ->orWhereHas('user', function ($q) use ($keywords) {
                        $q->where('email', 'like', "%$keywords%");
                    });
            });
        }

        // Fetch paginated results (prevents excessive data load)
        $paginate = $query->paginate(10);
        return view('pages.admin.dosen.index', compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDosenRequest $request)
    {
        try {
            DB::beginTransaction();
            $payload = $request->only('name', 'password', 'nip');
            $user = User::create($payload);

            // Assign user to dosen
            $payload['user_id'] = $user->id;
            Dosen::create($payload);

            // Commit transaction
            DB::commit();
            return Redirect::route('admin.dosen.index')->with(['success' => 'Data Dosen berhasil disimpan']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $model)
    {
        $listProdi = Dosen::get();
        return view('pages.admin.dosen.edit', compact('model', 'listProdi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDosenRequest $request, Dosen $model)
    {
        try {
            //  Start DB transaction
            DB::beginTransaction();

            // Prepare payload for user and dosen update
            $payload = $request->only('name', 'password', 'nip');

            // Update the resource
            $model->update($request->validated());

            // If password is provided, update the user's password
            if (isset($payload['password']) && empty($payload['password'])) {
                unset($payload['password']);
            }

            // Update the user
            $model->user->update($payload);

            // Commit transaction
            DB::commit();
            return Redirect::route('admin.dosen.index')->with(['success' => 'Data Dosen berhasil diubah']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $model)
    {
        try {
            $model->delete();
            return Redirect::route('admin.dosen.index')->with(['success' => 'Data Dosen berhasil dihapus']);
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with(['error' => $th->getMessage()]);
        }
    }
}
