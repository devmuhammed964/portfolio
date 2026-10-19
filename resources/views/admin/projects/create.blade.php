@extends('admin.layouts.app')
@section('title', 'Yeni Proje Ekle | Portfolio Admin')
@section('page-title', 'Yeni Proje Ekle')
@section('content')
<div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_320px]">
    <section>
        <div class="mb-8">
            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
                Proje Yönetimi
            </span>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
                Yeni bir proje oluşturun
            </h2>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
                Projenin başlık, açıklama, teknoloji, bağlantı ve görsel bilgilerini ekleyin.
            </p>
        </div>
        <form
            action="{{ route('admin.projects.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20"
        >
            @csrf
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
                        value="{{ old('title') }}"
                        required
                        placeholder="Örn. Kurumsal Web Sitesi"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >
                </div>
                <div>
                    <label for="title_en" class="mb-2 block text-sm font-medium text-slate-300">
                        Proje Başlığı (İngilizce)
                    </label>
                    <input
                        id="title_en"
                        type="text"
                        name="title_en"
                        value="{{ old('title_en') }}"
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
                        placeholder="Projeyi detaylı şekilde açıklayın..."
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('description') }}</textarea>
                </div>
                <div>
                    <label for="description_en" class="mb-2 block text-sm font-medium text-slate-300">
                        Açıklama (İngilizce)
                    </label>
                    <textarea
                        id="description_en"
                        name="description_en"
                        rows="7"
                        placeholder="Describe the project in detail..."
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('description_en') }}</textarea>
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
                        value="{{ old('technologies') }}"
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
                        value="{{ old('sort_order', 0) }}"
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
                            value="{{ old('project_url') }}"
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
                            value="{{ old('github_url') }}"
                            placeholder="https://github.com/..."
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >
                    </div>
                </div>
                <div>
                    <label class="mb-3 block text-sm font-medium text-slate-300">
                        Proje Görseli
                    </label>
                    <label
                        for="image"
                        class="group flex min-h-[170px] cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-white/15 bg-slate-900/50 px-6 py-8 text-center transition hover:border-white/30 hover:bg-slate-900"
                    >
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 text-xl text-slate-400 transition group-hover:bg-white/10 group-hover:text-white">
                            ↑
                        </div>
                        <p class="mt-4 text-sm font-medium text-slate-300">
                            Görsel seçmek için tıklayın
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
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-white/20 bg-slate-800 text-slate-200 focus:ring-slate-500"
                        >
                    </label>
                </div>
            </div>
            <div class="flex flex-col-reverse gap-3 border-t border-white/10 bg-black/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">
                <p class="text-xs text-slate-500">
                    Kaydettiğiniz proje doğrudan sistemde oluşturulacaktır.
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
                        Projeyi Kaydet
                    </button>
                </div>
            </div>
        </form>
    </section>
    <aside class="xl:pt-[118px]">
        <div class="sticky top-8 space-y-4">
            <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">
                <p class="text-sm font-semibold text-white">
                    Proje İpuçları
                </p>
                <div class="mt-5 space-y-4">
                    <div class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            01
                        </span>
                        <p class="text-sm leading-6 text-slate-400">
                            Proje görselini mümkün olduğunca yüksek kaliteli kullanın.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            02
                        </span>
                        <p class="text-sm leading-6 text-slate-400">
                            Teknolojileri virgülle ayırarak ekleyin.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            03
                        </span>
                        <p class="text-sm leading-6 text-slate-400">
                            Öne çıkarılan projeler ana sayfada daha görünür olur.
                        </p>
                    </div>
                </div>
            </div>
            <div class="rounded-[24px] border border-white/10 bg-gradient-to-br from-white/[0.06] to-transparent p-5">
                <p class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">
                    Durum
                </p>
                <div class="mt-3 flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                    <p class="text-sm font-medium text-slate-300">
                        Proje modülü aktif
                    </p>
                </div>
            </div>
        </div>
    </aside>
</div>
@endsection
