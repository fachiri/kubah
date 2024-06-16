<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    public function index()
    {
        return view('pages.security.index');
    }

    public function change_password(ChangePasswordRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->firstOrFail();
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with('success', 'Password berhasil diubah!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
