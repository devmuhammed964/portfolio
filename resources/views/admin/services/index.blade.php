@extends('admin.layouts.app')
@section('title', 'Hizmetler | Portfolio Admin')
@section('page-title', 'Hizmetler')
@section('content')
<div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
    <div>
        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
            Hizmetler
        </span>
        <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
            Hizmet içeriklerini yönetin
        </h2>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
            Hizmetlerin başlık, açıklama, görsel, ikon ve sıralama bilgilerini buradan düzenleyebilirsiniz.
        </p>
    </div>
    <div class="flex items-center gap-3">
        <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">
            <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                Toplam Hizmet
            </p>
            <p class="mt-2 text-2xl font-semibold text-white">
                {{ $services->count() }}
            </p>
        </div>
        <a
            href="{{ route('admin.services.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
        >
            + Yeni Hizmet
        </a>
    </div>
</div>
<div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">
    <div class="flex flex-col gap-4 border-b border-white/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-white">
                Hizmet Listesi
            </p>
            <p class="mt-1 text-xs text-slate-500">
                Tüm kayıtlar sıralama değerine göre gösterilir.
            </p>
        </div>
        <a
            href="{{ route('admin.services.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"
        >
            + Hizmet Ekle
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[1180px]">
            <thead>
                <tr class="border-b border-white/10 bg-white/[0.02]">
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Sıra
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Görsel
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Başlık
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Açıklama
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        İkon
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        İşlemler
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($services as $service)
                    <tr class="group transition hover:bg-white/[0.025]">
                        {{-- ORDER --}}
                        <td class="px-6 py-5">
                            <span class="inline-flex min-w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm font-medium text-slate-300">
                                {{ $service->order ?? 0 }}
                            </span>
                        </td>
                        {{-- IMAGE --}}
                        <td class="px-6 py-5">
                            @if($service->image)
                                <div
                                    class="
                                        relative
                                        h-16
                                        w-24
                                        overflow-hidden
                                        rounded-xl
                                        border
                                        border-white/10
                                        bg-slate-900
                                    "
                                >
                                    <img
                                        src="{{ asset('storage/' . $service->image) }}"
                                        alt="{{ $service->title }}"
                                        class="
                                            h-full
                                            w-full
                                            object-cover
                                            transition
                                            duration-300
                                            group-hover:scale-105
                                        "
                                    >
                                </div>
                            @else
                                <div
                                    class="
                                        flex
                                        h-16
                                        w-24
                                        items-center
                                        justify-center
                                        rounded-xl
                                        border
                                        border-dashed
                                        border-white/10
                                        bg-white/[0.025]
                                    "
                                >
                                    <div class="text-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            class="mx-auto h-5 w-5 text-slate-600"
                                        >
                                            <rect x="3" y="3" width="18" height="18" rx="3"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <path d="m21 15-5-5L5 21"/>
                                        </svg>
                                        <span class="mt-1 block text-[9px] text-slate-600">
                                            Görsel yok
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </td>
                        {{-- TITLE --}}
                        <td class="px-6 py-5">
                            <div class="max-w-[240px]">
                                <p class="truncate text-sm font-semibold text-white">
                                    {{ $service->title }}
                                </p>
                                <div class="mt-2 flex items-center gap-2">
                                    @if($service->image)
                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5
                                                rounded-full
                                                border
                                                border-emerald-500/15
                                                bg-emerald-500/10
                                                px-2.5
                                                py-1
                                                text-[10px]
                                                font-medium
                                                text-emerald-400
                                            "
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            Görsel hazır
                                        </span>
                                    @else
                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5
                                                rounded-full
                                                border
                                                border-amber-500/15
                                                bg-amber-500/10
                                                px-2.5
                                                py-1
                                                text-[10px]
                                                font-medium
                                                text-amber-400
                                            "
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                            Görsel eksik
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    @if(!empty($service->title_en) && !empty($service->description_en))
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-sky-500/15 bg-sky-500/10 px-2.5 py-1 text-[10px] font-medium text-sky-300">
                                            <span class="h-1.5 w-1.5 rounded-full bg-sky-400"></span>
                                            EN Hazır
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-500/15 bg-amber-500/10 px-2.5 py-1 text-[10px] font-medium text-amber-300">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                            EN Eksik
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        {{-- DESCRIPTION --}}
                        <td class="px-6 py-5">
                            <p class="max-w-[360px] text-sm leading-6 text-slate-400">
                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($service->description),
                                    90
                                ) }}
                            </p>
                        </td>
                        {{-- ICON --}}
                        <td class="px-6 py-5">
                            @if($service->icon)
                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        rounded-xl
                                        border
                                        border-white/10
                                        bg-white/5
                                        px-3
                                        py-2
                                        text-xs
                                        font-medium
                                        text-slate-400
                                    "
                                >
                                    {{ $service->icon }}
                                </span>
                            @else
                                <span class="text-sm text-slate-500">
                                    Belirtilmedi
                                </span>
                            @endif
                        </td>
                        {{-- ACTIONS --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                <a
                                    href="{{ route('admin.services.edit', $service) }}"
                                    class="
                                        inline-flex
                                        items-center
                                        gap-2
                                        rounded-xl
                                        border
                                        border-white/10
                                        bg-white/5
                                        px-4
                                        py-2.5
                                        text-sm
                                        font-medium
                                        text-slate-300
                                        transition
                                        hover:border-white/20
                                        hover:bg-white/10
                                        hover:text-white
                                    "
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        class="h-4 w-4"
                                    >
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                    </svg>
                                    Düzenle
                                </a>
                                <form
                                    action="{{ route('admin.services.destroy', $service) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bu hizmeti silmek istediğinize emin misiniz?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="
                                            inline-flex
                                            items-center
                                            gap-2
                                            rounded-xl
                                            border
                                            border-red-500/20
                                            bg-red-500/10
                                            px-4
                                            py-2.5
                                            text-sm
                                            font-medium
                                            text-red-300
                                            transition
                                            hover:bg-red-500/20
                                            hover:text-red-200
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            class="h-4 w-4"
                                        >
                                            <path d="M3 6h18"/>
                                            <path d="M8 6V4h8v2"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M10 11v5"/>
                                            <path d="M14 11v5"/>
                                        </svg>
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
                                <div
                                    class="
                                        flex
                                        h-14
                                        w-14
                                        items-center
                                        justify-center
                                        rounded-2xl
                                        border
                                        border-white/10
                                        bg-white/5
                                        text-xl
                                        text-slate-500
                                    "
                                >
                                    +
                                </div>
                                <p class="mt-4 text-sm font-semibold text-slate-300">
                                    Henüz hizmet eklenmedi
                                </p>
                                <p class="mt-1 max-w-sm text-xs leading-5 text-slate-500">
                                    İlk hizmetinizi ekleyerek hizmet yönetimini kullanmaya başlayabilirsiniz.
                                </p>
                                <a
                                    href="{{ route('admin.services.create') }}"
                                    class="
                                        mt-5
                                        inline-flex
                                        items-center
                                        rounded-xl
                                        bg-white
                                        px-4
                                        py-2.5
                                        text-sm
                                        font-semibold
                                        text-slate-950
                                        transition
                                        hover:bg-slate-200
                                    "
                                >
                                    Yeni Hizmet Ekle
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
