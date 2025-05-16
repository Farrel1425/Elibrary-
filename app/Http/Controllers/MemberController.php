<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

<<<<<<< HEAD

=======
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
         $members = Member::query()
=======
        $members = Member::query()
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
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
<<<<<<< HEAD
         $validated = $request->validate([
=======
        $validated = $request->validate([
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
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
<<<<<<< HEAD
    public function show(string $id)
    {
        $member = Member::findOrFail($id);
        
        return view('members.show', compact('member'));

=======
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
    }

    /**
     * Show the form for editing the specified resource.
     */
<<<<<<< HEAD
    public function edit(string $id)
    {
        $member = Member::findOrFail($id);

=======
    public function edit(Member $member)
    {
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

         $validated = $request->validate([
=======
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
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
<<<<<<< HEAD
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
=======
    public function destroy(Member $member)
    {
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
        // Hapus foto jika ada
        if ($member->photo_path) {
            Storage::disk('public')->delete($member->photo_path);
        }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
