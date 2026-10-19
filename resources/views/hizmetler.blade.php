@extends('layouts.site')
@php
    $servicesIsEnglish = app()->getLocale() === 'en';
    $servicesUrl = $servicesIsEnglish
        ? route('en.services.index', ['locale' => 'en'])
        : route('services.index');
    $contactUrl = $servicesIsEnglish
        ? route('en.contact', ['locale' => 'en'])
        : route('contact');
    $servicesSiteName = $settings['site_name'] ?? 'Portfolyo';
    $servicesSeoTitle = $servicesIsEnglish
        ? __('services.seo.title', ['site' => $servicesSiteName])
        : ('Hizmetler | ' . $servicesSiteName);
    $servicesMetaDescription = $servicesIsEnglish
        ? __('services.seo.description')
        : 'Web tasarım, özel yazılım, yönetim paneli, UI/UX, SEO altyapısı ve dijital ürün geliştirme hizmetleri. İhtiyaca özel, modern ve sürdürülebilir çözümler.';
@endphp
@section('title', $servicesSeoTitle)
@section(
    'meta_description',
    $servicesMetaDescription
)
@section('canonical', $servicesUrl)
@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)
@section('og_type', 'website')
@section(
    'og_image_alt',
    __('services.seo.og_alt', ['site' => $servicesSiteName])
)
@section('content')
<style>
    .services-reveal {
        opacity: 0;
        transform: translateY(28px);
        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }
    .services-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .service-image {
        transition:
            transform .9s cubic-bezier(.22, 1, .36, 1);
    }
    .service-row:hover .service-image {
        transform: scale(1.035);
    }
    .service-detail {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        transition:
            max-height .6s cubic-bezier(.22, 1, .36, 1),
            opacity .4s ease,
            margin-top .5s ease;
    }
    .service-detail.is-open {
        opacity: 1;
    }
    .service-arrow {
        transition:
            transform .35s cubic-bezier(.22, 1, .36, 1);
    }
    .service-toggle[aria-expanded="true"] .service-arrow {
        transform: rotate(90deg);
    }
    @media (prefers-reduced-motion: reduce) {
        .services-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .service-image,
        .service-detail,
        .service-arrow {
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
        pb-14
        pt-8
        lg:pb-20
        lg:pt-12
    "
>
    <div
        class="
            mx-auto
            max-w-[1400px]
            px-6
            lg:px-10
        "
    >
        <div
            class="
                services-reveal
                mx-auto
                max-w-[860px]
                text-center
            "
        >
            <div
                class="
                    flex
                    items-center
                    justify-center
                    gap-3
                "
            >
                <span class="h-px w-8 bg-black/20"></span>
                <span
                    class="
                        text-[9px]
                        font-medium
                        uppercase
                        tracking-[0.24em]
                        text-black/35
                    "
                >
                    {{ __('services.hero.eyebrow') }}
                </span>
                <span class="h-[5px] w-[5px] rounded-full bg-black"></span>
            </div>
            <h1
                class="
                    mt-6
                    text-[42px]
                    font-medium
                    leading-[1.04]
                    tracking-[-0.045em]
                    text-[#111]
                    sm:text-[54px]
                    lg:text-[64px]
                "
            >
                {{ __('services.hero.title_before') }}
                <span class="text-black/35">
                    {{ __('services.hero.title_emphasis') }}
                </span>
            </h1>
            <p
                class="
                    mx-auto
                    mt-6
                    max-w-[620px]
                    text-[13px]
                    leading-7
                    text-black/40
                    sm:text-[15px]
                "
            >
                {{ __('services.hero.description') }}
            </p>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- SERVICES --}}
{{-- ========================================================= --}}
<section
    class="
        bg-[#f3f4f5]
        pb-24
        lg:pb-32
    "
>
    <div
        class="
            mx-auto
            max-w-[1400px]
            px-6
            lg:px-10
        "
    >
        <div class="space-y-20 lg:space-y-28">
            @forelse($services as $service)
                @php
                    $serviceTitle = $servicesIsEnglish && !empty($service->title_en)
                        ? $service->title_en
                        : $service->title;
                    $serviceDescription = $servicesIsEnglish && !empty($service->description_en)
                        ? $service->description_en
                        : $service->description;
                    $serviceImage = data_get($service, 'image');
                    $serviceNumber =
                        str_pad(
                            $loop->iteration,
                            2,
                            '0',
                            STR_PAD_LEFT
                        );
                    $isEven =
                        $loop->even;
                @endphp
                <article
                    class="
                        service-row
                        services-reveal
                        relative
                    "
                    style="
                        transition-delay:
                        {{ min($loop->index * 70, 280) }}ms;
                    "
                >
                    <div
                        class="
                            grid
                            grid-cols-1
                            items-center
                            gap-9
                            lg:grid-cols-2
                            lg:gap-16
                        "
                    >
                        {{-- ================================================= --}}
                        {{-- IMAGE --}}
                        {{-- ================================================= --}}
                        <div
                            class="
                                {{ $isEven ? 'lg:order-1' : 'lg:order-2' }}
                            "
                        >
                            <div
                                class="
                                    group/image
                                    relative
                                    aspect-[16/10]
                                    overflow-hidden
                                    rounded-[22px]
                                    border
                                    border-black/[0.055]
                                    bg-[#e9e9e9]
                                    shadow-[0_22px_65px_rgba(0,0,0,0.06)]
                                "
                            >
                                @if(!empty($serviceImage))
                                    <img
                                        src="{{ asset('storage/' . $serviceImage) }}"
                                        alt="{{ $serviceTitle }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="
                                            service-image
                                            absolute
                                            inset-0
                                            h-full
                                            w-full
                                            object-cover
                                        "
                                    >
                                @else
                                    {{-- FALLBACK --}}
                                    <div
                                        class="
                                            absolute
                                            inset-0
                                            flex
                                            items-center
                                            justify-center
                                            bg-[#111]
                                        "
                                    >
                                        <div
                                            class="
                                                relative
                                                h-[180px]
                                                w-[180px]
                                                rounded-full
                                                border
                                                border-white/[0.08]
                                            "
                                        >
                                            <span
                                                class="
                                                    absolute
                                                    left-1/2
                                                    top-1/2
                                                    h-px
                                                    w-[230px]
                                                    -translate-x-1/2
                                                    -translate-y-1/2
                                                    rotate-[-18deg]
                                                    bg-white/[0.10]
                                                "
                                            ></span>
                                            <span
                                                class="
                                                    absolute
                                                    left-1/2
                                                    top-1/2
                                                    -translate-x-1/2
                                                    -translate-y-1/2
                                                    text-[11px]
                                                    font-medium
                                                    uppercase
                                                    tracking-[0.18em]
                                                    text-white/40
                                                "
                                            >
                                                {{ $serviceNumber }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                {{-- TOP BADGE --}}
                                <div
                                    class="
                                        absolute
                                        left-4
                                        top-4
                                        flex
                                        items-center
                                        gap-2
                                        rounded-full
                                        border
                                        border-white/20
                                        bg-white/85
                                        px-3
                                        py-1.5
                                        backdrop-blur-md
                                    "
                                >
                                    <span
                                        class="
                                            text-[7px]
                                            font-medium
                                            uppercase
                                            tracking-[0.13em]
                                            text-black/55
                                        "
                                    >
                                        {{ __('services.item.badge') }} {{ $serviceNumber }}
                                    </span>
                                </div>
                                {{-- BOTTOM GRADIENT --}}
                                <div
                                    class="
                                        pointer-events-none
                                        absolute
                                        inset-x-0
                                        bottom-0
                                        h-[28%]
                                        bg-gradient-to-t
                                        from-black/15
                                        to-transparent
                                    "
                                ></div>
                            </div>
                        </div>
                        {{-- ================================================= --}}
                        {{-- CONTENT --}}
                        {{-- ================================================= --}}
                        <div
                            class="
                                {{ $isEven ? 'lg:order-2' : 'lg:order-1' }}
                                {{ $isEven ? 'lg:pl-4' : 'lg:pr-4' }}
                            "
                        >
                            <div class="max-w-[520px]">
                                <div
                                    class="
                                        flex
                                        items-center
                                        gap-3
                                    "
                                >
                                    <span class="h-px w-8 bg-black/20"></span>
                                    <span
                                        class="
                                            text-[8px]
                                            font-medium
                                            uppercase
                                            tracking-[0.18em]
                                            text-black/30
                                        "
                                    >
                                        {{ $serviceNumber }}
                                    </span>
                                </div>
                                <h2
                                    class="
                                        mt-5
                                        text-[30px]
                                        font-medium
                                        leading-[1.08]
                                        tracking-[-0.04em]
                                        text-[#111]
                                        sm:text-[36px]
                                        lg:text-[40px]
                                    "
                                >
                                    {{ $serviceTitle }}
                                </h2>
                                <p
                                    class="
                                        mt-5
                                        max-w-[500px]
                                        text-[12px]
                                        leading-6
                                        text-black/42
                                        sm:text-[13px]
                                    "
                                >
                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($serviceDescription),
                                        180
                                    ) }}
                                </p>
                                {{-- TAGS --}}
                                <div
                                    class="
                                        mt-6
                                        flex
                                        flex-wrap
                                        gap-2
                                    "
                                >
                                    <span
                                        class="
                                            rounded-full
                                            border
                                            border-black/[0.07]
                                            bg-white/60
                                            px-3
                                            py-2
                                            text-[8px]
                                            text-black/42
                                        "
                                    >
                                        {{ __('services.item.tags.user_focused') }}
                                    </span>
                                    <span
                                        class="
                                            rounded-full
                                            border
                                            border-black/[0.07]
                                            bg-white/60
                                            px-3
                                            py-2
                                            text-[8px]
                                            text-black/42
                                        "
                                    >
                                        {{ __('services.item.tags.modern') }}
                                    </span>
                                    <span
                                        class="
                                            rounded-full
                                            border
                                            border-black/[0.07]
                                            bg-white/60
                                            px-3
                                            py-2
                                            text-[8px]
                                            text-black/42
                                        "
                                    >
                                        {{ __('services.item.tags.sustainable') }}
                                    </span>
                                </div>
                                {{-- BUTTON --}}
                                <div class="mt-8">
                                    <button
                                        type="button"
                                        data-service-toggle
                                        data-target="service-detail-{{ $service->id }}"
                                        aria-expanded="false"
                                        class="
                                            service-toggle
                                            group/button
                                            inline-flex
                                            items-center
                                            gap-3
                                            rounded-full
                                            bg-[#111]
                                            px-5
                                            py-3
                                            text-[9px]
                                            font-medium
                                            text-white
                                            shadow-[0_10px_25px_rgba(0,0,0,.12)]
                                            transition-all
                                            duration-300
                                            hover:-translate-y-0.5
                                            hover:bg-black
                                            hover:shadow-[0_16px_35px_rgba(0,0,0,.18)]
                                        "
                                    >
                                        <span data-service-button-text>
                                            {{ __('services.item.read_more') }}
                                        </span>
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            class="
                                                service-arrow
                                                h-4
                                                w-4
                                            "
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                        >
                                            <path d="M5 12h14"/>
                                            <path d="m14 7 5 5-5 5"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ================================================= --}}
                    {{-- EXPANDABLE DETAIL --}}
                    {{-- ================================================= --}}
                    <div
                        id="service-detail-{{ $service->id }}"
                        class="service-detail"
                    >
                        <div
                            class="
                                mt-10
                                rounded-[26px]
                                border
                                border-black/[0.055]
                                bg-white/70
                                p-7
                                shadow-[0_18px_50px_rgba(0,0,0,.035)]
                                backdrop-blur-sm
                                sm:p-8
                                lg:p-10
                            "
                        >
                            <div
                                class="
                                    grid
                                    grid-cols-1
                                    gap-10
                                    lg:grid-cols-[1.15fr_.85fr]
                                "
                            >
                                {{-- DETAIL --}}
                                <div>
                                    <div
                                        class="
                                            flex
                                            items-center
                                            gap-3
                                        "
                                    >
                                        <span class="h-px w-8 bg-black/20"></span>
                                        <span
                                            class="
                                                text-[8px]
                                                font-medium
                                                uppercase
                                                tracking-[0.18em]
                                                text-black/30
                                            "
                                        >
                                            {{ __('services.item.detail_title') }}
                                        </span>
                                    </div>
                                    <h3
                                        class="
                                            mt-5
                                            text-[25px]
                                            font-medium
                                            tracking-[-0.03em]
                                            text-[#111]
                                        "
                                    >
                                        {{ $serviceTitle }}
                                    </h3>
                                    <div
                                        class="
                                            mt-5
                                            text-[12px]
                                            leading-7
                                            text-black/45
                                        "
                                    >
                                        {!! nl2br(e($serviceDescription)) !!}
                                    </div>
                                </div>
                                {{-- FEATURES --}}
                                <div
                                    class="
                                        rounded-[20px]
                                        bg-[#111]
                                        p-6
                                        text-white
                                    "
                                >
                                    <p
                                        class="
                                            text-[8px]
                                            font-medium
                                            uppercase
                                            tracking-[0.16em]
                                            text-white/35
                                        "
                                    >
                                        {{ __('services.item.content_title') }}
                                    </p>
                                    <div class="mt-6 space-y-4">
                                        <div class="flex items-start gap-3">
                                            <span
                                                class="
                                                    mt-1
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    border
                                                    border-white/15
                                                    text-[7px]
                                                    text-white
                                                "
                                            >
                                                ✓
                                            </span>
                                            <p
                                                class="
                                                    text-[10px]
                                                    leading-5
                                                    text-white/60
                                                "
                                            >
                                                {{ __('services.item.features.analysis') }}
                                            </p>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <span
                                                class="
                                                    mt-1
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    border
                                                    border-white/15
                                                    text-[7px]
                                                    text-white
                                                "
                                            >
                                                ✓
                                            </span>
                                            <p
                                                class="
                                                    text-[10px]
                                                    leading-5
                                                    text-white/60
                                                "
                                            >
                                                {{ __('services.item.tags.modern') }} ve kullanıcı odaklı çözüm yaklaşımı.
                                            </p>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <span
                                                class="
                                                    mt-1
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    border
                                                    border-white/15
                                                    text-[7px]
                                                    text-white
                                                "
                                            >
                                                ✓
                                            </span>
                                            <p
                                                class="
                                                    text-[10px]
                                                    leading-5
                                                    text-white/60
                                                "
                                            >
                                                {{ __('services.item.tags.sustainable') }} ve geliştirilebilir yapı.
                                            </p>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <span
                                                class="
                                                    mt-1
                                                    flex
                                                    h-5
                                                    w-5
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    border
                                                    border-white/15
                                                    text-[7px]
                                                    text-white
                                                "
                                            >
                                                ✓
                                            </span>
                                            <p
                                                class="
                                                    text-[10px]
                                                    leading-5
                                                    text-white/60
                                                "
                                            >
                                                {{ __('services.item.features.performance') }}
                                            </p>
                                        </div>
                                    </div>
                                    <a
                                        href="{{ $contactUrl }}"
                                        class="
                                            mt-7
                                            inline-flex
                                            items-center
                                            gap-3
                                            rounded-full
                                            bg-white
                                            px-5
                                            py-3
                                            text-[9px]
                                            font-medium
                                            text-black
                                            transition-all
                                            duration-300
                                            hover:-translate-y-0.5
                                        "
                                    >
                                        {{ __('services.item.contact') }}
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
                                    </a>
                                </div>
                            </div>
                            <div
                                class="
                                    mt-8
                                    flex
                                    justify-end
                                    border-t
                                    border-black/[0.06]
                                    pt-5
                                "
                            >
                                <button
                                    type="button"
                                    data-service-close
                                    data-target="service-detail-{{ $service->id }}"
                                    class="
                                        text-[9px]
                                        font-medium
                                        text-black/38
                                        transition
                                        hover:text-black
                                    "
                                >
                                    {{ __('services.item.close') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="
                        rounded-[28px]
                        border
                        border-black/[0.06]
                        bg-white
                        px-6
                        py-20
                        text-center
                    "
                >
                    <p
                        class="
                            text-[12px]
                            font-medium
                            text-black/40
                        "
                    >
                        {{ __('services.empty') }}
                    </p>
                </div>
            @endforelse
        </div>
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
            services-reveal
            relative
            mx-auto
            max-w-[1400px]
            overflow-hidden
            rounded-[38px]
            bg-[#090909]
            px-7
            py-14
            text-white
            shadow-[0_30px_90px_rgba(0,0,0,.16)]
            sm:px-10
            lg:px-16
            lg:py-20
        "
    >
        <div
            class="
                pointer-events-none
                absolute
                -bottom-[170px]
                left-1/2
                h-[270px]
                w-[900px]
                -translate-x-1/2
                rounded-[50%]
                border-t
                border-white/[0.10]
            "
        ></div>
        <div
            class="
                relative
                z-10
                flex
                flex-col
                gap-10
                lg:flex-row
                lg:items-end
                lg:justify-between
            "
        >
            <div>
                <span
                    class="
                        text-[8px]
                        font-medium
                        uppercase
                        tracking-[0.20em]
                        text-white/30
                    "
                >
                    {{ __('services.cta.eyebrow') }}
                </span>
                <h2
                    class="
                        mt-5
                        max-w-[780px]
                        text-[36px]
                        font-medium
                        leading-[1.05]
                        tracking-[-0.045em]
                        text-white
                        sm:text-[46px]
                        lg:text-[56px]
                    "
                >
                    {{ __('services.cta.title_before') }}
                    <span class="text-white/35">
                        {{ __('services.cta.title_emphasis') }}
                    </span>
                    {{ __('services.cta.title_after') }}
                </h2>
                <p
                    class="
                        mt-6
                        max-w-[590px]
                        text-[12px]
                        leading-6
                        text-white/40
                    "
                >
                    {{ __('services.cta.description') }}
                </p>
            </div>
            <a
                href="{{ $contactUrl }}"
                class="
                    inline-flex
                    w-fit
                    shrink-0
                    items-center
                    gap-4
                    rounded-full
                    bg-white
                    px-6
                    py-4
                    text-[10px]
                    font-medium
                    text-black
                    transition-all
                    duration-300
                    hover:-translate-y-1
                "
            >
                {{ __('services.cta.button') }}
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
            </a>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    /*
    |--------------------------------------------------------------------------
    | REVEAL
    |--------------------------------------------------------------------------
    */
    const revealElements =
        document.querySelectorAll(
            '.services-reveal'
        );
    if (
        'IntersectionObserver'
        in window
    ) {
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
        revealElements.forEach(
            function (element) {
                observer.observe(
                    element
                );
            }
        );
    } else {
        revealElements.forEach(
            function (element) {
                element.classList.add(
                    'is-visible'
                );
            }
        );
    }
    /*
    |--------------------------------------------------------------------------
    | SERVICE ACCORDION
    |--------------------------------------------------------------------------
    */
    const toggleButtons =
        document.querySelectorAll(
            '[data-service-toggle]'
        );
    const closeButtons =
        document.querySelectorAll(
            '[data-service-close]'
        );
    function closeService(target) {
        if (!target) {
            return;
        }
        target.style.maxHeight =
            '0px';
        target.classList.remove(
            'is-open'
        );
        const toggle =
            document.querySelector(
                `[data-service-toggle][data-target="${target.id}"]`
            );
        if (toggle) {
            toggle.setAttribute(
                'aria-expanded',
                'false'
            );
            const text =
                toggle.querySelector(
                    '[data-service-button-text]'
                );
            if (text) {
                text.textContent =
                    @json(__('services.item.read_more'));
            }
        }
    }
    function openService(target) {
        if (!target) {
            return;
        }
        target.classList.add(
            'is-open'
        );
        target.style.maxHeight =
            target.scrollHeight +
            'px';
        const toggle =
            document.querySelector(
                `[data-service-toggle][data-target="${target.id}"]`
            );
        if (toggle) {
            toggle.setAttribute(
                'aria-expanded',
                'true'
            );
            const text =
                toggle.querySelector(
                    '[data-service-button-text]'
                );
            if (text) {
                text.textContent =
                    @json(__('services.item.show_less'));
            }
        }
    }
    toggleButtons.forEach(
        function (button) {
            button.addEventListener(
                'click',
                function () {
                    const targetId =
                        button.dataset.target;
                    const target =
                        document.getElementById(
                            targetId
                        );
                    if (!target) {
                        return;
                    }
                    const isOpen =
                        target.classList.contains(
                            'is-open'
                        );
                    document
                        .querySelectorAll(
                            '.service-detail.is-open'
                        )
                        .forEach(
                            function (openItem) {
                                if (
                                    openItem !== target
                                ) {
                                    closeService(
                                        openItem
                                    );
                                }
                            }
                        );
                    if (isOpen) {
                        closeService(
                            target
                        );
                    } else {
                        openService(
                            target
                        );
                    }
                }
            );
        }
    );
    closeButtons.forEach(
        function (button) {
            button.addEventListener(
                'click',
                function () {
                    const target =
                        document.getElementById(
                            button.dataset.target
                        );
                    closeService(
                        target
                    );
                }
            );
        }
    );
    window.addEventListener(
        'resize',
        function () {
            document
                .querySelectorAll(
                    '.service-detail.is-open'
                )
                .forEach(
                    function (target) {
                        target.style.maxHeight =
                            target.scrollHeight +
                            'px';
                    }
                );
        }
    );
});
</script>
@endsection
