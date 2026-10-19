@extends('layouts.site')
@php
    $projectsIsEnglish = app()->getLocale() === 'en';
    $projectsUrl = $projectsIsEnglish
        ? route('en.projects.index', ['locale' => 'en'])
        : route('projects.index');
    $contactUrl = $projectsIsEnglish
        ? route('en.contact', ['locale' => 'en'])
        : route('contact');
    $projectsSiteName = $settings['site_name'] ?? 'Portfolyo';
    $projectsSeoTitle = $projectsIsEnglish
        ? __('projects.seo.title', ['site' => $projectsSiteName])
        : ('Projeler – Web Yazılım ve Dijital Ürünler | ' . $projectsSiteName);
    $projectsMetaDescription = $projectsIsEnglish
        ? __('projects.seo.description')
        : 'Laravel, PHP, özel yazılım, yönetim paneli, kurumsal web ve dijital ürün geliştirme alanındaki seçili projeleri inceleyin. Modern ve performans odaklı çözümler.';
@endphp
@section('title', $projectsSeoTitle)
@section(
    'meta_description',
    $projectsMetaDescription
)
@section('canonical', $projectsUrl)
@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)
@section('og_type', 'website')
@section(
    'og_image_alt',
    __('projects.seo.og_alt', ['site' => $projectsSiteName])
)
@section('content')
<style>
    .projects-reveal {
        opacity: 0;
        transform: translateY(28px);
        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }
    .projects-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .project-image {
        transition:
            transform .9s cubic-bezier(.22, 1, .36, 1),
            filter .5s ease;
    }
    .project-card:hover .project-image {
        transform: scale(1.035);
    }
    @media (prefers-reduced-motion: reduce) {
        .projects-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .project-image {
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
                projects-reveal
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
                        {{ __('projects.hero.eyebrow') }}
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
                    {{ __('projects.hero.title_before') }}
                    <span class="text-black/35">
                        {{ __('projects.hero.title_emphasis') }}
                    </span>
                </h1>
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <span class="inline-flex h-2 w-2 rounded-full bg-black/20"></span>
                    <p
                        class="
                            text-[11px]
                            font-medium
                            tracking-[0.01em]
                            text-black/45
                            sm:text-[12px]
                        "
                    >
                        {{ $projectsIsEnglish
                            ? 'Some of the projects presented here were developed under the leadership of Sekiz Creative.'
                            : 'Projelerin bir bölümü Sekiz Creative öncülüğünde geliştirilmiştir.' }}
                    </p>
                </div>
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
                    {{ __('projects.hero.description') }}
                </p>
            </div>
            <div
                class="
                    flex
                    items-center
                    gap-6
                    lg:pb-2
                "
            >
                <div>
                    <p
                        class="
                            text-[8px]
                            font-medium
                            uppercase
                            tracking-[0.16em]
                            text-black/28
                        "
                    >
                        {{ __('projects.hero.total_projects') }}
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
                        {{ $projects->count() }}
                    </p>
                </div>
                <div class="h-12 w-px bg-black/[0.08]"></div>
                <div>
                    <p
                        class="
                            text-[8px]
                            font-medium
                            uppercase
                            tracking-[0.16em]
                            text-black/28
                        "
                    >
                        {{ __('projects.hero.focus') }}
                    </p>
                    <p
                        class="
                            mt-2
                            text-[12px]
                            font-medium
                            text-black/60
                        "
                    >
                        {{ __('projects.hero.focus_value') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- PROJECTS --}}
{{-- ========================================================= --}}
<section class="bg-[#f3f4f5] pb-24 lg:pb-32">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div
            class="
                grid
                grid-cols-1
                gap-x-6
                gap-y-14
                md:grid-cols-2
                lg:gap-x-8
                lg:gap-y-20
            "
        >
            @forelse($projects as $project)
                @php
                    $projectDisplayTitle = $projectsIsEnglish && !empty($project->title_en)
                        ? $project->title_en
                        : $project->title;
                    $projectDisplayDescription = $projectsIsEnglish && !empty($project->description_en)
                        ? $project->description_en
                        : $project->description;
                    $projectUrl = $projectsIsEnglish
                        ? route('en.projects.show', ['locale' => 'en', 'id' => $project->id])
                        : route('projects.show', $project->id);
                @endphp
                <article
                    class="
                        project-card
                        projects-reveal
                        group
                    "
                    style="
                        transition-delay:
                        {{ min(($loop->index % 6) * 70, 280) }}ms;
                    "
                >
                    <a
                        href="{{ $projectUrl }}"
                        aria-label="{{ $projectDisplayTitle }}"
                        class="block"
                    >
                        {{-- IMAGE --}}
                        <div
                            class="
                                relative
                                overflow-hidden
                                rounded-[22px]
                                bg-[#e7e7e7]
                            "
                        >
                            <div class="aspect-[16/11]">
                                @if($project->image)
                                    <img
                                        src="{{ asset('storage/' . $project->image) }}"
                                        alt="{{ $projectDisplayTitle }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="
                                            project-image
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
                                        <div class="text-center">
                                            <span
                                                class="
                                                    text-[9px]
                                                    font-medium
                                                    uppercase
                                                    tracking-[0.18em]
                                                    text-white/30
                                                "
                                            >
                                                {{ __('projects.card.project_label') }}
                                            </span>
                                            <p
                                                class="
                                                    mt-3
                                                    text-[13px]
                                                    text-white/55
                                                "
                                            >
                                                {{ __('projects.card.no_image') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{-- IMAGE OVERLAY --}}
                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    inset-0
                                    bg-gradient-to-t
                                    from-black/20
                                    via-transparent
                                    to-transparent
                                    opacity-60
                                "
                            ></div>
                            {{-- TOP INDEX --}}
                            <div
                                class="
                                    absolute
                                    left-4
                                    top-4
                                    flex
                                    h-9
                                    min-w-9
                                    items-center
                                    justify-center
                                    rounded-full
                                    border
                                    border-white/20
                                    bg-white/85
                                    px-3
                                    backdrop-blur-md
                                "
                            >
                                <span
                                    class="
                                        text-[8px]
                                        font-medium
                                        text-black/60
                                    "
                                >
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            {{-- HOVER BUTTON --}}
                            <div
                                class="
                                    absolute
                                    bottom-4
                                    right-4
                                    flex
                                    h-11
                                    w-11
                                    translate-y-2
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-white
                                    text-black
                                    opacity-0
                                    shadow-[0_12px_30px_rgba(0,0,0,.12)]
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
                                    stroke-width="1.7"
                                >
                                    <path d="M5 12h14"/>
                                    <path d="m14 7 5 5-5 5"/>
                                </svg>
                            </div>
                        </div>
                        {{-- CONTENT --}}
                        <div class="pt-5">
                            <div
                                class="
                                    flex
                                    items-start
                                    justify-between
                                    gap-5
                                "
                            >
                                <div class="min-w-0">
                                    <h2
                                        class="
                                            text-[23px]
                                            font-medium
                                            leading-tight
                                            tracking-[-0.035em]
                                            text-[#111]
                                            sm:text-[26px]
                                        "
                                    >
                                        {{ $projectDisplayTitle }}
                                    </h2>
                                    <p
                                        class="
                                            mt-3
                                            max-w-[540px]
                                            text-[11px]
                                            leading-6
                                            text-black/40
                                            sm:text-[12px]
                                        "
                                    >
                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($projectDisplayDescription),
                                            130
                                        ) }}
                                    </p>
                                </div>
                                <span
                                    class="
                                        mt-1
                                        shrink-0
                                        text-[8px]
                                        font-medium
                                        uppercase
                                        tracking-[0.16em]
                                        text-black/25
                                    "
                                >
                                    {{ __('projects.card.project_label') }}
                                </span>
                            </div>
                            {{-- TECHNOLOGIES --}}
                            @if(
                                !empty($project->technologies)
                                &&
                                is_array($project->technologies)
                            )
                                <div
                                    class="
                                        mt-5
                                        flex
                                        flex-wrap
                                        gap-2
                                    "
                                >
                                    @foreach(
                                        array_slice(
                                            $project->technologies,
                                            0,
                                            4
                                        )
                                        as $technology
                                    )
                                        <span
                                            class="
                                                rounded-full
                                                border
                                                border-black/[0.06]
                                                bg-white/55
                                                px-3
                                                py-1.5
                                                text-[8px]
                                                font-medium
                                                text-black/42
                                            "
                                        >
                                            {{ $technology }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
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
                                    {{ __('projects.card.view_details') }}
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
            @empty
                <div
                    class="
                        col-span-full
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
                        {{ __('projects.empty') }}
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
            projects-reveal
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
            lg:py-18
        "
    >
        <div
            class="
                pointer-events-none
                absolute
                -bottom-[160px]
                left-1/2
                h-[250px]
                w-[850px]
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
                    {{ __('projects.cta.eyebrow') }}
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
                    {{ __('projects.cta.title_before') }}
                    <span class="text-white/35">
                        {{ __('projects.cta.title_emphasis') }}
                    </span>
                </h2>
                <p
                    class="
                        mt-5
                        max-w-[570px]
                        text-[11px]
                        leading-6
                        text-white/40
                    "
                >
                    {{ __('projects.cta.description') }}
                </p>
            </div>
            <a
                href="{{ $contactUrl }}"
                aria-label="{{ __('projects.cta.button') }}"
                class="
                    group
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
                {{ __('projects.cta.button') }}
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
        document.querySelectorAll(
            '.projects-reveal'
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
                    rootMargin: '0px 0px -30px 0px'
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
