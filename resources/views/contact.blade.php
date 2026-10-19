@extends('layouts.site')
@php
    $contactIsEnglish = app()->getLocale() === 'en';
    $contactUrl = $contactIsEnglish
        ? route('en.contact', ['locale' => 'en'])
        : route('contact');
    $contactSiteName = $settings['site_name'] ?? 'Portfolyo';
    $contactSeoTitle = $contactIsEnglish
        ? __('contact.seo.title', ['site' => $contactSiteName])
        : ('İletişim – Yazılım ve Dijital Projeler | ' . $contactSiteName);
    $contactMetaDescription = $contactIsEnglish
        ? __('contact.seo.description')
        : 'Web yazılım, özel yazılım, Laravel, kurumsal web sitesi, yönetim paneli ve dijital ürün projeleri için iletişime geçin.';
@endphp
@section('title', $contactSeoTitle)
@section(
    'meta_description',
    $contactMetaDescription
)
@section('canonical', $contactUrl)
@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)
@section('og_type', 'website')
@section(
    'og_image_alt',
    __('contact.seo.og_alt', ['site' => $contactSiteName])
)
@section('content')
<style>
    .contact-reveal {
        opacity: 0;
        transform: translateY(26px);
        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }
    .contact-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .contact-info-item {
        transition:
            transform .35s cubic-bezier(.22, 1, .36, 1),
            background-color .35s ease,
            border-color .35s ease;
    }
    .contact-info-item:hover {
        transform: translateX(4px);
    }
    .cv-button-icon {
        transition:
            transform .35s cubic-bezier(.22, 1, .36, 1);
    }
    .cv-button:hover .cv-button-icon {
        transform: translate(2px, -2px);
    }
    @media (prefers-reduced-motion: reduce) {
        .contact-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .contact-info-item,
        .cv-button-icon {
            transition: none !important;
        }
    }
</style>
{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section
    class="
        relative
        overflow-hidden
        bg-[#f3f4f5]
        pb-12
        pt-8
        lg:pb-16
        lg:pt-12
    "
>
    <div
        class="
            pointer-events-none
            absolute
            right-[-180px]
            top-[-180px]
            h-[520px]
            w-[520px]
            rounded-full
            border
            border-black/[0.03]
        "
    ></div>
    <div
        class="
            pointer-events-none
            absolute
            right-[-80px]
            top-[-80px]
            h-[320px]
            w-[320px]
            rounded-full
            border
            border-black/[0.03]
        "
    ></div>
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div
            class="
                contact-reveal
                grid
                grid-cols-1
                gap-10
                lg:grid-cols-[1fr_auto]
                lg:items-end
            "
        >
            <div class="max-w-[860px]">
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-black/20"></span>
                    <span
                        class="
                            text-[9px]
                            font-medium
                            uppercase
                            tracking-[0.22em]
                            text-black/35
                        "
                    >
                        {{ __('contact.hero.eyebrow') }}
                    </span>
                    <span class="h-[5px] w-[5px] rounded-full bg-black"></span>
                </div>
                <h1
                    class="
                        mt-6
                        max-w-[860px]
                        text-[44px]
                        font-medium
                        leading-[1.01]
                        tracking-[-0.05em]
                        text-[#111]
                        sm:text-[58px]
                        lg:text-[72px]
                    "
                >
                    {{ __('contact.hero.title_before') }}
                    <span class="text-black/35">
                        {{ __('contact.hero.title_emphasis') }}
                    </span>
                </h1>
                <p
                    class="
                        mt-6
                        max-w-[620px]
                        text-[13px]
                        leading-7
                        text-black/42
                        sm:text-[15px]
                    "
                >
                    {{ __('contact.hero.description') }}
                </p>
            </div>
            <div
                class="
                    hidden
                    items-center
                    gap-3
                    lg:flex
                    lg:pb-2
                "
            >
                <span class="relative flex h-2 w-2">
                    <span
                        class="
                            absolute
                            inline-flex
                            h-full
                            w-full
                            animate-ping
                            rounded-full
                            bg-black/20
                        "
                    ></span>
                    <span
                        class="
                            relative
                            inline-flex
                            h-2
                            w-2
                            rounded-full
                            bg-black
                        "
                    ></span>
                </span>
                <span
                    class="
                        text-[8px]
                        font-medium
                        uppercase
                        tracking-[0.16em]
                        text-black/35
                    "
                >
                    {{ __('contact.hero.status') }}
                </span>
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- MAIN CONTACT AREA --}}
{{-- ========================================================= --}}
<section
    class="
        bg-[#f3f4f5]
        pb-24
        lg:pb-32
    "
>
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div
            class="
                grid
                grid-cols-1
                gap-8
                lg:grid-cols-[0.92fr_1.08fr]
                lg:gap-10
            "
        >
            {{-- ===================================================== --}}
            {{-- LEFT --}}
            {{-- ===================================================== --}}
            <div
                class="
                    contact-reveal
                    relative
                    overflow-hidden
                    rounded-[34px]
                    bg-[#0a0a0a]
                    p-7
                    text-white
                    shadow-[0_30px_90px_rgba(0,0,0,.14)]
                    sm:p-9
                    lg:p-10
                "
            >
                {{-- BACKGROUND DETAIL --}}
                <div
                    class="
                        pointer-events-none
                        absolute
                        -right-[170px]
                        -top-[170px]
                        h-[360px]
                        w-[360px]
                        rounded-full
                        border
                        border-white/[0.05]
                    "
                ></div>
                <div
                    class="
                        pointer-events-none
                        absolute
                        -right-[90px]
                        -top-[90px]
                        h-[200px]
                        w-[200px]
                        rounded-full
                        border
                        border-white/[0.05]
                    "
                ></div>
                <div class="relative">
                    {{-- HEADER --}}
                    <div>
                        <p
                            class="
                                text-[8px]
                                font-medium
                                uppercase
                                tracking-[0.18em]
                                text-white/30
                            "
                        >
                            {{ __('contact.info.eyebrow') }}
                        </p>
                        <h2
                            class="
                                mt-4
                                max-w-[430px]
                                text-[30px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.04em]
                                text-white
                                sm:text-[36px]
                            "
                        >
                            {{ __('contact.info.title_before') }}
                            <span class="text-white/35">
                                {{ __('contact.info.title_emphasis') }}
                            </span>
                        </h2>
                        <p
                            class="
                                mt-4
                                max-w-[420px]
                                text-[11px]
                                leading-6
                                text-white/35
                            "
                        >
                            {{ __('contact.info.description') }}
                        </p>
                    </div>
                    {{-- CONTACT ITEMS --}}
                    <div
                        class="
                            mt-10
                            border-t
                            border-white/[0.08]
                        "
                    >
                        {{-- EMAIL --}}
                        @if(!empty($settings['contact_email']))
                            <a
                                href="mailto:{{ $settings['contact_email'] }}"
                                class="
                                    contact-info-item
                                    group
                                    flex
                                    items-center
                                    justify-between
                                    gap-5
                                    border-b
                                    border-white/[0.08]
                                    py-6
                                "
                            >
                                <div>
                                    <p
                                        class="
                                            text-[8px]
                                            font-medium
                                            uppercase
                                            tracking-[0.17em]
                                            text-white/28
                                        "
                                    >
                                        {{ __('contact.info.email') }}
                                    </p>
                                    <p
                                        class="
                                            mt-2
                                            break-all
                                            text-[17px]
                                            font-medium
                                            tracking-[-0.02em]
                                            text-white
                                            sm:text-[19px]
                                        "
                                    >
                                        {{ $settings['contact_email'] }}
                                    </p>
                                </div>
                                <span
                                    class="
                                        flex
                                        h-10
                                        w-10
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-full
                                        border
                                        border-white/[0.10]
                                        text-white/40
                                        transition-all
                                        duration-300
                                        group-hover:bg-white
                                        group-hover:text-black
                                    "
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="h-4 w-4"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path d="M7 17 17 7"/>
                                        <path d="M8 7h9v9"/>
                                    </svg>
                                </span>
                            </a>
                        @endif
                        {{-- PHONE --}}
                        @if(!empty($settings['contact_phone']))
                            <a
                                href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone']) }}"
                                class="
                                    contact-info-item
                                    group
                                    flex
                                    items-center
                                    justify-between
                                    gap-5
                                    border-b
                                    border-white/[0.08]
                                    py-6
                                "
                            >
                                <div>
                                    <p
                                        class="
                                            text-[8px]
                                            font-medium
                                            uppercase
                                            tracking-[0.17em]
                                            text-white/28
                                        "
                                    >
                                        {{ __('contact.info.phone') }}
                                    </p>
                                    <p
                                        class="
                                            mt-2
                                            text-[17px]
                                            font-medium
                                            tracking-[-0.02em]
                                            text-white
                                            sm:text-[19px]
                                        "
                                    >
                                        {{ $settings['contact_phone'] }}
                                    </p>
                                </div>
                                <span
                                    class="
                                        flex
                                        h-10
                                        w-10
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-full
                                        border
                                        border-white/[0.10]
                                        text-white/40
                                        transition-all
                                        duration-300
                                        group-hover:bg-white
                                        group-hover:text-black
                                    "
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="h-4 w-4"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path
                                            d="M5 4h3l2 5-2 1.5c1.2 2.4 3.1 4.3 5.5 5.5L15 14l5 2v3c0 1.1-.9 2-2 2C10.3 21 3 13.7 3 6c0-1.1.9-2 2-2Z"
                                        />
                                    </svg>
                                </span>
                            </a>
                        @endif
                        {{-- ADDRESS --}}
                        @if(!empty($settings['contact_address']))
                            <div
                                class="
                                    flex
                                    items-start
                                    justify-between
                                    gap-5
                                    border-b
                                    border-white/[0.08]
                                    py-6
                                "
                            >
                                <div>
                                    <p
                                        class="
                                            text-[8px]
                                            font-medium
                                            uppercase
                                            tracking-[0.17em]
                                            text-white/28
                                        "
                                    >
                                        {{ __('contact.info.address') }}
                                    </p>
                                    <p
                                        class="
                                            mt-2
                                            max-w-[380px]
                                            text-[15px]
                                            leading-7
                                            text-white/75
                                        "
                                    >
                                        {{ $settings['contact_address'] }}
                                    </p>
                                </div>
                                <span
                                    class="
                                        flex
                                        h-10
                                        w-10
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-full
                                        border
                                        border-white/[0.10]
                                        text-white/40
                                    "
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="h-4 w-4"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path d="M12 21s6-5 6-11a6 6 0 1 0-12 0c0 6 6 11 6 11Z"/>
                                        <circle cx="12" cy="10" r="2"/>
                                    </svg>
                                </span>
                            </div>
                        @endif
                    </div>
                    {{-- SOCIAL MEDIA --}}
                    @if(
                        !empty($settings['github_url']) ||
                        !empty($settings['linkedin_url']) ||
                        !empty($settings['instagram_url'])
                    )
                        <div class="mt-8">
                            <p
                                class="
                                    text-[8px]
                                    font-medium
                                    uppercase
                                    tracking-[0.18em]
                                    text-white/30
                                "
                            >
                                {{ __('contact.info.social') }}
                            </p>
                            <div
                                class="
                                    mt-4
                                    flex
                                    flex-wrap
                                    gap-2
                                "
                            >
                                @if(!empty($settings['github_url']))
                                    <a
                                        href="{{ $settings['github_url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="
                                            group
                                            inline-flex
                                            items-center
                                            gap-3
                                            rounded-full
                                            border
                                            border-white/[0.10]
                                            bg-white/[0.04]
                                            px-4
                                            py-2.5
                                            text-[9px]
                                            font-medium
                                            text-white/55
                                            transition-all
                                            duration-300
                                            hover:bg-white
                                            hover:text-black
                                        "
                                    >
                                        GitHub
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            class="h-3.5 w-3.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path d="M7 17 17 7"/>
                                            <path d="M8 7h9v9"/>
                                        </svg>
                                    </a>
                                @endif
                                @if(!empty($settings['linkedin_url']))
                                    <a
                                        href="{{ $settings['linkedin_url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="
                                            group
                                            inline-flex
                                            items-center
                                            gap-3
                                            rounded-full
                                            border
                                            border-white/[0.10]
                                            bg-white/[0.04]
                                            px-4
                                            py-2.5
                                            text-[9px]
                                            font-medium
                                            text-white/55
                                            transition-all
                                            duration-300
                                            hover:bg-white
                                            hover:text-black
                                        "
                                    >
                                        LinkedIn
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            class="h-3.5 w-3.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path d="M7 17 17 7"/>
                                            <path d="M8 7h9v9"/>
                                        </svg>
                                    </a>
                                @endif
                                @if(!empty($settings['instagram_url']))
                                    <a
                                        href="{{ $settings['instagram_url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="
                                            group
                                            inline-flex
                                            items-center
                                            gap-3
                                            rounded-full
                                            border
                                            border-white/[0.10]
                                            bg-white/[0.04]
                                            px-4
                                            py-2.5
                                            text-[9px]
                                            font-medium
                                            text-white/55
                                            transition-all
                                            duration-300
                                            hover:bg-white
                                            hover:text-black
                                        "
                                    >
                                        Instagram
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            class="h-3.5 w-3.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path d="M7 17 17 7"/>
                                            <path d="M8 7h9v9"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                    {{-- STATUS --}}
                    <div
                        class="
                            mt-9
                            rounded-[20px]
                            border
                            border-white/[0.08]
                            bg-white/[0.035]
                            p-5
                        "
                    >
                        <div class="flex items-center gap-3">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="
                                        absolute
                                        inline-flex
                                        h-full
                                        w-full
                                        animate-ping
                                        rounded-full
                                        bg-emerald-400/40
                                    "
                                ></span>
                                <span
                                    class="
                                        relative
                                        inline-flex
                                        h-2
                                        w-2
                                        rounded-full
                                        bg-emerald-400
                                    "
                                ></span>
                            </span>
                            <p
                                class="
                                    text-[9px]
                                    font-medium
                                    uppercase
                                    tracking-[0.14em]
                                    text-white/60
                                "
                            >
                                {{ __('contact.info.open_status') }}
                            </p>
                        </div>
                        <p
                            class="
                                mt-3
                                max-w-[410px]
                                text-[10px]
                                leading-5
                                text-white/30
                            "
                        >
                            {{ __('contact.info.open_description') }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- ===================================================== --}}
            {{-- RIGHT / FORM --}}
            {{-- ===================================================== --}}
            <div
                class="
                    contact-reveal
                    relative
                    overflow-hidden
                    rounded-[34px]
                    border
                    border-black/[0.055]
                    bg-white
                    p-7
                    shadow-[0_24px_80px_rgba(0,0,0,.05)]
                    sm:p-9
                    lg:p-10
                "
                style="transition-delay: 100ms;"
            >
                <div
                    class="
                        pointer-events-none
                        absolute
                        -right-[100px]
                        -top-[100px]
                        h-[260px]
                        w-[260px]
                        rounded-full
                        border
                        border-black/[0.035]
                    "
                ></div>
                <div class="relative">
                    <div
                        class="
                            flex
                            items-start
                            justify-between
                            gap-8
                        "
                    >
                        <div>
                            <p
                                class="
                                    text-[8px]
                                    font-medium
                                    uppercase
                                    tracking-[0.18em]
                                    text-black/30
                                "
                            >
                                {{ __('contact.form.eyebrow') }}
                            </p>
                            <h2
                                class="
                                    mt-4
                                    max-w-[540px]
                                    text-[30px]
                                    font-medium
                                    leading-[1.08]
                                    tracking-[-0.04em]
                                    text-[#111]
                                    sm:text-[36px]
                                "
                            >
                                {{ __('contact.form.title_before') }}
                                <span class="text-black/35">
                                    {{ __('contact.form.title_emphasis') }}
                                </span>
                            </h2>
                            <p
                                class="
                                    mt-4
                                    max-w-[520px]
                                    text-[11px]
                                    leading-6
                                    text-black/38
                                "
                            >
                                {{ __('contact.form.description') }}
                            </p>
                        </div>
                        <div
                            class="
                                hidden
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-full
                                bg-[#111]
                                text-white
                                sm:flex
                            "
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-4 w-4"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <path d="M5 12h14"/>
                                <path d="m14 7 5 5-5 5"/>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="
                            mt-8
                            border-t
                            border-black/[0.06]
                            pt-8
                        "
                    >
                        <x-contact-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- BOTTOM INFO --}}
{{-- ========================================================= --}}
<section
    class="
        bg-[#f3f4f5]
        px-6
        pb-20
        lg:px-10
        lg:pb-24
    "
>
    <div
        class="
            contact-reveal
            mx-auto
            max-w-[1400px]
            border-t
            border-black/[0.07]
            pt-8
        "
    >
        <div
            class="
                grid
                grid-cols-1
                gap-8
                text-center
                sm:grid-cols-3
            "
        >
            <div>
                <span class="text-[8px] font-medium text-black/25">
                    01
                </span>
                <h3
                    class="
                        mt-3
                        text-[15px]
                        font-medium
                        text-[#111]
                    "
                >
                    {{ __('contact.steps.one.title') }}
                </h3>
                <p
                    class="
                        mx-auto
                        mt-2
                        max-w-[300px]
                        text-[10px]
                        leading-5
                        text-black/35
                    "
                >
                    {{ __('contact.steps.one.description') }}
                </p>
            </div>
            <div>
                <span class="text-[8px] font-medium text-black/25">
                    02
                </span>
                <h3
                    class="
                        mt-3
                        text-[15px]
                        font-medium
                        text-[#111]
                    "
                >
                    {{ __('contact.steps.two.title') }}
                </h3>
                <p
                    class="
                        mx-auto
                        mt-2
                        max-w-[300px]
                        text-[10px]
                        leading-5
                        text-black/35
                    "
                >
                    {{ __('contact.steps.two.description') }}
                </p>
            </div>
            <div>
                <span class="text-[8px] font-medium text-black/25">
                    03
                </span>
                <h3
                    class="
                        mt-3
                        text-[15px]
                        font-medium
                        text-[#111]
                    "
                >
                    {{ __('contact.steps.three.title') }}
                </h3>
                <p
                    class="
                        mx-auto
                        mt-2
                        max-w-[300px]
                        text-[10px]
                        leading-5
                        text-black/35
                    "
                >
                    {{ __('contact.steps.three.description') }}
                </p>
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- CV CTA --}}
{{-- ========================================================= --}}
{{-- ========================================================= --}}
{{-- CV CTA --}}
{{-- ========================================================= --}}
<section
    class="
        bg-[#f3f4f5]
        px-6
        pb-20
        lg:px-10
        lg:pb-28
    "
>
    <div
        class="
            contact-reveal
            relative
            mx-auto
            max-w-[1400px]
            overflow-hidden
            rounded-[36px]
            bg-[#090909]
            px-7
            py-8
            text-white
            shadow-[0_26px_70px_rgba(0,0,0,.13)]
            sm:px-10
            sm:py-9
            lg:px-14
            lg:py-10
        "
    >
        {{-- BACKGROUND DETAILS --}}
        <div
            class="
                pointer-events-none
                absolute
                -right-[180px]
                -top-[240px]
                h-[500px]
                w-[500px]
                rounded-full
                border
                border-white/[0.05]
            "
        ></div>
        <div
            class="
                pointer-events-none
                absolute
                -bottom-[190px]
                left-1/2
                h-[240px]
                w-[900px]
                -translate-x-1/2
                rounded-[50%]
                border-t
                border-white/[0.06]
            "
        ></div>
        <div
            class="
                relative
                z-10
                grid
                grid-cols-1
                items-center
                gap-8
                lg:grid-cols-[1fr_330px]
                lg:gap-12
            "
        >
            {{-- LEFT --}}
            <div>
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-white/20"></span>
                    <span
                        class="
                            text-[8px]
                            font-medium
                            uppercase
                            tracking-[0.20em]
                            text-white/35
                        "
                    >
                        {{ __('contact.cv.eyebrow') }}
                    </span>
                    <span
                        class="
                            h-[5px]
                            w-[5px]
                            rounded-full
                            bg-white
                        "
                    ></span>
                </div>
                <h2
                    class="
                        mt-4
                        max-w-[760px]
                        text-[30px]
                        font-medium
                        leading-[1.04]
                        tracking-[-0.045em]
                        text-white
                        sm:text-[36px]
                        lg:text-[42px]
                    "
                >
                    {{ __('contact.cv.title_before') }}
                    <span class="text-white/35">
                        {{ __('contact.cv.title_emphasis') }}
                    </span>
                </h2>
                <p
                    class="
                        mt-3
                        max-w-[560px]
                        text-[10px]
                        leading-5
                        text-white/40
                        sm:text-[11px]
                    "
                >
                    {{ __('contact.cv.description') }}
                </p>
                <a
                    href="{{ asset('cv/muhammed-cicek-cv.pdf') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="
                        cv-button
                        group
                        mt-5
                        inline-flex
                        items-center
                        gap-4
                        rounded-full
                        bg-white
                        px-5
                        py-2.5
                        pl-6
                        text-[9px]
                        font-medium
                        text-black
                        transition-all
                        duration-300
                        hover:-translate-y-1
                    "
                >
                    {{ __('contact.cv.button') }}
                    <span
                        class="
                            flex
                            h-8
                            w-8
                            items-center
                            justify-center
                            rounded-full
                            bg-[#111]
                            text-white
                        "
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            class="
                                cv-button-icon
                                h-3.5
                                w-3.5
                            "
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path d="M7 17 17 7"/>
                            <path d="M8 7h9v9"/>
                        </svg>
                    </span>
                </a>
            </div>
            {{-- RIGHT / DOCUMENT VISUAL --}}
            <div
                class="
                    relative
                    mx-auto
                    hidden
                    h-[185px]
                    w-full
                    max-w-[310px]
                    lg:block
                "
            >
                {{-- BACK DOCUMENT --}}
                <div
                    class="
                        absolute
                        left-[40px]
                        top-[14px]
                        h-[160px]
                        w-[132px]
                        rotate-[-7deg]
                        rounded-[16px]
                        border
                        border-white/[0.08]
                        bg-white/[0.04]
                    "
                ></div>
                {{-- MAIN DOCUMENT --}}
                <div
                    class="
                        absolute
                        left-1/2
                        top-1/2
                        h-[170px]
                        w-[142px]
                        -translate-x-1/2
                        -translate-y-1/2
                        rotate-[4deg]
                        rounded-[18px]
                        bg-white
                        p-3.5
                        text-black
                        shadow-[0_24px_55px_rgba(0,0,0,.28)]
                        transition-transform
                        duration-500
                        hover:rotate-[1deg]
                    "
                >
                    {{-- FOLDED CORNER --}}
                    <div
                        class="
                            absolute
                            right-0
                            top-0
                            h-8
                            w-8
                            overflow-hidden
                            rounded-tr-[18px]
                        "
                    >
                        <div
                            class="
                                absolute
                                right-[-16px]
                                top-[-16px]
                                h-8
                                w-8
                                rotate-45
                                bg-[#e9e9e9]
                            "
                        ></div>
                    </div>
                    {{-- DOCUMENT ICON --}}
                    <div
                        class="
                            flex
                            h-8
                            w-8
                            items-center
                            justify-center
                            rounded-full
                            bg-[#111]
                            text-white
                        "
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-3.5 w-3.5"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path d="M6 3h8l4 4v14H6z"/>
                            <path d="M14 3v5h5"/>
                            <path d="M9 13h6"/>
                            <path d="M9 16h6"/>
                        </svg>
                    </div>
                    <p
                        class="
                            mt-3
                            text-[7px]
                            font-medium
                            uppercase
                            tracking-[0.16em]
                            text-black/30
                        "
                    >
                        Curriculum Vitae
                    </p>
                    <div class="mt-3 space-y-1.5">
                        <span
                            class="
                                block
                                h-[3px]
                                w-[75%]
                                rounded-full
                                bg-black/80
                            "
                        ></span>
                        <span
                            class="
                                block
                                h-[3px]
                                w-full
                                rounded-full
                                bg-black/[0.08]
                            "
                        ></span>
                        <span
                            class="
                                block
                                h-[3px]
                                w-[90%]
                                rounded-full
                                bg-black/[0.08]
                            "
                        ></span>
                        <span
                            class="
                                block
                                h-[3px]
                                w-[65%]
                                rounded-full
                                bg-black/[0.08]
                            "
                        ></span>
                    </div>
                    <div
                        class="
                            absolute
                            bottom-3
                            left-3.5
                            right-3.5
                            flex
                            items-center
                            justify-between
                            border-t
                            border-black/[0.08]
                            pt-2
                        "
                    >
                        <span
                            class="
                                text-[6px]
                                font-medium
                                uppercase
                                tracking-[0.16em]
                                text-black/30
                            "
                        >
                            PDF
                        </span>
                        <span
                            class="
                                flex
                                h-5
                                w-5
                                items-center
                                justify-center
                                rounded-full
                                bg-black
                                text-white
                            "
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-2.5 w-2.5"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <path d="M7 17 17 7"/>
                                <path d="M8 7h9v9"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{-- BOTTOM META --}}
        <div
            class="
                relative
                z-10
                mt-6
                flex
                flex-col
                gap-2
                border-t
                border-white/[0.08]
                pt-3
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
        >
            <span
                class="
                    text-[7px]
                    font-medium
                    uppercase
                    tracking-[0.16em]
                    text-white/25
                "
            >
                PDF · Curriculum Vitae
            </span>
            <div
                class="
                    flex
                    items-center
                    gap-2
                    text-[7px]
                    uppercase
                    tracking-[0.14em]
                    text-white/25
                "
            >
                <span
                    class="
                        h-[4px]
                        w-[4px]
                        rounded-full
                        bg-white/40
                    "
                ></span>
                {{ __('contact.cv.new_tab') }}
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- REVEAL SCRIPT --}}
{{-- ========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const elements =
        document.querySelectorAll(
            '.contact-reveal'
        );
    if ('IntersectionObserver' in window) {
        const observer =
            new IntersectionObserver(
                function (
                    entries,
                    observerInstance
                ) {
                    entries.forEach(
                        function (entry) {
                            if (!entry.isIntersecting) {
                                return;
                            }
                            entry.target
                                .classList
                                .add(
                                    'is-visible'
                                );
                            observerInstance
                                .unobserve(
                                    entry.target
                                );
                        }
                    );
                },
                {
                    threshold: .10,
                    rootMargin:
                        '0px 0px -30px 0px'
                }
            );
        elements.forEach(
            function (element) {
                observer.observe(
                    element
                );
            }
        );
    } else {
        elements.forEach(
            function (element) {
                element.classList.add(
                    'is-visible'
                );
            }
        );
    }
});
</script>
@endsection
