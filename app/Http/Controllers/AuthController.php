<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\CommonUser;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    const ACCOUNT_TYPE_VOLUNTEER = 'Relawan';

    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(AuthenticateUserRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->device_token = $request->device_token;
            $user->save();

            $request->session()->regenerate();
            return redirect('/home')->with('success', 'Login berhasil');;
        }

        return back()->withErrors([
            'Email atau Password salah.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            $user = User::create($request->validated());

            if ($request->account_type === self::ACCOUNT_TYPE_VOLUNTEER) {
                Volunteer::create(['user_id' => $user->id]);
            } else {
                CommonUser::create(['user_id' => $user->id]);
            }

            DB::commit();
            return redirect('login')->with('success', 'Akun anda berhasil dibuat.');

        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.'])->withInput();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
