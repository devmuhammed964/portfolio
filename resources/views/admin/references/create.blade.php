@extends('admin.layouts.app')

@section('title', 'Yeni Referans | Portfolio Admin')
@section('page-title', 'Yeni Referans')

@section('content')

<div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_320px]">

    <section>

        <div class="mb-8">

            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
                Referans Yönetimi
            </span>

            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
                Yeni bir referans oluşturun
            </h2>

            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
                Firma bilgilerini, logoyu ve müşteri yorumunu ekleyerek referansınızı yayınlayabilirsiniz.
            </p>

        </div>


        <form
            action="{{ route('admin.references.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20"
        >

            @csrf


            <div class="border-b border-white/10 px-6 py-5 sm:px-8">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/5 text-slate-300">
                        +
                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Referans Bilgileri
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Temel firma ve iletişim bilgilerini girin.
                        </p>

                    </div>

                </div>

            </div>


            <div class="space-y-8 p-6 sm:p-8">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label
                            for="company"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Firma / Kişi Adı
                        </label>

                        <input
                            id="company"
                            type="text"
                            name="company"
                            value="{{ old('company') }}"
                            required
                            placeholder="Örn. ABC Teknoloji"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >

                    </div>


                    <div>

                        <label
                            for="title"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Unvan / Pozisyon
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Örn. Genel Müdür"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >

                    </div>

                </div>


                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-300">
                        Logo
                    </label>

                    <label
                        for="logo"
                        class="group flex min-h-[150px] cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-white/15 bg-slate-900/50 px-6 py-8 text-center transition hover:border-white/30 hover:bg-slate-900"
                    >

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 text-xl text-slate-400 transition group-hover:bg-white/10 group-hover:text-white">
                            ↑
                        </div>

                        <p class="mt-4 text-sm font-medium text-slate-300">
                            Logo seçmek için tıklayın
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            JPG, PNG, WEBP veya SVG · Maksimum 4 MB
                        </p>

                        <input
                            id="logo"
                            type="file"
                            name="logo"
                            accept=".jpg,.jpeg,.png,.webp,.svg"
                            class="hidden"
                        >

                    </label>

                </div>


                <div>

                    <label
                        for="website_url"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Web Sitesi
                    </label>

                    <input
                        id="website_url"
                        type="url"
                        name="website_url"
                        value="{{ old('website_url') }}"
                        placeholder="https://example.com"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >

                </div>


                <div>

                    <label
                        for="comment"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Müşteri Yorumu
                    </label>

                    <textarea
                        id="comment"
                        name="comment"
                        rows="6"
                        placeholder="Referans yorumunu buraya yazın..."
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('comment') }}</textarea>

                </div>


                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label
                            for="sort_order"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Sıralama
                        </label>

                        <input
                            id="sort_order"
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >

                    </div>


                    <div>

                        <span class="mb-2 block text-sm font-medium text-slate-300">
                            Yayın Durumu
                        </span>

                        <label class="flex h-[54px] cursor-pointer items-center justify-between rounded-2xl border border-white/10 bg-slate-900/80 px-4">

                            <div>

                                <p class="text-sm font-medium text-white">
                                    Aktif olarak yayınla
                                </p>

                                <p class="text-xs text-slate-500">
                                    Ön yüzde görünür olacaktır.
                                </p>

                            </div>

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="h-5 w-5 rounded border-white/20 bg-slate-800 text-slate-200 focus:ring-slate-500"
                            >

                        </label>

                    </div>

                </div>

            </div>


            <div class="flex flex-col-reverse gap-3 border-t border-white/10 bg-black/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">

                <p class="text-xs text-slate-500">
                    Kaydettiğiniz referans yönetim panelinde listelenecektir.
                </p>

                <div class="flex gap-3">

                    <a
                        href="{{ route('admin.references.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"
                    >
                        Vazgeç
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                    >
                        Referansı Kaydet
                    </button>

                </div>

            </div>

        </form>

    </section>


    <aside class="xl:pt-[118px]">

        <div class="sticky top-8 space-y-4">

            <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">

                <p class="text-sm font-semibold text-white">
                    Referans İpuçları
                </p>

                <div class="mt-5 space-y-4">

                    <div class="flex gap-3">

                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            01
                        </span>

                        <p class="text-sm leading-6 text-slate-400">
                            Mümkünse şeffaf arka planlı PNG veya SVG logo kullanın.
                        </p>

                    </div>


                    <div class="flex gap-3">

                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            02
                        </span>

                        <p class="text-sm leading-6 text-slate-400">
                            Sıralama değeri düşük olan referanslar önce gösterilir.
                        </p>

                    </div>


                    <div class="flex gap-3">

                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                            03
                        </span>

                        <p class="text-sm leading-6 text-slate-400">
                            Pasif referanslar panelde kalır ancak ön yüzde yayınlanmaz.
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
                        Referans modülü aktif
                    </p>

                </div>

            </div>

        </div>

    </aside>

</div>

@endsection