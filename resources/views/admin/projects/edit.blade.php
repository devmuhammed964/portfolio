@extends('admin.layouts.app')
@section('title', 'Proje Düzenle | Portfolio Admin')
@section('page-title', 'Proje Düzenle')
@section('content')
<div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_320px]">
    <section>
        <div class="mb-8">
            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
                Proje Yönetimi
            </span>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
                {{ $project->title }}
            </h2>
            <p class="mt-3 text-sm leading-6 text-slate-400">
                Projenin içerik, bağlantı, teknoloji ve görsel bilgilerini güncelleyin.
            </p>
        </div>
        <form
            action="{{ route('admin.projects.update', $project) }}"
            method="POST"
            enctype="multipart/form-data"
            class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20"
        >
            @csrf
            @method('PUT')
            <div class="space-y-8 p-6 sm:p-8">
                <div>
                    <label
                        for="title"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Proje Başlığı
                    </label>
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title', $project->title) }}"
                        required
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >
                </div>
                <div>
                    <label
                        for="title_en"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Proje Başlığı (İngilizce)
                    </label>
                    <input
                        id="title_en"
                        type="text"
                        name="title_en"
                        value="{{ old('title_en', $project->title_en) }}"
                        placeholder="Example: Corporate Website"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >
                    <p class="mt-2 text-xs text-slate-500">
                        Boş bırakırsanız İngilizce sayfada Türkçe başlık gösterilir.
                    </p>
                </div>
                <div>
                    <label
                        for="description"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Açıklama
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        required
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('description', $project->description) }}</textarea>
                </div>
                <div>
                    <label
                        for="description_en"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Açıklama (İngilizce)
                    </label>
                    <textarea
                        id="description_en"
                        name="description_en"
                        rows="7"
                        placeholder="Describe the project in detail..."
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('description_en', $project->description_en) }}</textarea>
                    <p class="mt-2 text-xs text-slate-500">
                        Boş bırakırsanız İngilizce sayfada Türkçe açıklama gösterilir.
                    </p>
                </div>
                <div>
                    <label
                        for="technologies"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Kullanılan Teknolojiler
                    </label>
                    <input
                        id="technologies"
                        type="text"
                        name="technologies"
                        value="{{ old(
                            'technologies',
                            is_array($project->technologies)
                                ? implode(', ', $project->technologies)
                                : $project->technologies
                        ) }}"
                        placeholder="Laravel, Tailwind CSS, Alpine.js"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >
                    <p class="mt-2 text-xs text-slate-500">
                        Teknolojileri virgülle ayırabilirsiniz.
                    </p>
                </div>
                <div>
                    <label
                        for="sort_order"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Proje Sırası
                    </label>
                    <input
                        id="sort_order"
                        type="number"
                        name="sort_order"
                        min="0"
                        value="{{ old('sort_order', $project->sort_order) }}"
                        placeholder="Örn. 1"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >
                    <p class="mt-2 text-xs text-slate-500">
                        Küçük sayı daha üstte görünür. Örn. 1 en üstte, 2 ikinci sırada.
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label
                            for="project_url"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Canlı Site Linki
                        </label>
                        <input
                            id="project_url"
                            type="url"
                            name="project_url"
                            value="{{ old('project_url', $project->project_url) }}"
                            placeholder="https://example.com"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >
                    </div>
                    <div>
                        <label
                            for="github_url"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            GitHub Linki
                        </label>
                        <input
                            id="github_url"
                            type="url"
                            name="github_url"
                            value="{{ old('github_url', $project->github_url) }}"
                            placeholder="https://github.com/..."
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >
                    </div>
                </div>
                <div>
                    <label class="mb-3 block text-sm font-medium text-slate-300">
                        Proje Görseli
                    </label>
                    @if($project->image)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                            <div class="grid gap-4 sm:grid-cols-[180px_1fr] sm:items-center">
                                <img
                                    src="{{ asset('storage/' . $project->image) }}"
                                    alt="{{ $project->title }}"
                                    class="h-32 w-full rounded-xl object-cover"
                                >
                                <div>
                                    <p class="text-sm font-medium text-white">
                                        Mevcut görsel
                                    </p>
                                    <p class="mt-2 text-xs leading-5 text-slate-500">
                                        Yeni bir görsel yüklemezseniz mevcut görsel korunur.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <label
                        for="image"
                        class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-white/15 bg-slate-900/50 px-6 py-8 text-center transition hover:border-white/30 hover:bg-slate-900"
                    >
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 text-xl text-slate-400">
                            ↑
                        </div>
                        <p class="mt-4 text-sm font-medium text-slate-300">
                            Yeni görsel yükle
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            JPG, PNG veya WEBP · Maksimum 2 MB
                        </p>
                        <input
                            id="image"
                            type="file"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="hidden"
                        >
                    </label>
                </div>
                <div>
                    <span class="mb-2 block text-sm font-medium text-slate-300">
                        Proje Durumu
                    </span>
                    <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4">
                        <div>
                            <p class="text-sm font-medium text-white">
                                Öne Çıkarılan Proje
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                Ana sayfadaki öne çıkan projeler alanında gösterilir.
                            </p>
                        </div>
                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-white/20 bg-slate-800 text-slate-200 focus:ring-slate-500"
                        >
                    </label>
                </div>
            </div>
            <div class="flex flex-col-reverse gap-3 border-t border-white/10 bg-black/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">
                <p class="text-xs text-slate-500">
                    Kaydettiğiniz değişiklikler ön yüze uygulanacaktır.
                </p>
                <div class="flex gap-3">
                    <a
                        href="{{ route('admin.projects.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"
                    >
                        Vazgeç
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                    >
                        Değişiklikleri Kaydet
                    </button>
                </div>
            </div>
        </form>
    </section>
    <aside class="xl:pt-[118px]">
        <div class="sticky top-8 space-y-4">
            <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">
                <p class="text-sm font-semibold text-white">
                    Proje Bilgileri
                </p>
                <div class="mt-5 space-y-5">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Başlık
                        </p>
                        <p class="mt-1 text-sm text-slate-300">
                            {{ $project->title }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Slug
                        </p>
                        <p class="mt-1 break-all text-sm text-slate-300">
                            {{ $project->slug }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Proje Sırası
                        </p>
                        <p class="mt-1 text-sm text-slate-300">
                            {{ $project->sort_order }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Öne Çıkan
                        </p>
                        <div class="mt-2">
                            @if($project->is_featured)
                                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-xs font-medium text-emerald-300">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                    Evet
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-slate-400">
                                    Hayır
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <a
                href="{{ route('projects.show', $project->id) }}"
                target="_blank"
                class="flex items-center justify-between rounded-[24px] border border-white/10 bg-white/[0.035] p-5 text-sm font-medium text-slate-300 transition hover:bg-white/[0.06] hover:text-white"
            >
                Projeyi Görüntüle
                <span>↗</span>
            </a>
        </div>
    </aside>
</div>
@endsection
