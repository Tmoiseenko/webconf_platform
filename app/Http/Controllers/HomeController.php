<?php

namespace App\Http\Controllers;

use App\Models\Room;
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
        $rooms = Room::orderBy('order', 'asc')->get();
        $materials = Material::orderBy('order', 'asc')->get();
        $partners = Partner::orderBy('order', 'asc')->get();
        $programs = Program::orderBy('started_at', 'asc')->get();
        $navLinks = [
            ['id' => '#stream', 'title' => 'Трансляция'],
            ['id' => '#rooms', 'title' => 'Комнаты'],
            ['id' => '#materials', 'title' => 'Материалы'],
            ['id' => '#program', 'title' => 'Программа'],
            ['id' => '#partners', 'title' => 'Партнеры'],
        ];

        return view('welcome', compact('event', 'rooms', 'materials', 'partners', 'programs', 'navLinks'));
    }
}
