<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'nisn'      => ['required', 'string', 'max:10'],
            'password'  => ['required'],
        ], [
            'nisn.required'             => 'NISN perlu diisi.',
            'nisn.max'                  => 'Maksimal NISN adalah :max digit.',
            'password.required'         => 'Password perlu diisi.',
        ]);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'errors'    => 'NISN atau Password salah.',
        ]);
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:10', 'unique:'.User::class],
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ], [
            'nisn.required'             => 'NISN perlu diisi.',
            // 'nisn.min:10'               => 'NISN harus 10 digit.',
            'nisn.unique'               => 'NISN telah terpakai.',
            'name.required'             => 'Nama perlu diisi.',
            'password.required'         => 'Password perlu diisi.',
            'password.min'              => 'Minimal password adalah :min.',
            'password.confirmed'        => 'Konfirmasi password salah.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return redirect(route('login'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect(route('index'));
    }
}