<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReferenceController extends Controller
{
    public function index()
    {
        $references = Reference::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('referanslar', compact('references'));
    }


    public function adminIndex()
    {
        $references = Reference::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.references.index', compact('references'));
    }


    public function create()
    {
        return view('admin.references.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'company_en' => 'nullable|string|max:255',

            'title' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',

            'comment' => 'nullable|string',
            'comment_en' => 'nullable|string',

            'website_url' => 'nullable|url|max:255',

            'logo' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:4096',
            ],

            'is_active' => 'nullable|boolean',

            'sort_order' => 'nullable|integer|min:0',
        ]);


        if ($request->hasFile('logo')) {

            $validated['logo'] = $request
                ->file('logo')
                ->store('references', 'public');
        }


        $validated['is_active'] =
            $request->boolean('is_active');


        $validated['sort_order'] =
            $request->integer('sort_order', 0);


        Reference::create($validated);


        return redirect()
            ->route('admin.references.index')
            ->with('success', 'Referans başarıyla eklendi.');
    }


    public function edit(Reference $reference)
    {
        return view(
            'admin.references.edit',
            compact('reference')
        );
    }


    public function update(Request $request, Reference $reference)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'company_en' => 'nullable|string|max:255',

            'title' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',

            'comment' => 'nullable|string',
            'comment_en' => 'nullable|string',

            'website_url' => 'nullable|url|max:255',

            'logo' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:4096',
            ],

            'is_active' => 'nullable|boolean',

            'sort_order' => 'nullable|integer|min:0',
        ]);


        if ($request->hasFile('logo')) {

            $newLogo = $request
                ->file('logo')
                ->store('references', 'public');


            if (
                $reference->logo &&
                Storage::disk('public')->exists($reference->logo)
            ) {

                Storage::disk('public')
                    ->delete($reference->logo);
            }


            $validated['logo'] = $newLogo;
        }


        $validated['is_active'] =
            $request->boolean('is_active');


        $validated['sort_order'] =
            $request->integer('sort_order', 0);


        $reference->update($validated);


        return redirect()
            ->route('admin.references.index')
            ->with('success', 'Referans başarıyla güncellendi.');
    }


    public function destroy(Reference $reference)
    {
        if (
            $reference->logo &&
            Storage::disk('public')->exists($reference->logo)
        ) {

            Storage::disk('public')
                ->delete($reference->logo);
        }


        $reference->delete();


        return redirect()
            ->route('admin.references.index')
            ->with('success', 'Referans başarıyla silindi.');
    }
}