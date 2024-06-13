<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
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
}
