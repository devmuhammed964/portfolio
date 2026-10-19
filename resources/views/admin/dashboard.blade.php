@extends('admin.layouts.app')

@section('title', 'Dashboard | Portfolio Admin')
@section('page-title', 'Dashboard')

@section('content')

<section class="relative overflow-hidden rounded-[30px] border border-white/10 bg-gradient-to-br from-white/[0.08] to-transparent p-7 lg:p-9">

    <div class="relative z-10 max-w-2xl">

        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
            Hoş geldiniz
        </span>

        <h1 class="mt-5 text-3xl font-semibold tracking-tight text-white lg:text-4xl">
            Portfolyonuzu tek panelden yönetin.
        </h1>

        <p class="mt-4 max-w-xl text-sm leading-7 text-slate-400">
            Projeler, hizmetler, haberler, referanslar ve gelen mesajlar için tüm yönetim araçları burada.
        </p>

        <div class="mt-7 flex flex-wrap gap-3">

            <a
                href="{{ route('admin.projects.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
            >
                Yeni Proje Ekle
            </a>

            <a
                href="{{ route('admin.references.create') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"
            >
                Referans Ekle
            </a>

        </div>

    </div>

</section>


<section class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

    <a
        href="{{ route('admin.projects.index') }}"
        class="group rounded-[24px] border border-white/10 bg-white/[0.035] p-6 transition hover:-translate-y-0.5 hover:bg-white/[0.06]"
    >

        <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
            Projeler
        </p>

        <div class="mt-4 flex items-end justify-between">

            <p class="text-3xl font-semibold text-white">
                {{ $projectCount ?? 0 }}
            </p>

            <span class="text-sm text-slate-500 transition group-hover:text-slate-300">
                Görüntüle →
            </span>

        </div>

    </a>


    <a
        href="{{ route('admin.services.index') }}"
        class="group rounded-[24px] border border-white/10 bg-white/[0.035] p-6 transition hover:-translate-y-0.5 hover:bg-white/[0.06]"
    >

        <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
            Hizmetler
        </p>

        <div class="mt-4 flex items-end justify-between">

            <p class="text-3xl font-semibold text-white">
                {{ $serviceCount ?? 0 }}
            </p>

            <span class="text-sm text-slate-500 transition group-hover:text-slate-300">
                Görüntüle →
            </span>

        </div>

    </a>


    <a
        href="{{ route('admin.references.index') }}"
        class="group rounded-[24px] border border-white/10 bg-white/[0.035] p-6 transition hover:-translate-y-0.5 hover:bg-white/[0.06]"
    >

        <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
            Referanslar
        </p>

        <div class="mt-4 flex items-end justify-between">

            <p class="text-3xl font-semibold text-white">
                {{ $referenceCount ?? 0 }}
            </p>

            <span class="text-sm text-slate-500 transition group-hover:text-slate-300">
                Görüntüle →
            </span>

        </div>

    </a>


    <a
        href="{{ route('admin.messages.index') }}"
        class="group rounded-[24px] border border-white/10 bg-white/[0.035] p-6 transition hover:-translate-y-0.5 hover:bg-white/[0.06]"
    >

        <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
            Mesajlar
        </p>

        <div class="mt-4 flex items-end justify-between">

            <p class="text-3xl font-semibold text-white">
                {{ $messageCount ?? 0 }}
            </p>

            <span class="text-sm text-slate-500 transition group-hover:text-slate-300">
                Görüntüle →
            </span>

        </div>

    </a>

</section>


<section class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-[1.4fr_1fr]">

    <div class="rounded-[28px] border border-white/10 bg-white/[0.035]">

        <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">

            <div>

                <h3 class="font-semibold text-white">
                    Hızlı İşlemler
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Sık kullanılan yönetim ekranları
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 gap-3 p-5 sm:grid-cols-2">

            <a
                href="{{ route('admin.projects.create') }}"
                class="group rounded-2xl border border-white/10 bg-slate-900/60 p-5 transition hover:border-white/20 hover:bg-slate-900"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-semibold text-white">
                            Yeni Proje
                        </p>

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Portfolyoya yeni bir çalışma ekleyin.
                        </p>

                    </div>

                    <span class="text-slate-600 transition group-hover:text-slate-300">
                        ↗
                    </span>

                </div>

            </a>


            <a
                href="{{ route('admin.services.create') }}"
                class="group rounded-2xl border border-white/10 bg-slate-900/60 p-5 transition hover:border-white/20 hover:bg-slate-900"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-semibold text-white">
                            Yeni Hizmet
                        </p>

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Hizmetler bölümüne yeni içerik ekleyin.
                        </p>

                    </div>

                    <span class="text-slate-600 transition group-hover:text-slate-300">
                        ↗
                    </span>

                </div>

            </a>


            <a
                href="{{ route('admin.posts.create') }}"
                class="group rounded-2xl border border-white/10 bg-slate-900/60 p-5 transition hover:border-white/20 hover:bg-slate-900"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-semibold text-white">
                            Yeni Haber
                        </p>

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Haber veya blog içeriği yayınlayın.
                        </p>

                    </div>

                    <span class="text-slate-600 transition group-hover:text-slate-300">
                        ↗
                    </span>

                </div>

            </a>


            <a
                href="{{ route('admin.references.create') }}"
                class="group rounded-2xl border border-white/10 bg-slate-900/60 p-5 transition hover:border-white/20 hover:bg-slate-900"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-semibold text-white">
                            Yeni Referans
                        </p>

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Yeni müşteri veya firma referansı ekleyin.
                        </p>

                    </div>

                    <span class="text-slate-600 transition group-hover:text-slate-300">
                        ↗
                    </span>

                </div>

            </a>

        </div>

    </div>


    <div class="rounded-[28px] border border-white/10 bg-white/[0.035]">

        <div class="border-b border-white/10 px-6 py-5">

            <h3 class="font-semibold text-white">
                Sistem
            </h3>

            <p class="mt-1 text-xs text-slate-500">
                Yönetim durumu
            </p>

        </div>


        <div class="space-y-5 p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-300">
                        CMS
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        İçerik yönetim sistemi
                    </p>

                </div>

                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-xs font-medium text-emerald-300">

                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                    Aktif
                </span>

            </div>


            <div class="border-t border-white/10"></div>


            <div>

                <p class="text-sm font-medium text-slate-300">
                    Kullanıcı
                </p>

                <p class="mt-1 break-all text-xs text-slate-500">
                    {{ auth()->user()->email }}
                </p>

            </div>


            <div class="border-t border-white/10"></div>


            <a
                href="{{ route('admin.settings.index') }}"
                class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-900/50 px-4 py-4 text-sm font-medium text-slate-300 transition hover:bg-slate-900 hover:text-white"
            >
                Site Ayarları

                <span>→</span>
            </a>


            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-900/50 px-4 py-4 text-sm font-medium text-slate-300 transition hover:bg-slate-900 hover:text-white"
            >
                Profil Ayarları

                <span>→</span>
            </a>

        </div>

    </div>

</section>

@endsection