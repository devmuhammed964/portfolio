@extends('admin.layouts.app')
@section('title', 'Yeni Haber Ekle | Portfolio Admin')
@section('page-title', 'Yeni Haber Ekle')
@section('content')
<div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_320px]">
    <section>
        <div class="mb-8">
            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
                Haber Yönetimi
            </span>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
                Yeni bir içerik yayınlayın
            </h2>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
                Haber başlığı, kısa özet, içerik ve kapak görselini ekleyerek yayına hazırlayın.
            </p>
        </div>
        <form
            action="{{ route('admin.posts.store') }}"
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
                        Yazı Başlığı
                    </label>
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="Örn. Yeni Web Projemizi Yayına Aldık"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >
                </div>
                <div>
                    <label
                        for="title_en"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Yazı Başlığı (İngilizce)
                    </label>
                    <input
                        id="title_en"
                        type="text"
                        name="title_en"
                        value="{{ old('title_en') }}"
                        placeholder="Example: We Launched Our New Web Project"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >
                    <p class="mt-2 text-xs text-slate-500">
                        Boş bırakırsanız İngilizce sayfada Türkçe başlık gösterilir.
                    </p>
                </div>
                <div>
                    <label
                        for="summary"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Kısa Özet
                    </label>
                    <textarea
                        id="summary"
                        name="summary"
                        rows="3"
                        placeholder="Kartlarda ve liste sayfasında görünecek kısa açıklama..."
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('summary') }}</textarea>
                </div>
                <div>
                    <label
                        for="summary_en"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Kısa Özet (İngilizce)
                    </label>
                    <textarea
                        id="summary_en"
                        name="summary_en"
                        rows="3"
                        placeholder="Short summary for cards and listing pages..."
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('summary_en') }}</textarea>
                    <p class="mt-2 text-xs text-slate-500">
                        Boş bırakırsanız İngilizce sayfada Türkçe özet kullanılır.
                    </p>
                </div>
                <div>
                    <label
                        for="content"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        İçerik
                    </label>
                    <textarea
                        id="content"
                        name="content"
                        rows="12"
                        required
                        placeholder="Haber veya blog içeriğini buraya yazın..."
                        class="w-full resize-y rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-7 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('content') }}</textarea>
                </div>
                <div>
                    <label
                        for="content_en"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        İçerik (İngilizce)
                    </label>
                    <textarea
                        id="content_en"
                        name="content_en"
                        rows="12"
                        placeholder="Write the news or blog content in English..."
                        class="w-full resize-y rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-7 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('content_en') }}</textarea>
                    <p class="mt-2 text-xs text-slate-500">
                        Boş bırakırsanız İngilizce sayfada Türkçe içerik gösterilir.
                    </p>
                </div>
                <div>
                    <label class="mb-3 block text-sm font-medium text-slate-300">
                        Kapak Görseli
                    </label>
                    <label
                        for="image"
                        class="group flex min-h-[180px] cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-white/15 bg-slate-900/50 px-6 py-8 text-center transition hover:border-white/30 hover:bg-slate-900"
                    >
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 text-xl text-slate-400 transition group-hover:bg-white/10 group-hover:text-white">
                            ↑
                        </div>
                        <p class="mt-4 text-sm font-medium text-slate-300">
                            Kapak görseli seçmek için tıklayın
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
                        Yayın Durumu
                    </span>
                    <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4">
                        <div>
                            <p class="text-sm font-medium text-white">
                                Yayında Olsun
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                Aktif olduğunda haber ön yüzde görüntülenir.
                            </p>
                        </div>
                        <input
                            type="checkbox"
                            name="is_published"
                            id="is_published"
                            value="1"
                            {{ old('is_published', true) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-white/20 bg-slate-800 text-slate-200 focus:ring-slate-500"
                        >
                    </label>
                </div>
            </div>
            <div class="flex flex-col-reverse gap-3 border-t border-white/10 bg-black/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">
                <p class="text-xs text-slate-500">
                    Yayınlanan içerik haberler sayfasında gösterilecektir.
                </p>
                <div class="flex gap-3">
                    <a
                        href="{{ route('admin.posts.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"
                    >
                        Vazgeç
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                    >
                        Yazıyı Kaydet
                    </button>
                </div>
            </div>
        </form>
    </section>
    <aside class="xl:pt-[118px]">
        <div class="sticky top-8 space-y-4">
            <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">
                <p class="text-sm font-semibold text-white">
                    İçerik İpuçları
                </p>
                <div class="mt-5 space-y-4">
                    <div class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            01
                        </span>
                        <p class="text-sm leading-6 text-slate-400">
                            Başlığı kısa ve dikkat çekici tutun.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            02
                        </span>
                        <p class="text-sm leading-6 text-slate-400">
                            Kısa özet alanı liste ve kart gösterimlerinde kullanılır.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            03
                        </span>
                        <p class="text-sm leading-6 text-slate-400">
                            Kapak görselini mümkün olduğunca yatay ve yüksek kaliteli seçin.
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
                        Haber modülü aktif
                    </p>
                </div>
            </div>
        </div>
    </aside>
</div>
@endsection
