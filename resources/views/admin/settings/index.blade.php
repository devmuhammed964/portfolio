@extends('admin.layouts.app')

@section('title', 'Site Ayarları | Portfolio Admin')
@section('page-title', 'Site Ayarları')

@section('content')

<div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_320px]">

    <section>

        <div class="mb-8">

            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">
                Genel Ayarlar
            </span>

            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">
                Site bilgilerini yönetin
            </h2>

            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">
                Marka, hero, hakkımda, iletişim, sosyal medya, footer ve SEO bilgilerini tek alandan yönetin.
            </p>

        </div>


        <form
            action="{{ route('admin.settings.update') }}"
            method="POST"
            enctype="multipart/form-data"
            class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20"
        >

            @csrf


            <div class="border-b border-white/10 px-6 py-5 sm:px-8">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/5 text-slate-300">
                        ⚙
                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Genel Site Bilgileri
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Ön yüzde kullanılan temel marka bilgilerini düzenleyin.
                        </p>

                    </div>

                </div>

            </div>


            <div class="space-y-10 p-6 sm:p-8">

                {{-- MARKA --}}
                <div>

                    <div class="mb-6">

                        <h3 class="text-sm font-semibold text-white">
                            Marka Bilgileri
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Site adı, logo ve favicon ayarlarını yönetin.
                        </p>

                    </div>


                    <div>

                        <label
                            for="site_name"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Site Adı
                        </label>

                        <input
                            id="site_name"
                            type="text"
                            name="site_name"
                            value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                            placeholder="Örn. Portfolio"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >

                    </div>


                    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div>

                            <label class="mb-2 block text-sm font-medium text-slate-300">
                                Site Logo
                            </label>

                            @if(!empty($settings['site_logo']))

                                <div class="mb-4 flex items-center gap-4 rounded-2xl border border-white/10 bg-slate-900/60 p-4">

                                    <div class="flex h-20 w-28 items-center justify-center rounded-xl border border-white/10 bg-white p-2">

                                        <img
                                            src="{{ asset('storage/' . $settings['site_logo']) }}"
                                            alt="Site Logo"
                                            class="max-h-full max-w-full object-contain"
                                        >

                                    </div>

                                    <div>

                                        <p class="text-sm font-medium text-white">
                                            Mevcut logo
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Yeni dosya seçmezseniz mevcut logo korunur.
                                        </p>

                                    </div>

                                </div>

                            @endif


                            <label
                                for="site_logo"
                                class="group flex min-h-[150px] cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-white/15 bg-slate-900/50 px-6 py-8 text-center transition hover:border-white/30 hover:bg-slate-900"
                            >

                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 text-xl text-slate-400 transition group-hover:bg-white/10 group-hover:text-white">
                                    ↑
                                </div>

                                <p class="mt-4 text-sm font-medium text-slate-300">
                                    Logo seçmek için tıklayın
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    JPG, PNG, WEBP veya SVG · Maksimum 4 MB
                                </p>

                                <input
                                    id="site_logo"
                                    type="file"
                                    name="site_logo"
                                    accept=".jpg,.jpeg,.png,.webp,.svg"
                                    class="hidden"
                                >

                            </label>

                        </div>


                        <div>

                            <label class="mb-2 block text-sm font-medium text-slate-300">
                                Favicon
                            </label>

                            @if(!empty($settings['favicon']))

                                <div class="mb-4 flex items-center gap-4 rounded-2xl border border-white/10 bg-slate-900/60 p-4">

                                    <div class="flex h-20 w-20 items-center justify-center rounded-xl border border-white/10 bg-white p-3">

                                        <img
                                            src="{{ asset('storage/' . $settings['favicon']) }}"
                                            alt="Favicon"
                                            class="max-h-full max-w-full object-contain"
                                        >

                                    </div>

                                    <div>

                                        <p class="text-sm font-medium text-white">
                                            Mevcut favicon
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Tarayıcı sekmesinde kullanılır.
                                        </p>

                                    </div>

                                </div>

                            @endif


                            <label
                                for="favicon"
                                class="group flex min-h-[150px] cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-white/15 bg-slate-900/50 px-6 py-8 text-center transition hover:border-white/30 hover:bg-slate-900"
                            >

                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 text-xl text-slate-400 transition group-hover:bg-white/10 group-hover:text-white">
                                    ↑
                                </div>

                                <p class="mt-4 text-sm font-medium text-slate-300">
                                    Favicon seçmek için tıklayın
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    ICO, PNG, JPG veya WEBP
                                </p>

                                <input
                                    id="favicon"
                                    type="file"
                                    name="favicon"
                                    accept=".ico,.png,.jpg,.jpeg,.webp"
                                    class="hidden"
                                >

                            </label>

                        </div>

                    </div>

                </div>


                {{-- HERO --}}
                <div class="border-t border-white/10 pt-8">

                    <div class="mb-6">

                        <h3 class="text-sm font-semibold text-white">
                            Hero Alanı
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Ana sayfanın ilk bölümündeki başlık ve alt başlığı yönetin.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div>

                            <label
                                for="hero_title"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Hero Başlığı
                            </label>

                            <input
                                id="hero_title"
                                type="text"
                                name="hero_title"
                                value="{{ old('hero_title', $settings['hero_title'] ?? '') }}"
                                placeholder="Örn. Dijital ürünler tasarlıyor ve geliştiriyorum."
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                            >

                        </div>


                        <div>

                            <label
                                for="hero_subtitle"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Hero Alt Başlığı
                            </label>

                            <input
                                id="hero_subtitle"
                                type="text"
                                name="hero_subtitle"
                                value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}"
                                placeholder="Örn. Laravel, Tailwind CSS ve modern web teknolojileri"
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                            >

                        </div>

                    </div>

                </div>


                {{-- ABOUT --}}
                <div class="border-t border-white/10 pt-8">

                    <div class="mb-6">

                        <h3 class="text-sm font-semibold text-white">
                            Hakkımda
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Ana sayfadaki hakkımda içeriğini yönetin.
                        </p>

                    </div>


                    <div>

                        <label
                            for="about_title"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Hakkımda Başlığı
                        </label>

                        <input
                            id="about_title"
                            type="text"
                            name="about_title"
                            value="{{ old('about_title', $settings['about_title'] ?? '') }}"
                            placeholder="Örn. Hakkımda"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >

                    </div>


                    <div class="mt-6">

                        <label
                            for="about_text"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Hakkımda Metni
                        </label>

                        <textarea
                            id="about_text"
                            name="about_text"
                            rows="6"
                            placeholder="Kısa hakkımda metni..."
                            class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-7 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >{{ old('about_text', $settings['about_text'] ?? '') }}</textarea>

                    </div>

                </div>


                {{-- İLETİŞİM --}}
                <div class="border-t border-white/10 pt-8">

                    <div class="mb-6">

                        <h3 class="text-sm font-semibold text-white">
                            İletişim Bilgileri
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Ziyaretçilerin size ulaşabileceği bilgileri yönetin.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div>

                            <label
                                for="contact_email"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                İletişim E-Posta
                            </label>

                            <input
                                id="contact_email"
                                type="email"
                                name="contact_email"
                                value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                                placeholder="ornek@email.com"
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                            >

                        </div>


                        <div>

                            <label
                                for="contact_phone"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Telefon Numarası
                            </label>

                            <input
                                id="contact_phone"
                                type="text"
                                name="contact_phone"
                                value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                                placeholder="+90 555 123 45 67"
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                            >

                        </div>

                    </div>

                </div>


                {{-- SOSYAL MEDYA --}}
                <div class="border-t border-white/10 pt-8">

                    <div class="mb-6">

                        <h3 class="text-sm font-semibold text-white">
                            Sosyal Medya
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Sosyal medya ve geliştirici profillerinizi yönetin.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div>

                            <label
                                for="github_url"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                GitHub
                            </label>

                            <input
                                id="github_url"
                                type="url"
                                name="github_url"
                                value="{{ old('github_url', $settings['github_url'] ?? '') }}"
                                placeholder="https://github.com/..."
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                            >

                        </div>


                        <div>

                            <label
                                for="linkedin_url"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                LinkedIn
                            </label>

                            <input
                                id="linkedin_url"
                                type="url"
                                name="linkedin_url"
                                value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"
                                placeholder="https://linkedin.com/in/..."
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                            >

                        </div>


                        <div class="md:col-span-2">

                            <label
                                for="instagram_url"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Instagram
                            </label>

                            <input
                                id="instagram_url"
                                type="url"
                                name="instagram_url"
                                value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                                placeholder="https://instagram.com/..."
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                            >

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="border-t border-white/10 pt-8">

                    <div class="mb-6">

                        <h3 class="text-sm font-semibold text-white">
                            Footer
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Sitenin alt bölümünde gösterilecek metni belirleyin.
                        </p>

                    </div>

                    <textarea
                        id="footer_text"
                        name="footer_text"
                        rows="3"
                        placeholder="Örn. Tüm hakları saklıdır."
                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-7 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                    >{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>

                </div>


                {{-- SEO --}}
                <div class="border-t border-white/10 pt-8">

                    <div class="mb-6">

                        <h3 class="text-sm font-semibold text-white">
                            SEO Ayarları
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Arama motorlarında kullanılacak temel meta bilgilerini yönetin.
                        </p>

                    </div>


                    <div>

                        <label
                            for="seo_title"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            SEO Title
                        </label>

                        <input
                            id="seo_title"
                            type="text"
                            name="seo_title"
                            value="{{ old('seo_title', $settings['seo_title'] ?? '') }}"
                            placeholder="Örn. Portfolio | Web Developer"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >

                    </div>


                    <div class="mt-6">

                        <label
                            for="meta_description"
                            class="mb-2 block text-sm font-medium text-slate-300"
                        >
                            Meta Description
                        </label>

                        <textarea
                            id="meta_description"
                            name="meta_description"
                            rows="4"
                            placeholder="Siteyi açıklayan kısa SEO metni..."
                            class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-7 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>

                    </div>

                </div>

            </div>


            <div class="flex flex-col-reverse gap-3 border-t border-white/10 bg-black/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">

                <p class="text-xs text-slate-500">
                    Kaydettiğiniz bilgiler sitenin ilgili alanlarına uygulanacaktır.
                </p>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"
                >
                    Ayarları Kaydet
                </button>

            </div>

        </form>

    </section>


    <aside class="xl:pt-[118px]">

        <div class="sticky top-8 space-y-4">

            <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">

                <p class="text-sm font-semibold text-white">
                    Site Özeti
                </p>

                <div class="mt-5 space-y-5">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Site Adı
                        </p>

                        <p class="mt-1 text-sm leading-6 text-slate-300">
                            {{ $settings['site_name'] ?? 'Belirtilmedi' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Hero
                        </p>

                        <p class="mt-1 text-sm leading-6 text-slate-300">
                            {{ $settings['hero_title'] ?? 'Belirtilmedi' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            E-Posta
                        </p>

                        <p class="mt-1 break-all text-sm text-slate-300">
                            {{ $settings['contact_email'] ?? 'Belirtilmedi' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.15em] text-slate-500">
                            Telefon
                        </p>

                        <p class="mt-1 text-sm text-slate-300">
                            {{ $settings['contact_phone'] ?? 'Belirtilmedi' }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="rounded-[24px] border border-white/10 bg-gradient-to-br from-white/[0.06] to-transparent p-5">

                <p class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">
                    SEO
                </p>

                <p class="mt-3 text-sm leading-6 text-slate-400">
                    SEO title ve meta description değerleri ana sayfanın head bölümüne bağlanabilir.
                </p>

            </div>


            <div class="rounded-[24px] border border-white/10 bg-gradient-to-br from-white/[0.06] to-transparent p-5">

                <p class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">
                    Durum
                </p>

                <div class="mt-3 flex items-center gap-2">

                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>

                    <p class="text-sm font-medium text-slate-300">
                        Site ayarları aktif
                    </p>

                </div>

            </div>

        </div>

    </aside>

</div>

@endsection