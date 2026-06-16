<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index(Request $request)
    {
        $query = Child::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('parent_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        $children = $query->paginate(12);

        return view('pages.dashboard.profile-anak.index', compact('children'));
    }

    public function update(Request $request, Child $child)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:L,P',
            'class' => 'nullable|in:bunga,matahari,bintang,bulan',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'allergies' => 'nullable|string',
            'status' => 'required|in:aktif,cuti,sakit,pindah,lulus',
        ]);

        $child->update($validated);

        return back()->with('success', 'Data anak berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:L,P',
            'class' => 'nullable|in:bunga,matahari,bintang,bulan',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'allergies' => 'nullable|string',
        ]);

        $validated['status'] = 'aktif';

        Child::create($validated);

        return back()->with('success', 'Data anak berhasil ditambahkan!');
    }
}
