@extends('admin.layouts.app')

@section('title', 'Profil Ayarları | Portfolio Admin')
@section('page-title', 'Profil Ayarları')

@section('content')

<div class="mx-auto max-w-[1180px]">

    <div class="mb-8">
        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
            Hesap Yönetimi
        </span>

        <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
            Hesap bilgilerinizi yönetin
        </h2>

        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
            Profil bilgilerinizi güncelleyin, giriş şifrenizi değiştirin ve hesap güvenliği ayarlarınızı yönetin.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1fr_340px]">

        <div class="space-y-6">

            {{-- PROFİL --}}
            <section class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

                <div class="border-b border-white/10 px-6 py-5 sm:px-8">
                    <p class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">
                        Profil
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-white">
                        Profil Bilgileri
                    </h3>
                </div>

                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </section>


            {{-- ŞİFRE --}}
            <section class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

                <div class="border-b border-white/10 px-6 py-5 sm:px-8">
                    <p class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">
                        Güvenlik
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-white">
                        Şifre Değiştir
                    </h3>
                </div>

                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>

            </section>


            {{-- HESAP SİL --}}
            <section class="overflow-hidden rounded-[28px] border border-red-500/15 bg-red-500/[0.035]">

                <div class="p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>

            </section>

        </div>


        {{-- RIGHT --}}
        <aside>

            <div class="sticky top-28 space-y-4">

                <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">

                    <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                        Aktif Hesap
                    </p>

                    <div class="mt-5 flex items-center gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-base font-semibold text-white">
                            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-sm font-semibold text-white">
                                {{ $user->name }}
                            </p>

                            <p class="mt-1 truncate text-xs text-slate-500">
                                {{ $user->email }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">

                    <p class="text-sm font-semibold text-white">
                        Hesap Güvenliği
                    </p>

                    <div class="mt-5 space-y-4">

                        <div class="flex gap-3">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                                01
                            </span>

                            <p class="text-sm leading-6 text-slate-400">
                                Güçlü ve benzersiz bir şifre kullanın.
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                                02
                            </span>

                            <p class="text-sm leading-6 text-slate-400">
                                E-posta adresiniz admin paneline giriş için kullanılır.
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">
                                03
                            </span>

                            <p class="text-sm leading-6 text-slate-400">
                                Şifrenizi belirli aralıklarla güncelleyin.
                            </p>
                        </div>

                    </div>

                </div>


                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center justify-between rounded-[24px] border border-white/10 bg-white/[0.035] p-5 text-sm font-medium text-slate-300 transition hover:bg-white/[0.06] hover:text-white"
                >
                    Yönetim Paneline Dön

                    <span>→</span>
                </a>

            </div>

        </aside>

    </div>

</div>

@endsection