<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\User;
use App\Services\KesuburanService;
use App\Services\MonitoringService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.home');
    }

}
