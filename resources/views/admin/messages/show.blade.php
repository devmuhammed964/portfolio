@extends('admin.layouts.app')

@section('title', 'Mesaj Detayı | Portfolio Admin')
@section('page-title', 'Mesaj Detayı')

@section('content')

<div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_320px]">

    <section>

        <div class="mb-8">

            <a
                href="{{ route('admin.messages.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 transition hover:text-white"
            >
                ← Tüm Mesajlara Dön
            </a>

            <span class="mt-5 inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
                Gelen Mesaj
            </span>

            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
                {{ $message->subject ?? 'Konu Yok' }}
            </h2>

            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
                İletişim formu üzerinden gönderilen mesajın detaylarını görüntülüyorsunuz.
            </p>

        </div>


        <div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

            <div class="border-b border-white/10 px-6 py-5 sm:px-8">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                            Gönderen
                        </p>

                        <p class="mt-2 text-lg font-semibold text-white">
                            {{ $message->name }}
                        </p>

                        <a
                            href="mailto:{{ $message->email }}"
                            class="mt-1 inline-block text-sm text-slate-400 transition hover:text-white"
                        >
                            {{ $message->email }}
                        </a>

                    </div>


                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">

                        <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                            Tarih
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-300">
                            {{ $message->created_at->format('d.m.Y H:i') }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 sm:p-8">

                <p class="mb-3 text-xs font-medium uppercase tracking-[0.16em] text-slate-500">
                    Mesaj
                </p>

                <div class="rounded-2xl border border-white/10 bg-slate-900/70 p-6">

                    <p class="whitespace-pre-line text-sm leading-7 text-slate-300">
                        {{ $message->message }}
                    </p>

                </div>

            </div>


            <div class="flex flex-col gap-3 border-t border-white/10 bg-black/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">

                <a
                    href="mailto:{{ $message->email }}"
                    class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                >
                    E-posta Gönder
                </a>


                <form
                    action="{{ route('admin.messages.destroy', $message) }}"
                    method="POST"
                    onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl border border-red-500/20 bg-red-500/10 px-5 py-3 text-sm font-medium text-red-300 transition hover:bg-red-500/20 hover:text-red-200"
                    >
                        Mesajı Sil
                    </button>

                </form>

            </div>

        </div>

    </section>


    <aside class="xl:pt-[118px]">

        <div class="sticky top-8 space-y-4">

            <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">

                <p class="text-sm font-semibold text-white">
                    Mesaj Bilgileri
                </p>

                <div class="mt-5 space-y-5">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Gönderen
                        </p>

                        <p class="mt-1 text-sm text-slate-300">
                            {{ $message->name }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            E-posta
                        </p>

                        <p class="mt-1 break-all text-sm text-slate-300">
                            {{ $message->email }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Konu
                        </p>

                        <p class="mt-1 text-sm leading-6 text-slate-300">
                            {{ $message->subject ?? 'Konu Yok' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Tarih
                        </p>

                        <p class="mt-1 text-sm text-slate-300">
                            {{ $message->created_at->format('d.m.Y H:i') }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="rounded-[24px] border border-white/10 bg-gradient-to-br from-white/[0.06] to-transparent p-5">

                <p class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">
                    İpucu
                </p>

                <p class="mt-3 text-sm leading-6 text-slate-400">
                    Yanıt vermek için doğrudan e-posta butonunu kullanabilirsiniz.
                </p>

            </div>

        </div>

    </aside>

</div>

@endsection