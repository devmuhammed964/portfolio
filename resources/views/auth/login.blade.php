<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Giriş | Portfolio Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">

<div class="flex min-h-screen items-center justify-center px-6 py-10">

    <div class="w-full max-w-md">

        <div class="mb-8 text-center">

            <p class="text-xs font-medium uppercase tracking-[0.28em] text-slate-500">
                Portfolio Admin
            </p>

            <h1 class="mt-3 text-3xl font-semibold tracking-tight text-white">
                Yönetim Paneli Girişi
            </h1>

            <p class="mt-3 text-sm leading-6 text-slate-400">
                Portfolyo yönetim paneline erişmek için hesabınızla giriş yapın.
            </p>

        </div>


        <div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/30">

            <div class="border-b border-white/10 px-6 py-5">

                <p class="text-sm font-semibold text-white">
                    Admin Girişi
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Yetkili kullanıcı bilgilerinizi girin.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('login') }}"
                class="space-y-6 p-6"
            >
                @csrf


                @if(session('status'))

                    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
                        {{ session('status') }}
                    </div>

                @endif


                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        E-posta
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="admin@portfolio.com"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >

                    @error('email')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label
                        for="password"
                        class="mb-2 block text-sm font-medium text-slate-300"
                    >
                        Şifre
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >

                    @error('password')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="flex items-center justify-between gap-4">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="remember"
                            class="h-4 w-4 rounded border-white/20 bg-slate-900 text-slate-200 focus:ring-slate-500"
                        >

                        <span class="text-sm text-slate-400">
                            Beni hatırla
                        </span>

                    </label>


                    @if(Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm font-medium text-slate-400 transition hover:text-white"
                        >
                            Şifremi unuttum
                        </a>

                    @endif

                </div>


                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-2xl bg-white px-5 py-3.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                >
                    Giriş Yap
                </button>

            </form>

        </div>


        <p class="mt-6 text-center text-xs text-slate-600">
            Yetkisiz erişimler kayıt altına alınabilir.
        </p>

    </div>

</div>

</body>
</html>