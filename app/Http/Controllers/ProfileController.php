<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index');
    }

    public function avatar_update(UpdateAvatarRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            if ($request->hasFile('avatar')) {
                Storage::delete('public/avatars/' . $user->avatar);
                $user->avatar = basename($request->file('avatar')->store('public/avatars'));
            }
            $user->save();

            return redirect()->back()->with('success', 'Avatar berhasil diubah.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    public function edit()
    {
        $user = auth()->user();

        return view('pages.profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->birth_place = $request->birth_place;
            $user->birth_date = $request->birth_date;
            $user->gender = $request->gender;
            $user->save();

            return redirect()->back()->with('success', 'Profil berhasil diedit.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }
}
