@extends('layouts.site')
@php
    $projectIsEnglish = app()->getLocale() === 'en';
    $projectsUrl = $projectIsEnglish
        ? route('en.projects.index', ['locale' => 'en'])
        : route('projects.index');
    $projectUrl = $projectIsEnglish
        ? route('en.projects.show', ['locale' => 'en', 'id' => $project->id])
        : route('projects.show', $project->id);
    $contactUrl = $projectIsEnglish
        ? route('en.contact', ['locale' => 'en'])
        : route('contact');
    $projectSiteName = $settings['site_name'] ?? 'Portfolyo';
    $projectDisplayTitle = $projectIsEnglish && !empty($project->title_en)
        ? $project->title_en
        : $project->title;
    $projectDisplayDescription = $projectIsEnglish && !empty($project->description_en)
        ? $project->description_en
        : $project->description;
    $projectSeoTitle = $projectDisplayTitle . ' – Proje Detayı | ' . $projectSiteName;
    $projectSeoDescription = \Illuminate\Support\Str::limit(
        trim(strip_tags($projectDisplayDescription ?? '')),
        155
    );
    $projectOgImage = !empty($project->image)
        ? asset('storage/' . $project->image)
        : null;
@endphp
@section('title', $projectSeoTitle)
@section(
    'meta_description',
    $projectSeoDescription
)
@section('canonical', $projectUrl)
@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)
@section('og_type', 'website')
@if($projectOgImage)
    @section('og_image', $projectOgImage)
@endif
@section(
    'og_image_alt',
    $projectDisplayTitle . ' ' . __('project_detail.seo.image_suffix')
)
@section('content')
@php
    $socialLinks = [
        [
            'label' => 'Instagram',
            'url' => data_get($settings ?? null, 'instagram_url')
                ?? data_get($settings ?? null, 'instagram'),
        ],
        [
            'label' => 'LinkedIn',
            'url' => data_get($settings ?? null, 'linkedin_url')
                ?? data_get($settings ?? null, 'linkedin'),
        ],
        [
            'label' => 'GitHub',
            'url' => data_get($settings ?? null, 'github_url')
                ?? data_get($settings ?? null, 'github'),
        ],
        [
            'label' => 'Behance',
            'url' => data_get($settings ?? null, 'behance_url')
                ?? data_get($settings ?? null, 'behance'),
        ],
    ];
    $socialLinks = collect($socialLinks)
        ->filter(fn ($item) => !empty($item['url']))
        ->values();
    $phone = data_get($settings ?? null, 'phone')
        ?? data_get($settings ?? null, 'site_phone');
    $email = data_get($settings ?? null, 'email')
        ?? data_get($settings ?? null, 'site_email');
@endphp
<style>
    .project-detail-reveal {
        opacity: 0;
        transform: translateY(24px);
        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }
    .project-detail-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .project-detail-image {
        transition: transform 1s cubic-bezier(.22, 1, .36, 1);
    }
    .project-detail-visual:hover .project-detail-image {
        transform: scale(1.018);
    }
    .technology-item,
    .contact-row,
    .project-link,
    .contact-cta {
        transition:
            background-color .3s ease,
            border-color .3s ease,
            color .3s ease,
            transform .3s ease;
    }
    .technology-item:hover {
        transform: translateY(-2px);
    }
    .contact-row:hover {
        transform: translateX(3px);
    }
    .contact-card {
        position: relative;
        overflow: hidden;
    }
    .contact-card::before {
        content: '';
        position: absolute;
        width: 170px;
        height: 170px;
        right: -75px;
        top: -75px;
        border-radius: 9999px;
        background: rgba(255,255,255,.045);
        filter: blur(2px);
        pointer-events: none;
    }
    .contact-card::after {
        content: '';
        position: absolute;
        width: 120px;
        height: 120px;
        right: 40px;
        bottom: -80px;
        border-radius: 9999px;
        border: 1px solid rgba(255,255,255,.05);
        pointer-events: none;
    }
    @media (prefers-reduced-motion: reduce) {
        .project-detail-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .project-detail-image,
        .technology-item,
        .contact-row,
        .project-link,
        .contact-cta {
            transition: none !important;
        }
    }
</style>
{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section class="bg-[#f3f4f5] pb-12 pt-8 lg:pb-16 lg:pt-12">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        {{-- BACK --}}
        <div class="project-detail-reveal">
            <a
                href="{{ $projectsUrl }}"
                class="
                    group
                    inline-flex
                    items-center
                    gap-3
                    text-[9px]
                    font-medium
                    uppercase
                    tracking-[0.16em]
                    text-black/35
                    transition
                    hover:text-black
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
                        group-hover:-translate-x-1
                    "
                    stroke="currentColor"
                    stroke-width="1.6"
                >
                    <path d="M19 12H5"/>
                    <path d="m10 7-5 5 5 5"/>
                </svg>
                {{ __('project_detail.hero.back') }}
            </a>
        </div>
        <div
            class="
                project-detail-reveal
                mt-10
                grid
                grid-cols-1
                gap-10
                lg:grid-cols-[1fr_auto]
                lg:items-end
                lg:gap-16
            "
            style="transition-delay: 80ms;"
        >
            {{-- LEFT --}}
            <div class="max-w-[900px]">
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
                        {{ __('project_detail.hero.eyebrow') }}
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
                        mt-6
                        max-w-[900px]
                        text-[42px]
                        font-medium
                        leading-[1.02]
                        tracking-[-0.05em]
                        text-[#111]
                        sm:text-[56px]
                        lg:text-[72px]
                    "
                >
                    {{ $projectDisplayTitle }}
                </h1>
            </div>
            {{-- RIGHT META --}}
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
                    {{ __('project_detail.hero.category') }}
                </p>
                <p
                    class="
                        mt-2
                        text-[12px]
                        font-medium
                        text-black/60
                    "
                >
                    {{ __('project_detail.hero.category_value') }}
                </p>
            </div>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- HERO IMAGE --}}
{{-- ========================================================= --}}
@if($project->image)
    <section class="bg-[#f3f4f5] pb-16 lg:pb-20">
        <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
            <div
                class="
                    project-detail-visual
                    project-detail-reveal
                    relative
                    overflow-hidden
                    rounded-[26px]
                    bg-[#e8e8e8]
                "
                style="transition-delay: 140ms;"
            >
                <div class="aspect-[16/8.5]">
                    <img
                        src="{{ asset('storage/' . $project->image) }}"
                        alt="{{ $projectDisplayTitle }}"
                        fetchpriority="high"
                        decoding="async"
                        class="
                            project-detail-image
                            h-full
                            w-full
                            object-cover
                        "
                    >
                </div>
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
                <div
                    class="
                        absolute
                        bottom-5
                        left-5
                        rounded-full
                        border
                        border-white/20
                        bg-white/80
                        px-4
                        py-2
                        backdrop-blur-md
                    "
                >
                    <span
                        class="
                            text-[8px]
                            font-medium
                            uppercase
                            tracking-[0.15em]
                            text-black/55
                        "
                    >
                        {{ __('project_detail.hero.selected') }}
                    </span>
                </div>
            </div>
        </div>
    </section>
@endif
{{-- ========================================================= --}}
{{-- CONTENT --}}
{{-- ========================================================= --}}
<section class="bg-[#f3f4f5] pb-24 lg:pb-32">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div
            class="
                grid
                grid-cols-1
                gap-14
                lg:grid-cols-[minmax(0,1fr)_330px]
                lg:gap-24
            "
        >
            {{-- ================================================= --}}
            {{-- LEFT CONTENT --}}
            {{-- ================================================= --}}
            <div class="project-detail-reveal">
                <div class="max-w-[820px]">
                    {{-- DESCRIPTION --}}
                    <div>
                        <div class="flex items-center gap-3">
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
                                {{ __('project_detail.about.eyebrow') }}
                            </span>
                        </div>
                        <div
                            class="
                                mt-7
                                whitespace-pre-line
                                text-[15px]
                                leading-8
                                text-black/52
                                sm:text-[16px]
                            "
                        >
                            {{ $projectDisplayDescription }}
                        </div>
                    </div>
                    {{-- ================================================= --}}
                    {{-- TECHNOLOGIES --}}
                    {{-- ================================================= --}}
                    @if(
                        !empty($project->technologies)
                        &&
                        is_array($project->technologies)
                    )
                        <div
                            class="
                                mt-14
                                border-t
                                border-black/[0.08]
                                pt-9
                                lg:mt-16
                                lg:pt-10
                            "
                        >
                            <div
                                class="
                                    flex
                                    flex-col
                                    gap-6
                                    sm:flex-row
                                    sm:items-end
                                    sm:justify-between
                                "
                            >
                                <div>
                                    <div class="flex items-center gap-3">
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
                                            {{ __('project_detail.technologies.eyebrow') }}
                                        </span>
                                    </div>
                                    <h2
                                        class="
                                            mt-4
                                            text-[24px]
                                            font-medium
                                            tracking-[-0.04em]
                                            text-[#111]
                                            sm:text-[28px]
                                        "
                                    >
                                        {{ __('project_detail.technologies.title_line1') }}
                                        <br class="hidden sm:block">
                                        {{ __('project_detail.technologies.title_line2') }}
                                    </h2>
                                </div>
                                <span
                                    class="
                                        hidden
                                        text-[9px]
                                        uppercase
                                        tracking-[0.18em]
                                        text-black/25
                                        sm:block
                                    "
                                >
                                    {{ count($project->technologies) }}
                                    {{ __('project_detail.technologies.count_label') }}
                                </span>
                            </div>
                            <div
                                class="
                                    mt-8
                                    grid
                                    grid-cols-1
                                    gap-2.5
                                    sm:grid-cols-2
                                "
                            >
                                @foreach($project->technologies as $index => $technology)
                                    <div
                                        class="
                                            technology-item
                                            group
                                            flex
                                            items-center
                                            justify-between
                                            rounded-[16px]
                                            border
                                            border-black/[0.07]
                                            bg-white/45
                                            px-5
                                            py-4
                                            hover:border-black/[0.12]
                                            hover:bg-white
                                        "
                                    >
                                        <div class="flex items-center gap-4">
                                            <span
                                                class="
                                                    flex
                                                    h-7
                                                    w-7
                                                    shrink-0
                                                    items-center
                                                    justify-center
                                                    rounded-full
                                                    bg-black/[0.04]
                                                    text-[8px]
                                                    font-medium
                                                    text-black/35
                                                "
                                            >
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                            <span
                                                class="
                                                    text-[12px]
                                                    font-medium
                                                    text-black/65
                                                    transition-colors
                                                    group-hover:text-black
                                                "
                                            >
                                                {{ $technology }}
                                            </span>
                                        </div>
                                        <span
                                            class="
                                                h-[5px]
                                                w-[5px]
                                                shrink-0
                                                rounded-full
                                                bg-black/20
                                                transition
                                                group-hover:bg-black
                                            "
                                        ></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- ================================================= --}}
            {{-- RIGHT SIDEBAR --}}
            {{-- ================================================= --}}
            <aside class="project-detail-reveal">
                <div
                    class="
                        space-y-6
                        lg:sticky
                        lg:top-28
                    "
                >
                    {{-- ================================================= --}}
                    {{-- PROJECT LINKS --}}
                    {{-- ================================================= --}}
                    <div
                        class="
                            border-t
                            border-black/[0.08]
                            pt-6
                        "
                    >
                        <p
                            class="
                                text-[8px]
                                font-medium
                                uppercase
                                tracking-[0.18em]
                                text-black/30
                            "
                        >
                            {{ __('project_detail.links.eyebrow') }}
                        </p>
                        <div class="mt-6 space-y-3">
                            @if($project->project_url)
                                <a
                                    href="{{ $project->project_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="
                                        project-link
                                        group
                                        flex
                                        items-center
                                        justify-between
                                        rounded-full
                                        bg-[#111]
                                        px-5
                                        py-3.5
                                        text-[10px]
                                        font-medium
                                        text-white
                                        hover:-translate-y-0.5
                                    "
                                >
                                    {{ __('project_detail.links.live') }}
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="
                                            h-4
                                            w-4
                                            transition-transform
                                            duration-300
                                            group-hover:translate-x-0.5
                                            group-hover:-translate-y-0.5
                                        "
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path d="M7 17 17 7"/>
                                        <path d="M8 7h9v9"/>
                                    </svg>
                                </a>
                            @endif
                            @if($project->github_url)
                                <a
                                    href="{{ $project->github_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="
                                        project-link
                                        group
                                        flex
                                        items-center
                                        justify-between
                                        rounded-full
                                        border
                                        border-black/[0.08]
                                        bg-white/55
                                        px-5
                                        py-3.5
                                        text-[10px]
                                        font-medium
                                        text-black/60
                                        hover:border-black/15
                                        hover:bg-white
                                        hover:text-black
                                    "
                                >
                                    GitHub
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="
                                            h-4
                                            w-4
                                            transition-transform
                                            duration-300
                                            group-hover:translate-x-0.5
                                            group-hover:-translate-y-0.5
                                        "
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path d="M7 17 17 7"/>
                                        <path d="M8 7h9v9"/>
                                    </svg>
                                </a>
                            @endif
                            @if(
                                !$project->project_url
                                &&
                                !$project->github_url
                            )
                                <p
                                    class="
                                        text-[11px]
                                        leading-6
                                        text-black/35
                                    "
                                >
                                    {{ __('project_detail.links.empty') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    {{-- ================================================= --}}
                    {{-- CONTACT CARD --}}
                    {{-- ================================================= --}}
                    <div
                        class="
                            contact-card
                            rounded-[26px]
                            bg-[#111]
                            p-6
                            text-white
                            shadow-[0_22px_60px_rgba(0,0,0,0.10)]
                        "
                    >
                        <div class="relative z-10">
                            {{-- TOP --}}
                            <div
                                class="
                                    flex
                                    items-center
                                    justify-between
                                "
                            >
                                <span
                                    class="
                                        text-[8px]
                                        font-medium
                                        uppercase
                                        tracking-[0.18em]
                                        text-white/35
                                    "
                                >
                                    {{ __('project_detail.contact.eyebrow') }}
                                </span>
                                <span
                                    class="
                                        h-[6px]
                                        w-[6px]
                                        rounded-full
                                        bg-white
                                    "
                                ></span>
                            </div>
                            {{-- TITLE --}}
                            <h3
                                class="
                                    mt-5
                                    text-[25px]
                                    font-medium
                                    leading-[1.08]
                                    tracking-[-0.045em]
                                    text-white
                                "
                            >
                                {{ __('project_detail.contact.title_line1') }}
                                <br>
                                {{ __('project_detail.contact.title_line2') }}
                            </h3>
                            {{-- DESCRIPTION --}}
                            <p
                                class="
                                    mt-4
                                    max-w-[255px]
                                    text-[11px]
                                    leading-5
                                    text-white/45
                                "
                            >
                                {{ __('project_detail.contact.description') }}
                            </p>
                            {{-- ================================================= --}}
                            {{-- CTA BUTTON --}}
                            {{-- ================================================= --}}
                            <a
                                href="{{ $contactUrl }}"
                                class="
                                    contact-cta
                                    group
                                    mt-6
                                    flex
                                    w-full
                                    items-center
                                    justify-between
                                    rounded-full
                                    bg-white
                                    px-4
                                    py-3
                                    pl-5
                                    text-[10px]
                                    font-semibold
                                    text-black
                                    hover:-translate-y-0.5
                                    hover:bg-white/90
                                "
                            >
                                <span>
                                    {{ __('project_detail.contact.button') }}
                                </span>
                                <span
                                    class="
                                        flex
                                        h-8
                                        w-8
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-full
                                        bg-[#111]
                                        text-white
                                        transition-transform
                                        duration-300
                                        group-hover:translate-x-0.5
                                    "
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="h-3.5 w-3.5"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <path d="M5 12h14"/>
                                        <path d="m14 7 5 5-5 5"/>
                                    </svg>
                                </span>
                            </a>
                            {{-- ================================================= --}}
                            {{-- CONTACT INFO --}}
                            {{-- ================================================= --}}
                            @if($phone || $email)
                                <div
                                    class="
                                        mt-7
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
                                        {{ __('project_detail.contact.direct') }}
                                    </span>
                                    <div class="mt-4 space-y-2">
                                        @if($phone)
                                            <a
                                                href="tel:{{ preg_replace('/\s+/', '', $phone) }}"
                                                class="
                                                    contact-row
                                                    group
                                                    flex
                                                    items-center
                                                    justify-between
                                                    rounded-[14px]
                                                    border
                                                    border-white/[0.08]
                                                    bg-white/[0.04]
                                                    px-4
                                                    py-3.5
                                                    hover:border-white/[0.16]
                                                    hover:bg-white/[0.07]
                                                "
                                            >
                                                <div>
                                                    <span
                                                        class="
                                                            block
                                                            text-[7px]
                                                            uppercase
                                                            tracking-[0.16em]
                                                            text-white/25
                                                        "
                                                    >
                                                        {{ __('project_detail.contact.phone') }}
                                                    </span>
                                                    <span
                                                        class="
                                                            mt-1
                                                            block
                                                            text-[11px]
                                                            font-medium
                                                            text-white/80
                                                        "
                                                    >
                                                        {{ $phone }}
                                                    </span>
                                                </div>
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    class="
                                                        h-4
                                                        w-4
                                                        shrink-0
                                                        text-white/30
                                                        transition
                                                        group-hover:text-white
                                                    "
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                >
                                                    <path d="M7 17 17 7"/>
                                                    <path d="M8 7h9v9"/>
                                                </svg>
                                            </a>
                                        @endif
                                        @if($email)
                                            <a
                                                href="mailto:{{ $email }}"
                                                class="
                                                    contact-row
                                                    group
                                                    flex
                                                    items-center
                                                    justify-between
                                                    rounded-[14px]
                                                    border
                                                    border-white/[0.08]
                                                    bg-white/[0.04]
                                                    px-4
                                                    py-3.5
                                                    hover:border-white/[0.16]
                                                    hover:bg-white/[0.07]
                                                "
                                            >
                                                <div class="min-w-0 pr-4">
                                                    <span
                                                        class="
                                                            block
                                                            text-[7px]
                                                            uppercase
                                                            tracking-[0.16em]
                                                            text-white/25
                                                        "
                                                    >
                                                        {{ __('project_detail.contact.email') }}
                                                    </span>
                                                    <span
                                                        class="
                                                            mt-1
                                                            block
                                                            truncate
                                                            text-[11px]
                                                            font-medium
                                                            text-white/80
                                                        "
                                                    >
                                                        {{ $email }}
                                                    </span>
                                                </div>
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    class="
                                                        h-4
                                                        w-4
                                                        shrink-0
                                                        text-white/30
                                                        transition
                                                        group-hover:text-white
                                                    "
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
                            {{-- ================================================= --}}
                            {{-- SOCIAL MEDIA --}}
                            {{-- ================================================= --}}
                            @if($socialLinks->isNotEmpty())
                                <div
                                    class="
                                        mt-7
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
                                        {{ __('project_detail.contact.social') }}
                                    </span>
                                    <div
                                        class="
                                            mt-4
                                            flex
                                            flex-wrap
                                            gap-2
                                        "
                                    >
                                        @foreach($socialLinks as $social)
                                            <a
                                                href="{{ $social['url'] }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="
                                                    rounded-full
                                                    border
                                                    border-white/[0.10]
                                                    px-3
                                                    py-2
                                                    text-[8px]
                                                    font-medium
                                                    text-white/50
                                                    transition-all
                                                    duration-300
                                                    hover:-translate-y-0.5
                                                    hover:border-white/25
                                                    hover:bg-white
                                                    hover:text-black
                                                "
                                            >
                                                {{ $social['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            {{-- STATUS --}}
                            <div
                                class="
                                    mt-7
                                    flex
                                    items-center
                                    gap-3
                                    border-t
                                    border-white/[0.08]
                                    pt-5
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
                                        text-[7px]
                                        uppercase
                                        tracking-[0.16em]
                                        text-white/30
                                    "
                                >
                                    {{ __('project_detail.contact.status') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- BOTTOM NAVIGATION --}}
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
            project-detail-reveal
            mx-auto
            max-w-[1400px]
            border-t
            border-black/[0.08]
            pt-8
        "
    >
        <div
            class="
                flex
                flex-col
                gap-6
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
        >
            <div>
                <p
                    class="
                        text-[8px]
                        font-medium
                        uppercase
                        tracking-[0.17em]
                        text-black/28
                    "
                >
                    {{ __('project_detail.bottom.eyebrow') }}
                </p>
                <p
                    class="
                        mt-2
                        text-[18px]
                        font-medium
                        tracking-[-0.025em]
                        text-black
                    "
                >
                    {{ __('project_detail.bottom.title') }}
                </p>
            </div>
            <a
                href="{{ $projectsUrl }}"
                class="
                    group
                    inline-flex
                    w-fit
                    items-center
                    gap-4
                    rounded-full
                    bg-[#111]
                    px-6
                    py-4
                    text-[10px]
                    font-medium
                    text-white
                    transition-all
                    duration-300
                    hover:-translate-y-0.5
                "
            >
                {{ __('project_detail.bottom.button') }}
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
            '.project-detail-reveal'
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
                element.classList.add(
                    'is-visible'
                );
            }
        );
    }
});
</script>
@endsection
