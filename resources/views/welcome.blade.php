@extends('layouts.site')

@php
    $homeLocale = app()->getLocale();
    $homeIsEnglish = $homeLocale === 'en';

    $homeHomeUrl = $homeIsEnglish
        ? route('en.home', ['locale' => 'en'])
        : route('home');

    $homeProjectsUrl = $homeIsEnglish
        ? route('en.projects.index', ['locale' => 'en'])
        : route('projects.index');

    $homeServicesUrl = $homeIsEnglish
        ? route('en.services.index', ['locale' => 'en'])
        : route('services.index');

    $homeReferencesUrl = $homeIsEnglish
        ? route('en.references.index', ['locale' => 'en'])
        : route('references.index');

    $homeNewsUrl = $homeIsEnglish
        ? route('en.news.index', ['locale' => 'en'])
        : route('news.index');

    $homeSiteName = $settings['site_name'] ?? 'Portfolyo';

    $homeSeoTitle = $homeIsEnglish
        ? __('home.seo.title', ['site' => $homeSiteName])
        : (
            $settings['seo_title']
                ?? __('home.seo.title', ['site' => $homeSiteName])
        );

    $homeMetaDescription = $homeIsEnglish
        ? __('home.seo.description')
        : (
            $settings['meta_description']
                ?? __('home.seo.description')
        );
@endphp

@section('title', $homeSeoTitle)

@section(
    'meta_description',
    $homeMetaDescription
)

@section('canonical', $homeHomeUrl)

@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)

@section('og_type', 'website')

@section(
    'og_image',
    asset('assets/beyazslider22.webp')
)

@section(
    'og_image_alt',
    __('home.seo.og_alt', ['site' => $homeSiteName])
)

@push('head')
    <link
        rel="preload"
        as="image"
        href="{{ asset('assets/beyazslider22.webp') }}"
        fetchpriority="high"
    >
@endpush

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .hero-story-text {
        position: absolute;
        inset: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        text-align: center;

        will-change:
            opacity,
            transform,
            filter;

        backface-visibility: hidden;
        -webkit-font-smoothing: antialiased;
    }

    #heroStoryOne {
        opacity: 1;
        transform: translate3d(0, 0, 0) scale(1);
        filter: blur(0);
    }

    #heroStoryTwo {
        opacity: 0;
        transform: translate3d(0, 28px, 0) scale(.986);
        filter: blur(4px);
    }

    #heroBackgroundImage {
        transform: scale(1);
        will-change: transform;
    }

    /* =========================================================
       HERO SCROLL INDICATOR
    ========================================================= */

    @keyframes scrollMove {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }

        25% {
            opacity: 1;
        }

        70% {
            opacity: 1;
        }

        100% {
            transform: translateY(100%);
            opacity: 0;
        }
    }

    .hero-scroll-line {
        animation: scrollMove 2s ease-in-out infinite;
    }

    /* =========================================================
       PROJECT REVEAL
    ========================================================= */

    .project-reveal {
        opacity: 0;
        transform: translateY(24px);

        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }

    .project-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* =========================================================
       PROJECT PARALLAX
    ========================================================= */

    .project-parallax {
        --project-shift: 0px;

        transform:
            translate3d(
                0,
                var(--project-shift),
                0
            );

        will-change: transform;
    }

    /* =========================================================
       REDUCED MOTION
    ========================================================= */

    @media (prefers-reduced-motion: reduce) {

        html {
            scroll-behavior: auto;
        }

        #heroStoryOne {
            opacity: 1 !important;
            transform: none !important;
            filter: none !important;
        }

        #heroStoryTwo {
            display: none !important;
        }

        #heroBackgroundImage {
            transform: none !important;
        }

        .hero-scroll-line {
            animation: none !important;
        }

        .project-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }

        .project-parallax {
            transform: none !important;
        }
    }

    @keyframes softwareMarqueeLeft {
        from { transform: translate3d(0,0,0); }
        to { transform: translate3d(-50%,0,0); }
    }

    @keyframes softwareMarqueeRight {
        from { transform: translate3d(-50%,0,0); }
        to { transform: translate3d(0,0,0); }
    }

    .software-marquee-track {
        display: flex;
        width: max-content;
        will-change: transform;
    }

    .software-marquee-left {
        animation: softwareMarqueeLeft 34s linear infinite;
    }

    .software-marquee-right {
        animation: softwareMarqueeRight 38s linear infinite;
    }

    .software-marquee-slow {
        animation-duration: 44s;
    }

    .software-marquee-row:hover .software-marquee-track {
        animation-play-state: paused;
    }

    @media (prefers-reduced-motion: reduce) {
        .software-marquee-track {
            animation: none !important;
            transform: none !important;
        }
    }

</style>

{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<section
    id="heroStorySection"
    class="
        relative
        h-[1450px]
        bg-black
    "
>

    <div
        class="
            sticky
            top-0
            h-[720px]
            overflow-hidden
            bg-black
            text-white
            lg:h-screen
        "
    >

        <img
            id="heroBackgroundImage"
            src="{{ asset('assets/beyazslider22.webp') }}"
            alt=""
            fetchpriority="high"
            decoding="async"
            class="
                absolute
                inset-0
                h-full
                w-full
                object-cover
                object-center
            "
        >

        <div
            class="
                pointer-events-none
                absolute
                inset-0
                bg-black/15
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                left-1/2
                top-[46%]
                h-[430px]
                w-[940px]
                -translate-x-1/2
                -translate-y-1/2
                rounded-full
                bg-black/45
                blur-[90px]
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                inset-0
                bg-[radial-gradient(circle_at_50%_45%,transparent_0%,transparent_27%,rgba(0,0,0,0.10)_56%,rgba(0,0,0,0.50)_100%)]
            "
        ></div>

        <div
            class="
                relative
                z-10
                mx-auto
                h-full
                max-w-5xl
                px-6
            "
        >

            {{-- STORY 1 --}}
            <div
                id="heroStoryOne"
                class="hero-story-text"
            >

                <div class="max-w-4xl">

                    <h1
                        class="
                            text-[44px]
                            font-medium
                            leading-[1.08]
                            tracking-[-0.035em]
                            text-white
                            drop-shadow-[0_4px_22px_rgba(0,0,0,0.45)]
                            sm:text-[56px]
                            md:text-[66px]
                            lg:text-[74px]
                        "
                    >

                        <span class="block">
                            {{ __('home.hero.line1') }}
                        </span>

                        <span
                            class="
                                block
                                bg-gradient-to-r
                                from-white
                                via-[#d8d8d8]
                                to-white
                                bg-clip-text
                                text-transparent
                            "
                        >
                            {{ __('home.hero.line2') }}
                        </span>

                        <span class="block">
                            {{ __('home.hero.line3') }}
                        </span>

                    </h1>

                    <p
                        class="
                            mx-auto
                            mt-7
                            max-w-xl
                            text-[15px]
                            leading-7
                            text-white/65
                            md:text-base
                        "
                    >
                        {{ $homeIsEnglish
                            ? __('home.hero.subtitle')
                            : (
                                $settings['hero_subtitle']
                                    ?? __('home.hero.subtitle')
                            )
                        }}
                    </p>

                </div>

            </div>

            {{-- STORY 2 --}}
            <div
                id="heroStoryTwo"
                class="hero-story-text"
            >

                <div class="max-w-4xl">

    

                    <h2
                        class="
                            text-[42px]
                            font-medium
                            leading-[1.08]
                            tracking-[-0.035em]
                            text-white
                            sm:text-[54px]
                            md:text-[64px]
                            lg:text-[72px]
                        "
                    >

                        <span class="block">
                            {{ __('home.hero_second.line1') }}
                        </span>

                        <span
                            class="
                                block
                                bg-gradient-to-r
                                from-white
                                via-[#d2d2d2]
                                to-white
                                bg-clip-text
                                text-transparent
                            "
                        >
                            {{ __('home.hero_second.line2') }}
                        </span>

                        <span class="block">
                            {{ __('home.hero_second.line3') }}
                        </span>

                    </h2>

                    <p
                        class="
                            mx-auto
                            mt-7
                            max-w-xl
                            text-[15px]
                            leading-7
                            text-white/60
                            md:text-base
                        "
                    >
                        {{ __('home.hero_second.subtitle') }}
                    </p>

                </div>

            </div>

        </div>

        {{-- SCROLL INDICATOR --}}
        <div
            id="heroScrollIndicator"
            class="
                pointer-events-none
                absolute
                bottom-5
                left-1/2
                z-20
                flex
                -translate-x-1/2
                flex-col
                items-center
                gap-2
            "
        >

            <span
                class="
                    text-[9px]
                    font-medium
                    uppercase
                    tracking-[0.28em]
                    text-white/35
                "
            >
                {{ __('home.hero.scroll') }}
            </span>

            <span
                class="
                    relative
                    block
                    h-8
                    w-px
                    overflow-hidden
                    bg-white/10
                "
            >

                <span
                    class="
                        hero-scroll-line
                        absolute
                        inset-x-0
                        top-0
                        h-full
                        bg-gradient-to-b
                        from-white
                        to-transparent
                    "
                ></span>

            </span>

        </div>

    </div>

</section>

{{-- ========================================================= --}}
{{-- HOMEPAGE SECTION ORDER WRAPPER --}}
{{-- Görsel sıralama flex order ile yapılır; section içerikleri taşınmaz. --}}
{{-- ========================================================= --}}

<div class="flex flex-col">

{{-- ========================================================= --}}
{{-- FEATURED PROJECTS --}}
{{-- ========================================================= --}}

@php
    $featuredProjects = $projects
        ->where('is_featured', true)
        ->take(3);

    if ($featuredProjects->isEmpty()) {
        $featuredProjects = $projects->take(3);
    }
@endphp

<section
    id="projectsSection"
    class="
        order-1
        relative
        overflow-hidden
        bg-[#f3f4f5]
        py-20
        lg:py-24
    "
>

    <div
        class="
            pointer-events-none
            absolute
            inset-x-0
            top-0
            h-40
            bg-gradient-to-b
            from-white/65
            to-transparent
        "
    ></div>

    <div
        class="
            relative
            mx-auto
            max-w-[1400px]
            px-6
            lg:px-10
        "
    >

        <div
            class="
                grid
                grid-cols-1
                gap-5
                sm:grid-cols-2
                lg:grid-cols-4
            "
        >

            {{-- ================================================= --}}
            {{-- PREMIUM INTRO CARD --}}
            {{-- ================================================= --}}

            <div class="project-reveal">

                <div
                    class="
                        group
                        relative
                        aspect-[4/4.6]
                        overflow-hidden
                        rounded-[28px]
                        border
                        border-black/[0.045]
                        bg-[#faf9f7]
                        p-8
                        shadow-[0_18px_55px_rgba(0,0,0,0.045)]
                        transition-all
                        duration-500
                        ease-[cubic-bezier(.22,1,.36,1)]
                        hover:-translate-y-1.5
                        hover:border-black/[0.08]
                        hover:shadow-[0_28px_75px_rgba(0,0,0,0.08)]
                        xl:p-9
                    "
                >

                    <div
                        class="
                            relative
                            z-10
                            flex
                            h-full
                            flex-col
                        "
                    >

                        {{-- TOP --}}
                        <div>

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-3
                                "
                            >

                                <span
                                    class="
                                        h-px
                                        w-8
                                        bg-black/25
                                    "
                                ></span>

                                <span
                                    class="
                                        text-[9px]
                                        font-medium
                                        uppercase
                                        tracking-[0.24em]
                                        text-black/50
                                    "
                                >
                                    {{ __('home.projects.eyebrow') }}
                                </span>

                            </div>

                            <h2
                                class="
                                    mt-8
                                    max-w-[235px]
                                    text-[30px]
                                    font-medium
                                    leading-[1.10]
                                    tracking-[-0.035em]
                                    text-[#111]
                                    xl:text-[34px]
                                "
                            >
                                {{ __('home.projects.title_before') }}

                                <span class="text-black/40">
                                    {{ __('home.projects.title_emphasis') }}
                                </span>

                                {{ __('home.projects.title_after') }}
                            </h2>

                        </div>

                        {{-- BOTTOM --}}
                        <div class="mt-auto">

                            <div
                                class="
                                    mb-4
                                    h-px
                                    w-full
                                    bg-black/[0.06]
                                "
                            ></div>

                            <a
                                href="{{ $homeProjectsUrl }}"
                                class="
                                    group/button
                                    flex
                                    items-center
                                    justify-between
                                    gap-4
                                "
                            >

                                <span
                                    class="
                                        text-[9px]
                                        font-medium
                                        uppercase
                                        tracking-[0.16em]
                                        text-black/65
                                        transition
                                        duration-300
                                        group-hover/button:text-black
                                        xl:text-[10px]
                                    "
                                >
                                    {{ __('home.projects.view_all') }}
                                </span>

                                {{-- SADE ARROW --}}
                                <span
                                    class="
                                        flex
                                        shrink-0
                                        items-center
                                        justify-center
                                        text-black/45
                                        transition-all
                                        duration-300
                                        ease-out
                                        group-hover/button:-translate-y-[2px]
                                        group-hover/button:translate-x-[2px]
                                        group-hover/button:text-black
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.65"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="h-5 w-5"
                                    >
                                        <path d="M7 17L17 7" />
                                        <path d="M9 7H17V15" />
                                    </svg>

                                </span>

                            </a>

                        </div>

                    </div>

                    {{-- DECOR --}}
                    <div
                        class="
                            pointer-events-none
                            absolute
                            inset-0
                            overflow-hidden
                        "
                    >

                        <div
                            class="
                                absolute
                                -bottom-[75px]
                                -right-[65px]
                                h-[220px]
                                w-[220px]
                                rounded-full
                                border
                                border-black/[0.03]
                            "
                        ></div>

                        <div
                            class="
                                absolute
                                -bottom-[70px]
                                -left-[70px]
                                h-[165px]
                                w-[165px]
                                rounded-full
                                border
                                border-black/[0.03]
                            "
                        ></div>

                    </div>

                </div>

            </div>

            {{-- ================================================= --}}
            {{-- PROJECT CARDS --}}
            {{-- ================================================= --}}

            @forelse($featuredProjects as $project)

                @php
                    $homeProjectTitle = $homeIsEnglish && !empty($project->title_en)
                        ? $project->title_en
                        : $project->title;

                    $homeProjectDescription = $homeIsEnglish && !empty($project->description_en)
                        ? $project->description_en
                        : $project->description;
                @endphp

                <div
                    class="project-reveal"
                    style="
                        transition-delay:
                        {{ min($loop->index * 90, 180) }}ms;
                    "
                >

                    <article
                        class="
                            project-parallax
                            group
                            relative
                            aspect-[4/4.6]
                            overflow-hidden
                            rounded-[14px]
                            bg-[#111]
                            shadow-[0_12px_35px_rgba(0,0,0,0.05)]
                            transition-[box-shadow]
                            duration-500
                            ease-[cubic-bezier(.22,1,.36,1)]
                            hover:shadow-[0_28px_70px_rgba(0,0,0,0.16)]
                        "
                        data-project-parallax
                        data-parallax-strength="{{ 5 + ($loop->index * 2) }}"
                    >

                        <a
                            href="{{ $homeIsEnglish
                                ? route('en.projects.show', ['locale' => 'en', 'id' => $project->id])
                                : route('projects.show', $project->id)
                            }}"
                            class="
                                block
                                h-full
                                w-full
                            "
                            aria-label="{{ $homeProjectTitle }}"
                        >

                            {{-- IMAGE --}}
                            @if($project->image)

                                <img
                                    src="{{ asset('storage/' . $project->image) }}"
                                    alt="{{ $homeProjectTitle }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="
                                        absolute
                                        inset-0
                                        h-full
                                        w-full
                                        object-cover
                                        transition-transform
                                        duration-[900ms]
                                        ease-[cubic-bezier(.22,1,.36,1)]
                                        group-hover:scale-[1.05]
                                    "
                                >

                            @else

                                <div
                                    class="
                                        absolute
                                        inset-0
                                        bg-gradient-to-br
                                        from-[#191919]
                                        via-[#262626]
                                        to-[#090909]
                                    "
                                ></div>

                            @endif

                            {{-- HOVER DARKEN --}}
                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    inset-0
                                    bg-black/0
                                    transition-colors
                                    duration-500
                                    group-hover:bg-black/[0.07]
                                "
                            ></div>

                            {{-- SOFT BOTTOM GRADIENT --}}
                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    inset-x-0
                                    bottom-0
                                    h-[62%]
                                    bg-[linear-gradient(to_top,rgba(0,0,0,0.92)_0%,rgba(0,0,0,0.64)_20%,rgba(0,0,0,0.35)_43%,rgba(0,0,0,0.13)_65%,rgba(0,0,0,0.03)_82%,transparent_100%)]
                                "
                            ></div>

                            {{-- SOFT DEPTH --}}
                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    -bottom-10
                                    left-1/2
                                    h-28
                                    w-[90%]
                                    -translate-x-1/2
                                    rounded-[50%]
                                    bg-black/50
                                    blur-3xl
                                "
                            ></div>

                            {{-- CONTENT --}}
                            <div
                                class="
                                    absolute
                                    inset-x-0
                                    bottom-0
                                    flex
                                    items-end
                                    justify-between
                                    gap-4
                                    p-5
                                    transition-transform
                                    duration-500
                                    ease-[cubic-bezier(.22,1,.36,1)]
                                    group-hover:-translate-y-[3px]
                                    xl:p-6
                                "
                            >

                                <div class="min-w-0">

                                    <h3
                                        class="
                                            truncate
                                            text-[15px]
                                            font-medium
                                            tracking-[-0.015em]
                                            text-white
                                            drop-shadow-[0_2px_10px_rgba(0,0,0,.4)]
                                            xl:text-lg
                                        "
                                    >
                                        {{ $homeProjectTitle }}
                                    </h3>

                                    <p
                                        class="
                                            mt-1
                                            truncate
                                            text-[10px]
                                            font-medium
                                            text-white/60
                                            transition
                                            duration-300
                                            group-hover:text-white/80
                                            xl:text-[11px]
                                        "
                                    >

                                        @if(
                                            !empty($project->technologies)
                                            &&
                                            is_array($project->technologies)
                                            &&
                                            count($project->technologies)
                                        )

                                            {{ $project->technologies[0] }}

                                        @else

                                            {{ __('home.projects.fallback_category') }}

                                        @endif

                                    </p>

                                </div>

                                {{-- ================================================= --}}
                                {{-- SADE PREMIUM ARROW --}}
                                {{-- ================================================= --}}

                                <span
                                    class="
                                        mb-[1px]
                                        flex
                                        shrink-0
                                        items-center
                                        justify-center
                                        text-white
                                        drop-shadow-[0_2px_8px_rgba(0,0,0,0.28)]
                                        transition-all
                                        duration-400
                                        ease-[cubic-bezier(.22,1,.36,1)]
                                        group-hover:-translate-y-[3px]
                                        group-hover:translate-x-[3px]
                                        group-hover:scale-105
                                    "
                                    aria-hidden="true"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.65"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="
                                            h-6
                                            w-6
                                            xl:h-7
                                            xl:w-7
                                        "
                                    >
                                        <path d="M7 17L17 7" />
                                        <path d="M9 7H17V15" />
                                    </svg>

                                </span>

                            </div>

                        </a>

                    </article>

                </div>

            @empty

                <div
                    class="
                        project-reveal
                        flex
                        aspect-[4/4.6]
                        items-center
                        justify-center
                        rounded-[14px]
                        border
                        border-black/5
                        bg-white
                        text-sm
                        text-black/40
                    "
                >
                    {{ __('home.projects.empty') }}
                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- ========================================================= --}}
{{-- FEATURED BANNER --}}
{{-- ========================================================= --}}

<section
    class="
        order-3
        relative
        bg-[#f3f4f5]
        pb-20
        lg:pb-24
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

        <a
            href="{{ $homeProjectsUrl }}"
            class="
                group
                relative
                block
                overflow-hidden
                rounded-[24px]
                border
                border-black/[0.05]
                bg-[#111]
                transition-transform
                duration-300
                hover:-translate-y-0.5
            "
        >

            {{-- GÖRSEL --}}
            <img
                src="{{ asset('anasayfa/portbanner2.png') }}"
                alt="{{ $homeIsEnglish ? 'Muhammed Çiçek Portfolio Project' : 'Muhammed Çiçek Portfolyo Projesi' }}"
                loading="lazy"
                decoding="async"
                class="
                    absolute
                    inset-0
                    h-full
                    w-full
                    object-cover
                    object-center
                "
            >

            {{-- TEK OVERLAY --}}
            <div
                class="
                    pointer-events-none
                    absolute
                    inset-0
                    bg-gradient-to-r
                    from-black/82
                    via-black/45
                    to-black/10
                "
            ></div>

            {{-- CONTENT --}}
            <div
                class="
                    relative
                    z-10
                    flex
                    min-h-[320px]
                    items-center
                    px-8
                    py-10

                    sm:min-h-[350px]

                    md:px-12

                    lg:min-h-[390px]
                    lg:px-16
                "
            >

                <div
                    class="
                        max-w-[540px]
                        text-white
                    "
                >

                    {{-- EYEBROW --}}
                    <div
                        class="
                            flex
                            items-center
                            gap-3
                        "
                    >

                        <span
                            class="
                                h-[5px]
                                w-[5px]
                                rounded-full
                                bg-white
                            "
                        ></span>

                        <span
                            class="
                                text-[9px]
                                font-medium
                                uppercase
                                tracking-[0.26em]
                                text-white/50
                            "
                        >
                            {{ $homeIsEnglish ? 'Selected Project' : 'Seçili Proje' }}
                        </span>

                    </div>

                    {{-- TITLE --}}
                    <h2
                        class="
                            mt-7
                            text-[38px]
                            font-medium
                            leading-[1.04]
                            tracking-[-0.04em]

                            sm:text-[46px]

                            lg:text-[54px]
                        "
                    >
                        Muhammed Çiçek

                        <span class="text-white/45">
                            Portfolio
                        </span>
                    </h2>

                    {{-- DESCRIPTION --}}
                    <p
                        class="
                            mt-5
                            max-w-[500px]
                            text-[13px]
                            leading-7
                            text-white/60

                            sm:text-[14px]
                        "
                    >
                        {{ $homeIsEnglish
                            ? 'A modern, performance-focused portfolio project bringing personal branding, web design and development together in a single digital experience.'
                            : 'Kişisel marka kimliği, web tasarım ve geliştirme süreçlerini tek bir dijital deneyimde buluşturan modern ve performans odaklı portfolyo projesi.'
                        }}
                    </p>

                    {{-- TAGS --}}
                    <div
                        class="
                            mt-7
                            flex
                            flex-wrap
                            gap-2
                        "
                    >

                        <span
                            class="
                                rounded-full
                                border
                                border-white/10
                                px-4
                                py-2
                                text-[9px]
                                uppercase
                                tracking-[0.14em]
                                text-white/55
                            "
                        >
                            Laravel
                        </span>

                        <span
                            class="
                                rounded-full
                                border
                                border-white/10
                                px-4
                                py-2
                                text-[9px]
                                uppercase
                                tracking-[0.14em]
                                text-white/55
                            "
                        >
                            Tailwind CSS
                        </span>

                        <span
                            class="
                                rounded-full
                                border
                                border-white/10
                                px-4
                                py-2
                                text-[9px]
                                uppercase
                                tracking-[0.14em]
                                text-white/55
                            "
                        >
                            UI / UX
                        </span>

                    </div>

                    {{-- CTA --}}
                    <div
                        class="
                            mt-8
                            inline-flex
                            items-center
                            gap-3
                            text-[10px]
                            font-medium
                            uppercase
                            tracking-[0.16em]
                            text-white
                        "
                    >

                        <span>
                            {{ $homeIsEnglish ? 'View Project' : 'Projeyi İncele' }}
                        </span>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="
                                h-4
                                w-4
                                transition-transform
                                duration-300
                                group-hover:translate-x-1
                            "
                        >
                            <path d="M5 12h14" />
                            <path d="M14 7l5 5-5 5" />
                        </svg>

                    </div>

                </div>

            </div>

        </a>

    </div>

</section>

{{-- ========================================================= --}}
{{-- TECHNOLOGIES --}}
{{-- ========================================================= --}}

<section
    id="technologiesSection"
    class="
        order-4
        relative
        overflow-hidden
        bg-[#f3f4f5]
        pb-20
        lg:pb-28
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
                grid
                grid-cols-1
                items-center
                gap-12
                lg:grid-cols-[0.92fr_1.08fr]
                lg:gap-16
                xl:gap-20
            "
        >

            {{-- ================================================= --}}
            {{-- LEFT / CONTENT --}}
            {{-- ================================================= --}}

            <div class="project-reveal">

                <div
                    class="
                        flex
                        items-center
                        gap-3
                    "
                >
                    <span
                        class="
                            h-px
                            w-8
                            bg-black/20
                        "
                    ></span>

                    <span
                        class="
                            text-[9px]
                            font-medium
                            uppercase
                            tracking-[0.24em]
                            text-black/45
                        "
                    >
                        {{ __('home.technologies.eyebrow') }}
                    </span>

                    <span
                        class="
                            h-[5px]
                            w-[5px]
                            rounded-full
                            bg-black/70
                        "
                    ></span>
                </div>

                <h2
                    class="
                        mt-7
                        max-w-[610px]
                        text-[38px]
                        font-medium
                        leading-[1.08]
                        tracking-[-0.035em]
                        text-[#111]
                        sm:text-[46px]
                        lg:text-[52px]
                    "
                >
                    {{ __('home.technologies.title_before') }}
                    <span class="text-black/38">
                        {{ __('home.technologies.title_emphasis') }}
                    </span>
                </h2>

                <p
                    class="
                        mt-5
                        max-w-[560px]
                        text-[13px]
                        leading-6
                        text-black/45
                        sm:text-[14px]
                    "
                >
                    {{ __('home.technologies.description') }}
                </p>

                {{-- ================================================= --}}
                {{-- LOGO GRID --}}
                {{-- ================================================= --}}

                <div
                    class="
                        mt-10
                        grid
                        grid-cols-2
                        sm:grid-cols-4
                    "
                >

                    @php
                        $technologies = [
                            ['name' => 'Laravel', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg'],
                            ['name' => 'PHP', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg'],
                            ['name' => 'JavaScript', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg'],
                            ['name' => 'React', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg'],
                            ['name' => 'Vue.js', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg'],
                            ['name' => 'Tailwind CSS', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg'],
                            ['name' => 'MySQL', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg'],
                            ['name' => 'Git', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg'],
                        ];
                    @endphp

                    @foreach($technologies as $index => $technology)
                        <div
                            class="
                                group/tech
                                flex
                                min-h-[112px]
                                items-center
                                justify-center
                                border-black/[0.06]
                                px-5
                                py-6
                                transition-all
                                duration-300
                                hover:bg-white/60

                                {{ $index < 4 ? 'border-b' : '' }}
                                {{ !in_array($index, [3, 7]) ? 'border-r' : '' }}
                            "
                        >
                            <img
                                src="{{ $technology['icon'] }}"
                                alt="{{ $technology['name'] }}"
                                width="48"
                                height="48"
                                loading="lazy"
                                decoding="async"
                                class="
                                    h-12
                                    w-12
                                    object-contain
                                    grayscale
                                    opacity-55
                                    transition-all
                                    duration-300
                                    ease-[cubic-bezier(.22,1,.36,1)]
                                    group-hover/tech:-translate-y-1
                                    group-hover/tech:scale-110
                                    group-hover/tech:grayscale-0
                                    group-hover/tech:opacity-100
                                "
                            >
                        </div>
                    @endforeach

                </div>

            </div>

            {{-- ================================================= --}}
            {{-- RIGHT / PREMIUM CODE LAB VISUAL --}}
            {{-- ================================================= --}}

            <div
                class="
                    project-reveal
                    group/techvisual
                    relative
                    min-h-[500px]
                    overflow-visible
                    lg:min-h-[575px]
                "
            >

                {{-- AMBIENT LIGHT --}}
                <div
                    class="
                        pointer-events-none
                        absolute
                        left-[52%]
                        top-[52%]
                        h-[360px]
                        w-[520px]
                        -translate-x-1/2
                        -translate-y-1/2
                        rounded-[50%]
                        bg-white/90
                        blur-[70px]
                    "
                ></div>

                {{-- ORBIT / GUIDE LINES --}}
                <svg
                    class="
                        pointer-events-none
                        absolute
                        inset-0
                        h-full
                        w-full
                        opacity-70
                    "
                    viewBox="0 0 720 580"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <ellipse
                        cx="365"
                        cy="298"
                        rx="285"
                        ry="206"
                        stroke="rgba(0,0,0,.055)"
                        stroke-width="1"
                    />

                    <path
                        d="M88 408C175 345 255 320 355 320C470 320 564 355 645 420"
                        stroke="rgba(0,0,0,.045)"
                        stroke-width="1"
                    />

                    <circle
                        cx="615"
                        cy="160"
                        r="4.5"
                        fill="rgba(0,0,0,.25)"
                    />
                </svg>

                {{-- FLOOR SHADOW --}}
                <div
                    class="
                        pointer-events-none
                        absolute
                        bottom-[4%]
                        left-[52%]
                        h-[68px]
                        w-[72%]
                        -translate-x-1/2
                        rounded-[50%]
                        bg-black/[0.11]
                        blur-[34px]
                    "
                ></div>

                {{-- MAIN LAPTOP --}}
                <div
                    class="
                        absolute
                        bottom-[9%]
                        left-[13%]
                        z-20
                        w-[76%]
                        transition-all
                        duration-700
                        ease-[cubic-bezier(.22,1,.36,1)]
                        group-hover/techvisual:translate-x-2
                        group-hover/techvisual:-translate-y-2
                        group-hover/techvisual:rotate-[.45deg]
                        group-hover/techvisual:scale-[1.012]
                    "
                >

                    <div
                        class="
                            relative
                            aspect-[16/10]
                            overflow-hidden
                            rounded-t-[24px]
                            rounded-b-[10px]
                            border-[5px]
                            border-[#101010]
                            bg-[#0a0a0a]
                            shadow-[0_34px_90px_rgba(0,0,0,.24)]
                        "
                    >

                        {{-- WINDOW BAR --}}
                        <div
                            class="
                                absolute
                                inset-x-0
                                top-0
                                z-20
                                flex
                                h-9
                                items-center
                                justify-between
                                border-b
                                border-white/[0.055]
                                bg-[#111]
                                px-4
                            "
                        >
                            <div class="flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-white/30"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-white/18"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-white/10"></span>
                            </div>

                            <span
                                class="
                                    text-[6px]
                                    font-medium
                                    uppercase
                                    tracking-[0.14em]
                                    text-white/28
                                "
                            >
                                portfolio / welcome.blade.php
                            </span>

                            <span
                                class="
                                    h-1.5
                                    w-1.5
                                    rounded-full
                                    bg-white/35
                                "
                            ></span>
                        </div>

                        {{-- IDE BODY --}}
                        <div
                            class="
                                absolute
                                inset-x-0
                                bottom-0
                                top-9
                                grid
                                grid-cols-[54px_1fr_155px]
                            "
                        >

                            {{-- SIDEBAR --}}
                            <div
                                class="
                                    border-r
                                    border-white/[0.05]
                                    bg-[#0d0d0d]
                                    px-2
                                    py-3
                                "
                            >
                                <div class="space-y-3">
                                    <span class="block h-5 rounded-md bg-white/[0.06]"></span>
                                    <span class="block h-5 rounded-md bg-white/[0.025]"></span>
                                    <span class="block h-5 rounded-md bg-white/[0.025]"></span>
                                    <span class="block h-5 rounded-md bg-white/[0.025]"></span>
                                </div>
                            </div>

                            {{-- CODE EDITOR --}}
                            <div
                                class="
                                    relative
                                    overflow-hidden
                                    bg-[#0b0b0b]
                                    px-5
                                    py-4
                                "
                            >

                                <div
                                    class="
                                        mb-4
                                        flex
                                        items-center
                                        gap-3
                                        border-b
                                        border-white/[0.045]
                                        pb-3
                                    "
                                >
                                    <span
                                        class="
                                            text-[7px]
                                            font-medium
                                            text-white/60
                                        "
                                    >
                                        welcome.blade.php
                                    </span>

                                    <span
                                        class="
                                            rounded-full
                                            bg-white/[0.06]
                                            px-2
                                            py-1
                                            text-[5px]
                                            text-white/30
                                        "
                                    >
                                        Laravel
                                    </span>
                                </div>

                                <div
                                    class="
                                        grid
                                        grid-cols-[18px_1fr]
                                        gap-3
                                        font-mono
                                        text-[7px]
                                        leading-[1.85]
                                    "
                                >

                                    <div class="select-none text-right text-white/16">
                                        01<br>
                                        02<br>
                                        03<br>
                                        04<br>
                                        05<br>
                                        06<br>
                                        07<br>
                                        08<br>
                                        09<br>
                                        10<br>
                                        11<br>
                                        12
                                    </div>

                                    <div class="whitespace-nowrap text-white/68">

                                        <div>
                                            <span class="text-white/28">&lt;</span><span class="text-white">section</span>
                                            <span class="text-white/35"> class=</span><span class="text-white/75">"portfolio"</span><span class="text-white/28">&gt;</span>
                                        </div>

                                        <div class="pl-3">
                                            <span class="text-white/28">&#123;&#123;</span>
                                            <span class="text-white"> $project->title </span>
                                            <span class="text-white/28">&#125;&#125;</span>
                                        </div>

                                        <div class="pl-3">
                                            <span class="text-white/28">&#64;foreach</span><span class="text-white/50">(</span><span class="text-white">$technologies</span>
                                            <span class="text-white/40"> as </span><span class="text-white">$tech</span><span class="text-white/50">)</span>
                                        </div>

                                        <div class="pl-6">
                                            <span class="text-white/30">&lt;div</span>
                                            <span class="text-white/45"> class=</span><span class="text-white/75">"stack-item"</span><span class="text-white/30">&gt;</span>
                                        </div>

                                        <div class="pl-9">
                                            <span class="text-white/28">&#123;&#123;</span>
                                            <span class="text-white">$tech['name']</span>
                                            <span class="text-white/28">&#125;&#125;</span>
                                        </div>

                                        <div class="pl-6">
                                            <span class="text-white/30">&lt;/div&gt;</span>
                                        </div>

                                        <div class="pl-3">
                                            <span class="text-white/28">&#64;endforeach</span>
                                        </div>

                                        <div class="mt-2 pl-3 text-white/42">
                                            // design → build → launch
                                        </div>

                                        <div class="pl-3">
                                            <span class="text-white/28">const</span>
                                            <span class="text-white"> performance </span>
                                            <span class="text-white/42">=</span>
                                            <span class="text-white/75"> 'optimized'</span>;
                                        </div>

                                        <div class="pl-3">
                                            <span class="text-white/28">const</span>
                                            <span class="text-white"> experience </span>
                                            <span class="text-white/42">=</span>
                                            <span class="text-white/75"> 'premium'</span>;
                                        </div>

                                        <div>
                                            <span class="text-white/28">&lt;/</span><span class="text-white">section</span><span class="text-white/28">&gt;</span>
                                        </div>

                                    </div>
                                </div>

                                <div
                                    class="
                                        pointer-events-none
                                        absolute
                                        bottom-[22%]
                                        left-[47%]
                                        h-24
                                        w-24
                                        rounded-full
                                        bg-white/[0.035]
                                        blur-[30px]
                                    "
                                ></div>

                            </div>

                            {{-- RIGHT DEV PANEL --}}
                            <div
                                class="
                                    border-l
                                    border-white/[0.05]
                                    bg-[#101010]
                                    p-4
                                "
                            >

                                <p
                                    class="
                                        text-[6px]
                                        font-medium
                                        uppercase
                                        tracking-[0.16em]
                                        text-white/28
                                    "
                                >
                                    Build Status
                                </p>

                                <div
                                    class="
                                        mt-4
                                        rounded-[12px]
                                        border
                                        border-white/[0.06]
                                        bg-white/[0.03]
                                        p-3
                                    "
                                >
                                    <div class="flex items-center justify-between">
                                        <span class="text-[6px] text-white/40">
                                            Production
                                        </span>

                                        <span
                                            class="
                                                h-1.5
                                                w-1.5
                                                rounded-full
                                                bg-white/70
                                            "
                                        ></span>
                                    </div>

                                    <p
                                        class="
                                            mt-2
                                            text-[10px]
                                            font-medium
                                            text-white
                                        "
                                    >
                                        Ready
                                    </p>
                                </div>

                                <div class="mt-5">
                                    <div class="flex items-center justify-between text-[5px] text-white/28">
                                        <span>Performance</span>
                                        <span>98</span>
                                    </div>

                                    <div
                                        class="
                                            mt-2
                                            h-1
                                            overflow-hidden
                                            rounded-full
                                            bg-white/[0.06]
                                        "
                                    >
                                        <div
                                            class="
                                                h-full
                                                w-[92%]
                                                rounded-full
                                                bg-white/70
                                            "
                                        ></div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <div class="flex items-center justify-between text-[5px] text-white/28">
                                        <span>Accessibility</span>
                                        <span>100</span>
                                    </div>

                                    <div
                                        class="
                                            mt-2
                                            h-1
                                            overflow-hidden
                                            rounded-full
                                            bg-white/[0.06]
                                        "
                                    >
                                        <div
                                            class="
                                                h-full
                                                w-full
                                                rounded-full
                                                bg-white/55
                                            "
                                        ></div>
                                    </div>
                                </div>

                                <div
                                    class="
                                        mt-6
                                        rounded-[12px]
                                        bg-white
                                        px-3
                                        py-2.5
                                        text-black
                                    "
                                >
                                    <p
                                        class="
                                            text-[5px]
                                            uppercase
                                            tracking-[0.13em]
                                            text-black/40
                                        "
                                    >
                                        Deployment
                                    </p>

                                    <p
                                        class="
                                            mt-1
                                            text-[8px]
                                            font-medium
                                        "
                                    >
                                        Successful ✓
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div
                        class="
                            mx-auto
                            h-[5px]
                            w-[95%]
                            bg-[#111]
                        "
                    ></div>

                    <div
                        class="
                            relative
                            mx-auto
                            h-[20px]
                            w-[109%]
                            rounded-b-[24px]
                            bg-gradient-to-b
                            from-[#ededed]
                            via-[#cfcfcf]
                            to-[#9f9f9f]
                            shadow-[0_15px_26px_rgba(0,0,0,.14)]
                        "
                    >
                        <div
                            class="
                                absolute
                                left-1/2
                                top-0
                                h-[5px]
                                w-[17%]
                                -translate-x-1/2
                                rounded-b-full
                                bg-black/[0.13]
                            "
                        ></div>
                    </div>

                </div>

                {{-- FLOATING TERMINAL --}}
                <div
                    class="
                        absolute
                        left-[2%]
                        top-[10%]
                        z-40
                        w-[34%]
                        -rotate-[5deg]
                        rounded-[22px]
                        border
                        border-white/[0.08]
                        bg-[#111]
                        p-4
                        shadow-[0_25px_65px_rgba(0,0,0,.22)]
                        transition-all
                        duration-700
                        ease-[cubic-bezier(.22,1,.36,1)]
                        group-hover/techvisual:-translate-x-2
                        group-hover/techvisual:-translate-y-3
                        group-hover/techvisual:-rotate-[7deg]
                    "
                >

                    <div class="mb-4 flex items-center gap-1.5">
                        <span class="h-1.5 w-1.5 rounded-full bg-white/30"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-white/18"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-white/10"></span>
                    </div>

                    <div
                        class="
                            font-mono
                            text-[7px]
                            leading-[1.8]
                            text-white/65
                        "
                    >
                        <span class="text-white/28">$</span> php artisan optimize
                        <br>
                        <span class="text-white/28">→</span> routes cached
                        <br>
                        <span class="text-white/28">→</span> views compiled
                        <br>
                        <span class="text-white/28">✓</span> production ready
                    </div>

                </div>

                {{-- DATABASE CARD --}}
                <div
                    class="
                        absolute
                        right-[2%]
                        top-[13%]
                        z-40
                        w-[29%]
                        rotate-[3deg]
                        rounded-[20px]
                        border
                        border-black/[0.055]
                        bg-white/95
                        p-4
                        shadow-[0_20px_50px_rgba(0,0,0,.10)]
                        backdrop-blur-md
                        transition-all
                        duration-700
                        ease-[cubic-bezier(.22,1,.36,1)]
                        group-hover/techvisual:translate-x-2
                        group-hover/techvisual:-translate-y-2
                        group-hover/techvisual:rotate-[5deg]
                    "
                >

                    <div class="flex items-center justify-between">
                        <div>
                            <p
                                class="
                                    text-[6px]
                                    font-medium
                                    uppercase
                                    tracking-[0.15em]
                                    text-black/32
                                "
                            >
                                Database
                            </p>

                            <p
                                class="
                                    mt-1
                                    text-[11px]
                                    font-medium
                                    text-black/75
                                "
                            >
                                MySQL
                            </p>
                        </div>

                        <div
                            class="
                                flex
                                h-9
                                w-9
                                items-center
                                justify-center
                                rounded-full
                                border
                                border-black/[0.06]
                                bg-black/[0.025]
                            "
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                class="h-4 w-4 text-black/55"
                                stroke="currentColor"
                                stroke-width="1.5"
                            >
                                <ellipse cx="12" cy="5" rx="7" ry="3"/>
                                <path d="M5 5v6c0 1.7 3.1 3 7 3s7-1.3 7-3V5"/>
                                <path d="M5 11v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"/>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between text-[6px] text-black/32">
                            <span>projects</span>
                            <span>128</span>
                        </div>

                        <div class="flex items-center justify-between text-[6px] text-black/32">
                            <span>users</span>
                            <span>42</span>
                        </div>

                        <div class="flex items-center justify-between text-[6px] text-black/32">
                            <span>settings</span>
                            <span>16</span>
                        </div>
                    </div>

                </div>

                {{-- STACK BADGES --}}
                <div
                    class="
                        absolute
                        bottom-[4%]
                        left-[5%]
                        z-40
                        flex
                        items-center
                        gap-2
                        transition-all
                        duration-700
                        group-hover/techvisual:-translate-x-1
                        group-hover/techvisual:-translate-y-1
                    "
                >

                    <span
                        class="
                            rounded-full
                            border
                            border-black/[0.055]
                            bg-white
                            px-3
                            py-2
                            text-[6px]
                            font-medium
                            text-black/55
                            shadow-[0_12px_30px_rgba(0,0,0,.06)]
                        "
                    >
                        Laravel
                    </span>

                    <span
                        class="
                            rounded-full
                            border
                            border-black/[0.055]
                            bg-white
                            px-3
                            py-2
                            text-[6px]
                            font-medium
                            text-black/55
                            shadow-[0_12px_30px_rgba(0,0,0,.06)]
                        "
                    >
                        Tailwind
                    </span>

                    <span
                        class="
                            rounded-full
                            border
                            border-black/[0.055]
                            bg-white
                            px-3
                            py-2
                            text-[6px]
                            font-medium
                            text-black/55
                            shadow-[0_12px_30px_rgba(0,0,0,.06)]
                        "
                    >
                        React
                    </span>

                </div>

                {{-- SMALL STATUS --}}
                <div
                    class="
                        absolute
                        bottom-[6%]
                        right-[5%]
                        z-40
                        hidden
                        rounded-[18px]
                        border
                        border-black/[0.05]
                        bg-white/95
                        px-4
                        py-3
                        shadow-[0_18px_45px_rgba(0,0,0,.08)]
                        backdrop-blur-md
                        transition-all
                        duration-700
                        group-hover/techvisual:translate-x-1
                        group-hover/techvisual:-translate-y-2
                        sm:block
                    "
                >
                    <div class="flex items-center gap-2">
                        <span
                            class="
                                h-2
                                w-2
                                rounded-full
                                bg-black/65
                            "
                        ></span>

                        <span
                            class="
                                text-[6px]
                                font-medium
                                uppercase
                                tracking-[0.14em]
                                text-black/35
                            "
                        >
                            Development
                        </span>
                    </div>

                    <p
                        class="
                            mt-1
                            text-[10px]
                            font-medium
                            text-black/70
                        "
                    >
                        Stack Online
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

{{-- ========================================================= --}}
{{-- SERVICES --}}
{{-- ========================================================= --}}

<section
    id="servicesSection"
    class="
        order-2
        relative
        overflow-hidden
        bg-[#f3f4f5]
        pt-10
        pb-20
        lg:pt-12
        lg:pb-24
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
                grid
                grid-cols-1
                items-center
                gap-12
                lg:grid-cols-[1.02fr_.98fr]
                lg:gap-14
            "
        >

            {{-- ================================================= --}}
            {{-- LEFT --}}
            {{-- ================================================= --}}

            <div class="project-reveal">

                <div class="flex items-center gap-3">

                    <span
                        class="
                            h-8
                            w-[4px]
                            rounded-full
                            bg-black
                        "
                    ></span>

                    <h2
                        class="
                            text-[40px]
                            font-medium
                            leading-none
                            tracking-[-0.04em]
                            text-[#111]
                            sm:text-[48px]
                            lg:text-[54px]
                        "
                    >
                        {{ __('home.services.title') }}
                    </h2>

                    <span
                        class="
                            mt-4
                            h-[7px]
                            w-[7px]
                            rounded-full
                            bg-black/80
                        "
                    ></span>

                </div>

                <p
                    class="
                        mt-5
                        max-w-[520px]
                        pl-5
                        text-[13px]
                        leading-6
                        text-black/45
                        sm:text-[14px]
                    "
                >
                    {{ __('home.services.description') }}
                </p>

                {{-- ================================================= --}}
                {{-- PREMIUM SERVICE VISUAL --}}
                {{-- ================================================= --}}

                <div
                    class="
                        group/services-visual
                        relative
                        mt-9
                        min-h-[470px]
                        overflow-visible
                        lg:min-h-[520px]
                    "
                >

                    {{-- ambient halo --}}
                    <div
                        class="
                            pointer-events-none
                            absolute
                            left-[48%]
                            top-[54%]
                            h-[330px]
                            w-[500px]
                            -translate-x-1/2
                            -translate-y-1/2
                            rounded-[50%]
                            bg-white/85
                            blur-[72px]
                        "
                    ></div>

                    {{-- orbit --}}
                    <svg
                        class="
                            pointer-events-none
                            absolute
                            inset-0
                            h-full
                            w-full
                            opacity-70
                        "
                        viewBox="0 0 680 520"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <ellipse
                            cx="320"
                            cy="272"
                            rx="248"
                            ry="184"
                            stroke="rgba(0,0,0,0.055)"
                            stroke-width="1"
                        />

                        <path
                            d="M60 420C160 320 255 285 355 286C465 287 555 330 630 402"
                            stroke="rgba(0,0,0,0.045)"
                            stroke-width="1"
                        />

                        <circle
                            cx="605"
                            cy="170"
                            r="4"
                            fill="rgba(0,0,0,0.24)"
                        />
                    </svg>

                    {{-- floor shadow --}}
                    <div
                        class="
                            pointer-events-none
                            absolute
                            bottom-[4%]
                            left-[47%]
                            h-[62px]
                            w-[70%]
                            -translate-x-1/2
                            rounded-[50%]
                            bg-black/[0.11]
                            blur-[30px]
                        "
                    ></div>

                    {{-- MAIN LAPTOP --}}
                    <div
                        class="
                            absolute
                            bottom-[9%]
                            left-[18%]
                            z-20
                            w-[70%]
                            transition-all
                            duration-700
                            ease-[cubic-bezier(.22,1,.36,1)]
                            group-hover/services-visual:translate-x-2
                            group-hover/services-visual:-translate-y-2
                            group-hover/services-visual:rotate-[.4deg]
                            group-hover/services-visual:scale-[1.015]
                        "
                    >

                        <div
                            class="
                                relative
                                aspect-[16/10]
                                overflow-hidden
                                rounded-t-[24px]
                                rounded-b-[10px]
                                border-[5px]
                                border-[#111]
                                bg-[#0b0b0b]
                                shadow-[0_34px_88px_rgba(0,0,0,0.22)]
                            "
                        >
                            <img
                                src="{{ asset('anasayfa/portbanner2.png') }}"
                                alt=""
                                loading="lazy"
                                decoding="async"
                                class="
                                    absolute
                                    inset-0
                                    h-full
                                    w-full
                                    object-cover
                                    grayscale
                                    contrast-125
                                    brightness-110
                                "
                            >

                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    inset-0
                                    bg-gradient-to-tr
                                    from-black/20
                                    via-transparent
                                    to-white/[0.12]
                                "
                            ></div>

                            <div
                                class="
                                    absolute
                                    left-5
                                    top-5
                                    text-[8px]
                                    font-medium
                                    uppercase
                                    tracking-[0.14em]
                                    text-white/75
                                "
                            >
                                Portfolio.
                            </div>

                            <div
                                class="
                                    absolute
                                    bottom-5
                                    left-5
                                    rounded-full
                                    border
                                    border-white/15
                                    bg-black/35
                                    px-3
                                    py-1.5
                                    text-[7px]
                                    text-white/70
                                    backdrop-blur-md
                                "
                            >
                                {{ __('home.services.visual_tag') }}
                            </div>
                        </div>

                        <div
                            class="
                                mx-auto
                                h-[5px]
                                w-[94%]
                                bg-[#111]
                            "
                        ></div>

                        <div
                            class="
                                relative
                                mx-auto
                                h-[18px]
                                w-[108%]
                                rounded-b-[22px]
                                bg-gradient-to-b
                                from-[#f0f0f0]
                                via-[#d6d6d6]
                                to-[#a3a3a3]
                                shadow-[0_14px_24px_rgba(0,0,0,0.12)]
                            "
                        >
                            <span
                                class="
                                    absolute
                                    left-1/2
                                    top-0
                                    h-[5px]
                                    w-[18%]
                                    -translate-x-1/2
                                    rounded-b-full
                                    bg-black/[0.12]
                                "
                            ></span>
                        </div>

                    </div>

                    {{-- PHONE --}}
                    <div
                        class="
                            absolute
                            bottom-[10%]
                            left-[2%]
                            z-30
                            w-[20%]
                            -rotate-[5deg]
                            transition-all
                            duration-700
                            ease-[cubic-bezier(.22,1,.36,1)]
                            group-hover/services-visual:-translate-x-2
                            group-hover/services-visual:-translate-y-3
                            group-hover/services-visual:-rotate-[7deg]
                            group-hover/services-visual:scale-[1.02]
                        "
                    >
                        <div
                            class="
                                relative
                                aspect-[9/19]
                                overflow-hidden
                                rounded-[29px]
                                border-[6px]
                                border-[#111]
                                bg-black
                                shadow-[0_28px_65px_rgba(0,0,0,0.22)]
                            "
                        >
                            <img
                                src="{{ asset('anasayfa/portbanner2.png') }}"
                                alt=""
                                loading="lazy"
                                decoding="async"
                                class="
                                    absolute
                                    inset-0
                                    h-full
                                    w-full
                                    object-cover
                                    grayscale
                                    contrast-125
                                    brightness-110
                                "
                            >

                            <div
                                class="
                                    absolute
                                    left-1/2
                                    top-2
                                    h-[5px]
                                    w-[30%]
                                    -translate-x-1/2
                                    rounded-full
                                    bg-black
                                "
                            ></div>

                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    inset-0
                                    bg-gradient-to-tr
                                    from-black/18
                                    via-transparent
                                    to-white/[0.10]
                                "
                            ></div>
                        </div>
                    </div>

                    {{-- TOP LEFT CARD --}}
                    <div
                        class="
                            absolute
                            left-[1%]
                            top-[12%]
                            z-40
                            w-[34%]
                            rounded-[20px]
                            border
                            border-black/[0.05]
                            bg-white/94
                            p-4
                            shadow-[0_20px_50px_rgba(0,0,0,0.09)]
                            backdrop-blur-md
                            transition-all
                            duration-700
                            group-hover/services-visual:-translate-x-1
                            group-hover/services-visual:-translate-y-2
                        "
                    >
                        <div class="flex items-center gap-4">

                            <div
                                class="
                                    flex
                                    h-11
                                    w-11
                                    items-end
                                    gap-1
                                "
                            >
                                <span class="h-[40%] w-2 rounded-sm bg-black/30"></span>
                                <span class="h-[68%] w-2 rounded-sm bg-black/55"></span>
                                <span class="h-full w-2 rounded-sm bg-black"></span>
                            </div>

                            <div>
                                <p
                                    class="
                                        text-[10px]
                                        font-medium
                                        text-black/75
                                    "
                                >
                                    {{ __('home.services.visual_strategy') }}
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-[8px]
                                        text-black/40
                                    "
                                >
                                    {{ __('home.services.visual_design_dev') }}
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- TOP RIGHT CARD --}}
                    <div
                        class="
                            absolute
                            right-[1%]
                            top-[15%]
                            z-40
                            w-[29%]
                            rotate-[2deg]
                            rounded-[20px]
                            border
                            border-white/[0.10]
                            bg-[#111]
                            p-4
                            shadow-[0_24px_60px_rgba(0,0,0,0.20)]
                            transition-all
                            duration-700
                            group-hover/services-visual:translate-x-2
                            group-hover/services-visual:-translate-y-2
                            group-hover/services-visual:rotate-[4deg]
                        "
                    >
                        <div class="mb-3 flex gap-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-white/30"></span>
                            <span class="h-1.5 w-1.5 rounded-full bg-white/20"></span>
                            <span class="h-1.5 w-1.5 rounded-full bg-white/10"></span>
                        </div>

                        <div
                            class="
                                font-mono
                                text-[6px]
                                leading-[1.8]
                                text-white/70
                            "
                        >
                            idea → design
                            <br>
                            design → build
                            <br>
                            build → launch
                        </div>
                    </div>

                    {{-- SPHERE --}}
                    <div
                        class="
                            absolute
                            bottom-[3%]
                            right-[8%]
                            z-40
                            h-[60px]
                            w-[60px]
                            rounded-full
                            bg-gradient-to-br
                            from-[#515151]
                            via-[#171717]
                            to-black
                            shadow-[0_18px_38px_rgba(0,0,0,0.22)]
                            transition-all
                            duration-700
                            group-hover/services-visual:translate-x-2
                            group-hover/services-visual:-translate-y-2
                        "
                    >
                        <span
                            class="
                                absolute
                                left-3
                                top-3
                                h-4
                                w-4
                                rounded-full
                                bg-white/30
                                blur-[2px]
                            "
                        ></span>
                    </div>

                </div>

            </div>

            {{-- ================================================= --}}
            {{-- RIGHT SERVICES --}}
            {{-- ================================================= --}}

                <div

                class="

                    project-reveal

                "

            >

                @php

                    try {

                        $homeServices = \App\Models\Service::query()

                            ->orderBy('order', 'asc')

                            ->take(5)

                            ->get();

                    } catch (\Throwable $e) {

                        $homeServices = collect();

                    }

                @endphp

                <div class="space-y-3">

                    @foreach($homeServices as $service)

                        @php

                            $homeServiceTitle = $homeIsEnglish && !empty($service->title_en)

                                ? $service->title_en

                                : $service->title;

                            $homeServiceDescription = $homeIsEnglish && !empty($service->description_en)

                                ? $service->description_en

                                : $service->description;

                            $serviceType = $service->icon ?: ($service->slug ?? 'web');

                        @endphp

                        <a

                            href="{{ $homeServicesUrl }}"

                            class="

                                group/service

                                flex

                                min-h-[104px]

                                items-center

                                gap-5

                                rounded-[22px]

                                border

                                border-black/[0.055]

                                border-l-[3px]

                                border-l-black

                                bg-white/70

                                px-5

                                py-4

                                shadow-[0_12px_34px_rgba(0,0,0,0.025)]

                                backdrop-blur-sm

                                transition-all

                                duration-300

                                ease-[cubic-bezier(.22,1,.36,1)]

                                hover:-translate-y-1

                                hover:border-black/[0.09]

                                hover:bg-white

                                hover:shadow-[0_20px_50px_rgba(0,0,0,0.06)]

                                sm:px-6

                            "

                        >

                            {{-- ICON --}}

                            <span

                                class="

                                    flex

                                    h-14

                                    w-14

                                    shrink-0

                                    items-center

                                    justify-center

                                    rounded-[16px]

                                    border

                                    border-black/[0.07]

                                    bg-white

                                    text-black/55

                                    transition-all

                                    duration-300

                                    group-hover/service:scale-105

                                    group-hover/service:text-black

                                "

                            >

                                @if($serviceType === 'web')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3.5" y="5" width="17" height="14" rx="2.5"/>
                                        <path d="M3.5 8.5h17"/>
                                    </svg>
                                @elseif($serviceType === 'mobile')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="7" y="2.5" width="10" height="19" rx="2.5"/>
                                        <path d="M10.5 5h3"/>
                                        <path d="M11.5 18.5h1"/>
                                    </svg>
                                @elseif($serviceType === 'dashboard')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19V10"/>
                                        <path d="M10 19V14"/>
                                        <path d="M16 19V6"/>
                                        <path d="M3 19h18"/>
                                        <path d="m5 10 5-4 4 3 5-5"/>
                                    </svg>
                                @elseif($serviceType === 'brand')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3 19 8v8l-7 5-7-5V8l7-5Z"/>
                                        <path d="m9 12 2 2 4-4"/>
                                    </svg>
                                @elseif($serviceType === 'seo')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="10.5" cy="10.5" r="5.5"/>
                                        <path d="m15 15 5 5"/>
                                        <path d="M7.5 11.5 9.5 9.5 11 11l2.8-3"/>
                                    </svg>
                                @elseif($serviceType === 'api')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 8 4 12l4 4"/>
                                        <path d="m16 8 4 4-4 4"/>
                                        <path d="m14 5-4 14"/>
                                    </svg>
                                @elseif($serviceType === 'ecommerce')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 5h2l2 10h10l2-7H6"/>
                                        <circle cx="9" cy="19" r="1.5"/>
                                        <circle cx="17" cy="19" r="1.5"/>
                                    </svg>
                                @elseif($serviceType === 'database')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <ellipse cx="12" cy="5" rx="7" ry="3"/>
                                        <path d="M5 5v6c0 1.7 3.1 3 7 3s7-1.3 7-3V5"/>
                                        <path d="M5 11v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"/>
                                    </svg>
                                @elseif($serviceType === 'server')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="4" y="4" width="16" height="6" rx="2"/>
                                        <rect x="4" y="14" width="16" height="6" rx="2"/>
                                        <path d="M8 7h.01M8 17h.01"/>
                                    </svg>
                                @elseif($serviceType === 'support')
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 13a8 8 0 0 1 16 0"/>
                                        <path d="M4 13v4a2 2 0 0 0 2 2h2v-6H4Z"/>
                                        <path d="M20 13v4a2 2 0 0 1-2 2h-2v-6h4Z"/>
                                    </svg>
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m12 3 4 4-4 4-4-4 4-4Z"/>
                                        <path d="M8 7 5 10l3 3"/>
                                        <path d="m16 7 3 3-3 3"/>
                                        <path d="m8 13 4 8 4-8"/>
                                    </svg>
                                @endif

                            </span>

                            {{-- TEXT --}}

                            <span

                                class="

                                    min-w-0

                                    flex-1

                                "

                            >

                                <span

                                    class="

                                        block

                                        text-[17px]

                                        font-medium

                                        tracking-[-0.02em]

                                        text-black

                                        sm:text-[18px]

                                    "

                                >

                                    {{ $homeServiceTitle }}

                                </span>

                                <span

                                    class="

                                        mt-1

                                        block

                                        max-w-[390px]

                                        text-[11px]

                                        leading-5

                                        text-black/42

                                        line-clamp-2

                                        sm:text-[12px]

                                    "

                                >

                                    {{ \Illuminate\Support\Str::limit(strip_tags($homeServiceDescription), 95) }}

                                </span>

                            </span>

                            {{-- ARROW --}}

                            <span

                                class="

                                    shrink-0

                                    text-black/35

                                    transition-all

                                    duration-300

                                    group-hover/service:translate-x-1

                                    group-hover/service:text-black

                                "

                            >

                                <svg

                                    viewBox="0 0 24 24"

                                    fill="none"

                                    class="h-5 w-5"

                                    stroke="currentColor"

                                    stroke-width="1.6"

                                    stroke-linecap="round"

                                    stroke-linejoin="round"

                                >

                                    <path d="M5 12h14"/>

                                    <path d="m14 7 5 5-5 5"/>

                                </svg>

                            </span>

                        </a>

                    @endforeach

                </div>

                {{-- ================================================= --}}
                {{-- ALL SERVICES --}}
                {{-- ================================================= --}}

                <div
                    class="
                        mt-6
                        flex
                        justify-end
                    "
                >

                    <a
                        href="{{ $homeServicesUrl }}"
                        class="
                            group/all-services
                            inline-flex
                            items-center
                            gap-4
                            rounded-full
                            border
                            border-black/[0.08]
                            bg-white/60
                            py-2.5
                            pl-5
                            pr-2.5
                            text-[9px]
                            font-medium
                            text-black/55
                            transition-all
                            duration-300
                            hover:border-black
                            hover:bg-[#111]
                            hover:text-white
                        "
                    >

                        <span>
                            {{ __('home.services.view_all') }}
                        </span>

                        <span
                            class="
                                flex
                                h-7
                                w-7
                                items-center
                                justify-center
                                rounded-full
                                bg-black/[0.05]
                                transition-all
                                duration-300
                                group-hover/all-services:bg-white/10
                            "
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                class="
                                    h-3.5
                                    w-3.5
                                    transition-transform
                                    duration-300
                                    group-hover/all-services:translate-x-0.5
                                "
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M5 12h14"/>
                                <path d="m14 7 5 5-5 5"/>
                            </svg>
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ========================================================= --}}
{{-- SOFTWARE MARQUEE --}}
{{-- ========================================================= --}}

<section
    id="softwareMarqueeSection"
    class="order-5 relative overflow-hidden bg-[#f3f4f5] py-14 sm:py-16 lg:py-20"
>
    <div class="pointer-events-none absolute inset-x-0 top-0 mx-auto h-px max-w-[1320px] bg-black/[0.05]"></div>

    <div class="pointer-events-none absolute left-1/2 top-1/2 h-[320px] w-[900px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/60 blur-[110px]"></div>

    <div class="relative">

        <div class="mx-auto mb-10 max-w-[1400px] px-6 lg:px-10">
            <div class="flex items-center gap-3">
                <span class="h-px w-8 bg-black/20"></span>

                <span class="text-[9px] font-medium uppercase tracking-[0.24em] text-black/40">
                    {{ __('home.software.eyebrow') }}
                </span>

                <span class="h-[5px] w-[5px] rounded-full bg-black/70"></span>
            </div>

            <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <h2 class="max-w-[640px] text-[30px] font-medium leading-[1.08] tracking-[-0.035em] text-[#111] sm:text-[38px] lg:text-[44px]">
                    {{ __('home.software.title_before') }}
                    <span class="text-black/38">{{ __('home.software.title_emphasis') }}</span>
                </h2>

                <p class="max-w-[400px] text-[12px] leading-6 text-black/38 sm:text-right">
                    {{ __('home.software.description') }}
                </p>
            </div>
        </div>

        <div class="pointer-events-none absolute inset-y-0 left-0 z-20 w-12 bg-gradient-to-r from-[#f3f4f5] to-transparent sm:w-24 lg:w-36"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 z-20 w-12 bg-gradient-to-l from-[#f3f4f5] to-transparent sm:w-24 lg:w-36"></div>

        @php
            $softwareRows = [
                [
                    ['Laravel','</>'],
                    ['PHP 8+','PHP'],
                    ['Blade','BL'],
                    ['JavaScript','JS'],
                    ['React','RC'],
                    ['Vue.js','VU'],
                    ['Tailwind CSS','TW'],
                    ['Alpine.js','AL'],
                    ['REST API','API'],
                    ['Responsive UI','UI'],
                ],
                [
                    ['MySQL','DB'],
                    ['Git','GT'],
                    ['GitHub','GH'],
                    ['Vite','VT'],
                    ['NPM','NP'],
                    ['Composer','CP'],
                    ['cPanel','CP'],
                    ['Plesk','PL'],
                    ['Linux Server','LX'],
                    ['Deployment','DP'],
                ],
                [
                    [__('home.software.items.web_design'),'WEB'],
                    ['UI / UX','UX'],
                    ['Admin Panel','ADM'],
                    [__('home.software.items.corporate'),'CORP'],
                    [__('home.software.items.ecommerce'),'EC'],
                    ['CMS','CMS'],
                    [__('home.software.items.seo'),'SEO'],
                    [__('home.software.items.performance'),'98'],
                    [__('home.software.items.mobile'),'MB'],
                    [__('home.software.items.support'),'SUP'],
                ],
            ];
        @endphp

        @foreach($softwareRows as $rowIndex => $row)
            <div class="software-marquee-row relative {{ !$loop->last ? 'mb-4' : '' }} overflow-hidden">
                <div
                    class="
                        software-marquee-track
                        {{ $rowIndex === 1 ? 'software-marquee-right' : 'software-marquee-left' }}
                        {{ $rowIndex === 2 ? 'software-marquee-slow' : '' }}
                        gap-3
                    "
                >
                    @for($copy = 0; $copy < 2; $copy++)
                        <div class="flex shrink-0 gap-3 pr-3">
                            @foreach($row as $item)
                                <div
                                    class="
                                        group/item
                                        flex
                                        h-[54px]
                                        shrink-0
                                        items-center
                                        gap-3
                                        rounded-[14px]
                                        border
                                        border-black/[0.055]
                                        bg-white/72
                                        px-5
                                        shadow-[0_8px_26px_rgba(0,0,0,0.028)]
                                        backdrop-blur-sm
                                        transition-all
                                        duration-300
                                        hover:border-black/[0.10]
                                        hover:bg-[#111]
                                        hover:shadow-[0_14px_35px_rgba(0,0,0,0.10)]
                                    "
                                >
                                    <span
                                        class="
                                            flex
                                            h-7
                                            min-w-7
                                            items-center
                                            justify-center
                                            rounded-[8px]
                                            border
                                            border-black/[0.06]
                                            bg-black/[0.025]
                                            px-1.5
                                            font-mono
                                            text-[8px]
                                            font-medium
                                            text-black/45
                                            transition
                                            duration-300
                                            group-hover/item:border-white/10
                                            group-hover/item:bg-white/10
                                            group-hover/item:text-white/80
                                        "
                                    >
                                        {{ $item[1] }}
                                    </span>

                                    <span
                                        class="
                                            whitespace-nowrap
                                            text-[11px]
                                            font-medium
                                            tracking-[-0.01em]
                                            text-black/55
                                            transition
                                            duration-300
                                            group-hover/item:text-white
                                        "
                                    >
                                        {{ $item[0] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
        @endforeach

    </div>
</section>

{{-- ========================================================= --}}
{{-- REFERENCES / OPTIMIZED DARK PANEL --}}
{{-- ========================================================= --}}

@php
    try {
        $homeReferences = \App\Models\Reference::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->take(11)
            ->get();
    } catch (\Throwable $e) {
        $homeReferences = collect();
    }

    $myLogo = $settings['site_logo'] ?? null;
@endphp

<section
    id="referencesSection"
    class="
        order-6
        bg-[#f3f4f5]
        px-4
        py-8
        sm:px-6
        sm:py-10
        lg:px-10
        lg:py-12
    "
>

    <div
        class="
            project-reveal
            relative
            mx-auto
            max-w-[1400px]
            overflow-hidden
            rounded-[30px]
            bg-[#080808]
            text-white
            sm:rounded-[34px]
            lg:rounded-[38px]
        "
    >

        <div
            class="
                relative
                z-10
                px-6
                py-12
                sm:px-8
                sm:py-14
                lg:px-12
                lg:py-16
                xl:px-14
            "
        >

            {{-- ================================================= --}}
            {{-- HEADER --}}
            {{-- ================================================= --}}

            <div
                class="
                    grid
                    grid-cols-1
                    gap-8
                    lg:grid-cols-[minmax(0,1fr)_390px]
                    lg:items-end
                    lg:gap-16
                "
            >

                <div>

                    <div class="flex items-center gap-3">

                        <span
                            class="
                                h-px
                                w-8
                                bg-white/20
                            "
                        ></span>

                        <span
                            class="
                                text-[8px]
                                font-medium
                                uppercase
                                tracking-[0.24em]
                                text-white/35
                            "
                        >
                            {{ __('home.references.eyebrow') }}
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
                            mt-6
                            max-w-[720px]
                            text-[34px]
                            font-medium
                            leading-[1.04]
                            tracking-[-0.045em]
                            text-white
                            sm:text-[42px]
                            lg:text-[50px]
                        "
                    >
                        {{ __('home.references.title_before') }}

                        <span class="text-white/35">
                            {{ __('home.references.title_emphasis') }}
                        </span>
                    </h2>

                </div>

                <p
                    class="
                        max-w-[380px]
                        text-[11px]
                        leading-6
                        text-white/38
                        sm:text-[12px]
                    "
                >
                    {{ __('home.references.description') }}
                </p>

            </div>

            {{-- ================================================= --}}
            {{-- LOGO GRID --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-12
                    grid
                    grid-cols-2
                    overflow-hidden
                    rounded-[22px]
                    border
                    border-white/[0.07]
                    sm:grid-cols-3
                    lg:grid-cols-4
                "
            >

                {{-- ================================================= --}}
                {{-- MUHAMMED ÇİÇEK --}}
                {{-- ================================================= --}}

                <a
                    href="{{ $homeHomeUrl }}"
                    class="
                        group/reference
                        relative
                        flex
                        min-h-[145px]
                        items-center
                        justify-center
                        border-b
                        border-r
                        border-white/[0.07]
                        bg-white/[0.018]
                        px-7
                        py-8
                        transition-colors
                        duration-300
                        hover:bg-white/[0.055]
                        sm:min-h-[165px]
                        lg:min-h-[185px]
                    "
                >

                    @if(!empty($myLogo))

                        <img
                            src="{{ asset('storage/' . $myLogo) }}"
                            alt="Muhammed Çiçek"
                            loading="lazy"
                            decoding="async"
                            class="
                                max-h-[58px]
                                max-w-[180px]
                                object-contain
                                brightness-0
                                invert
                                opacity-100
                                transition-transform
                                duration-300
                                group-hover/reference:scale-[1.04]
                                sm:max-h-[64px]
                                sm:max-w-[195px]
                            "
                        >

                    @else

                        <div class="text-center">

                            <div
                                class="
                                    text-[34px]
                                    font-semibold
                                    tracking-[-0.05em]
                                    text-white
                                "
                            >
                                mc.
                            </div>

                            <div
                                class="
                                    mt-2
                                    text-[7px]
                                    uppercase
                                    tracking-[0.28em]
                                    text-white/45
                                "
                            >
                                Muhammed Çiçek
                            </div>

                        </div>

                    @endif

                    <span
                        class="
                            absolute
                            left-5
                            top-5
                            text-[6px]
                            uppercase
                            tracking-[0.18em]
                            text-white/20
                        "
                    >
                        01
                    </span>

                    <span
                        class="
                            absolute
                            bottom-5
                            right-5
                            translate-y-1
                            text-white/25
                            opacity-0
                            transition-all
                            duration-300
                            group-hover/reference:translate-y-0
                            group-hover/reference:opacity-100
                        "
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            class="h-4 w-4"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path d="M7 17 17 7"/>
                            <path d="M8 7h9v9"/>
                        </svg>
                    </span>

                </a>

                {{-- ================================================= --}}
                {{-- DYNAMIC REFERENCES --}}
                {{-- ================================================= --}}

                @forelse($homeReferences as $reference)

                    @php
                        $referenceIndex = $loop->iteration + 1;
                    @endphp

                    @if(!empty($reference->website_url))

                        <a
                            href="{{ $reference->website_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="{{ $reference->company }}"
                            class="
                                group/reference
                                relative
                                flex
                                min-h-[145px]
                                items-center
                                justify-center
                                border-b
                                border-r
                                border-white/[0.07]
                                bg-white/[0.018]
                                px-7
                                py-8
                                transition-colors
                                duration-300
                                hover:bg-white/[0.055]
                                sm:min-h-[165px]
                                lg:min-h-[185px]
                            "
                        >

                            @if(!empty($reference->logo))

                                <img
                                    src="{{ asset('storage/' . $reference->logo) }}"
                                    alt="{{ $reference->company }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="
                                        max-h-[52px]
                                        max-w-[145px]
                                        object-contain
                                        brightness-0
                                        invert
                                        opacity-55
                                        transition-all
                                        duration-300
                                        group-hover/reference:scale-[1.04]
                                        group-hover/reference:opacity-100
                                        sm:max-h-[58px]
                                        sm:max-w-[165px]
                                        lg:max-h-[64px]
                                        lg:max-w-[180px]
                                    "
                                >

                            @else

                                <span
                                    class="
                                        text-[26px]
                                        font-medium
                                        uppercase
                                        text-white/40
                                        transition-colors
                                        duration-300
                                        group-hover/reference:text-white
                                    "
                                >
                                    {{ strtoupper(substr($reference->company, 0, 1)) }}
                                </span>

                            @endif

                            <span
                                class="
                                    absolute
                                    left-5
                                    top-5
                                    text-[6px]
                                    tracking-[0.18em]
                                    text-white/18
                                "
                            >
                                {{ str_pad($referenceIndex, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <span
                                class="
                                    absolute
                                    bottom-5
                                    right-5
                                    translate-y-1
                                    text-white/20
                                    opacity-0
                                    transition-all
                                    duration-300
                                    group-hover/reference:translate-y-0
                                    group-hover/reference:text-white
                                    group-hover/reference:opacity-100
                                "
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    class="h-4 w-4"
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
                                group/reference
                                relative
                                flex
                                min-h-[145px]
                                items-center
                                justify-center
                                border-b
                                border-r
                                border-white/[0.07]
                                bg-white/[0.018]
                                px-7
                                py-8
                                transition-colors
                                duration-300
                                hover:bg-white/[0.045]
                                sm:min-h-[165px]
                                lg:min-h-[185px]
                            "
                        >

                            @if(!empty($reference->logo))

                                <img
                                    src="{{ asset('storage/' . $reference->logo) }}"
                                    alt="{{ $reference->company }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="
                                        max-h-[52px]
                                        max-w-[145px]
                                        object-contain
                                        brightness-0
                                        invert
                                        opacity-55
                                        transition-all
                                        duration-300
                                        group-hover/reference:scale-[1.04]
                                        group-hover/reference:opacity-100
                                        sm:max-h-[58px]
                                        sm:max-w-[165px]
                                        lg:max-h-[64px]
                                        lg:max-w-[180px]
                                    "
                                >

                            @else

                                <span
                                    class="
                                        text-[26px]
                                        font-medium
                                        uppercase
                                        text-white/40
                                    "
                                >
                                    {{ strtoupper(substr($reference->company, 0, 1)) }}
                                </span>

                            @endif

                            <span
                                class="
                                    absolute
                                    left-5
                                    top-5
                                    text-[6px]
                                    tracking-[0.18em]
                                    text-white/18
                                "
                            >
                                {{ str_pad($referenceIndex, 2, '0', STR_PAD_LEFT) }}
                            </span>

                        </div>

                    @endif

                @empty

                    @foreach(range(2, 8) as $i)

                        <div
                            class="
                                flex
                                min-h-[145px]
                                items-center
                                justify-center
                                border-b
                                border-r
                                border-white/[0.07]
                                bg-white/[0.018]
                            "
                        >

                            <span
                                class="
                                    text-[7px]
                                    uppercase
                                    tracking-[0.22em]
                                    text-white/15
                                "
                            >
                                {{ __('home.references.placeholder') }}
                            </span>

                        </div>

                    @endforeach

                @endforelse

            </div>

            {{-- ================================================= --}}
            {{-- BOTTOM --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-8
                    flex
                    flex-col
                    gap-6
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                <div class="flex items-center gap-3">

                    <span
                        class="
                            h-[5px]
                            w-[5px]
                            rounded-full
                            bg-white/50
                        "
                    ></span>

                    <span
                        class="
                            text-[7px]
                            uppercase
                            tracking-[0.20em]
                            text-white/25
                        "
                    >
                        {{ __('home.references.bottom_label') }}
                    </span>

                </div>

                <a
                    href="{{ $homeReferencesUrl }}"
                    class="
                        group/all-references
                        inline-flex
                        w-fit
                        items-center
                        gap-4
                        rounded-full
                        border
                        border-white/[0.11]
                        bg-white/[0.035]
                        py-2.5
                        pl-5
                        pr-3
                        text-[8px]
                        font-medium
                        text-white/55
                        transition-all
                        duration-300
                        hover:border-white
                        hover:bg-white
                        hover:text-black
                    "
                >

                    <span>
                        {{ __('home.references.view_all') }}
                    </span>

                    <span
                        class="
                            flex
                            h-7
                            w-7
                            items-center
                            justify-center
                            rounded-full
                            bg-white/[0.07]
                            transition-colors
                            duration-300
                            group-hover/all-references:bg-black
                            group-hover/all-references:text-white
                        "
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            class="
                                h-3.5
                                w-3.5
                                transition-transform
                                duration-300
                                group-hover/all-references:translate-x-0.5
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

    </div>

</section>

{{-- ========================================================= --}}
{{-- BLOG / LATEST POSTS --}}
{{-- ========================================================= --}}

@php
    try {
        $homePosts = \App\Models\Post::query()
            ->orderByDesc('id')
            ->take(3)
            ->get();
    } catch (\Throwable $e) {
        $homePosts = collect();
    }
@endphp

<section
    id="blogSection"
    class="
        order-6
        relative
        overflow-hidden
        bg-[#f3f4f5]
        py-20
        lg:py-28
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

        {{-- HEADER --}}
        <div
            class="
                mb-10
                flex
                flex-col
                gap-7
                sm:mb-12
                lg:flex-row
                lg:items-end
                lg:justify-between
            "
        >
            <div>
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-black/20"></span>

                    <span
                        class="
                            text-[9px]
                            font-medium
                            uppercase
                            tracking-[0.24em]
                            text-black/40
                        "
                    >
                        Blog
                    </span>

                    <span class="h-[5px] w-[5px] rounded-full bg-black/70"></span>
                </div>

                <h2
                    class="
                        mt-5
                        max-w-[650px]
                        text-[34px]
                        font-medium
                        leading-[1.08]
                        tracking-[-0.04em]
                        text-[#111]
                        sm:text-[42px]
                        lg:text-[50px]
                    "
                >
                    {{ __('home.blog.title_before') }}
                    <span class="text-black/35">
                        {{ __('home.blog.title_emphasis') }}
                    </span>
                </h2>

                <p
                    class="
                        mt-4
                        max-w-[540px]
                        text-[12px]
                        leading-6
                        text-black/38
                        sm:text-[13px]
                    "
                >
                    {{ __('home.blog.description') }}
                </p>
            </div>

            <a
                href="{{ $homeNewsUrl }}"
                class="
                    group/all-posts
                    inline-flex
                    w-fit
                    items-center
                    gap-3
                    rounded-full
                    border
                    border-black/[0.08]
                    bg-white/70
                    px-5
                    py-3
                    text-[10px]
                    font-medium
                    text-black/60
                    shadow-[0_10px_30px_rgba(0,0,0,0.025)]
                    backdrop-blur-sm
                    transition-all
                    duration-300
                    hover:-translate-y-0.5
                    hover:border-black/[0.14]
                    hover:bg-[#111]
                    hover:text-white
                    hover:shadow-[0_16px_38px_rgba(0,0,0,0.10)]
                "
            >
                <span>{{ __('home.blog.view_all') }}</span>

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    class="
                        h-4
                        w-4
                        transition-transform
                        duration-300
                        group-hover/all-posts:translate-x-1
                    "
                    stroke="currentColor"
                    stroke-width="1.6"
                >
                    <path d="M5 12h14"/>
                    <path d="m14 7 5 5-5 5"/>
                </svg>
            </a>
        </div>

        {{-- POSTS --}}
        <div
            class="
                grid
                grid-cols-1
                gap-5
                md:grid-cols-3
            "
        >

            @forelse($homePosts as $post)

                @php
                    $postUrl = $homeIsEnglish
                        ? route('en.news.show', ['locale' => 'en', 'slug' => $post->slug])
                        : route('news.show', $post->slug);

                    $homePostTitle = $homeIsEnglish && !empty($post->title_en)
                        ? $post->title_en
                        : $post->title;

                    $homePostText = $homeIsEnglish
                        ? (
                            !empty($post->summary_en)
                                ? $post->summary_en
                                : (!empty($post->content_en)
                                    ? $post->content_en
                                    : ($post->summary ?: $post->content))
                        )
                        : ($post->summary ?: $post->content);

                    $postDate = $post->published_at
                        ?? $post->created_at;
                @endphp

                <article
                    class="
                        project-reveal
                        group/blog
                        relative
                        overflow-hidden
                        rounded-[22px]
                        border
                        border-black/[0.055]
                        bg-white/70
                        shadow-[0_18px_48px_rgba(0,0,0,0.035)]
                        backdrop-blur-sm
                        transition-all
                        duration-500
                        ease-[cubic-bezier(.22,1,.36,1)]
                        hover:-translate-y-1.5
                        hover:border-black/[0.10]
                        hover:bg-white
                        hover:shadow-[0_28px_70px_rgba(0,0,0,0.08)]
                    "
                    style="transition-delay: {{ min($loop->index * 80, 160) }}ms;"
                >
                    <a
                        href="{{ $postUrl }}"
                        class="block h-full"
                        aria-label="{{ $homePostTitle }}"
                    >

                        {{-- IMAGE --}}
                        <div
                            class="
                                relative
                                aspect-[4/3]
                                overflow-hidden
                                bg-[#e9e9e9]
                            "
                        >
                            @if(!empty($post->image))

                                <img
                                    src="{{ asset('storage/' . $post->image) }}"
                                    alt="{{ $homePostTitle }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="
                                        absolute
                                        inset-0
                                        h-full
                                        w-full
                                        object-cover
                                        transition-transform
                                        duration-[900ms]
                                        ease-[cubic-bezier(.22,1,.36,1)]
                                        group-hover/blog:scale-[1.04]
                                    "
                                >

                                <div
                                    class="
                                        pointer-events-none
                                        absolute
                                        inset-0
                                        bg-gradient-to-t
                                        from-black/15
                                        via-transparent
                                        to-transparent
                                    "
                                ></div>

                            @else

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
                                            h-[120px]
                                            w-[120px]
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
                                                w-[160px]
                                                -translate-x-1/2
                                                -translate-y-1/2
                                                rotate-[-18deg]
                                                bg-white/[0.12]
                                            "
                                        ></span>

                                        <span
                                            class="
                                                absolute
                                                left-1/2
                                                top-1/2
                                                h-2
                                                w-2
                                                -translate-x-1/2
                                                -translate-y-1/2
                                                rounded-full
                                                bg-white/70
                                            "
                                        ></span>
                                    </div>
                                </div>

                            @endif

                            {{-- INDEX --}}
                            <span
                                class="
                                    absolute
                                    left-4
                                    top-4
                                    flex
                                    h-8
                                    min-w-8
                                    items-center
                                    justify-center
                                    rounded-full
                                    border
                                    border-white/10
                                    bg-black/30
                                    px-2
                                    text-[8px]
                                    font-medium
                                    text-white/80
                                    backdrop-blur-md
                                "
                            >
                                0{{ $loop->iteration }}
                            </span>
                        </div>

                        {{-- CONTENT --}}
                        <div class="p-5 sm:p-6">

                            <div
                                class="
                                    flex
                                    items-center
                                    justify-between
                                    gap-4
                                    text-[8px]
                                    uppercase
                                    tracking-[0.14em]
                                    text-black/30
                                "
                            >
                                <span>Blog</span>

                                @if($postDate)
                                    <span>
                                        {{ \Carbon\Carbon::parse($postDate)->format('d.m.Y') }}
                                    </span>
                                @endif
                            </div>

                            <h3
                                class="
                                    mt-4
                                    line-clamp-2
                                    text-[18px]
                                    font-medium
                                    leading-[1.25]
                                    tracking-[-0.025em]
                                    text-[#111]
                                    sm:text-[20px]
                                "
                            >
                                {{ $homePostTitle }}
                            </h3>

                            @if(!empty($homePostText))
                                <p
                                    class="
                                        mt-3
                                        line-clamp-3
                                        text-[11px]
                                        leading-5
                                        text-black/38
                                    "
                                >
                                    {{ \Illuminate\Support\Str::limit(strip_tags($homePostText), 125) }}
                                </p>
                            @endif

                            <div
                                class="
                                    mt-6
                                    flex
                                    items-center
                                    justify-between
                                    border-t
                                    border-black/[0.06]
                                    pt-4
                                "
                            >
                                <span
                                    class="
                                        text-[9px]
                                        font-medium
                                        text-black/45
                                        transition-colors
                                        duration-300
                                        group-hover/blog:text-black
                                    "
                                >
                                    {{ __('home.blog.read') }}
                                </span>

                                <span
                                    class="
                                        text-black/40
                                        transition-all
                                        duration-300
                                        group-hover/blog:translate-x-1
                                        group-hover/blog:text-black
                                    "
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="h-5 w-5"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path d="M5 12h14"/>
                                        <path d="m14 7 5 5-5 5"/>
                                    </svg>
                                </span>
                            </div>

                        </div>

                    </a>
                </article>

            @empty

                @for($i = 1; $i <= 3; $i++)
                    <div
                        class="
                            project-reveal
                            overflow-hidden
                            rounded-[22px]
                            border
                            border-black/[0.055]
                            bg-white/65
                        "
                    >
                        <div
                            class="
                                flex
                                aspect-[4/3]
                                items-center
                                justify-center
                                bg-[#111]
                            "
                        >
                            <span
                                class="
                                    text-[9px]
                                    uppercase
                                    tracking-[0.18em]
                                    text-white/30
                                "
                            >
                                Blog 0{{ $i }}
                            </span>
                        </div>

                        <div class="p-6">
                            <p class="text-[8px] uppercase tracking-[0.14em] text-black/25">
                                Blog
                            </p>

                            <p class="mt-4 text-[18px] font-medium text-black/65">
                                {{ __('home.blog.empty') }}
                            </p>
                        </div>
                    </div>
                @endfor

            @endforelse

        </div>

        {{-- MOBILE ALL POSTS --}}
        <div class="mt-8 flex justify-center lg:hidden">
            <a
                href="{{ $homeNewsUrl }}"
                class="
                    inline-flex
                    items-center
                    gap-3
                    text-[10px]
                    font-medium
                    text-black/55
                "
            >
                {{ __('home.blog.view_all') }}

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

</div>

{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | HERO
    |--------------------------------------------------------------------------
    */

    const hero =
        document.getElementById('heroStorySection');

    const storyOne =
        document.getElementById('heroStoryOne');

    const storyTwo =
        document.getElementById('heroStoryTwo');

    const indicator =
        document.getElementById('heroScrollIndicator');

    const heroBackground =
        document.getElementById('heroBackgroundImage');

    let targetHeroProgress = 0;
    let smoothHeroProgress = 0;
    let heroFrame = null;

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    function clamp(value, min, max) {

        return Math.min(
            Math.max(value, min),
            max
        );

    }

    function smoothstep(value) {

        const x =
            clamp(
                value,
                0,
                1
            );

        return (
            x *
            x *
            (3 - 2 * x)
        );

    }

    function range(
        progress,
        start,
        end
    ) {

        return smoothstep(
            (progress - start) /
            (end - start)
        );

    }

    /*
    |--------------------------------------------------------------------------
    | HERO PROGRESS
    |--------------------------------------------------------------------------
    */

    function calculateHeroProgress() {

        if (!hero) {
            return 0;
        }

        const rect =
            hero.getBoundingClientRect();

        const distance =
            Math.max(
                hero.offsetHeight -
                window.innerHeight,
                1
            );

        return clamp(
            (-rect.top) / distance,
            0,
            1
        );

    }

    /*
    |--------------------------------------------------------------------------
    | DRAW HERO
    |--------------------------------------------------------------------------
    */

    function drawHero(progress) {

        if (
            !storyOne ||
            !storyTwo
        ) {
            return;
        }

        const firstExit =
            range(
                progress,
                .20,
                .66
            );

        storyOne.style.opacity =
            1 - firstExit;

        storyOne.style.transform =
            `
                translate3d(
                    0,
                    ${-25 * firstExit}px,
                    0
                )
                scale(
                    ${1 - (.014 * firstExit)}
                )
            `;

        storyOne.style.filter =
            `blur(${3 * firstExit}px)`;

        const secondEnter =
            range(
                progress,
                .30,
                .74
            );

        storyTwo.style.opacity =
            secondEnter;

        storyTwo.style.transform =
            `
                translate3d(
                    0,
                    ${28 * (1 - secondEnter)}px,
                    0
                )
                scale(
                    ${.986 + (.014 * secondEnter)}
                )
            `;

        storyTwo.style.filter =
            `blur(${4 * (1 - secondEnter)}px)`;

        if (heroBackground) {

            heroBackground.style.transform =
                `scale(${1 + smoothstep(progress) * .008})`;

        }

        if (indicator) {

            const fade =
                range(
                    progress,
                    .02,
                    .24
                );

            indicator.style.opacity =
                1 - fade;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | HERO SMOOTH LOOP
    |--------------------------------------------------------------------------
    */

    function animateHero() {

        smoothHeroProgress +=
            (
                targetHeroProgress -
                smoothHeroProgress
            ) * .075;

        drawHero(
            smoothHeroProgress
        );

        if (
            Math.abs(
                targetHeroProgress -
                smoothHeroProgress
            ) > .0001
        ) {

            heroFrame =
                requestAnimationFrame(
                    animateHero
                );

        } else {

            smoothHeroProgress =
                targetHeroProgress;

            drawHero(
                smoothHeroProgress
            );

            heroFrame =
                null;

        }

    }

    function requestHeroUpdate() {

        targetHeroProgress =
            calculateHeroProgress();

        if (!heroFrame) {

            heroFrame =
                requestAnimationFrame(
                    animateHero
                );

        }

    }

    /*
    |--------------------------------------------------------------------------
    | PROJECT PARALLAX
    |--------------------------------------------------------------------------
    */

    const projectsSection =
        document.getElementById(
            'projectsSection'
        );

    const projectCards =
        document.querySelectorAll(
            '[data-project-parallax]'
        );

    let projectFrame = null;

    function updateProjectParallax() {

        projectFrame = null;

        if (
            !projectsSection ||
            !projectCards.length
        ) {
            return;
        }

        const rect =
            projectsSection
                .getBoundingClientRect();

        const viewport =
            window.innerHeight;

        const rawProgress =
            (
                viewport -
                rect.top
            ) /
            (
                viewport +
                rect.height
            );

        const progress =
            clamp(
                rawProgress,
                0,
                1
            );

        const centered =
            (progress - .5) * 2;

        projectCards.forEach(
            function (card) {

                const strength =
                    Number(
                        card.dataset
                            .parallaxStrength
                    ) || 5;

                const movement =
                    -centered *
                    strength;

                card.style.setProperty(
                    '--project-shift',
                    `${movement}px`
                );

            }
        );

    }

    function requestProjectUpdate() {

        if (projectFrame) {
            return;
        }

        projectFrame =
            requestAnimationFrame(
                updateProjectParallax
            );

    }

    /*
    |--------------------------------------------------------------------------
    | REVEAL
    |--------------------------------------------------------------------------
    */

    const revealElements =
        document.querySelectorAll(
            '.project-reveal'
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

                            if (
                                !entry.isIntersecting
                            ) {
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
                    threshold: .12,
                    rootMargin:
                        '0px 0px -40px 0px'
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
    | INIT
    |--------------------------------------------------------------------------
    */

    targetHeroProgress =
        calculateHeroProgress();

    smoothHeroProgress =
        targetHeroProgress;

    drawHero(
        smoothHeroProgress
    );

    updateProjectParallax();

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        'scroll',
        function () {

            requestHeroUpdate();

            requestProjectUpdate();

        },
        {
            passive: true
        }
    );

    window.addEventListener(
        'resize',
        function () {

            targetHeroProgress =
                calculateHeroProgress();

            smoothHeroProgress =
                targetHeroProgress;

            drawHero(
                smoothHeroProgress
            );

            updateProjectParallax();

        }
    );

});
</script>

@endsection