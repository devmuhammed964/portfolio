<section>

    <p class="max-w-2xl text-sm leading-6 text-slate-400">
        Hesabınızın güvenliği için mevcut şifrenizi doğrulayarak yeni bir giriş şifresi belirleyebilirsiniz.
    </p>

    <form
        method="POST"
        action="{{ route('password.update') }}"
        class="mt-7 space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- CURRENT PASSWORD --}}
        <div>

            <label
                for="update_password_current_password"
                class="mb-2 block text-sm font-medium text-slate-300"
            >
                Mevcut Şifre
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"
            >

            @foreach(
                $errors->updatePassword->get('current_password')
                as $message
            )

                <p class="mt-2 text-xs font-medium text-red-300">
                    {{ $message }}
                </p>

            @endforeach

        </div>


        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- NEW PASSWORD --}}
            <div>

                <label
                    for="update_password_password"
                    class="mb-2 block text-sm font-medium text-slate-300"
                >
                    Yeni Şifre
                </label>

                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                >

                @foreach(
                    $errors->updatePassword->get('password')
                    as $message
                )

                    <p class="mt-2 text-xs font-medium text-red-300">
                        {{ $message }}
                    </p>

                @endforeach

            </div>


            {{-- CONFIRM PASSWORD --}}
            <div>

                <label
                    for="update_password_password_confirmation"
                    class="mb-2 block text-sm font-medium text-slate-300"
                >
                    Yeni Şifre Tekrar
                </label>

                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                >

                @foreach(
                    $errors->updatePassword->get('password_confirmation')
                    as $message
                )

                    <p class="mt-2 text-xs font-medium text-red-300">
                        {{ $message }}
                    </p>

                @endforeach

            </div>

        </div>


        <div class="flex flex-wrap items-center gap-4 border-t border-white/10 pt-6">

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
            >
                Şifreyi Güncelle
            </button>


            @if(session('status') === 'password-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm font-medium text-emerald-300"
                >
                    Şifreniz güncellendi.
                </p>

            @endif

        </div>

    </form>

</section>