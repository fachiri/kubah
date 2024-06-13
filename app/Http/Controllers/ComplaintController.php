<?php

namespace App\Http\Controllers;

use App\Constants\ComplaintStatus;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Complaint;
use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Complaint::class);

        $complaintQuery = Complaint::query();

        if (auth()->user()->isCommonUser() || auth()->user()->isVolunteer()) {
            $complaintQuery->where('user_id', auth()->user()->id);
        }

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $complaintQuery->where(function ($query) use ($searchTerm) {
                $query->where('category', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $complaints = $complaintQuery->latest()->paginate(5);

        return view('pages.complaints.index', compact('complaints'));
    }

    public function create()
    {
        Gate::authorize('create', Complaint::class);

        return view('pages.complaints.create');
    }

    public function store(StoreComplaintRequest $request)
    {
        Gate::authorize('create', Complaint::class);

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
        Gate::authorize('view', $complaint);

        return view('pages.complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        Gate::authorize('update', $complaint);

        return view('pages.complaints.edit', compact('complaint'));
    }

    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        Gate::authorize('update', $complaint);

        try {
            $complaint->reporter_role = $request->reporter_role;
            $complaint->category = $request->category;
            $complaint->description = $request->description;
            $complaint->location = $request->location;
            $complaint->incident_date = $request->incident_date;
            $complaint->incident_time = $request->incident_time;
            if ($request->hasFile('ktp')) {
                Storage::delete("public/ktp/{$complaint->ktp}");
                $complaint->ktp = basename($request->file('ktp')->store('public/ktp'));
            }
            if ($request->hasFile('evidences')) {
                foreach ($request->file('evidences') as $evidence) {
                    $filename = $evidence->store('public/evidences');
                    Evidence::create([
                        'filename' => basename($filename),
                        'complaint_id' => $complaint->id
                    ]);
                }
            }
            $complaint->update();

            return redirect()->back()->with('success', 'Pengaduan telah diedit.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    public function destroy(Complaint $complaint)
    {
        Gate::authorize('delete', $complaint);

        try {
            $complaint->delete();

            return redirect()->route('complaints.index')->with('success', 'Pengaduan telah dihapus.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    public function process(Complaint $complaint)
    {
        Gate::authorize('process', $complaint);

        try {
            $complaint->status = ComplaintStatus::IN_PROGRESS;
            $complaint->update();

            return redirect()->back()->with('success', 'Pengaduan telah diproses.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    public function cancel(Complaint $complaint)
    {
        Gate::authorize('cancel', $complaint);

        try {
            $complaint->status = ComplaintStatus::CANCELED;
            $complaint->update();

            return redirect()->back()->with('success', 'Pengaduan telah dibatalkan.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    public function resolve(Complaint $complaint)
    {
        Gate::authorize('resolve', $complaint);

        try {
            $complaint->status = ComplaintStatus::RESOLVED;
            $complaint->update();

            return redirect()->back()->with('success', 'Pengaduan telah diselesaikan.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }
}
