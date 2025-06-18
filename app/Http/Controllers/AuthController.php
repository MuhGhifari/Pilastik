<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('admin.home');
        } elseif ($user->role == 'collector') {
            return redirect()->route('collector.index');
        } elseif ($user->role == 'resident') {
            return redirect()->route('resident.home');
        } else {
            abort(403);
        }

    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Kredensial Salah!'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
