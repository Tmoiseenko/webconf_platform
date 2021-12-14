<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendCalendarLinkMail;
use App\Models\Program;
use App\Models\Role;
use App\Models\Session;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Events\SendCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $programs = Program::orderBy('started_at', 'asc')->get();
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
            'phone' => ['required', 'regex:/^\+7\(\d{2}\) \d{3}-\d{2}-\d{2}$/i'],
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'agree' => ['required'],
            'password' => 'required|string|min:6',
        ]);

        Auth::login($user = User::create([
            'name' => $request->first_name . " " . $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'company' => $request->company,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]));

        $user->roles()->save(Role::where('slug', 'user')->first());

        event(new Registered($user));

        Mail::to($user->email)->send(new SendCalendarLinkMail(Setting::first()));


        return redirect(RouteServiceProvider::HOME);
    }
}
