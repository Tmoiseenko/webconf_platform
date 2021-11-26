<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Session;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Events\SendCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $programs = Program::orderBy('order', 'asc')->get();
        return view('auth.register', compact('programs'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => ['required', 'numeric', 'min:11'],
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'agree' => ['required'],
            'password' => 'required|string|min:6',
        ]);

        Auth::login($user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'company' => $request->company,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));
        event(new SendCalendar($user));

        $now = \Carbon\Carbon::now();
        $newSession = new Session();
        $newSession->id = sha1(Auth::user()->id . $now->timestamp);
        $newSession->user_id = Auth::user()->id;
        $newSession->connected_at = $now;
        $newSession->last_activity = $now->timestamp;
        $newSession->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
