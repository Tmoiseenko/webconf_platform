<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Material;
use App\Models\Partner;
use App\Models\Program;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $event = Setting::first();
        $materials = Material::orderBy('order', 'asc')->get();
        $partners = Partner::orderBy('order', 'asc')->get();
        $programs = Program::orderBy('started_at', 'asc')->get();

        return view('welcome', compact('event', 'materials', 'partners', 'programs'));
    }
}
