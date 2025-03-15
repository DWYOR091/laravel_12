<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // return redirect()->intended('/blog');
            return redirect()->route('blog.index');
        }

        return back()->withErrors('Login Invalid');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function register(): View
    {
        return view('register');
    }

    public function createNewUser(Request $req)
    {
        $credentials = $req->validate([
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required'
        ]);


        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('blog.index');
    }
}
