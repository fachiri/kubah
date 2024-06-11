<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Models\Complaint;
use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::get();

        return view('pages.complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('pages.complaints.create');
    }

    public function store(StoreComplaintRequest $request)
    {
        try {
            $data = $request->validated();
            $ktpFilename = basename($request->file('ktp')->store('public/ktp'));
            $data['ktp'] = $ktpFilename;

            $complaint = Complaint::create($data);

            foreach ($request->file('evidences') as $evidence) {
                $filename = $evidence->store('public/evidences');
                Evidence::create([
                    'filename' => basename($filename),
                    'complaint_id' => $complaint->id
                ]);
            }

            return redirect()->route('complaints.show', $complaint->ulid)->with('success', 'Pengaduan Anda berhasil dibuat.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat membuat pengaduan. Silakan coba lagi.'])->withInput();
        }
    }

    public function show(Complaint $complaint)
    {
        return view('pages.complaints.show', compact('complaint'));
    }
}
