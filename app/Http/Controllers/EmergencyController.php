<?php

namespace App\Http\Controllers;

use App\Helpers\PushNotif;
use App\Http\Requests\StoreEmergencyRequest;
use App\Models\Emergency;
use App\Models\User;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    protected $pushNotif;

    public function __construct(PushNotif $pushNotif)
    {
        $this->pushNotif = $pushNotif;
    }

    public function index()
    {
        $emergencies = Emergency::with('user')->get();

        return view('pages.emergencies.index', compact('emergencies'));
    }

    public function store(StoreEmergencyRequest $request)
    {
        try {
            $currentUser = auth()->user();
            $users = User::where('id', '!=', $currentUser->id)->get();
            $tokens = $users->pluck('device_token')->filter()->toArray();

            $data = $request->validated();
            $data['user_id'] = $currentUser->id;

            Emergency::create($data);

            $senderName = $currentUser->name;
            $payload = [
                'title' => "Keadaan darurat",
                'notificationTitle' => "$senderName butuh pertolongan",
                'body' => "Ayo berikan pertolongan",
                'senderName' => $senderName,
                'image' => null,
            ];

            if (!empty($tokens)) {
                $this->pushNotif->broadcast($tokens, $payload);
            }

            return redirect()->route('emergencies.index')->with('success', 'Berhasil. Berlindung ditempat yang aman sampai pertolongan datang!');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }
    }
}
