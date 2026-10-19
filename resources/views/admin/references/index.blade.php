@extends('admin.layouts.app')

@section('title', 'Referanslar | Portfolio Admin')
@section('page-title', 'Referanslar')

@section('content')

<div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

    <div>

        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
            Referanslar
        </span>

        <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
            Müşteri referanslarını yönetin
        </h2>

        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
            Firma bilgilerini, logoları, sıralamayı ve yayın durumlarını buradan yönetebilirsiniz.
        </p>

    </div>


    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">

            <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">

                <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                    Toplam
                </p>

                <p class="mt-2 text-2xl font-semibold text-white">
                    {{ $references->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">

                <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                    Aktif
                </p>

                <p class="mt-2 text-2xl font-semibold text-emerald-400">
                    {{ $references->where('is_active', true)->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">

                <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                    Pasif
                </p>

                <p class="mt-2 text-2xl font-semibold text-slate-300">
                    {{ $references->where('is_active', false)->count() }}
                </p>

            </div>

        </div>


        <a
            href="{{ route('admin.references.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
        >
            + Yeni Referans
        </a>

    </div>

</div>


<div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

    <div class="flex flex-col gap-4 border-b border-white/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-sm font-semibold text-white">
                Referans Listesi
            </p>

            <p class="mt-1 text-xs text-slate-500">
                Tüm kayıtlar ve yayın durumları
            </p>

        </div>


        <a
            href="{{ route('admin.references.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"
        >
            + Referans Ekle
        </a>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full min-w-[980px]">

            <thead>

                <tr class="border-b border-white/10 bg-white/[0.02]">

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Logo
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Firma
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Unvan
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Durum
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Sıra
                    </th>

                    <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        İşlemler
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-white/5">

                @forelse($references as $reference)

                    <tr class="group transition hover:bg-white/[0.025]">

                        <td class="px-6 py-5">

                            @if($reference->logo)

                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white p-2">

                                    <img
                                        src="{{ asset('storage/' . $reference->logo) }}"
                                        alt="{{ $reference->company }}"
                                        class="max-h-full max-w-full object-contain"
                                    >

                                </div>

                            @else

                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-xs text-slate-500">
                                    Logo Yok
                                </div>

                            @endif

                        </td>


                        <td class="px-6 py-5">

                            <div class="max-w-[280px]">

                                <p class="truncate text-sm font-semibold text-white">
                                    {{ $reference->company }}
                                </p>

                                @if($reference->website_url)

                                    <a
                                        href="{{ $reference->website_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="mt-1 block truncate text-xs text-slate-500 transition hover:text-slate-300"
                                    >
                                        {{ $reference->website_url }}
                                    </a>

                                @endif

                            </div>

                        </td>


                        <td class="px-6 py-5">

                            <p class="max-w-[220px] truncate text-sm text-slate-400">
                                {{ $reference->title ?: 'Belirtilmedi' }}
                            </p>

                        </td>


                        <td class="px-6 py-5">

                            @if($reference->is_active)

                                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-xs font-medium text-emerald-300">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                    Aktif
                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-slate-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>

                                    Pasif
                                </span>

                            @endif

                        </td>


                        <td class="px-6 py-5">

                            <span class="inline-flex min-w-9 items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm font-medium text-slate-300">
                                {{ $reference->sort_order }}
                            </span>

                        </td>


                        <td class="px-6 py-5">

                            <div class="flex items-center justify-end gap-2">

                                <a
                                    href="{{ route('admin.references.edit', $reference) }}"
                                    class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white"
                                >
                                    Düzenle
                                </a>


                                <form
                                    action="{{ route('admin.references.destroy', $reference) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bu referansı silmek istediğinize emin misiniz?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-medium text-red-300 transition hover:bg-red-500/20 hover:text-red-200"
                                    >
                                        Sil
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="px-6 py-20">

                            <div class="flex flex-col items-center justify-center text-center">

                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-xl text-slate-500">
                                    +
                                </div>

                                <p class="mt-4 text-sm font-semibold text-slate-300">
                                    Henüz referans eklenmedi
                                </p>

                                <p class="mt-1 max-w-sm text-xs leading-5 text-slate-500">
                                    İlk referansınızı ekleyerek referans yönetimini kullanmaya başlayabilirsiniz.
                                </p>

                                <a
                                    href="{{ route('admin.references.create') }}"
                                    class="mt-5 inline-flex items-center rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                                >
                                    Yeni Referans Ekle
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection