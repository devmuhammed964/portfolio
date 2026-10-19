<section>

    <p class="max-w-2xl text-sm leading-6 text-slate-400">
        Yönetim panelinde kullanılan adınızı ve giriş e-posta adresinizi buradan güncelleyebilirsiniz.
    </p>

    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
        class="mt-7 space-y-6"
    >

        @csrf
        @method('PATCH')


        {{-- AD SOYAD --}}
        <div>

            <label
                for="name"
                class="mb-2 block text-sm font-medium text-slate-300"
            >
                Ad Soyad
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
            >

            @foreach($errors->get('name') as $message)

                <p class="mt-2 text-xs font-medium text-red-300">
                    {{ $message }}
                </p>

            @endforeach

        </div>


        {{-- EMAIL --}}
        <div>

            <label
                for="email"
                class="mb-2 block text-sm font-medium text-slate-300"
            >
                E-posta Adresi
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
            >

            @foreach($errors->get('email') as $message)

                <p class="mt-2 text-xs font-medium text-red-300">
                    {{ $message }}
                </p>

            @endforeach


            @if(
                $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                && ! $user->hasVerifiedEmail()
            )

                <div class="mt-4 rounded-2xl border border-amber-500/20 bg-amber-500/10 p-4">

                    <p class="text-sm leading-6 text-amber-200">
                        E-posta adresiniz henüz doğrulanmamış.
                    </p>

                    <button
                        form="send-verification"
                        type="submit"
                        class="mt-2 text-xs font-semibold text-amber-300 underline underline-offset-4 transition hover:text-amber-200"
                    >
                        Doğrulama e-postasını yeniden gönder
                    </button>

                    @if(session('status') === 'verification-link-sent')

                        <p class="mt-3 text-xs font-medium text-emerald-300">
                            Yeni doğrulama bağlantısı e-posta adresinize gönderildi.
                        </p>

                    @endif

                </div>

            @endif

        </div>


        {{-- SAVE --}}
        <div class="flex flex-wrap items-center gap-4 border-t border-white/10 pt-6">

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
            >
                Bilgileri Kaydet
            </button>


            @if(session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm font-medium text-emerald-300"
                >
                    Değişiklikler kaydedildi.
                </p>

            @endif

        </div>

    </form>

</section>