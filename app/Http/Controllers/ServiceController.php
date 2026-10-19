<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'icon' => 'nullable|string|max:255',

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'order' => 'nullable|integer|min:0',
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('services', 'public');
        }

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Hizmet başarıyla eklendi.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(
        Request $request,
        Service $service
    ) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'icon' => 'nullable|string|max:255',

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'order' => 'nullable|integer|min:0',
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('image')) {
            if (
                !empty($service->image)
                &&
                Storage::disk('public')->exists($service->image)
            ) {
                Storage::disk('public')->delete($service->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('services', 'public');
        }

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Hizmet başarıyla güncellendi.');
    }

    public function destroy(Service $service)
    {
        if (
            !empty($service->image)
            &&
            Storage::disk('public')->exists($service->image)
        ) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Hizmet başarıyla silindi.');
    }
}