@extends('admin.layouts.app')
@section('title', 'Haber Yönetimi | Portfolio Admin')
@section('page-title', 'Haberler')
@section('content')
<div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
    <div>
        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
            Haberler
        </span>
        <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
            Haber ve blog içeriklerini yönetin
        </h2>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
            İçeriklerin yayın durumlarını, kapak görsellerini ve düzenleme işlemlerini buradan yönetin.
        </p>
    </div>
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
            <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                    Toplam
                </p>
                <p class="mt-2 text-2xl font-semibold text-white">
                    {{ $posts->total() }}
                </p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                    Yayında
                </p>
                <p class="mt-2 text-2xl font-semibold text-emerald-400">
                    {{ $posts->getCollection()->where('is_published', true)->count() }}
                </p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                    Taslak
                </p>
                <p class="mt-2 text-2xl font-semibold text-slate-300">
                    {{ $posts->getCollection()->where('is_published', false)->count() }}
                </p>
            </div>
        </div>
        <a
            href="{{ route('admin.posts.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
        >
            + Yeni Haber
        </a>
    </div>
</div>
<div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">
    <div class="flex flex-col gap-4 border-b border-white/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-white">
                Haber Listesi
            </p>
            <p class="mt-1 text-xs text-slate-500">
                Tüm içerikler ve yayın durumları
            </p>
        </div>
        <a
            href="{{ route('admin.posts.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"
        >
            + Haber Ekle
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[1100px]">
            <thead>
                <tr class="border-b border-white/10 bg-white/[0.02]">
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Görsel
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Başlık
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Durum
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Tarih
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        İşlemler
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($posts as $post)
                    <tr class="group transition hover:bg-white/[0.025]">
                        <td class="px-6 py-5">
                            @if($post->image)
                                <div class="h-16 w-24 overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                                    <img
                                        src="{{ asset('storage/' . $post->image) }}"
                                        alt="{{ $post->title }}"
                                        class="h-full w-full object-cover"
                                    >
                                </div>
                            @else
                                <div class="flex h-16 w-24 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-xs text-slate-500">
                                    Görsel Yok
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div class="max-w-[420px]">
                                <p class="truncate text-sm font-semibold text-white">
                                    {{ $post->title }}
                                </p>
                                @if($post->summary)
                                    <p class="mt-1 text-xs leading-5 text-slate-500">
                                        {{ \Illuminate\Support\Str::limit($post->summary, 90) }}
                                    </p>
                                @else
                                    <p class="mt-1 text-xs text-slate-600">
                                        Özet eklenmemiş
                                    </p>
                                @endif
                                <div class="mt-3">
                                    @if(
                                        !empty($post->title_en)
                                        && !empty($post->summary_en)
                                        && !empty($post->content_en)
                                    )
                                        <span class="inline-flex items-center gap-2 rounded-full border border-sky-500/20 bg-sky-500/10 px-2.5 py-1 text-[10px] font-medium text-sky-300">
                                            <span class="h-1.5 w-1.5 rounded-full bg-sky-400"></span>
                                            EN Hazır
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-full border border-amber-500/20 bg-amber-500/10 px-2.5 py-1 text-[10px] font-medium text-amber-300">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                            EN Eksik
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @if($post->is_published)
                                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-xs font-medium text-emerald-300">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                    Yayında
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-slate-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>
                                    Taslak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div>
                                <p class="text-sm text-slate-300">
                                    {{ $post->created_at->format('d.m.Y') }}
                                </p>
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $post->created_at->format('H:i') }}
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                @if($post->is_published)
                                    <a
                                        href="{{ route('news.show', $post->slug) }}"
                                        target="_blank"
                                        class="inline-flex items-center rounded-xl border border-white/10 bg-white/5 px-3.5 py-2.5 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white"
                                    >
                                        Görüntüle
                                    </a>
                                @endif
                                <a
                                    href="{{ route('admin.posts.edit', $post) }}"
                                    class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white"
                                >
                                    Düzenle
                                </a>
                                <form
                                    action="{{ route('admin.posts.destroy', $post) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bu haberi silmek istediğinize emin misiniz?')"
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
                        <td colspan="5" class="px-6 py-20">
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-xl text-slate-500">
                                    +
                                </div>
                                <p class="mt-4 text-sm font-semibold text-slate-300">
                                    Henüz haber eklenmedi
                                </p>
                                <p class="mt-1 max-w-sm text-xs leading-5 text-slate-500">
                                    İlk haber veya blog içeriğinizi ekleyerek içerik yönetimini kullanmaya başlayabilirsiniz.
                                </p>
                                <a
                                    href="{{ route('admin.posts.create') }}"
                                    class="mt-5 inline-flex items-center rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                                >
                                    Yeni Haber Ekle
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($posts->hasPages())
    <div class="mt-6 rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">
        {{ $posts->links() }}
    </div>
@endif
@endsection
