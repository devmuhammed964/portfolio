<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Portfolio Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="hidden w-72 shrink-0 border-r border-white/10 bg-slate-950 lg:flex lg:flex-col">

        {{-- BRAND --}}
        <div class="border-b border-white/10 px-6 py-6">

            <p class="text-xs font-medium uppercase tracking-[0.28em] text-slate-500">
                Yönetim Paneli
            </p>

            <h1 class="mt-2 text-xl font-semibold text-white">
                Portfolio Admin
            </h1>

        </div>


        {{-- NAV --}}
        <nav class="flex-1 space-y-1.5 px-4 py-6">

            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm transition
                {{ request()->routeIs('admin.dashboard') || request()->routeIs('dashboard')
                    ? 'bg-white font-semibold text-slate-950'
                    : 'font-medium text-slate-400 hover:bg-white/5 hover:text-white' }}"
            >
                Dashboard
            </a>


            <a
                href="{{ route('admin.projects.index') }}"
                class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm transition
                {{ request()->routeIs('admin.projects.*')
                    ? 'bg-white font-semibold text-slate-950'
                    : 'font-medium text-slate-400 hover:bg-white/5 hover:text-white' }}"
            >
                Projeler
            </a>


            <a
                href="{{ route('admin.services.index') }}"
                class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm transition
                {{ request()->routeIs('admin.services.*')
                    ? 'bg-white font-semibold text-slate-950'
                    : 'font-medium text-slate-400 hover:bg-white/5 hover:text-white' }}"
            >
                Hizmetler
            </a>


            <a
                href="{{ route('admin.posts.index') }}"
                class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm transition
                {{ request()->routeIs('admin.posts.*')
                    ? 'bg-white font-semibold text-slate-950'
                    : 'font-medium text-slate-400 hover:bg-white/5 hover:text-white' }}"
            >
                Haberler
            </a>


            <a
                href="{{ route('admin.references.index') }}"
                class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm transition
                {{ request()->routeIs('admin.references.*')
                    ? 'bg-white font-semibold text-slate-950'
                    : 'font-medium text-slate-400 hover:bg-white/5 hover:text-white' }}"
            >
                Referanslar
            </a>


            <a
                href="{{ route('admin.messages.index') }}"
                class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm transition
                {{ request()->routeIs('admin.messages.*')
                    ? 'bg-white font-semibold text-slate-950'
                    : 'font-medium text-slate-400 hover:bg-white/5 hover:text-white' }}"
            >
                Mesajlar
            </a>


            <a
                href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm transition
                {{ request()->routeIs('admin.settings.*')
                    ? 'bg-white font-semibold text-slate-950'
                    : 'font-medium text-slate-400 hover:bg-white/5 hover:text-white' }}"
            >
                Site Ayarları
            </a>

        </nav>


        {{-- SIDEBAR FOOTER --}}
        <div class="border-t border-white/10 p-4">

            <a
                href="{{ route('profile.edit') }}"
                class="mb-2 flex items-center rounded-2xl px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
            >
                Profil Ayarları
            </a>


            <form
                method="POST"
                action="{{ route('logout') }}"
                class="w-full"
            >
                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center rounded-2xl px-4 py-3 text-left text-sm font-medium text-red-300 transition hover:bg-red-500/10 hover:text-red-200"
                >
                    Çıkış Yap
                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN --}}
    <main class="min-w-0 flex-1">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/90 backdrop-blur">

            <div class="flex items-center justify-between px-6 py-5 lg:px-10">

                <div>

                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-slate-500">
                        Portfolio Admin
                    </p>

                    <h2 class="mt-1 text-xl font-semibold text-white">
                        @yield('page-title', 'Yönetim Paneli')
                    </h2>

                </div>


                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="hidden rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white sm:inline-flex"
                    >
                        Siteyi Görüntüle
                    </a>


                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-sm font-semibold text-white">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                </div>

            </div>

        </header>


        {{-- CONTENT --}}
        <div class="p-6 lg:p-10">

            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-5 py-4 text-sm font-medium text-emerald-300">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 rounded-2xl border border-red-500/20 bg-red-500/10 px-5 py-4 text-sm font-medium text-red-300">
                    {{ session('error') }}
                </div>

            @endif


            @if($errors->any())

                <div class="mb-6 rounded-2xl border border-red-500/20 bg-red-500/10 p-5">

                    <p class="text-sm font-semibold text-red-300">
                        Formda bazı hatalar var.
                    </p>

                    <ul class="mt-3 space-y-1 text-sm text-red-300/80">

                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            @yield('content')

        </div>

    </main>

</div>


@stack('scripts')

</body>
</html>