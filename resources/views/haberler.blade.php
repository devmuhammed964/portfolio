@extends('layouts.site')
@php
    $newsIsEnglish = app()->getLocale() === 'en';
    $newsUrl = $newsIsEnglish
        ? route('en.news.index', ['locale' => 'en'])
        : route('news.index');
    $contactUrl = $newsIsEnglish
        ? route('en.contact', ['locale' => 'en'])
        : route('contact');
    $newsSiteName = $settings['site_name'] ?? 'Portfolyo';
    $newsSeoTitle = $newsIsEnglish
        ? __('news.seo.title', ['site' => $newsSiteName])
        : ('Haberler ve Blog – Yazılım ve Web Geliştirme | ' . $newsSiteName);
    $newsMetaDescription = $newsIsEnglish
        ? __('news.seo.description')
        : 'Laravel, PHP, web geliştirme, özel yazılım, kullanıcı deneyimi, dijital ürünler ve güncel teknoloji çalışmaları üzerine haberler ve blog içerikleri.';
@endphp
@section('title', $newsSeoTitle)
@section(
    'meta_description',
    $newsMetaDescription
)
@section('canonical', $newsUrl)
@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)
@section('og_type', 'website')
@section(
    'og_image_alt',
    __('news.seo.og_alt', ['site' => $newsSiteName])
)
@section('content')
<style>
    .news-reveal {
        opacity: 0;
        transform: translateY(26px);
        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }
    .news-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .news-image {
        transition:
            transform .9s cubic-bezier(.22, 1, .36, 1),
            filter .5s ease;
    }
    .news-card:hover .news-image {
        transform: scale(1.035);
    }
    @media (prefers-reduced-motion: reduce) {
        .news-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .news-image {
            transition: none !important;
        }
    }
</style>
{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section class="bg-[#f3f4f5] pb-12 pt-8 lg:pb-16 lg:pt-12">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div
            class="
                news-reveal
                flex
                flex-col
                gap-8
                lg:flex-row
                lg:items-end
                lg:justify-between
            "
        >
            <div class="max-w-[760px]">
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
                        {{ __('news.hero.eyebrow') }}
                    </span>
                    <span class="h-[5px] w-[5px] rounded-full bg-black"></span>
                </div>
                <h1
                    class="
                        mt-6
                        text-[42px]
                        font-medium
                        leading-[1.02]
                        tracking-[-0.05em]
                        text-[#111]
                        sm:text-[56px]
                        lg:text-[68px]
                    "
                >
                    {{ __('news.hero.title_before') }}
                    <span class="text-black/35">
                        {{ __('news.hero.title_emphasis') }}
                    </span>
                </h1>
                <p
                    class="
                        mt-6
                        max-w-[620px]
                        text-[13px]
                        leading-7
                        text-black/40
                        sm:text-[15px]
                    "
                >
                    {{ __('news.hero.description') }}
                </p>
            </div>
            <div class="lg:pb-2">
                <p
                    class="
                        text-[8px]
                        font-medium
                        uppercase
                        tracking-[0.16em]
                        text-black/28
                    "
                >
                    {{ __('news.hero.total') }}
                </p>
                <p
                    class="
                        mt-2
                        text-[28px]
                        font-medium
                        tracking-[-0.04em]
                        text-black
                    "
                >
                    {{ $posts->total() }}
                </p>
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- POSTS --}}
{{-- ========================================================= --}}
<section class="bg-[#f3f4f5] pb-24 lg:pb-32">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        @forelse($posts as $post)
            @php
                $postUrl = $newsIsEnglish
                    ? route('en.news.show', ['locale' => 'en', 'slug' => $post->slug])
                    : route('news.show', $post->slug);
                $postDisplayTitle = $newsIsEnglish && !empty($post->title_en)
                    ? $post->title_en
                    : $post->title;
                $postDisplaySummary = $newsIsEnglish
                    ? (
                        !empty($post->summary_en)
                            ? $post->summary_en
                            : (!empty($post->content_en)
                                ? $post->content_en
                                : ($post->summary ?: $post->content))
                    )
                    : ($post->summary ?: $post->content);
            @endphp
            @if($loop->first)
                {{-- FEATURED POST --}}
                <article
                    class="
                        news-card
                        news-reveal
                        group
                        mb-20
                        lg:mb-28
                    "
                >
                    <a
                        href="{{ $postUrl }}"
                        class="
                            grid
                            grid-cols-1
                            gap-8
                            lg:grid-cols-[1.15fr_.85fr]
                            lg:items-center
                            lg:gap-14
                        "
                    >
                        {{-- IMAGE --}}
                        <div
                            class="
                                relative
                                overflow-hidden
                                rounded-[26px]
                                bg-[#e8e8e8]
                            "
                        >
                            <div class="aspect-[16/10]">
                                @if($post->image)
                                    <img
                                        src="{{ asset('storage/' . $post->image) }}"
                                        alt="{{ $postDisplayTitle }}"
                                        width="1280"
                                        height="800"
                                        fetchpriority="high"
                                        decoding="async"
                                        class="
                                            news-image
                                            h-full
                                            w-full
                                            object-cover
                                        "
                                    >
                                @else
                                    <div
                                        class="
                                            flex
                                            h-full
                                            items-center
                                            justify-center
                                            bg-[#111]
                                        "
                                    >
                                        <span
                                            class="
                                                text-[10px]
                                                uppercase
                                                tracking-[0.18em]
                                                text-white/30
                                            "
                                        >
                                            {{ __('news.card.no_image') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    inset-0
                                    bg-gradient-to-t
                                    from-black/20
                                    via-transparent
                                    to-transparent
                                "
                            ></div>
                            <div
                                class="
                                    absolute
                                    left-4
                                    top-4
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
                                        text-[8px]
                                        font-medium
                                        uppercase
                                        tracking-[0.14em]
                                        text-black/55
                                    "
                                >
                                    {{ __('news.card.featured') }}
                                </span>
                            </div>
                        </div>
                        {{-- CONTENT --}}
                        <div class="max-w-[520px]">
                            <span
                                class="
                                    text-[8px]
                                    font-medium
                                    uppercase
                                    tracking-[0.16em]
                                    text-black/30
                                "
                            >
                                {{ $post->created_at->format('d.m.Y') }}
                            </span>
                            <h2
                                class="
                                    mt-5
                                    text-[32px]
                                    font-medium
                                    leading-[1.08]
                                    tracking-[-0.04em]
                                    text-[#111]
                                    sm:text-[40px]
                                    lg:text-[44px]
                                "
                            >
                                {{ $postDisplayTitle }}
                            </h2>
                            <p
                                class="
                                    mt-5
                                    text-[12px]
                                    leading-7
                                    text-black/42
                                    sm:text-[13px]
                                "
                            >
                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($postDisplaySummary),
                                    190
                                ) }}
                            </p>
                            <div class="mt-7">
                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        gap-3
                                        text-[10px]
                                        font-medium
                                        text-black/60
                                        transition
                                        group-hover:text-black
                                    "
                                >
                                    {{ __('news.card.read_more') }}
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
                            </div>
                        </div>
                    </a>
                </article>
            @else
                @if($loop->index === 1)
                    <div
                        class="
                            grid
                            grid-cols-1
                            gap-x-8
                            gap-y-16
                            md:grid-cols-2
                            lg:gap-y-20
                        "
                    >
                @endif
                <article
                    class="
                        news-card
                        news-reveal
                        group
                    "
                    style="
                        transition-delay:
                        {{ min(($loop->index % 5) * 70, 280) }}ms;
                    "
                >
                    <a
                        href="{{ $postUrl }}"
                        class="block"
                    >
                        {{-- IMAGE --}}
                        <div
                            class="
                                relative
                                overflow-hidden
                                rounded-[22px]
                                bg-[#e8e8e8]
                            "
                        >
                            <div class="aspect-[16/10]">
                                @if($post->image)
                                    <img
                                        src="{{ asset('storage/' . $post->image) }}"
                                        alt="{{ $postDisplayTitle }}"
                                        width="1280"
                                        height="800"
                                        loading="lazy"
                                        decoding="async"
                                        class="
                                            news-image
                                            h-full
                                            w-full
                                            object-cover
                                        "
                                    >
                                @else
                                    <div
                                        class="
                                            flex
                                            h-full
                                            items-center
                                            justify-center
                                            bg-[#111]
                                        "
                                    >
                                        <span
                                            class="
                                                text-[9px]
                                                uppercase
                                                tracking-[0.17em]
                                                text-white/30
                                            "
                                        >
                                            {{ __('news.card.no_image') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div
                                class="
                                    absolute
                                    bottom-4
                                    right-4
                                    flex
                                    h-10
                                    w-10
                                    translate-y-2
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-white
                                    text-black
                                    opacity-0
                                    transition-all
                                    duration-300
                                    group-hover:translate-y-0
                                    group-hover:opacity-100
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
                        {{-- CONTENT --}}
                        <div class="pt-5">
                            <span
                                class="
                                    text-[8px]
                                    font-medium
                                    uppercase
                                    tracking-[0.15em]
                                    text-black/28
                                "
                            >
                                {{ $post->created_at->format('d.m.Y') }}
                            </span>
                            <h2
                                class="
                                    mt-3
                                    text-[22px]
                                    font-medium
                                    leading-tight
                                    tracking-[-0.035em]
                                    text-[#111]
                                    sm:text-[25px]
                                "
                            >
                                {{ $postDisplayTitle }}
                            </h2>
                            <p
                                class="
                                    mt-3
                                    max-w-[560px]
                                    text-[11px]
                                    leading-6
                                    text-black/40
                                    sm:text-[12px]
                                "
                            >
                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($postDisplaySummary),
                                    135
                                ) }}
                            </p>
                            <div
                                class="
                                    mt-5
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
                                        transition
                                        group-hover:text-black
                                    "
                                >
                                    {{ __('news.card.read_more') }}
                                </span>
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    class="
                                        h-4
                                        w-4
                                        text-black/30
                                        transition-transform
                                        duration-300
                                        group-hover:translate-x-1
                                        group-hover:text-black
                                    "
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                >
                                    <path d="M5 12h14"/>
                                    <path d="m14 7 5 5-5 5"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </article>
                @if($loop->last)
                    </div>
                @endif
            @endif
        @empty
            <div
                class="
                    rounded-[24px]
                    border
                    border-black/[0.06]
                    bg-white/60
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
                    {{ __('news.empty') }}
                </p>
            </div>
        @endforelse
        {{-- PAGINATION --}}
        @if($posts->hasPages())
            <div
                class="
                    mt-16
                    border-t
                    border-black/[0.06]
                    pt-8
                "
            >
                {{ $posts->links() }}
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
            news-reveal
            relative
            mx-auto
            max-w-[1400px]
            overflow-hidden
            rounded-[38px]
            bg-[#090909]
            px-7
            py-14
            text-white
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
                border-white/[0.08]
            "
        ></div>
        <div
            class="
                relative
                z-10
                flex
                flex-col
                gap-9
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
                    {{ __('news.cta.eyebrow') }}
                </span>
                <h2
                    class="
                        mt-5
                        max-w-[720px]
                        text-[34px]
                        font-medium
                        leading-[1.06]
                        tracking-[-0.045em]
                        text-white
                        sm:text-[44px]
                        lg:text-[52px]
                    "
                >
                    {{ __('news.cta.title_before') }}
                    <span class="text-white/35">
                        {{ __('news.cta.title_emphasis') }}
                    </span>
                </h2>
                <p
                    class="
                        mt-5
                        max-w-[580px]
                        text-[11px]
                        leading-6
                        text-white/40
                    "
                >
                    {{ __('news.cta.description') }}
                </p>
            </div>
            <a
                href="{{ $contactUrl }}"
                class="
                    group
                    inline-flex
                    w-fit
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
                {{ __('news.cta.button') }}
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
            </a>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const elements =
        document.querySelectorAll('.news-reveal');
    if ('IntersectionObserver' in window) {
        const observer =
            new IntersectionObserver(
                function (entries, observerInstance) {
                    entries.forEach(
                        function (entry) {
                            if (!entry.isIntersecting) {
                                return;
                            }
                            entry.target.classList.add(
                                'is-visible'
                            );
                            observerInstance.unobserve(
                                entry.target
                            );
                        }
                    );
                },
                {
                    threshold: .10,
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
                element.classList.add('is-visible');
            }
        );
    }
});
</script>
@endsection
