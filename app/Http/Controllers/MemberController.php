<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $members = Member::query()
            ->when(request('search'), function($query) {
                $query->where('name', 'like', '%'.request('search').'%')
                    ->orWhere('member_id', 'like', '%'.request('search').'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastMember = Member::orderBy('id', 'desc')->first();
        $nextId = $lastMember ? (int) substr($lastMember->member_id, 4) + 1 : 1;
        $memberId = 'MEM-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        return view('members.create', compact('memberId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'member_id' => 'required|unique:members',
            'name' => 'required|max:100',
            'email' => 'required|email|unique:members',
            'phone' => 'required|max:15|regex:/^08[0-9]{9,}$/',
            'type' => 'required|in:siswa,mahasiswa,guru,staff,umum',
            'address' => 'required',
            'join_date' => 'required|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('member-photos', 'public');
        }

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::findOrFail($id);
        
        return view('members.show', compact('member'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = Member::findOrFail($id);

        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

         $validated = $request->validate([
            'member_id' => [
                'required',
                Rule::unique('members')->ignore($member->id)
            ],
            'name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('members')->ignore($member->id)
            ],
            'phone' => 'required|max:15|regex:/^08[0-9]{9,}$/',
            'type' => 'required|in:siswa,mahasiswa,guru,staff,umum',
            'address' => 'required',
            'join_date' => 'required|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle photo update
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($member->photo_path) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('member-photos', 'public');
        }

        $member->update($validated);

        return redirect()->route('members.show', $member->id)
            ->with('success', 'Data anggota berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        // Hapus foto jika ada
        if ($member->photo_path) {
            Storage::disk('public')->delete($member->photo_path);
        }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}
