<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderByRaw(
                'CASE WHEN sort_order = 0 THEN 1 ELSE 0 END'
            )
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('id')
            ->get();

        return view('projeler', compact('projects'));
    }

    public function show($localeOrId, $id = null)
    {
        $projectId = $id ?? $localeOrId;
        $project = Project::findOrFail($projectId);

        return view('proje-detay', compact('project'));
    }

    public function adminIndex()
    {
        $projects = Project::orderByRaw(
                'CASE WHEN sort_order = 0 THEN 1 ELSE 0 END'
            )
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('id')
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['technologies'] = $request->filled('technologies')
            ? array_map('trim', explode(',', $request->technologies))
            : [];

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->integer('sort_order', 0);

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proje başarıyla eklendi.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['technologies'] = $request->filled('technologies')
            ? array_map('trim', explode(',', $request->technologies))
            : [];

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->integer('sort_order', 0);

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proje başarıyla güncellendi.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proje başarıyla silindi.');
    }
}
