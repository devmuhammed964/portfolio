<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONTEND
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $posts = Post::where('is_published', true)
            ->latest()
            ->paginate(6);

        return view('haberler', compact('posts'));
    }

    public function show($localeOrSlug, $slug = null)
    {
        /*
         * TR:
         * /haberler/ornek-yazi
         *
         * EN:
         * /en/news/ornek-yazi
         */

        $postSlug = $slug ?? $localeOrSlug;

        $post = Post::where('slug', $postSlug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('haber-detay', compact('post'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $posts = Post::latest()->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.posts.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',

            'summary' => 'nullable|string',
            'summary_en' => 'nullable|string',

            'content' => 'required|string',
            'content_en' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request
                ->file('image')
                ->store('posts', 'public');
        }

        Post::create([
            'title' => $validated['title'],
            'title_en' => $validated['title_en'] ?? null,

            'slug' => Str::slug($validated['title']) . '-' . rand(100, 999),

            'summary' => $validated['summary'] ?? null,
            'summary_en' => $validated['summary_en'] ?? null,

            'content' => $validated['content'],
            'content_en' => $validated['content_en'] ?? null,

            'image' => $imagePath,

            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Yazı başarıyla eklendi.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',

            'summary' => 'nullable|string',
            'summary_en' => 'nullable|string',

            'content' => 'required|string',
            'content_en' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'title_en' => $validated['title_en'] ?? null,

            'summary' => $validated['summary'] ?? null,
            'summary_en' => $validated['summary_en'] ?? null,

            'content' => $validated['content'],
            'content_en' => $validated['content_en'] ?? null,

            'is_published' => $request->boolean('is_published'),
        ];

        if ($post->title !== $validated['title']) {
            $data['slug'] =
                Str::slug($validated['title']) . '-' . rand(100, 999);
        }

        if ($request->hasFile('image')) {
            if (
                !empty($post->image)
                &&
                Storage::disk('public')->exists($post->image)
            ) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('posts', 'public');
        }

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Yazı başarıyla güncellendi.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Post $post)
    {
        if (
            !empty($post->image)
            &&
            Storage::disk('public')->exists($post->image)
        ) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Yazı başarıyla silindi.');
    }
}