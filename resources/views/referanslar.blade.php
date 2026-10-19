@extends('layouts.site')
@php
    $referencesIsEnglish = app()->getLocale() === 'en';
    $referencesUrl = $referencesIsEnglish
        ? route('en.references.index', ['locale' => 'en'])
        : route('references.index');
    $contactUrl = $referencesIsEnglish
        ? route('en.contact', ['locale' => 'en'])
        : route('contact');
    $referencesSiteName = $settings['site_name'] ?? 'Portfolyo';
    $referencesSeoTitle = $referencesIsEnglish
        ? __('references.seo.title', ['site' => $referencesSiteName])
        : ('Referanslar – Marka ve Proje İş Birlikleri | ' . $referencesSiteName);
    $referencesMetaDescription = $referencesIsEnglish
        ? __('references.seo.description')
        : 'Birlikte çalıştığım marka, kurum ve proje referanslarını inceleyin. Web yazılım, dijital ürün, kurumsal web ve özel geliştirme alanındaki iş birlikleri.';
@endphp
@section('title', $referencesSeoTitle)
@section(
    'meta_description',
    $referencesMetaDescription
)
@section('canonical', $referencesUrl)
@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)
@section('og_type', 'website')
@section(
    'og_image_alt',
    __('references.seo.og_alt', ['site' => $referencesSiteName])
)
@section('content')
<style>
    .references-reveal {
        opacity: 0;
        transform: translateY(24px);
        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }
    .references-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .reference-card {
        transition:
            transform .45s cubic-bezier(.22, 1, .36, 1),
            border-color .35s ease,
            background-color .35s ease,
            box-shadow .35s ease;
    }
    .reference-card:hover {
        transform: translateY(-5px);
        background: #171717;
        border-color: rgba(255,255,255,.16);
    }
    .reference-logo {
        transition:
            transform .45s cubic-bezier(.22, 1, .36, 1),
            opacity .35s ease;
    }
    .reference-card:hover .reference-logo {
        transform: scale(1.05);
    }
    .reference-cta {
        position: relative;
        overflow: hidden;
    }
    .reference-cta::before {
        content: '';
        position: absolute;
        width: 420px;
        height: 420px;
        right: -180px;
        top: -250px;
        border-radius: 9999px;
        background:
            radial-gradient(
                circle,
                rgba(255,255,255,.08) 0%,
                rgba(255,255,255,.02) 45%,
                transparent 70%
            );
        pointer-events: none;
    }
    .reference-cta::after {
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        right: 80px;
        bottom: -170px;
        border-radius: 9999px;
        border: 1px solid rgba(255,255,255,.05);
        pointer-events: none;
    }
    @media (prefers-reduced-motion: reduce) {
        .references-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .reference-card,
        .reference-logo {
            transition: none !important;
        }
    }
</style>
{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section
    class="
        bg-[#f3f4f5]
        pb-16
        pt-12
        lg:pb-24
        lg:pt-16
    "
>
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div
            class="
                references-reveal
                grid
                grid-cols-1
                gap-12
                lg:grid-cols-[minmax(0,1fr)_340px]
                lg:items-end
                lg:gap-20
            "
        >
            {{-- LEFT --}}
            <div class="max-w-[950px]">
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-black/20"></span>
                    <span
                        class="
                            text-[8px]
                            font-medium
                            uppercase
                            tracking-[0.22em]
                            text-black/35
                        "
                    >
                        {{ __('references.hero.eyebrow') }}
                    </span>
                    <span
                        class="
                            h-[5px]
                            w-[5px]
                            rounded-full
                            bg-black
                        "
                    ></span>
                </div>
                <h1
                    class="
                        mt-7
                        max-w-[900px]
                        text-[44px]
                        font-medium
                        leading-[0.98]
                        tracking-[-0.055em]
                        text-[#111]
                        sm:text-[58px]
                        lg:text-[78px]
                    "
                >
                    {{ __('references.hero.title_before') }}
                    <span class="text-black/35">
                        {{ __('references.hero.title_emphasis') }}
                    </span>
                </h1>
            </div>
            {{-- RIGHT --}}
            <div class="lg:pb-2">
                <p
                    class="
                        max-w-[320px]
                        text-[13px]
                        leading-7
                        text-black/45
                    "
                >
                    {{ __('references.hero.description') }}
                </p>
                @if(isset($references))
                    <div class="mt-7 flex items-center gap-3">
                        <span
                            class="
                                text-[28px]
                                font-medium
                                tracking-[-0.04em]
                                text-black
                            "
                        >
                            {{ method_exists($references, 'total')
                                ? str_pad($references->total(), 2, '0', STR_PAD_LEFT)
                                : str_pad($references->count(), 2, '0', STR_PAD_LEFT)
                            }}
                        </span>
                        <span
                            class="
                                text-[8px]
                                uppercase
                                tracking-[0.18em]
                                text-black/30
                            "
                        >
                            Marka /
                            <br>
                            Referans
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- REFERENCES --}}
{{-- ========================================================= --}}
<section class="bg-[#f3f4f5] pb-24 lg:pb-32">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        {{-- HEADER LINE --}}
        <div
            class="
                references-reveal
                flex
                items-center
                justify-between
                border-t
                border-black/[0.08]
                pb-8
                pt-6
            "
        >
            <span
                class="
                    text-[8px]
                    font-medium
                    uppercase
                    tracking-[0.18em]
                    text-black/30
                "
            >
                {{ __('references.list.eyebrow') }}
            </span>
            <span
                class="
                    hidden
                    text-[8px]
                    uppercase
                    tracking-[0.18em]
                    text-black/25
                    sm:block
                "
            >
                {{ __('references.list.collaborations') }}
            </span>
        </div>
        {{-- ================================================= --}}
        {{-- LOGO GRID --}}
        {{-- ================================================= --}}
        <div
            class="
                grid
                grid-cols-2
                gap-3
                md:grid-cols-3
                xl:grid-cols-4
            "
        >
            @forelse($references as $reference)
                @if($reference->website_url)
                    <a
                        href="{{ $reference->website_url }}"
                        target="_blank"
                        rel="noopener noreferrer nofollow"
                        aria-label="{{ $reference->company }} {{ __('references.list.visit_website') }}"
                        class="
                            reference-card
                            references-reveal
                            group
                            relative
                            flex
                            aspect-[1/0.78]
                            items-center
                            justify-center
                            overflow-hidden
                            rounded-[24px]
                            border
                            border-white/[0.08]
                            bg-[#111]
                            p-8
                            hover:border-white/[0.16]
                            hover:bg-[#171717]
                            hover:shadow-[0_18px_50px_rgba(0,0,0,0.12)]
                            sm:p-10
                        "
                        style="transition-delay: {{ ($loop->index % 8) * 45 }}ms;"
                    >
                        @if($reference->logo)
                            <img
                                src="{{ asset('storage/' . $reference->logo) }}"
                                alt="{{ $reference->company }}"
                                loading="lazy"
                                decoding="async"
                                class="
                                    reference-logo
                                    max-h-[72px]
                                    max-w-[170px]
                                    object-contain
                                    opacity-90
                                    sm:max-h-[82px]
                                    sm:max-w-[200px]
                                    group-hover:opacity-100
                                group-hover:border-white/25
                                group-hover:text-white
                                "
                            >
                        @else
                            <div
                                class="
                                    reference-logo
                                    flex
                                    h-16
                                    w-16
                                    items-center
                                    justify-center
                                    rounded-[18px]
                                    bg-white/[0.08]
                                    text-[20px]
                                    font-medium
                                    text-white
                                "
                            >
                                {{ strtoupper(substr($reference->company, 0, 1)) }}
                            </div>
                        @endif
                        {{-- SMALL ARROW --}}
                        <span
                            class="
                                absolute
                                bottom-5
                                right-5
                                flex
                                h-8
                                w-8
                                items-center
                                justify-center
                                rounded-full
                                border
                                border-white/[0.10]
                                text-white/40
                                opacity-0
                                transition-all
                                duration-300
                                group-hover:opacity-100
                            "
                        >
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
                        </span>
                    </a>
                @else
                    <div
                        class="
                            reference-card
                            references-reveal
                            group
                            relative
                            flex
                            aspect-[1/0.78]
                            items-center
                            justify-center
                            overflow-hidden
                            rounded-[24px]
                            border
                            border-white/[0.08]
                            bg-[#111]
                            p-8
                            hover:border-white/[0.16]
                            hover:bg-[#171717]
                            hover:shadow-[0_18px_50px_rgba(0,0,0,0.12)]
                            sm:p-10
                        "
                        style="transition-delay: {{ ($loop->index % 8) * 45 }}ms;"
                    >
                        @if($reference->logo)
                            <img
                                src="{{ asset('storage/' . $reference->logo) }}"
                                alt="{{ $reference->company }}"
                                loading="lazy"
                                decoding="async"
                                class="
                                    reference-logo
                                    max-h-[72px]
                                    max-w-[170px]
                                    object-contain
                                    opacity-90
                                    sm:max-h-[82px]
                                    sm:max-w-[200px]
                                    group-hover:opacity-100
                                "
                            >
                        @else
                            <div
                                class="
                                    reference-logo
                                    flex
                                    h-16
                                    w-16
                                    items-center
                                    justify-center
                                    rounded-[18px]
                                    bg-white/[0.08]
                                    text-[20px]
                                    font-medium
                                    text-white
                                "
                            >
                                {{ strtoupper(substr($reference->company, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                @endif
            @empty
                <div
                    class="
                        col-span-full
                        flex
                        min-h-[260px]
                        items-center
                        justify-center
                        rounded-[24px]
                        border
                        border-white/[0.08]
                        bg-[#111]
                        px-8
                    "
                >
                    <div class="text-center">
                        <span
                            class="
                                mx-auto
                                block
                                h-[6px]
                                w-[6px]
                                rounded-full
                                bg-white/35
                            "
                        ></span>
                        <p
                            class="
                                mt-5
                                text-[12px]
                                font-medium
                                text-white/40
                            "
                        >
                            {{ __('references.empty') }}
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}
        @if(
            method_exists($references, 'hasPages')
            &&
            $references->hasPages()
        )
            <div
                class="
                    references-reveal
                    mt-12
                    border-t
                    border-black/[0.08]
                    pt-8
                "
            >
                {{ $references->links() }}
            </div>
        @endif
    </div>
</section>
{{-- ========================================================= --}}
{{-- CTA --}}
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
            reference-cta
            references-reveal
            mx-auto
            max-w-[1400px]
            rounded-[30px]
            bg-[#111]
            px-7
            py-9
            text-white
            sm:px-10
            sm:py-11
            lg:px-14
            lg:py-14
        "
    >
        <div
            class="
                relative
                z-10
                grid
                grid-cols-1
                gap-10
                lg:grid-cols-[minmax(0,1fr)_auto]
                lg:items-end
            "
        >
            {{-- LEFT --}}
            <div class="max-w-[800px]">
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
                        {{ __('references.cta.eyebrow') }}
                    </span>
                </div>
                <h2
                    class="
                        mt-6
                        max-w-[760px]
                        text-[34px]
                        font-medium
                        leading-[1.05]
                        tracking-[-0.045em]
                        text-white
                        sm:text-[46px]
                        lg:text-[58px]
                    "
                >
                    {{ __('references.cta.title_before') }}
                    <span class="text-white/35">
                        {{ __('references.cta.title_emphasis') }}
                    </span>
                </h2>
                <p
                    class="
                        mt-6
                        max-w-[620px]
                        text-[13px]
                        leading-7
                        text-white/40
                    "
                >
                    {{ __('references.cta.description') }}
                </p>
            </div>
            {{-- CTA --}}
            <div>
                <a
                    href="{{ $contactUrl }}"
                    class="
                        group
                        inline-flex
                        min-w-[210px]
                        items-center
                        justify-between
                        gap-8
                        rounded-full
                        bg-white
                        py-3
                        pl-6
                        pr-3
                        text-[10px]
                        font-semibold
                        text-black
                        transition-all
                        duration-300
                        hover:-translate-y-0.5
                        hover:bg-white/90
                    "
                >
                    <span>
                        {{ __('references.cta.button') }}
                    </span>
                    <span
                        class="
                            flex
                            h-10
                            w-10
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
                                h-4
                                w-4
                                transition-transform
                                duration-300
                                group-hover:translate-x-1
                            "
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path d="M5 12h14"/>
                            <path d="m14 7 5 5-5 5"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        {{-- BOTTOM --}}
        <div
            class="
                relative
                z-10
                mt-12
                flex
                items-center
                justify-between
                border-t
                border-white/[0.08]
                pt-5
            "
        >
            <span
                class="
                    text-[7px]
                    uppercase
                    tracking-[0.17em]
                    text-white/25
                "
            >
                {{ __('references.cta.bottom_label') }}
            </span>
            <span class="flex items-center gap-2">
                <span class="relative flex h-2 w-2">
                    <span
                        class="
                            absolute
                            inline-flex
                            h-full
                            w-full
                            animate-ping
                            rounded-full
                            bg-white
                            opacity-20
                        "
                    ></span>
                    <span
                        class="
                            relative
                            inline-flex
                            h-2
                            w-2
                            rounded-full
                            bg-white/70
                        "
                    ></span>
                </span>
                <span
                    class="
                        hidden
                        text-[7px]
                        uppercase
                        tracking-[0.15em]
                        text-white/25
                        sm:block
                    "
                >
                    {{ __('references.cta.status') }}
                </span>
            </span>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const elements =
        document.querySelectorAll(
            '.references-reveal'
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
                                .add('is-visible');
                            observerInstance
                                .unobserve(entry.target);
                        }
                    );
                },
                {
                    threshold: .08,
                    rootMargin: '0px 0px -30px 0px'
                }
            );
        elements.forEach(
            function (element) {
                observer.observe(element);
            }
        );
    } else {
        elements.forEach(
            function (element) {
                element
                    .classList
                    .add('is-visible');
            }
        );
    }
});
</script>
@endsection
