<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @php
        /*
        |--------------------------------------------------------------------------
        | GLOBAL SETTINGS + LOCALE
        |--------------------------------------------------------------------------
        */
        try {
            $siteSettings = $settings
                ?? \App\Models\Setting::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            $siteSettings = $settings ?? [];
        }

        $siteName = trim($siteSettings['site_name'] ?? 'Portfolio');
        $seoTitle = trim($siteSettings['seo_title'] ?? $siteName);
        $metaDescription = trim(
            $siteSettings['meta_description']
            ?? 'Modern web tasarım, yazılım ve dijital çözümler.'
        );

        $currentLocale = app()->getLocale();
        $isEnglish = $currentLocale === 'en';
        $htmlLang = $isEnglish ? 'en' : 'tr';
        $schemaLanguage = $isEnglish ? 'en-US' : 'tr-TR';
        $ogLocale = $isEnglish ? 'en_US' : 'tr_TR';
        $ogAlternateLocale = $isEnglish ? 'tr_TR' : 'en_US';

        /*
        |--------------------------------------------------------------------------
        | ROUTES + LOCALIZED URLS
        |--------------------------------------------------------------------------
        */
        $currentRouteName = request()->route()?->getName() ?? 'home';

        $baseRouteName = \Illuminate\Support\Str::startsWith($currentRouteName, 'en.')
            ? \Illuminate\Support\Str::after($currentRouteName, 'en.')
            : $currentRouteName;

        $localizedFrontendRoutes = [
            'home',
            'about',
            'services.index',
            'contact',
            'news.index',
            'news.show',
            'projects.index',
            'projects.show',
            'references.index',
            'legal',
        ];

        $currentRouteParameters = request()->route()?->parameters() ?? [];
        unset($currentRouteParameters['locale']);

        $canLocalizeCurrentRoute = in_array(
            $baseRouteName,
            $localizedFrontendRoutes,
            true
        );

        $trUrl = $canLocalizeCurrentRoute
            ? route($baseRouteName, $currentRouteParameters)
            : route('home');

        $enUrl = $canLocalizeCurrentRoute
            ? route(
                'en.' . $baseRouteName,
                array_merge(['locale' => 'en'], $currentRouteParameters)
            )
            : route('en.home', ['locale' => 'en']);

        $switchLocaleUrl = $isEnglish ? $trUrl : $enUrl;

        $homeUrl = $isEnglish
            ? route('en.home', ['locale' => 'en'])
            : route('home');

        $aboutUrl = $isEnglish
            ? route('en.about', ['locale' => 'en'])
            : route('about');

        $servicesUrl = $isEnglish
            ? route('en.services.index', ['locale' => 'en'])
            : route('services.index');

        $projectsUrl = $isEnglish
            ? route('en.projects.index', ['locale' => 'en'])
            : route('projects.index');

        $newsUrl = $isEnglish
            ? route('en.news.index', ['locale' => 'en'])
            : route('news.index');

        $referencesUrl = $isEnglish
            ? route('en.references.index', ['locale' => 'en'])
            : route('references.index');

        $contactUrl = $isEnglish
            ? route('en.contact', ['locale' => 'en'])
            : route('contact');

        $legalRouteName = $isEnglish ? 'en.legal' : 'legal';
        $legalRouteParameters = $isEnglish ? ['locale' => 'en'] : [];
        $isHome = $baseRouteName === 'home';

        /*
        |--------------------------------------------------------------------------
        | PAGE SEO
        |--------------------------------------------------------------------------
        | Child views can override:
        | title, meta_description, canonical, robots, og_type, og_image,
        | og_image_alt, published_time, modified_time
        */
        $pageTitle = trim(strip_tags(
            $__env->yieldContent('title', $seoTitle)
        ));

        $pageDescription = trim(preg_replace(
            '/\s+/u',
            ' ',
            strip_tags($__env->yieldContent('meta_description', $metaDescription))
        ));

        $pageCanonical = trim(
            $__env->yieldContent('canonical', url()->current())
        );

        if ($canLocalizeCurrentRoute) {
            $pageCanonical = $isEnglish ? $enUrl : $trUrl;
        }

        $pageRobots = trim(
            $__env->yieldContent(
                'robots',
                'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
            )
        );

        $pageOgType = trim($__env->yieldContent('og_type', 'website'));
        $pagePublishedTime = trim($__env->yieldContent('published_time', ''));
        $pageModifiedTime = trim($__env->yieldContent('modified_time', ''));

        /*
        |--------------------------------------------------------------------------
        | PRIVATE / ADMIN PAGES
        |--------------------------------------------------------------------------
        */
        if (
            request()->is(
                'admin',
                'admin/*',
                'login',
                'register',
                'forgot-password',
                'reset-password/*',
                'dashboard',
                'profile',
                'profile/*'
            )
        ) {
            $pageRobots = 'noindex, nofollow, noarchive';
        }

        /*
        |--------------------------------------------------------------------------
        | SOCIAL SHARE IMAGE
        |--------------------------------------------------------------------------
        */
        $defaultOgImagePath =
            $siteSettings['og_image']
            ?? $siteSettings['seo_image']
            ?? $siteSettings['site_logo']
            ?? null;

        $defaultOgImage = $defaultOgImagePath
            ? asset('storage/' . ltrim($defaultOgImagePath, '/'))
            : null;

        $customOgImage = trim($__env->yieldContent('og_image', ''));

        if (!empty($customOgImage)) {
            $pageOgImage = \Illuminate\Support\Str::startsWith(
                $customOgImage,
                ['http://', 'https://']
            )
                ? $customOgImage
                : url('/' . ltrim($customOgImage, '/'));
        } else {
            $pageOgImage = $defaultOgImage;
        }

        $pageOgImageAlt = trim(
            strip_tags($__env->yieldContent('og_image_alt', $pageTitle))
        );

        /*
        |--------------------------------------------------------------------------
        | STRUCTURED DATA
        |--------------------------------------------------------------------------
        */
        $sameAs = array_values(array_filter([
            $siteSettings['github_url'] ?? null,
            $siteSettings['linkedin_url'] ?? null,
            $siteSettings['instagram_url'] ?? null,
        ]));

        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => $homeUrl,
            'name' => $siteName,
            'inLanguage' => $schemaLanguage,
        ];

        $personSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            '@id' => url('/') . '#person',
            'name' => $siteName,
            'url' => $homeUrl,
        ];

        if (!empty($sameAs)) {
            $personSchema['sameAs'] = $sameAs;
        }

        if (!empty($siteSettings['contact_email'])) {
            $personSchema['email'] = 'mailto:' . $siteSettings['contact_email'];
        }

        $webPageSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            '@id' => $pageCanonical . '#webpage',
            'url' => $pageCanonical,
            'name' => $pageTitle,
            'description' => $pageDescription,
            'isPartOf' => [
                '@id' => url('/') . '#website',
            ],
            'about' => [
                '@id' => url('/') . '#person',
            ],
            'inLanguage' => $schemaLanguage,
        ];

        if (!empty($pageOgImage)) {
            $webPageSchema['primaryImageOfPage'] = [
                '@type' => 'ImageObject',
                'url' => $pageOgImage,
            ];
        }

        $breadcrumbSchema = null;

        if (!$isHome && $canLocalizeCurrentRoute) {
            $breadcrumbSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => $isEnglish ? 'Home' : 'Ana Sayfa',
                        'item' => $homeUrl,
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => $pageTitle,
                        'item' => $pageCanonical,
                    ],
                ],
            ];
        }

        $articleSchema = null;

        if ($pageOgType === 'article') {
            $articleSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $pageTitle,
                'description' => $pageDescription,
                'mainEntityOfPage' => [
                    '@id' => $pageCanonical . '#webpage',
                ],
                'author' => [
                    '@id' => url('/') . '#person',
                ],
                'publisher' => [
                    '@id' => url('/') . '#person',
                ],
                'inLanguage' => $schemaLanguage,
            ];

            if (!empty($pageOgImage)) {
                $articleSchema['image'] = [$pageOgImage];
            }

            if (!empty($pagePublishedTime)) {
                $articleSchema['datePublished'] = $pagePublishedTime;
            }

            if (!empty($pageModifiedTime)) {
                $articleSchema['dateModified'] = $pageModifiedTime;
            }
        }
    @endphp

    {{-- BASIC META --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="robots" content="{{ $pageRobots }}">
    <meta name="googlebot" content="{{ $pageRobots }}">
    <meta name="bingbot" content="{{ $pageRobots }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="theme-color" content="#070707">
    <meta name="color-scheme" content="light">
    <meta name="format-detection" content="telephone=no">

    <title>{{ $pageTitle }}</title>

    {{-- CANONICAL / LANGUAGE --}}
    <link rel="canonical" href="{{ $pageCanonical }}">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">

    @if($canLocalizeCurrentRoute)
        <link rel="alternate" hreflang="tr-TR" href="{{ $trUrl }}">
        <link rel="alternate" hreflang="en" href="{{ $enUrl }}">
        <link rel="alternate" hreflang="x-default" href="{{ $trUrl }}">
    @endif

    {{-- OPEN GRAPH --}}
    <meta property="og:locale" content="{{ $ogLocale }}">
    <meta property="og:locale:alternate" content="{{ $ogAlternateLocale }}">
    <meta property="og:type" content="{{ $pageOgType }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $pageCanonical }}">

    @if(!empty($pageOgImage))
        <meta property="og:image" content="{{ $pageOgImage }}">
        <meta property="og:image:secure_url" content="{{ $pageOgImage }}">
        <meta property="og:image:alt" content="{{ $pageOgImageAlt }}">
    @endif

    @if($pageOgType === 'article' && !empty($pagePublishedTime))
        <meta property="article:published_time" content="{{ $pagePublishedTime }}">
    @endif

    @if($pageOgType === 'article' && !empty($pageModifiedTime))
        <meta property="article:modified_time" content="{{ $pageModifiedTime }}">
    @endif

    {{-- TWITTER / X --}}
    <meta name="twitter:card" content="{{ !empty($pageOgImage) ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:url" content="{{ $pageCanonical }}">

    @if(!empty($pageOgImage))
        <meta name="twitter:image" content="{{ $pageOgImage }}">
        <meta name="twitter:image:alt" content="{{ $pageOgImageAlt }}">
    @endif

    {{-- FAVICON --}}
    @if(!empty($siteSettings['favicon']))
        <link rel="icon" href="{{ asset('storage/' . $siteSettings['favicon']) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $siteSettings['favicon']) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif

    {{-- STRUCTURED DATA --}}
    <script type="application/ld+json">
        {!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @if($breadcrumbSchema)
        <script type="application/ld+json">
            {!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endif

    @if($articleSchema)
        <script type="application/ld+json">
            {!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endif

    {{-- FONTS / ASSETS --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    rel="preload"
    as="style"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    onload="this.onload=null;this.rel='stylesheet'"
>

<noscript>
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    >
</noscript>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('head')

    <style>

        /* =========================================================
           GLOBAL FONT
        ========================================================= */

        html,
        body,
        button,
        input,
        textarea,
        select,
        option {
            font-family: 'Poppins', sans-serif;
        }

        .font-sans {
            font-family: 'Poppins', sans-serif !important;
        }

        :root {
            --portfolio-purple: #111111;
            --portfolio-paper: #F3F4F5;
            --portfolio-dark: #080808;
            --portfolio-text: #111111;
        }

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        #siteHeader {
            background: #070707;

            overflow: hidden;

            border-bottom-left-radius: 48px;
            border-bottom-right-radius: 48px;

            transform: translateY(0);

            box-shadow:
                0 10px 34px rgba(0, 0, 0, .10),
                inset 0 -1px 0 rgba(255, 255, 255, .04);

            transition:
                transform .38s cubic-bezier(.22, 1, .36, 1),
                background-color .35s ease,
                backdrop-filter .35s ease,
                box-shadow .35s ease,
                border-radius .35s ease;

            will-change: transform;
        }

        #siteHeader.is-hidden {
            transform: translateY(calc(-100% - 14px));
        }

        #siteHeader.is-scrolled {
            background: rgba(7, 7, 7, .96);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            box-shadow:
                0 18px 45px rgba(0, 0, 0, .16),
                inset 0 -1px 0 rgba(255, 255, 255, .05);
        }

        /*
        |--------------------------------------------------------------------------
        | FULLSCREEN MENU
        |--------------------------------------------------------------------------
        */

        #siteMenu {
            visibility: hidden;
            opacity: 0;
            pointer-events: none;

            background:
                linear-gradient(
                    180deg,
                    #f6f6f6 0%,
                    #f1f1f1 100%
                );

            transition:
                opacity .38s cubic-bezier(.22, 1, .36, 1),
                visibility .38s;
        }

        #siteMenu.is-open {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }

        /*
        |--------------------------------------------------------------------------
        | MENU CONTENT ENTER
        |--------------------------------------------------------------------------
        */

        .menu-panel-left,
        .menu-panel-right {
            opacity: 0;

            transform:
                translateY(18px);

            transition:
                opacity .55s cubic-bezier(.22, 1, .36, 1),
                transform .55s cubic-bezier(.22, 1, .36, 1);
        }

        #siteMenu.is-open .menu-panel-left,
        #siteMenu.is-open .menu-panel-right {
            opacity: 1;

            transform:
                translateY(0);
        }

        #siteMenu.is-open .menu-panel-right {
            transition-delay: .06s;
        }

        /*
        |--------------------------------------------------------------------------
        | MENU LINKS
        |--------------------------------------------------------------------------
        */

        .menu-link {
            color: rgba(17, 17, 17, .27);

            transition:
                color .28s ease,
                transform .28s cubic-bezier(.22, 1, .36, 1),
                opacity .28s ease;
        }

        .menu-link:hover,
        .menu-link.is-active {
            color: #111;

            transform:
                translateX(8px);
        }

        .menu-links:hover .menu-link:not(:hover) {
            color: rgba(17, 17, 17, .12);
        }

        .menu-link-dot {
            opacity: 0;
            transform: scale(.65);

            transition:
                opacity .28s ease,
                transform .28s cubic-bezier(.22, 1, .36, 1);
        }

        .menu-link:hover .menu-link-dot,
        .menu-link.is-active .menu-link-dot {
            opacity: 1;
            transform: scale(1);
        }

        .menu-visual-card {
            opacity: 0;
            pointer-events: none;

            transform:
                translateY(14px)
                scale(.985);

            transition:
                opacity .4s ease,
                transform .65s cubic-bezier(.22, 1, .36, 1);
        }

        .menu-visual-card.is-active {
            opacity: 1;
            pointer-events: auto;

            transform:
                translateY(0)
                scale(1);
        }

        .menu-visual-float {
            transition:
                transform .7s cubic-bezier(.22, 1, .36, 1),
                box-shadow .4s ease;
        }

        .menu-visual-card.is-active .menu-visual-float:nth-child(odd) {
            transform: translateY(-4px);
        }

        .menu-visual-card.is-active .menu-visual-float:nth-child(even) {
            transform: translateY(3px);
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        #menuPreviewImage {
            transition:
                opacity .35s ease,
                transform .65s cubic-bezier(.22, 1, .36, 1);
        }

        /*
        |--------------------------------------------------------------------------
        | TEXT PREVIEW
        |--------------------------------------------------------------------------
        */

        #menuPreviewTitle,
        #menuPreviewDescription {
            transition:
                opacity .22s ease;
        }

        /*
        |--------------------------------------------------------------------------
        | MENU OPEN HEADER
        |--------------------------------------------------------------------------
        */

        body.menu-open #siteHeader {
            background:
                #070707 !important;

            backdrop-filter:
                none !important;

            -webkit-backdrop-filter:
                none !important;

            box-shadow:
                0 10px 34px rgba(0, 0, 0, .10) !important;

            transform:
                translateY(0) !important;
        }

        body.menu-open {
            overflow:
                hidden;
        }

        /*
        |--------------------------------------------------------------------------
        | REDUCED MOTION
        |--------------------------------------------------------------------------
        */

        @media (prefers-reduced-motion: reduce) {

            #siteMenu,
            .menu-panel-left,
            .menu-panel-right,
            .menu-link,
                transition:
                    none !important;
            }

        }

        @media (max-width: 640px) {
            #siteHeader {
                border-bottom-left-radius: 34px;
                border-bottom-right-radius: 34px;
            }
        }

        /* =========================================================
           PREMIUM FOOTER
        ========================================================= */

        .premium-footer {
            position: relative;
            isolation: isolate;
        }

        .premium-footer::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: -2;

            background:
                radial-gradient(
                    circle at 50% 105%,
                    rgba(255, 255, 255, .10),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 50% 50%,
                    rgba(255, 255, 255, .025),
                    transparent 46%
                );
        }

        .premium-footer::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -150px;

            width: min(940px, 86vw);
            height: 260px;

            transform: translateX(-50%);
            border-radius: 50%;
            border-top: 1px solid rgba(255, 255, 255, .10);

            box-shadow:
                0 -20px 70px rgba(255, 255, 255, .045),
                0 -2px 18px rgba(255, 255, 255, .035);

            pointer-events: none;
            z-index: -1;
        }

        .footer-glow-line {
            position: relative;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, .10) 18%,
                    rgba(255, 255, 255, .32) 50%,
                    rgba(255, 255, 255, .10) 82%,
                    transparent
                );
        }

        .footer-glow-line::after {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;

            width: 92px;
            height: 22px;

            transform: translate(-50%, -50%);
            border-radius: 50%;

            background: rgba(255, 255, 255, .15);
            filter: blur(18px);
        }

        .footer-social {
            transition:
                transform .35s cubic-bezier(.22, 1, .36, 1),
                border-color .35s ease,
                background-color .35s ease,
                color .35s ease,
                box-shadow .35s ease;
        }

        .footer-social:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, .24);
            background: rgba(255, 255, 255, .08);
            color: #fff;

            box-shadow:
                0 14px 34px rgba(0, 0, 0, .25),
                inset 0 1px 0 rgba(255, 255, 255, .06);
        }

    </style>

    @stack('styles')

</head>

<body
    class="
        min-h-screen
        bg-[#F7F5F1]
        text-slate-800
        antialiased
        selection:bg-black
        selection:text-white
    "
>

<div class="flex min-h-screen flex-col">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <header
        id="siteHeader"
        class="
            fixed
            inset-x-0
            top-0
            z-50
        "
    >

        <div
            class="
                mx-auto
                flex
                h-[84px]
                max-w-[1440px]
                items-center
                justify-between
                px-6
                lg:px-10
            "
        >

            {{-- ================================================= --}}
            {{-- LOGO --}}
            {{-- ================================================= --}}

            <a
                href="{{ $homeUrl }}"
                class="
                    relative
                    z-[70]
                    flex
                    items-center
                "
                aria-label="{{ $siteName }}"
            >

                @if(!empty($siteSettings['site_logo']))

                    <img
                        id="siteLogoImage"
                        src="{{ asset('storage/' . $siteSettings['site_logo']) }}"
                        alt="{{ $siteName }}"
                        class="
                            h-auto
                            w-auto
                            max-h-[48px]
                            max-w-[220px]
                            object-contain
                            brightness-0
                            invert
                            transition
                            duration-300
                            sm:max-h-[52px]
                            sm:max-w-[250px]
                            lg:max-h-[58px]
                            lg:max-w-[290px]
                        "
                    >

                @else

                    <span
                        id="siteLogoText"
                        class="
                            flex
                            items-center
                            gap-1.5
                            text-[12px]
                            font-semibold
                            uppercase
                            tracking-[0.08em]
                            text-white
                            transition
                            duration-300
                        "
                    >

                        {{ $siteName }}

                        <span
                            class="
                                h-[6px]
                                w-[6px]
                                rounded-full
                                bg-white
                                shadow-[0_0_12px_rgba(255,255,255,.22)]
                            "
                        ></span>

                    </span>

                @endif

            </a>

            {{-- ================================================= --}}
            {{-- MENU BUTTON --}}
            {{-- ================================================= --}}

            <div class="relative z-[70] flex items-center gap-3">

                <div
                    id="languageSwitcher"
                    class="
                        relative
                        hidden
                        h-[34px]
                        w-[86px]
                        grid-cols-2
                        items-center
                        rounded-full
                        border
                        border-white/10
                        bg-white/[0.04]
                        p-[3px]
                        sm:grid
                    "
                    data-language="{{ $isEnglish ? 'en' : 'tr' }}"
                    aria-label="{{ __('site.language.label') }}"
                >
                    <span
                        id="languageSwitcherThumb"
                        class="
                            pointer-events-none
                            absolute
                            left-[3px]
                            top-[3px]
                            h-[28px]
                            w-[40px]
                            rounded-full
                            bg-white
                            shadow-[0_3px_12px_rgba(0,0,0,.18)]
                            transition-transform
                            duration-300
                            ease-[cubic-bezier(.22,1,.36,1)]
                        "
                        style="transform: translateX({{ $isEnglish ? '40px' : '0px' }});"
                    ></span>

                    <a
                        href="{{ $trUrl }}"
                        data-language-target="tr"
                        class="
                            relative
                            z-10
                            flex
                            h-[28px]
                            w-[40px]
                            items-center
                            justify-center
                            rounded-full
                            text-center
                            text-[9px]
                            font-semibold
                            leading-none
                            tracking-[0.08em]
                            transition-colors
                            duration-200
                            {{ !$isEnglish ? 'text-black' : 'text-white/45 hover:text-white' }}
                        "
                    >
                        TR
                    </a>

                    <a
                        href="{{ $enUrl }}"
                        data-language-target="en"
                        class="
                            relative
                            z-10
                            flex
                            h-[28px]
                            w-[40px]
                            items-center
                            justify-center
                            rounded-full
                            text-center
                            text-[9px]
                            font-semibold
                            leading-none
                            tracking-[0.08em]
                            transition-colors
                            duration-200
                            {{ $isEnglish ? 'text-black' : 'text-white/45 hover:text-white' }}
                        "
                    >
                        EN
                    </a>
                </div>

            <button
                type="button"
                id="menuButton"
                class="
                    relative
                    z-[70]
                    flex
                    h-10
                    w-10
                    items-center
                    justify-center
                    text-white/70
                    transition
                    duration-300
                    hover:text-white
                "
                aria-label="{{ __('site.actions.open_menu') }}"
                aria-expanded="false"
            >

                <div
                    class="
                        relative
                        h-[18px]
                        w-[22px]
                    "
                >

                    <span
                        id="menuLine1"
                        class="
                            absolute
                            left-0
                            top-[2px]
                            block
                            h-[1.5px]
                            w-[22px]
                            bg-current
                            transition-all
                            duration-300
                        "
                    ></span>

                    <span
                        id="menuLine2"
                        class="
                            absolute
                            left-0
                            top-[8px]
                            block
                            h-[1.5px]
                            w-[22px]
                            bg-current
                            transition-all
                            duration-300
                        "
                    ></span>

                    <span
                        id="menuLine3"
                        class="
                            absolute
                            left-0
                            top-[14px]
                            block
                            h-[1.5px]
                            w-[22px]
                            bg-current
                            transition-all
                            duration-300
                        "
                    ></span>

                </div>

            </button>

            </div>

        </div>

    </header>

    {{-- ========================================================= --}}
    {{-- FULLSCREEN MENU --}}
    {{-- ========================================================= --}}

    <div
        id="siteMenu"
        class="
            fixed
            inset-0
            z-40
            overflow-hidden
        "
    >

        {{-- ===================================================== --}}
        {{-- BACKGROUND DETAILS --}}
        {{-- ===================================================== --}}

        <div
            class="
                pointer-events-none
                absolute
                -left-[280px]
                top-[25%]
                h-[660px]
                w-[660px]
                rounded-full
                bg-black/[0.035]
                blur-[190px]
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                right-[2%]
                top-[22%]
                h-[520px]
                w-[520px]
                rounded-full
                bg-black/[0.025]
                blur-[190px]
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                bottom-[-270px]
                left-1/2
                h-[480px]
                w-[960px]
                -translate-x-1/2
                rounded-full
                bg-white/70
                blur-[190px]
            "
        ></div>

        {{-- ===================================================== --}}
        {{-- MAIN MENU --}}
        {{-- ===================================================== --}}

        <div
            class="
                relative
                mx-auto
                flex
                min-h-screen
                max-w-[1380px]
                items-center
                px-6
                pb-16
                pt-[104px]
                lg:px-10
            "
        >

            <div
                class="
                    grid
                    w-full
                    grid-cols-1
                    items-center
                    gap-16
                    lg:grid-cols-[0.82fr_1.18fr]
                    lg:gap-24
                "
            >

                {{-- ================================================= --}}
                {{-- LEFT --}}
                {{-- ================================================= --}}

                <div class="menu-panel-left">

                    <div
                        class="
                            mb-9
                            flex
                            items-center
                            gap-4
                        "
                    >

                        <span
                            class="
                                block
                                h-px
                                w-10
                                bg-black/20
                            "
                        ></span>

                        <p
                            class="
                                text-[10px]
                                font-semibold
                                uppercase
                                tracking-[0.3em]
                                text-black/35
                            "
                        >
                            {{ __('site.menu.label') }}
                        </p>

                    </div>

                    <nav
                        class="
                            menu-links
                            space-y-[1px]
                        "
                    >

                        <a
                            href="{{ $homeUrl }}"
                            data-menu-type="home"
                            data-menu-title="{{ __('site.menu.home') }}"
                            data-menu-description="{{ __('site.menu_desc.home') }}"
                            class="
                                menu-link
                                {{ $baseRouteName === 'home' ? 'is-active' : '' }}
                                block
                                w-fit
                                text-[38px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.045em]
                                md:text-[50px]
                                lg:text-[55px]
                            "
                        >
                            <span class="inline-flex items-center gap-3">
                                <span>{{ __('site.menu.home') }}</span>
                                <span class="menu-link-dot h-[7px] w-[7px] rounded-full bg-black"></span>
                            </span>
                        </a>

                        <a
                            href="{{ $aboutUrl }}"
                            data-menu-type="about"
                            data-menu-title="{{ __('site.menu.about') }}"
                            data-menu-description="{{ __('site.menu_desc.about') }}"
                            class="
                                menu-link
                                {{ $baseRouteName === 'about' ? 'is-active' : '' }}
                                block
                                w-fit
                                text-[38px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.045em]
                                md:text-[50px]
                                lg:text-[55px]
                            "
                        >
                            <span class="inline-flex items-center gap-3">
                                <span>{{ __('site.menu.about') }}</span>
                                <span class="menu-link-dot h-[7px] w-[7px] rounded-full bg-black"></span>
                            </span>
                        </a>

                        <a
                            href="{{ $servicesUrl }}"
                            data-menu-type="services"
                            data-menu-title="{{ __('site.menu.services') }}"
                            data-menu-description="{{ __('site.menu_desc.services') }}"
                            class="
                                menu-link
                                {{ \Illuminate\Support\Str::startsWith($baseRouteName, 'services.') ? 'is-active' : '' }}
                                block
                                w-fit
                                text-[38px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.045em]
                                md:text-[50px]
                                lg:text-[55px]
                            "
                        >
                            <span class="inline-flex items-center gap-3">
                                <span>{{ __('site.menu.services') }}</span>
                                <span class="menu-link-dot h-[7px] w-[7px] rounded-full bg-black"></span>
                            </span>
                        </a>

                        <a
                            href="{{ $projectsUrl }}"
                            data-menu-type="projects"
                            data-menu-title="{{ __('site.menu.projects') }}"
                            data-menu-description="{{ __('site.menu_desc.projects') }}"
                            class="
                                menu-link
                                {{ \Illuminate\Support\Str::startsWith($baseRouteName, 'projects.') ? 'is-active' : '' }}
                                block
                                w-fit
                                text-[38px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.045em]
                                md:text-[50px]
                                lg:text-[55px]
                            "
                        >
                            <span class="inline-flex items-center gap-3">
                                <span>{{ __('site.menu.projects') }}</span>
                                <span class="menu-link-dot h-[7px] w-[7px] rounded-full bg-black"></span>
                            </span>
                        </a>

                        <a
                            href="{{ $newsUrl }}"
                            data-menu-type="news"
                            data-menu-title="{{ __('site.menu.news') }}"
                            data-menu-description="{{ __('site.menu_desc.news') }}"
                            class="
                                menu-link
                                {{ \Illuminate\Support\Str::startsWith($baseRouteName, 'news.') ? 'is-active' : '' }}
                                block
                                w-fit
                                text-[38px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.045em]
                                md:text-[50px]
                                lg:text-[55px]
                            "
                        >
                            <span class="inline-flex items-center gap-3">
                                <span>{{ __('site.menu.news') }}</span>
                                <span class="menu-link-dot h-[7px] w-[7px] rounded-full bg-black"></span>
                            </span>
                        </a>

                        <a
                            href="{{ $referencesUrl }}"
                            data-menu-type="references"
                            data-menu-title="{{ __('site.menu.references') }}"
                            data-menu-description="{{ __('site.menu_desc.references') }}"
                            class="
                                menu-link
                                {{ \Illuminate\Support\Str::startsWith($baseRouteName, 'references.') ? 'is-active' : '' }}
                                block
                                w-fit
                                text-[38px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.045em]
                                md:text-[50px]
                                lg:text-[55px]
                            "
                        >
                            <span class="inline-flex items-center gap-3">
                                <span>{{ __('site.menu.references') }}</span>
                                <span class="menu-link-dot h-[7px] w-[7px] rounded-full bg-black"></span>
                            </span>
                        </a>

                        <a
                            href="{{ $contactUrl }}"
                            data-menu-type="contact"
                            data-menu-title="{{ __('site.menu.contact') }}"
                            data-menu-description="{{ __('site.menu_desc.contact') }}"
                            class="
                                menu-link
                                {{ $baseRouteName === 'contact' ? 'is-active' : '' }}
                                block
                                w-fit
                                text-[38px]
                                font-medium
                                leading-[1.08]
                                tracking-[-0.045em]
                                md:text-[50px]
                                lg:text-[55px]
                            "
                        >
                            <span class="inline-flex items-center gap-3">
                                <span>{{ __('site.menu.contact') }}</span>
                                <span class="menu-link-dot h-[7px] w-[7px] rounded-full bg-black"></span>
                            </span>
                        </a>

                    </nav>

                </div>

                {{-- ================================================= --}}
                {{-- RIGHT / DYNAMIC MONOCHROME VISUALS --}}
                {{-- ================================================= --}}

                <div
                    class="
                        menu-panel-right
                        hidden
                        items-center
                        justify-center
                        lg:flex
                    "
                >
                    <div class="w-full max-w-[650px]">

                        <div
                            id="menuVisualStage"
                            class="
                                relative
                                aspect-[4/3]
                                overflow-visible
                            "
                        >

                            {{-- subtle guide lines only, no background card --}}
                            <svg
                                class="pointer-events-none absolute inset-0 h-full w-full opacity-60"
                                viewBox="0 0 650 488"
                                fill="none"
                            >
                                <ellipse
                                    cx="330"
                                    cy="270"
                                    rx="255"
                                    ry="174"
                                    stroke="rgba(0,0,0,.045)"
                                />

                                <path
                                    d="M58 393C165 306 260 273 354 276C457 279 548 326 610 399"
                                    stroke="rgba(0,0,0,.038)"
                                />

                                <path
                                    d="M105 135C212 88 324 82 437 114C504 133 554 163 601 202"
                                    stroke="rgba(0,0,0,.025)"
                                />
                            </svg>

                            {{-- ================================================= --}}
                            {{-- HOME --}}
                            {{-- ================================================= --}}

                            <div
                                class="menu-visual-card is-active absolute inset-0"
                                data-menu-visual="home"
                            >

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        left-[5%]
                                        top-[9%]
                                        w-[31%]
                                        rounded-[22px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        p-5
                                        shadow-[0_18px_50px_rgba(0,0,0,.07)]
                                    "
                                >
                                    <p class="text-[8px] font-medium uppercase tracking-[0.18em] text-black/30">
                                        Genel Bakış
                                    </p>

                                    <p class="mt-3 text-[20px] font-medium leading-tight tracking-[-0.04em] text-black">
                                        Tasarım +
                                        <br>
                                        Kod.
                                    </p>

                                    <p class="mt-3 text-[8px] leading-4 text-black/38">
                                        Fikirleri çalışan dijital ürünlere dönüştürüyorum.
                                    </p>

                                    <div class="mt-5 flex items-center gap-2 text-[7px] text-black/40">
                                        <span class="h-1.5 w-1.5 rounded-full bg-black"></span>
                                        <span>Aktif üretim akışı</span>
                                    </div>
                                </div>

                                <div
                                    class="
                                        absolute
                                        bottom-[8%]
                                        left-[21%]
                                        z-20
                                        w-[66%]
                                    "
                                >
                                    <div
                                        class="
                                            relative
                                            aspect-[16/10]
                                            overflow-hidden
                                            rounded-t-[22px]
                                            border-[5px]
                                            border-[#111]
                                            bg-[#0d0d0d]
                                            shadow-[0_30px_72px_rgba(0,0,0,.20)]
                                        "
                                    >
                                        <div class="absolute inset-0 bg-[#0d0d0d]"></div>

                                        <div class="absolute inset-x-5 top-5 flex items-center justify-between">
                                            <span class="text-[7px] uppercase tracking-[0.18em] text-white">Portfolio</span>
                                            <span class="text-[6px] text-white">Design / Development</span>
                                        </div>

                                        <div class="absolute bottom-5 left-5 right-5 grid grid-cols-[1fr_.8fr] gap-3">
                                            <div class="rounded-[13px] border border-white/[0.07] bg-white/[0.025] p-3">
                                                <p class="text-[7px] text-white">Öne Çıkan</p>
                                                <p class="mt-2 text-[11px] font-medium text-white">Dijital Deneyim</p>
                                                <div class="mt-3 h-1.5 w-[72%] rounded bg-white/10"></div>
                                                <div class="mt-2 h-1.5 w-[48%] rounded bg-white/[0.07]"></div>
                                            </div>

                                            <div class="rounded-[13px] border border-white/[0.07] bg-white/[0.03] p-3">
                                                <p class="text-[7px] text-white">Stack</p>
                                                <div class="mt-3 flex flex-wrap gap-1.5">
                                                    <span class="rounded-full border border-white/10 px-2 py-1 text-[6px] text-white/95">Laravel</span>
                                                    <span class="rounded-full border border-white/10 px-2 py-1 text-[6px] text-white/95">Tailwind</span>
                                                    <span class="rounded-full border border-white/10 px-2 py-1 text-[6px] text-white/95">JS</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mx-auto h-[5px] w-[94%] bg-[#111]"></div>

                                    <div class="mx-auto h-[18px] w-[108%] rounded-b-[20px] bg-gradient-to-b from-[#efefef] via-[#cfcfcf] to-[#a4a4a4]"></div>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        bottom-[10%]
                                        left-[3%]
                                        z-30
                                        w-[18%]
                                        -rotate-[5deg]
                                    "
                                >
                                    <div
                                        class="
                                            relative
                                            aspect-[9/19]
                                            overflow-hidden
                                            rounded-[26px]
                                            border-[5px]
                                            border-[#111]
                                            bg-black
                                            shadow-[0_24px_55px_rgba(0,0,0,.22)]
                                        "
                                    >
                                        <div class="absolute inset-x-3 top-10">
                                            <p class="text-[6px] uppercase tracking-[0.14em] text-white">Mobile</p>
                                            <p class="mt-3 text-[10px] font-medium leading-tight text-white/95">Her ekranda güçlü.</p>
                                            <div class="mt-5 h-14 rounded-[10px] border border-white/[0.07] bg-white/[0.03]"></div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        right-[1%]
                                        top-[11%]
                                        w-[27%]
                                        rotate-[2deg]
                                        rounded-[20px]
                                        bg-[#111]
                                        p-4
                                        shadow-[0_22px_55px_rgba(0,0,0,.18)]
                                    "
                                >
                                    <p class="font-mono text-[7px] leading-4 text-white">
                                        idea → design
                                        <br>
                                        design → build
                                        <br>
                                        build → launch
                                    </p>

                                    <div class="mt-4 flex items-center gap-2 text-[6px] text-white">
                                        <span class="h-1.5 w-1.5 rounded-full bg-white/50"></span>
                                        <span>workflow.ready</span>
                                    </div>
                                </div>

                            </div>

                            {{-- ================================================= --}}
                            {{-- ABOUT --}}
                            {{-- ================================================= --}}

                            <div
                                class="menu-visual-card absolute inset-0"
                                data-menu-visual="about"
                            >
                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        left-[5%]
                                        top-[9%]
                                        w-[39%]
                                        rounded-[24px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        p-6
                                        shadow-[0_20px_55px_rgba(0,0,0,.075)]
                                    "
                                >
                                    <span class="text-[8px] font-medium uppercase tracking-[0.18em] text-black/30">
                                        Yaklaşım
                                    </span>

                                    <h3 class="mt-4 text-[25px] font-medium leading-[1.02] tracking-[-0.045em] text-black">
                                        Fikirden
                                        <br>
                                        ürüne.
                                    </h3>

                                    <p class="mt-4 max-w-[190px] text-[8px] leading-4 text-black/38">
                                        Strateji, tasarım ve geliştirmeyi tek bir üretim akışında birleştiriyorum.
                                    </p>

                                    <div class="mt-5 h-px w-full bg-black/[0.07]"></div>

                                    <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                                        <div>
                                            <p class="text-[13px] font-medium text-black/80">01</p>
                                            <p class="mt-1 text-[6px] text-black/30">Keşif</p>
                                        </div>
                                        <div>
                                            <p class="text-[13px] font-medium text-black/80">02</p>
                                            <p class="mt-1 text-[6px] text-black/30">Tasarım</p>
                                        </div>
                                        <div>
                                            <p class="text-[13px] font-medium text-black/80">03</p>
                                            <p class="mt-1 text-[6px] text-black/30">Geliştirme</p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        right-[7%]
                                        top-[14%]
                                        w-[38%]
                                        rotate-[3deg]
                                        rounded-[26px]
                                        bg-[#111]
                                        p-5
                                        shadow-[0_26px_70px_rgba(0,0,0,.18)]
                                    "
                                >
                                    <div
                                        class="
                                            relative
                                            aspect-[4/3]
                                            overflow-hidden
                                            rounded-[18px]
                                            border
                                            border-white/10
                                            bg-[#0c0c0c]
                                        "
                                    >
                                        <div class="absolute inset-0 bg-[#0c0c0c]"></div>

                                        <div class="absolute bottom-3 left-3 right-3 grid grid-cols-2 gap-2">
                                            <div class="rounded-[9px] bg-white/[0.04] p-2">
                                                <p class="text-[6px] text-white">Problem</p>
                                                <p class="mt-1 text-[8px] text-white">Karmaşıklık</p>
                                            </div>
                                            <div class="rounded-[9px] bg-white/[0.04] p-2">
                                                <p class="text-[6px] text-white">Çözüm</p>
                                                <p class="mt-1 text-[8px] text-white">Sadelik</p>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-4 text-[7px] leading-4 text-white">
                                        Görsel kalite kadar kullanılabilirliği de merkeze alan bir yaklaşım.
                                    </p>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        bottom-[8%]
                                        left-[24%]
                                        flex
                                        w-[58%]
                                        items-center
                                        justify-between
                                        rounded-[20px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        px-5
                                        py-4
                                        shadow-[0_18px_48px_rgba(0,0,0,.065)]
                                    "
                                >
                                    <span class="text-[8px] font-medium text-black/60">Araştır</span>
                                    <span class="h-px w-8 bg-black/10"></span>
                                    <span class="text-[8px] font-medium text-black/60">Tasarla</span>
                                    <span class="h-px w-8 bg-black/10"></span>
                                    <span class="text-[8px] font-medium text-black/60">Geliştir</span>
                                    <span class="h-px w-8 bg-black/10"></span>
                                    <span class="text-[8px] font-medium text-black/60">Yayınla</span>
                                </div>
                            </div>

                            {{-- ================================================= --}}
                            {{-- SERVICES --}}
                            {{-- ================================================= --}}

                            <div
                                class="menu-visual-card absolute inset-0"
                                data-menu-visual="services"
                            >
                                <div class="absolute left-[4%] top-[8%] grid w-[56%] grid-cols-2 gap-3">

                                    <div class="menu-visual-float rounded-[18px] border border-black/[0.055] bg-white p-4 shadow-[0_14px_35px_rgba(0,0,0,.06)]">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-[9px] border border-black/[0.07]">
                                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4 text-black/60" stroke="currentColor" stroke-width="1.5">
                                                <rect x="3.5" y="5" width="17" height="14" rx="2.5"/>
                                                <path d="M3.5 8.5h17"/>
                                            </svg>
                                        </div>
                                        <p class="mt-6 text-[9px] font-medium text-black/72">Web Tasarım</p>
                                        <p class="mt-1 text-[7px] leading-4 text-black/32">Modern, hızlı ve kullanıcı odaklı siteler.</p>
                                    </div>

                                    <div class="menu-visual-float rounded-[18px] bg-[#111] p-4 shadow-[0_14px_35px_rgba(0,0,0,.12)]">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-[9px] border border-white/10">
                                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4 text-white/90" stroke="currentColor" stroke-width="1.5">
                                                <rect x="7" y="2.5" width="10" height="19" rx="2.5"/>
                                            </svg>
                                        </div>
                                        <p class="mt-6 text-[9px] font-medium text-white">Mobil Arayüz</p>
                                        <p class="mt-1 text-[7px] leading-4 text-white/70">Telefon ve tablet için sezgisel deneyimler.</p>
                                    </div>

                                    <div class="menu-visual-float rounded-[18px] border border-black/[0.055] bg-white p-4 shadow-[0_14px_35px_rgba(0,0,0,.06)]">
                                        <div class="flex h-8 w-8 items-end gap-1">
                                            <span class="h-[42%] w-1.5 rounded-sm bg-black/25"></span>
                                            <span class="h-[68%] w-1.5 rounded-sm bg-black/50"></span>
                                            <span class="h-full w-1.5 rounded-sm bg-black"></span>
                                        </div>
                                        <p class="mt-6 text-[9px] font-medium text-black/72">Dashboard</p>
                                        <p class="mt-1 text-[7px] leading-4 text-black/32">Veriyi sade ve anlamlı panellere dönüştürme.</p>
                                    </div>

                                    <div class="menu-visual-float rounded-[18px] border border-black/[0.055] bg-white p-4 shadow-[0_14px_35px_rgba(0,0,0,.06)]">
                                        <div class="h-8 w-8 rounded-full border-[7px] border-black/10 border-r-black"></div>
                                        <p class="mt-6 text-[9px] font-medium text-black/72">Marka Kimliği</p>
                                        <p class="mt-1 text-[7px] leading-4 text-black/32">Tutarlı ve akılda kalıcı görsel sistemler.</p>
                                    </div>

                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        bottom-[8%]
                                        right-[4%]
                                        w-[39%]
                                        rotate-[2deg]
                                        rounded-[24px]
                                        bg-[#111]
                                        p-5
                                        shadow-[0_24px_65px_rgba(0,0,0,.20)]
                                    "
                                >
                                    <div class="mb-4 flex items-center justify-between">
                                        <div class="flex gap-1.5">
                                            <span class="h-1.5 w-1.5 rounded-full bg-white/35"></span>
                                            <span class="h-1.5 w-1.5 rounded-full bg-white/20"></span>
                                            <span class="h-1.5 w-1.5 rounded-full bg-white/10"></span>
                                        </div>
                                        <span class="text-[6px] text-white/95">service.flow</span>
                                    </div>

                                    <div class="font-mono text-[7px] leading-5 text-white">
                                        brief → strategy
                                        <br>
                                        strategy → interface
                                        <br>
                                        interface → code
                                        <br>
                                        code → launch
                                    </div>

                                    <div class="mt-4 border-t border-white/[0.07] pt-3 text-[6px] text-white">
                                        Tasarım ve yazılım tek süreçte.
                                    </div>
                                </div>
                            </div>

                            {{-- ================================================= --}}
                            {{-- PROJECTS --}}
                            {{-- ================================================= --}}

                            <div
                                class="menu-visual-card absolute inset-0"
                                data-menu-visual="projects"
                            >
                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        left-[4%]
                                        top-[8%]
                                        rounded-[18px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        px-5
                                        py-4
                                        shadow-[0_16px_40px_rgba(0,0,0,.07)]
                                    "
                                >
                                    <p class="text-[7px] uppercase tracking-[0.16em] text-black/28">
                                        Selected Work
                                    </p>
                                    <p class="mt-2 text-[16px] font-medium text-black/78">
                                        50+ Proje
                                    </p>
                                    <p class="mt-1 text-[7px] text-black/30">
                                        Web · UI · Kurumsal
                                    </p>
                                </div>

                                <div class="absolute bottom-[8%] left-[13%] z-20 w-[75%]">

                                    <div
                                        class="
                                            relative
                                            aspect-[16/10]
                                            overflow-hidden
                                            rounded-t-[24px]
                                            border-[5px]
                                            border-[#111]
                                            bg-[#0c0c0c]
                                            shadow-[0_30px_75px_rgba(0,0,0,.22)]
                                        "
                                    >
                                        <div class="absolute inset-x-0 top-0 flex h-10 items-center justify-between border-b border-white/[0.06] px-4">
                                            <span class="text-[7px] uppercase tracking-[0.16em] text-white/95">
                                                Projects
                                            </span>
                                            <span class="text-[6px] text-white/95">
                                                2026
                                            </span>
                                        </div>

                                        <div class="absolute inset-x-5 bottom-5 top-14 grid grid-cols-2 gap-3">
                                            <div
                                                class="
                                                    rounded-[12px]
                                                    border
                                                    border-white/[0.07]
                                                    bg-[#151515]
                                                "
                                            >
                                                <div class="absolute bottom-8 left-8">
                                                    <p class="text-[7px] text-white">Project 01</p>
                                                    <p class="mt-1 text-[10px] font-medium text-white">Corporate Web</p>
                                                </div>
                                            </div>

                                            <div class="rounded-[12px] border border-white/[0.08] bg-[#151515] p-4">
                                                <p class="text-[7px] text-white">Project 02</p>
                                                <p class="mt-2 text-[10px] font-medium text-white">Dashboard UI</p>

                                                <div class="mt-5 grid grid-cols-3 gap-2">
                                                    <div class="h-10 rounded-[8px] bg-white/[0.04]"></div>
                                                    <div class="h-10 rounded-[8px] bg-white/[0.04]"></div>
                                                    <div class="h-10 rounded-[8px] bg-white/[0.04]"></div>
                                                </div>

                                                <div class="mt-3 h-1.5 w-[75%] rounded bg-white/10"></div>
                                                <div class="mt-2 h-1.5 w-[52%] rounded bg-white/[0.07]"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mx-auto h-[5px] w-[94%] bg-[#111]"></div>
                                    <div class="mx-auto h-[19px] w-[108%] rounded-b-[22px] bg-gradient-to-b from-[#eee] via-[#d0d0d0] to-[#9d9d9d]"></div>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        right-[1%]
                                        top-[12%]
                                        w-[27%]
                                        rounded-[19px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        p-4
                                        shadow-[0_16px_40px_rgba(0,0,0,.06)]
                                    "
                                >
                                    <p class="text-[7px] text-black/28">Odak</p>
                                    <p class="mt-2 text-[11px] font-medium text-black/70">Detay + performans</p>

                                    <div class="mt-4 space-y-2">
                                        <div class="flex items-center justify-between text-[6px] text-black/32">
                                            <span>UI</span>
                                            <span>98%</span>
                                        </div>
                                        <div class="h-1 rounded-full bg-black/[0.06]">
                                            <div class="h-full w-[98%] rounded-full bg-black"></div>
                                        </div>

                                        <div class="flex items-center justify-between text-[6px] text-black/32">
                                            <span>Speed</span>
                                            <span>94%</span>
                                        </div>
                                        <div class="h-1 rounded-full bg-black/[0.06]">
                                            <div class="h-full w-[94%] rounded-full bg-black"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ================================================= --}}
                            {{-- NEWS --}}
                            {{-- ================================================= --}}

                            <div
                                class="menu-visual-card absolute inset-0"
                                data-menu-visual="news"
                            >
                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        left-[5%]
                                        top-[8%]
                                        w-[52%]
                                        -rotate-[2deg]
                                        rounded-[24px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        p-6
                                        shadow-[0_24px_60px_rgba(0,0,0,.08)]
                                    "
                                >
                                    <span class="text-[8px] uppercase tracking-[0.18em] text-black/28">
                                        Journal / 2026
                                    </span>

                                    <div
                                        class="
                                            mt-5
                                            flex
                                            h-24
                                            items-center
                                            justify-center
                                            rounded-[16px]
                                            border
                                            border-black/[0.045]
                                            bg-[#f1f1f1]
                                        "
                                    >
                                        <div class="relative h-14 w-14 rounded-full border border-black/[0.08]">
                                            <span class="absolute left-1/2 top-1/2 h-px w-20 -translate-x-1/2 -translate-y-1/2 rotate-[-18deg] bg-black/18"></span>
                                        </div>
                                    </div>

                                    <h3 class="mt-5 text-[18px] font-medium leading-tight tracking-[-0.03em] text-black/80">
                                        Tasarım ve teknoloji
                                        <br>
                                        üzerine notlar.
                                    </h3>

                                    <p class="mt-3 text-[7px] leading-4 text-black/33">
                                        Üretim süreçleri, arayüzler ve yeni dijital yaklaşımlar.
                                    </p>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        bottom-[9%]
                                        right-[6%]
                                        w-[36%]
                                        rotate-[4deg]
                                        rounded-[22px]
                                        bg-[#111]
                                        p-5
                                        shadow-[0_26px_70px_rgba(0,0,0,.18)]
                                    "
                                >
                                    <p class="text-[7px] uppercase tracking-[0.14em] text-white">
                                        Latest Update
                                    </p>

                                    <p class="mt-4 text-[14px] font-medium leading-tight text-white">
                                        Daha iyi bir kullanıcı deneyimi nasıl kurulur?
                                    </p>

                                    <div class="mt-5 h-px bg-white/[0.08]"></div>

                                    <div class="mt-4 flex items-center justify-between text-[6px] text-white">
                                        <span>UI / UX</span>
                                        <span>5 dk okuma</span>
                                    </div>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        right-[4%]
                                        top-[8%]
                                        rounded-full
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        px-4
                                        py-2
                                        text-[7px]
                                        text-black/40
                                        shadow-[0_12px_28px_rgba(0,0,0,.05)]
                                    "
                                >
                                    Güncel içerikler
                                </div>
                            </div>

                            {{-- ================================================= --}}
                            {{-- REFERENCES --}}
                            {{-- ================================================= --}}

                            <div
                                class="menu-visual-card absolute inset-0"
                                data-menu-visual="references"
                            >
                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        left-[5%]
                                        top-[8%]
                                        w-[31%]
                                        rounded-[22px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        p-5
                                        shadow-[0_18px_45px_rgba(0,0,0,.065)]
                                    "
                                >
                                    <p class="text-[8px] uppercase tracking-[0.18em] text-black/28">
                                        {{ __('site.menu.references') }}
                                    </p>

                                    <p class="mt-3 text-[22px] font-medium leading-tight tracking-[-0.04em] text-black">
                                        Güçlü iş
                                        <br>
                                        birlikleri.
                                    </p>

                                    <p class="mt-3 text-[7px] leading-4 text-black/34">
                                        Farklı sektörlerden markalarla uzun soluklu dijital çalışmalar.
                                    </p>
                                </div>

                                <div class="absolute right-[4%] top-[8%] grid w-[60%] grid-cols-3 gap-3">
                                    @foreach([
                                        ['01','Sanayi'],
                                        ['02','Gıda'],
                                        ['03','Tekstil'],
                                        ['04','İnşaat'],
                                        ['05','Tarım'],
                                        ['06','Hizmet'],
                                        ['07','Otomotiv'],
                                        ['08','Perakende'],
                                        ['09','Teknoloji'],
                                    ] as $referenceItem)

                                        <div
                                            class="
                                                menu-visual-float
                                                flex
                                                min-h-[88px]
                                                flex-col
                                                justify-between
                                                rounded-[17px]
                                                border
                                                border-black/[0.05]
                                                bg-white
                                                p-4
                                                shadow-[0_12px_30px_rgba(0,0,0,.045)]
                                            "
                                        >
                                            <span class="text-[7px] text-black/24">
                                                {{ $referenceItem[0] }}
                                            </span>

                                            <span class="text-[8px] font-medium text-black/56">
                                                {{ $referenceItem[1] }}
                                            </span>
                                        </div>

                                    @endforeach
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        bottom-[6%]
                                        left-[21%]
                                        rounded-full
                                        bg-[#111]
                                        px-5
                                        py-3
                                        text-[7px]
                                        text-white
                                        shadow-[0_16px_38px_rgba(0,0,0,.16)]
                                    "
                                >
                                    Farklı sektörler · Tek kalite standardı
                                </div>
                            </div>

                            {{-- ================================================= --}}
                            {{-- CONTACT --}}
                            {{-- ================================================= --}}

                            <div
                                class="menu-visual-card absolute inset-0"
                                data-menu-visual="contact"
                            >
                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        bottom-[8%]
                                        left-[7%]
                                        z-20
                                        w-[27%]
                                        -rotate-[5deg]
                                    "
                                >
                                    <div
                                        class="
                                            relative
                                            aspect-[9/19]
                                            overflow-hidden
                                            rounded-[30px]
                                            border-[6px]
                                            border-[#111]
                                            bg-black
                                            shadow-[0_28px_70px_rgba(0,0,0,.24)]
                                        "
                                    >
                                        <div class="absolute left-1/2 top-2 h-[5px] w-[30%] -translate-x-1/2 rounded-full bg-black"></div>

                                        <div class="absolute inset-x-4 top-12">
                                            <p class="text-[7px] uppercase tracking-[0.14em] text-white">
                                                Contact
                                            </p>

                                            <p class="mt-4 text-[15px] font-medium leading-tight text-white">
                                                Bir proje mi var?
                                            </p>

                                            <p class="mt-2 text-[6px] leading-3 text-white">
                                                Fikrinizi konuşalım, doğru dijital çözümü birlikte kuralım.
                                            </p>

                                            <div class="mt-6 space-y-2">
                                                <div class="rounded-[9px] border border-white/[0.07] bg-white/[0.035] px-3 py-2">
                                                    <p class="text-[5px] text-white/95">E-posta</p>
                                                    <p class="mt-1 text-[6px] text-white/95">{{ $siteSettings['contact_email'] ?? 'hello@portfolio.com' }}</p>
                                                </div>

                                                <div class="rounded-[9px] border border-white/[0.07] bg-white/[0.035] px-3 py-2">
                                                    <p class="text-[5px] text-white/95">Proje</p>
                                                    <p class="mt-1 text-[6px] text-white/95">Yeni web sitesi</p>
                                                </div>

                                                <div class="rounded-[9px] bg-white px-3 py-2 text-center text-[6px] font-medium text-black">
                                                    Mesaj Gönder
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        right-[6%]
                                        top-[10%]
                                        w-[51%]
                                        rounded-[26px]
                                        border
                                        border-black/[0.055]
                                        bg-white
                                        p-6
                                        shadow-[0_22px_60px_rgba(0,0,0,.085)]
                                    "
                                >
                                    <div class="flex items-start justify-between">
                                        <div
                                            class="
                                                flex
                                                h-12
                                                w-12
                                                items-center
                                                justify-center
                                                rounded-full
                                                border
                                                border-black/[0.07]
                                                bg-black/[0.02]
                                            "
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5 text-black/65" stroke="currentColor" stroke-width="1.5">
                                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                                <path d="m4 7 8 6 8-6"/>
                                            </svg>
                                        </div>

                                        <span class="rounded-full border border-black/[0.06] px-3 py-1.5 text-[6px] text-black/30">
                                            Açık iletişim
                                        </span>
                                    </div>

                                    <p class="mt-6 text-[8px] uppercase tracking-[0.16em] text-black/28">
                                        E-posta
                                    </p>

                                    <p class="mt-2 text-[14px] font-medium text-black/76">
                                        {{ $siteSettings['contact_email'] ?? 'hello@portfolio.com' }}
                                    </p>

                                    @if(!empty($siteSettings['contact_phone']))
                                        <p class="mt-4 text-[8px] uppercase tracking-[0.16em] text-black/28">
                                            Telefon
                                        </p>

                                        <p class="mt-2 text-[12px] font-medium text-black/68">
                                            {{ $siteSettings['contact_phone'] }}
                                        </p>
                                    @endif

                                    <div class="mt-6 h-px w-full bg-black/[0.07]"></div>

                                    <p class="mt-4 text-[7px] leading-4 text-black/34">
                                        Yeni proje, teklif veya iş birliği için doğrudan iletişime geçebilirsiniz.
                                    </p>
                                </div>

                                <div
                                    class="
                                        menu-visual-float
                                        absolute
                                        bottom-[7%]
                                        right-[8%]
                                        rounded-[18px]
                                        bg-[#111]
                                        px-5
                                        py-4
                                        shadow-[0_18px_45px_rgba(0,0,0,.16)]
                                    "
                                >
                                    <p class="text-[6px] text-white/95">
                                        Ortalama dönüş
                                    </p>

                                    <p class="mt-1 text-[11px] font-medium text-white/90">
                                        24 saat içinde
                                    </p>
                                </div>
                            </div>

                        </div>

                        {{-- INFO --}}
                        <div
                            class="
                                mt-7
                                grid
                                grid-cols-[1fr_auto]
                                items-start
                                gap-10
                            "
                        >
                            <div>
                                <p
                                    id="menuPreviewTitle"
                                    class="
                                        text-[14px]
                                        font-semibold
                                        tracking-[-0.015em]
                                        text-[#111]
                                    "
                                >
                                    {{ __('site.menu.home') }}
                                </p>

                                <p
                                    id="menuPreviewDescription"
                                    class="
                                        mt-1.5
                                        max-w-md
                                        text-xs
                                        leading-5
                                        text-black/35
                                    "
                                >
                                    {{ __('site.menu_desc.home') }}
                                </p>
                            </div>

                            <div class="mt-2 flex items-center gap-3">
                                <span class="block h-px w-12 bg-black/15"></span>
                                <span class="h-[5px] w-[5px] rounded-full bg-black"></span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ================================================= --}}
            {{-- MENU BOTTOM --}}
            {{-- ================================================= --}}

            <div
                class="
                    absolute
                    bottom-7
                    left-6
                    right-6
                    flex
                    items-center
                    justify-between
                    border-t
                    border-black/[0.08]
                    pt-5
                    text-[11px]
                    text-black/30
                    lg:left-10
                    lg:right-10
                "
            >

                <p>
                    © {{ date('Y') }} {{ $siteName }}
                </p>

                <div
                    class="
                        hidden
                        items-center
                        gap-6
                        sm:flex
                    "
                >

                    @if(!empty($siteSettings['instagram_url']))

                        <a
                            href="{{ $siteSettings['instagram_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="
                                transition
                                duration-300
                                hover:text-black
                            "
                        >
                            Instagram
                        </a>

                    @endif

                    @if(!empty($siteSettings['linkedin_url']))

                        <a
                            href="{{ $siteSettings['linkedin_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="
                                transition
                                duration-300
                                hover:text-black
                            "
                        >
                            LinkedIn
                        </a>

                    @endif

                    @if(!empty($siteSettings['github_url']))

                        <a
                            href="{{ $siteSettings['github_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="
                                transition
                                duration-300
                                hover:text-black
                            "
                        >
                            GitHub
                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- PAGE --}}
    {{-- ========================================================= --}}

    <main
        class="
            flex-1
            {{ $isHome ? '' : 'pt-[84px]' }}
        "
    >
        @yield('content')
    </main>

    {{-- ========================================================= --}}
    {{-- PREMIUM FOOTER --}}
    {{-- ========================================================= --}}

    <footer
        class="
            premium-footer
            relative
            overflow-hidden
            rounded-t-[128px]
            rounded-b-none
            border-t
            border-white/[0.06]
            bg-[#070707]
            text-white
            shadow-[0_-10px_40px_rgba(0,0,0,0.08)]
        "
    >

        {{-- subtle top glow --}}
        <div
            class="
                pointer-events-none
                absolute
                left-1/2
                top-0
                h-[240px]
                w-[780px]
                -translate-x-1/2
                rounded-full
                bg-white/[0.025]
                blur-[110px]
            "
        ></div>

        <div
            class="
                relative
                mx-auto
                max-w-[1400px]
                px-6
                py-14
                sm:py-18
                lg:px-10
                lg:py-20
            "
        >

            <div
                class="
                    mx-auto
                    flex
                    max-w-4xl
                    flex-col
                    items-center
                    text-center
                "
            >

                {{-- BRAND --}}
                <a
                    href="{{ $homeUrl }}"
                    class="
                        group
                        inline-flex
                        items-center
                        justify-center
                        gap-3
                    "
                    aria-label="{{ $siteName }}"
                >

                    @if(!empty($siteSettings['site_logo']))

                        <img
                            src="{{ asset('storage/' . $siteSettings['site_logo']) }}"
                            alt="{{ $siteName }}"
                            class="
                                h-auto
                                w-auto
                                max-h-[58px]
                                max-w-[280px]
                                object-contain
                                brightness-0
                                invert
                                transition
                                duration-300
                                sm:max-h-[64px]
                                sm:max-w-[320px]
                                lg:max-h-[72px]
                                lg:max-w-[360px]
                                group-hover:opacity-80
                            "
                        >

                    @else

                        <span
                            class="
                                text-[30px]
                                font-medium
                                uppercase
                                tracking-[0.10em]
                                text-white
                                sm:text-[38px]
                            "
                        >
                            {{ $siteName }}
                        </span>

                        <span
                            class="
                                h-2.5
                                w-2.5
                                rounded-full
                                bg-white/75
                                shadow-[0_0_18px_rgba(255,255,255,.22)]
                            "
                        ></span>

                    @endif

                </a>

                {{-- TAGLINE --}}
                <p
                    class="
                        mt-6
                        max-w-2xl
                        text-[14px]
                        font-light
                        leading-7
                        tracking-[-0.01em]
                        text-white/44
                        sm:text-[16px]
                    "
                >
                    {{ $isEnglish
                        ? __('site.footer.tagline')
                        : (
                            $siteSettings['footer_text']
                                ?? __('site.footer.tagline')
                        )
                    }}
                </p>

                {{-- GLOW LINE --}}
                <div
                    class="
                        footer-glow-line
                        mt-10
                        w-full
                        max-w-[700px]
                    "
                ></div>

                {{-- SOCIALS --}}
                <div
                    class="
                        mt-10
                        flex
                        flex-wrap
                        items-center
                        justify-center
                        gap-3
                        sm:gap-4
                    "
                >

                    @if(!empty($siteSettings['github_url']))

                        <a
                            href="{{ $siteSettings['github_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="
                                footer-social
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center
                                rounded-full
                                border
                                border-white/[0.10]
                                bg-white/[0.025]
                                text-white/62
                            "
                            aria-label="GitHub"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                class="h-5 w-5"
                            >
                                <path d="M9 19c-4.5 1.5-4.5-2.5-6-3m12 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 19 4.77 5.07 5.07 0 0 0 18.91 1S17.73.65 15 2.48a13.38 13.38 0 0 0-6 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                            </svg>
                        </a>

                    @endif

                    @if(!empty($siteSettings['linkedin_url']))

                        <a
                            href="{{ $siteSettings['linkedin_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="
                                footer-social
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center
                                rounded-full
                                border
                                border-white/[0.10]
                                bg-white/[0.025]
                                text-white/62
                            "
                            aria-label="LinkedIn"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                                class="h-5 w-5"
                            >
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6Z"/>
                                <rect x="2" y="9" width="4" height="12"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                        </a>

                    @endif

                    @if(!empty($siteSettings['instagram_url']))

                        <a
                            href="{{ $siteSettings['instagram_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="
                                footer-social
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center
                                rounded-full
                                border
                                border-white/[0.10]
                                bg-white/[0.025]
                                text-white/62
                            "
                            aria-label="Instagram"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                                class="h-5 w-5"
                            >
                                <rect x="3" y="3" width="18" height="18" rx="5"/>
                                <circle cx="12" cy="12" r="4"/>
                                <circle cx="17.5" cy="6.5" r=".8" fill="currentColor" stroke="none"/>
                            </svg>
                        </a>

                    @endif

                    @if(!empty($siteSettings['contact_email']))

                        <a
                            href="mailto:{{ $siteSettings['contact_email'] }}"
                            class="
                                footer-social
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center
                                rounded-full
                                border
                                border-white/[0.10]
                                bg-white/[0.025]
                                text-white/62
                            "
                            aria-label="E-posta"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                                class="h-5 w-5"
                            >
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <path d="m4 7 8 6 8-6"/>
                            </svg>
                        </a>

                    @endif

                </div>

                {{-- MINI NAV --}}
           {{-- MINI NAV --}}
<nav
    class="
        mt-9
        flex
        flex-wrap
        items-center
        justify-center
        gap-x-6
        gap-y-3
        text-[11px]
        text-white/28
    "
>

    <a
        href="{{ $aboutUrl }}"
        class="transition hover:text-white/75"
    >
        {{ __('site.menu.about') }}
    </a>

    <a
        href="{{ $servicesUrl }}"
        class="transition hover:text-white/75"
    >
        {{ __('site.menu.services') }}
    </a>

    <a
        href="{{ $projectsUrl }}"
        class="transition hover:text-white/75"
    >
        {{ __('site.menu.projects') }}
    </a>

    <a
        href="{{ $newsUrl }}"
        class="transition hover:text-white/75"
    >
        {{ __('site.menu.news') }}
    </a>

    <a
        href="{{ $referencesUrl }}"
        class="transition hover:text-white/75"
    >
        {{ __('site.menu.references') }}
    </a>

    <a
        href="{{ $contactUrl }}"
        class="transition hover:text-white/75"
    >
        {{ __('site.menu.contact') }}
    </a>

</nav>

                {{-- LEGAL LINKS --}}
                <div
                    class="
                        mt-10
                        flex
                        flex-wrap
                        items-center
                        justify-center
                        gap-x-3
                        gap-y-2
                        text-[9px]
                        text-white/18
                    "
                >

                    <a
                        href="{{ route($legalRouteName, array_merge($legalRouteParameters, ['tab' => 'kvkk'])) }}"
                        class="
                            transition
                            duration-300
                            hover:text-white/55
                        "
                    >
                        {{ __('site.footer.kvkk') }}
                    </a>

                    <span class="h-[3px] w-[3px] rounded-full bg-white/15"></span>

                    <a
                        href="{{ route($legalRouteName, array_merge($legalRouteParameters, ['tab' => 'privacy'])) }}"
                        class="
                            transition
                            duration-300
                            hover:text-white/55
                        "
                    >
                        {{ __('site.footer.privacy') }}
                    </a>

                    <span class="h-[3px] w-[3px] rounded-full bg-white/15"></span>

                    <a
                        href="{{ route($legalRouteName, array_merge($legalRouteParameters, ['tab' => 'cookies'])) }}"
                        class="
                            transition
                            duration-300
                            hover:text-white/55
                        "
                    >
                        {{ __('site.footer.cookies') }}
                    </a>

                </div>

                {{-- COPYRIGHT --}}
                <div
                    class="
                        mt-4
                        flex
                        flex-wrap
                        items-center
                        justify-center
                        gap-x-2
                        gap-y-1
                        text-center
                        text-[10px]
                        text-white/22
                    "
                >
                    <span>
                        © {{ date('Y') }}
                    </span>

                    <span>
                        {{ __('site.footer.rights') }}
                    </span>
                </div>

            </div>

        </div>

    </footer>

</div>

{{-- ========================================================= --}}
{{-- SCRIPT --}}
{{-- ========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const body =
        document.body;

    const header =
        document.getElementById(
            'siteHeader'
        );

    const button =
        document.getElementById(
            'menuButton'
        );

    const menu =
        document.getElementById(
            'siteMenu'
        );

    const line1 =
        document.getElementById(
            'menuLine1'
        );

    const line2 =
        document.getElementById(
            'menuLine2'
        );

    const line3 =
        document.getElementById(
            'menuLine3'
        );

    const logoImage =
        document.getElementById(
            'siteLogoImage'
        );

    const logoText =
        document.getElementById(
            'siteLogoText'
        );

    const links =
        document.querySelectorAll(
            '.menu-link'
        );

    const preview =
        document.getElementById(
            'menuPreviewImage'
        );

    const previewTitle =
        document.getElementById(
            'menuPreviewTitle'
        );

    const previewDescription =
        document.getElementById(
            'menuPreviewDescription'
        );

    const menuVisuals =
        document.querySelectorAll(
            '[data-menu-visual]'
        );

    const isHome =
        @json($isHome);

    let menuOpen =
        false;

    let currentImage =
        preview
            ? preview.src
            : null;

    let lastScrollY =
        window.scrollY;

    let scrollDelta =
        0;

    const scrollThreshold =
        8;

    /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

    function updateHeader() {

        if (!header) {
            return;
        }

        const currentScrollY =
            Math.max(
                window.scrollY,
                0
            );

        const delta =
            currentScrollY -
            lastScrollY;

        /*
        |--------------------------------------------------------------------------
        | MENU AÇIKSA NAVBAR HER ZAMAN GÖRÜNSÜN
        |--------------------------------------------------------------------------
        */

        if (menuOpen) {

            header.classList.remove(
                'is-hidden'
            );

            lastScrollY =
                currentScrollY;

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | SAYFANIN EN ÜSTÜ
        |--------------------------------------------------------------------------
        */

        if (currentScrollY <= 12) {

            header.classList.remove(
                'is-hidden'
            );

            if (isHome) {

                header.classList.remove(
                    'is-scrolled'
                );

            } else {

                header.classList.add(
                    'is-scrolled'
                );

            }

            lastScrollY =
                currentScrollY;

            scrollDelta =
                0;

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | SCROLL EDİLMİŞ NAVBAR GÖRÜNÜMÜ
        |--------------------------------------------------------------------------
        */

        header.classList.add(
            'is-scrolled'
        );

        /*
        |--------------------------------------------------------------------------
        | SCROLL YÖNÜ
        |--------------------------------------------------------------------------
        */

        if (
            Math.abs(delta) >= 1
        ) {

            scrollDelta +=
                delta;

        }

        /*
        |--------------------------------------------------------------------------
        | AŞAĞI KAYDIRIRKEN GİZLE
        |--------------------------------------------------------------------------
        */

        if (
            scrollDelta > scrollThreshold
        ) {

            header.classList.add(
                'is-hidden'
            );

            scrollDelta =
                0;

        }

        /*
        |--------------------------------------------------------------------------
        | YUKARI KAYDIRIRKEN GÖSTER
        |--------------------------------------------------------------------------
        */

        if (
            scrollDelta < -scrollThreshold
        ) {

            header.classList.remove(
                'is-hidden'
            );

            scrollDelta =
                0;

        }

        lastScrollY =
            currentScrollY;

    }

    /*
    |--------------------------------------------------------------------------
    | OPEN MENU
    |--------------------------------------------------------------------------
    */

    function openMenu() {

        if (!menu) {
            return;
        }

        menuOpen =
            true;

        header?.classList.remove(
            'is-hidden'
        );

        body.classList.add(
            'menu-open'
        );

        menu.classList.add(
            'is-open'
        );

        button.setAttribute(
            'aria-expanded',
            'true'
        );

        /*
        |--------------------------------------------------------------------------
        | HAMBURGER
        |--------------------------------------------------------------------------
        */

        line1.style.transform =
            'translateY(6px) rotate(45deg)';

        line2.style.opacity =
            '0';

        line3.style.transform =
            'translateY(-6px) rotate(-45deg)';

        /*
        |--------------------------------------------------------------------------
        | BUTTON COLOR
        |--------------------------------------------------------------------------
        */

        button.classList.remove(
            'text-[#111]'
        );

        button.classList.add(
            'text-white/70'
        );

        /*
        |--------------------------------------------------------------------------
        | LOGO
        |--------------------------------------------------------------------------
        */

        if (logoImage) {

            logoImage.classList.add(
                'brightness-0',
                'invert'
            );

        }

        if (logoText) {

            logoText.classList.remove(
                'text-[#111]'
            );

            logoText.classList.add(
                'text-white'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        header.classList.remove(
            'is-scrolled'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | CLOSE MENU
    |--------------------------------------------------------------------------
    */

    function closeMenu() {

        if (!menu) {
            return;
        }

        menuOpen =
            false;

        body.classList.remove(
            'menu-open'
        );

        menu.classList.remove(
            'is-open'
        );

        button.setAttribute(
            'aria-expanded',
            'false'
        );

        /*
        |--------------------------------------------------------------------------
        | HAMBURGER RESET
        |--------------------------------------------------------------------------
        */

        line1.style.transform =
            '';

        line2.style.opacity =
            '';

        line3.style.transform =
            '';

        /*
        |--------------------------------------------------------------------------
        | BUTTON COLOR
        |--------------------------------------------------------------------------
        */

        button.classList.remove(
            'text-[#111]'
        );

        button.classList.add(
            'text-white/70'
        );

        /*
        |--------------------------------------------------------------------------
        | LOGO
        |--------------------------------------------------------------------------
        */

        if (logoImage) {

            logoImage.classList.add(
                'brightness-0',
                'invert'
            );

        }

        if (logoText) {

            logoText.classList.remove(
                'text-[#111]'
            );

            logoText.classList.add(
                'text-white'
            );

        }

        updateHeader();

    }

    /*
    |--------------------------------------------------------------------------
    | MENU BUTTON
    |--------------------------------------------------------------------------
    */

    button?.addEventListener(
        'click',
        function () {

            if (menuOpen) {

                closeMenu();

            } else {

                openMenu();

            }

        }
    );

    /*
    |--------------------------------------------------------------------------
    | ESC
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                menuOpen
            ) {

                closeMenu();

            }

        }
    );

    /*
    |--------------------------------------------------------------------------
    | MENU HOVER
    |--------------------------------------------------------------------------
    */

    links.forEach(
        function (link) {

            link.addEventListener(
                'mouseenter',
                function () {

                    const menuType =
                        link.dataset.menuType;

                    const title =
                        link.dataset.menuTitle;

                    const description =
                        link.dataset.menuDescription;

                    /*
                    |--------------------------------------------------------------------------
                    | ACTIVE LINK
                    |--------------------------------------------------------------------------
                    */

                    links.forEach(
                        function (item) {

                            item.classList.remove(
                                'is-active'
                            );

                        }
                    );

                    link.classList.add(
                        'is-active'
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | TITLE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        previewTitle &&
                        title
                    ) {

                        previewTitle.style.opacity =
                            '0';

                        setTimeout(
                            function () {

                                previewTitle.textContent =
                                    title;

                                previewTitle.style.opacity =
                                    '1';

                            },
                            100
                        );

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | DESCRIPTION
                    |--------------------------------------------------------------------------
                    */

                    if (
                        previewDescription &&
                        description
                    ) {

                        previewDescription.style.opacity =
                            '0';

                        setTimeout(
                            function () {

                                previewDescription.textContent =
                                    description;

                                previewDescription.style.opacity =
                                    '1';

                            },
                            100
                        );

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | VISUAL
                    |--------------------------------------------------------------------------
                    */

                    if (menuType) {

                        menuVisuals.forEach(
                            function (visual) {

                                visual.classList.toggle(
                                    'is-active',
                                    visual.dataset.menuVisual === menuType
                                );

                            }
                        );

                    }

                }
            );

        }
    );

    /*
    |--------------------------------------------------------------------------
    | LANGUAGE SWITCHER
    |--------------------------------------------------------------------------
    */

    const languageSwitcher =
        document.getElementById('languageSwitcher');

    const languageThumb =
        document.getElementById('languageSwitcherThumb');

    const languageLinks =
        document.querySelectorAll('[data-language-target]');

    languageLinks.forEach(function (languageLink) {
        languageLink.addEventListener('click', function (event) {
            if (!languageSwitcher || !languageThumb) {
                return;
            }

            const targetLanguage =
                languageLink.dataset.languageTarget;

            const currentLanguage =
                languageSwitcher.dataset.language;

            if (!targetLanguage || targetLanguage === currentLanguage) {
                return;
            }

            event.preventDefault();

            const targetUrl =
                languageLink.href;

            languageSwitcher.dataset.language =
                targetLanguage;

            languageThumb.style.transform =
                targetLanguage === 'en'
                    ? 'translateX(40px)'
                    : 'translateX(0px)';

            languageLinks.forEach(function (item) {
                const isActive =
                    item.dataset.languageTarget === targetLanguage;

                item.classList.toggle('text-black', isActive);
                item.classList.toggle('text-white/45', !isActive);
            });

            window.setTimeout(function () {
                window.location.href = targetUrl;
            }, 260);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | START
    |--------------------------------------------------------------------------
    */

    updateHeader();

    window.addEventListener(
        'scroll',
        updateHeader,
        {
            passive: true
        }
    );

});
</script>

@stack('scripts')

@php
    $whatsAppNumber = preg_replace(
        '/\D+/',
        '',
        $siteSettings['whatsapp_number']
            ?? $siteSettings['contact_phone']
            ?? '905555555555'
    );

    $whatsAppMessage = rawurlencode(
        __('site.whatsapp.message')
    );
@endphp

@if(!empty($whatsAppNumber))

    <div
        id="whatsappFloating"
        class="
            group
            fixed
            bottom-6
            left-6
            z-[100]
        "
    >

        {{-- ===================================================== --}}
        {{-- SOFT WAVES --}}
        {{-- ===================================================== --}}

        <span class="whatsapp-wave whatsapp-wave-1"></span>
        <span class="whatsapp-wave whatsapp-wave-2"></span>
        <span class="whatsapp-wave whatsapp-wave-3"></span>

        <a
            id="whatsappFloatingLink"
            href="https://wa.me/{{ $whatsAppNumber }}?text={{ $whatsAppMessage }}"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ __('site.whatsapp.aria') }}"
            class="
                relative
                flex
                h-[58px]
                w-[58px]
                items-center
                overflow-hidden
                rounded-full
                bg-[#0b0b0b]
                shadow-[0_16px_45px_rgba(0,0,0,.16)]
                transition-all
                duration-500
                ease-[cubic-bezier(.22,1,.36,1)]

                hover:w-[286px]

                sm:group-hover:w-[286px]
            "
        >

            {{-- ===================================================== --}}
            {{-- ICON --}}
            {{-- ===================================================== --}}

            <span
                class="
                    relative
                    z-10
                    flex
                    h-[58px]
                    w-[58px]
                    shrink-0
                    items-center
                    justify-center
                    rounded-full
                    bg-[#0b0b0b]
                    text-white
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    fill="currentColor"
                    class="
                        h-[24px]
                        w-[24px]
                    "
                >
                    <path
                        d="M16.04 3C8.84 3 3 8.76 3 15.86c0 2.48.72 4.9 2.08 6.97L3 29l6.39-2.01a13.16 13.16 0 0 0 6.65 1.82h.01C23.25 28.81 29 23.05 29 15.95 29 8.85 23.24 3 16.04 3Zm0 23.62h-.01a10.98 10.98 0 0 1-5.59-1.53l-.4-.23-3.79 1.19 1.24-3.69-.26-.42a10.72 10.72 0 0 1-1.68-5.78c0-5.92 4.83-10.74 10.78-10.74s10.78 4.82 10.78 10.74c0 5.93-4.84 10.75-10.77 10.75Z"
                    />

                    <path
                        d="M22.09 18.19c-.33-.17-1.93-.95-2.23-1.06-.3-.11-.52-.17-.74.17-.22.33-.85 1.06-1.04 1.28-.19.22-.38.25-.71.08-.33-.16-1.39-.51-2.65-1.63-.98-.87-1.64-1.95-1.83-2.28-.19-.33-.02-.51.14-.67.15-.15.33-.38.49-.57.16-.19.22-.33.33-.55.11-.22.05-.41-.03-.57-.08-.17-.74-1.78-1.01-2.44-.27-.64-.54-.55-.74-.56h-.63c-.22 0-.57.08-.88.41-.3.33-1.15 1.12-1.15 2.74s1.18 3.18 1.34 3.4c.16.22 2.32 3.54 5.63 4.96.79.34 1.4.54 1.88.69.79.25 1.5.21 2.06.13.63-.09 1.93-.79 2.2-1.55.27-.76.27-1.41.19-1.55-.08-.14-.3-.22-.63-.38Z"
                    />
                </svg>

            </span>

            {{-- ===================================================== --}}
            {{-- TEXT --}}
            {{-- ===================================================== --}}

            <span
                class="
                    relative
                    z-10
                    flex
                    min-w-[220px]
                    translate-x-[-8px]
                    flex-col
                    justify-center
                    pl-4
                    pr-5
                    opacity-0
                    transition-all
                    duration-300
                    delay-0

                    group-hover:translate-x-0
                    group-hover:opacity-100
                    group-hover:delay-150
                "
            >

                <span
                    class="
                        whitespace-nowrap
                        text-[13px]
                        font-semibold
                        tracking-[-0.02em]
                        text-white
                    "
                >
                    {{ __('site.whatsapp.title') }}
                </span>

                <span
                    class="
                        mt-1
                        flex
                        items-center
                        gap-2
                        whitespace-nowrap
                        text-[10px]
                        font-medium
                        text-white/45
                    "
                >

                    <span
                        class="
                            h-[6px]
                            w-[6px]
                            rounded-full
                            bg-white/40
                        "
                    ></span>

                    {{ __('site.whatsapp.subtitle') }}

                </span>

            </span>

        </a>

    </div>

    <style>
        #whatsappFloating {
            isolation: isolate;
        }

        #whatsappFloatingLink {
            will-change: width;
        }

        /* =========================================================
           SOFT WAVE ANIMATION
        ========================================================= */

        .whatsapp-wave {
            position: absolute;

            left: 29px;
            top: 29px;

            width: 58px;
            height: 58px;

            border: 1px solid rgba(0, 0, 0, 0.14);
            border-radius: 9999px;

            pointer-events: none;

            transform:
                translate(-50%, -50%)
                scale(.92);

            opacity: 0;

            z-index: -1;

            animation:
                whatsappSoftWave
                3.4s
                cubic-bezier(.22, 1, .36, 1)
                infinite;
        }

        .whatsapp-wave-1 {
            animation-delay: 0s;
        }

        .whatsapp-wave-2 {
            animation-delay: 1.1s;
        }

        .whatsapp-wave-3 {
            animation-delay: 2.2s;
        }

        @keyframes whatsappSoftWave {

            0% {
                transform:
                    translate(-50%, -50%)
                    scale(.92);

                opacity: 0;
            }

            12% {
                opacity: .48;
            }

            55% {
                opacity: .12;
            }

            100% {
                transform:
                    translate(-50%, -50%)
                    scale(1.78);

                opacity: 0;
            }

        }

        /* Hover durumunda dalgaları biraz sakinleştir */
        #whatsappFloating:hover .whatsapp-wave {
            animation-duration: 4.3s;
            border-color: rgba(0, 0, 0, 0.08);
        }

        /* =========================================================
           MOBILE OPEN
        ========================================================= */

        @media (max-width: 639px) {

            #whatsappFloating.is-open #whatsappFloatingLink {
                width: 270px;
            }

            #whatsappFloating.is-open #whatsappFloatingLink > span:nth-child(2) {
                opacity: 1;
                transform: translateX(0);
            }

        }

        /* =========================================================
           REDUCED MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            #whatsappFloatingLink,
            #whatsappFloatingLink * {
                transition: none !important;
            }

            .whatsapp-wave {
                display: none !important;
            }

        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const wrapper =
                document.getElementById(
                    'whatsappFloating'
                );

            const link =
                document.getElementById(
                    'whatsappFloatingLink'
                );

            if (!wrapper || !link) {
                return;
            }

            let firstTap = false;

            link.addEventListener(
                'click',
                function (event) {

                    if (window.innerWidth >= 640) {
                        return;
                    }

                    if (!firstTap) {

                        event.preventDefault();

                        wrapper.classList.add(
                            'is-open'
                        );

                        firstTap = true;

                        return;
                    }

                    firstTap = false;

                }
            );

            document.addEventListener(
                'click',
                function (event) {

                    if (
                        wrapper.contains(
                            event.target
                        )
                    ) {
                        return;
                    }

                    wrapper.classList.remove(
                        'is-open'
                    );

                    firstTap = false;

                }
            );

            window.addEventListener(
                'resize',
                function () {

                    if (window.innerWidth >= 640) {

                        wrapper.classList.remove(
                            'is-open'
                        );

                        firstTap = false;

                    }

                }
            );

        });
    </script>

@endif
</body>

</html>