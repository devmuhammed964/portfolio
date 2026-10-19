@extends('admin.layouts.app')

@section('title', 'Mesajlar | Portfolio Admin')
@section('page-title', 'Mesajlar')

@section('content')

<div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

    <div>

        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
            Gelen Kutusu
        </span>

        <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
            Gelen mesajları yönetin
        </h2>

        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
            İletişim formundan gelen mesajları görüntüleyin, okuyun veya silin.
        </p>

    </div>


    <div class="grid grid-cols-2 gap-3">

        <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">

            <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                Toplam
            </p>

            <p class="mt-2 text-2xl font-semibold text-white">
                {{ $messages->count() }}
            </p>

        </div>


        <div class="rounded-2xl border border-white/10 bg-white/[0.035] px-5 py-4">

            <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                Okunmamış
            </p>

            <p class="mt-2 text-2xl font-semibold text-emerald-400">
                {{ $messages->where('is_read', false)->count() }}
            </p>

        </div>

    </div>

</div>


<div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

    <div class="flex flex-col gap-4 border-b border-white/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-sm font-semibold text-white">
                Mesaj Listesi
            </p>

            <p class="mt-1 text-xs text-slate-500">
                En son gelen mesajlar
            </p>

        </div>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full min-w-[1000px]">

            <thead>

                <tr class="border-b border-white/10 bg-white/[0.02]">

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Durum
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Gönderen
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                        Konu
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

                @forelse($messages as $msg)

                    <tr class="group transition hover:bg-white/[0.025] {{ !$msg->is_read ? 'bg-white/[0.018]' : '' }}">

                        <td class="px-6 py-5">

                            @if(!$msg->is_read)

                                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-xs font-medium text-emerald-300">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                    Yeni
                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-slate-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>

                                    Okundu
                                </span>

                            @endif

                        </td>


                        <td class="px-6 py-5">

                            <div class="max-w-[260px]">

                                <p class="truncate text-sm font-semibold text-white">
                                    {{ $msg->name }}
                                </p>

                                <p class="mt-1 truncate text-xs text-slate-500">
                                    {{ $msg->email }}
                                </p>

                            </div>

                        </td>


                        <td class="px-6 py-5">

                            <p class="max-w-[360px] truncate text-sm text-slate-300">
                                {{ $msg->subject ?? 'Konu Yok' }}
                            </p>

                        </td>


                        <td class="px-6 py-5">

                            <div>

                                <p class="text-sm text-slate-300">
                                    {{ $msg->created_at->format('d.m.Y') }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $msg->created_at->format('H:i') }}
                                </p>

                            </div>

                        </td>


                        <td class="px-6 py-5">

                            <div class="flex items-center justify-end gap-2">

                                <a
                                    href="{{ route('admin.messages.show', $msg) }}"
                                    class="inline-flex items-center rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white"
                                >
                                    Oku
                                </a>


                                <form
                                    action="{{ route('admin.messages.destroy', $msg) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-medium text-red-300 transition hover:bg-red-500/20 hover:text-red-200"
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
                                    ✉
                                </div>

                                <p class="mt-4 text-sm font-semibold text-slate-300">
                                    Henüz mesaj yok
                                </p>

                                <p class="mt-1 max-w-sm text-xs leading-5 text-slate-500">
                                    İletişim formundan gelen yeni mesajlar burada görüntülenecek.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection