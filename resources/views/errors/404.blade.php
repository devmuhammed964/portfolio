@extends('layouts.site')

@php
    $errorSiteName = $settings['site_name'] ?? 'Portfolyo';

    $errorSeoTitle =
        'Sayfa Bulunamadı | ' . $errorSiteName;

    $errorMetaDescription =
        'Aradığınız sayfa bulunamadı. Ana sayfaya veya projeler bölümüne geri dönebilirsiniz.';
@endphp

@section(
    'title',
    $errorSeoTitle
)

@section(
    'meta_description',
    $errorMetaDescription
)

@section(
    'robots',
    'noindex, nofollow, noarchive'
)

@section(
    'og_type',
    'website'
)

@section('content')

<style>
    .error-reveal {
        opacity: 0;
        transform: translateY(22px);

        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }

    .error-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (prefers-reduced-motion: reduce) {
        .error-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
</style>


<section
    class="
        relative
        min-h-[calc(100vh-84px)]
        overflow-hidden
        bg-[#f3f4f5]
        px-6
        py-16
        lg:px-10
        lg:py-24
    "
>

    {{-- BACKGROUND DETAILS --}}
    <div
        class="
            pointer-events-none
            absolute
            -right-[220px]
            -top-[220px]
            h-[620px]
            w-[620px]
            rounded-full
            border
            border-black/[0.035]
        "
    ></div>

    <div
        class="
            pointer-events-none
            absolute
            right-[-80px]
            top-[-80px]
            h-[340px]
            w-[340px]
            rounded-full
            border
            border-black/[0.035]
        "
    ></div>

    <div
        class="
            pointer-events-none
            absolute
            bottom-[-240px]
            left-1/2
            h-[380px]
            w-[900px]
            -translate-x-1/2
            rounded-[50%]
            border-t
            border-black/[0.05]
        "
    ></div>


    <div
        class="
            relative
            mx-auto
            grid
            min-h-[620px]
            max-w-[1400px]
            grid-cols-1
            items-center
            gap-14
            lg:grid-cols-[1fr_.85fr]
            lg:gap-20
        "
    >

        {{-- LEFT --}}
        <div class="error-reveal max-w-[760px]">

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
                    404 · Sayfa Bulunamadı
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
                    max-w-[760px]
                    text-[48px]
                    font-medium
                    leading-[1.01]
                    tracking-[-0.055em]
                    text-[#111]
                    sm:text-[64px]
                    lg:text-[78px]
                "
            >
                Aradığınız sayfa

                <span class="text-black/35">
                    burada değil.
                </span>
            </h1>


            <p
                class="
                    mt-6
                    max-w-[580px]
                    text-[13px]
                    leading-7
                    text-black/42
                    sm:text-[15px]
                "
            >
                Bağlantı kaldırılmış, adres değiştirilmiş veya yanlış yazılmış
                olabilir. Ana sayfaya dönebilir ya da projeleri incelemeye
                devam edebilirsiniz.
            </p>


            <div
                class="
                    mt-9
                    flex
                    flex-wrap
                    items-center
                    gap-3
                "
            >

                <a
                    href="{{ route('home') }}"
                    class="
                        group
                        inline-flex
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
                        hover:bg-black
                    "
                >
                    Ana Sayfaya Dön

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


                <a
                    href="{{ route('projects.index') }}"
                    class="
                        group
                        inline-flex
                        items-center
                        gap-4
                        rounded-full
                        border
                        border-black/[0.08]
                        bg-white/65
                        px-6
                        py-4
                        text-[10px]
                        font-medium
                        text-black/55
                        transition-all
                        duration-300
                        hover:-translate-y-0.5
                        hover:border-black/15
                        hover:bg-white
                        hover:text-black
                    "
                >
                    Projeleri İncele

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



        {{-- RIGHT VISUAL --}}
        <div
            class="
                error-reveal
                relative
                hidden
                min-h-[500px]
                lg:block
            "
            style="transition-delay: 100ms;"
        >

            <svg
                class="
                    pointer-events-none
                    absolute
                    inset-0
                    h-full
                    w-full
                "
                viewBox="0 0 620 520"
                fill="none"
            >
                <ellipse
                    cx="310"
                    cy="275"
                    rx="245"
                    ry="175"
                    stroke="rgba(0,0,0,.05)"
                />

                <path
                    d="M65 390C155 315 245 280 340 284C445 288 525 330 585 395"
                    stroke="rgba(0,0,0,.04)"
                />
            </svg>


            <div
                class="
                    absolute
                    left-1/2
                    top-1/2
                    w-[78%]
                    -translate-x-1/2
                    -translate-y-1/2
                    rounded-[30px]
                    bg-[#0b0b0b]
                    p-8
                    text-white
                    shadow-[0_30px_85px_rgba(0,0,0,.20)]
                "
            >

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
                            uppercase
                            tracking-[0.18em]
                            text-white/35
                        "
                    >
                        Error
                    </span>

                    <span
                        class="
                            h-2
                            w-2
                            rounded-full
                            bg-white/70
                        "
                    ></span>

                </div>


                <div class="mt-12">

                    <p
                        class="
                            text-[92px]
                            font-medium
                            leading-none
                            tracking-[-0.07em]
                            text-white
                        "
                    >
                        404
                    </p>

                    <p
                        class="
                            mt-5
                            max-w-[300px]
                            text-[11px]
                            leading-6
                            text-white/45
                        "
                    >
                        İstenen içerik bu adreste bulunamadı.
                    </p>

                </div>


                <div
                    class="
                        mt-12
                        border-t
                        border-white/[0.08]
                        pt-5
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                        "
                    >

                        <span
                            class="
                                text-[7px]
                                uppercase
                                tracking-[0.16em]
                                text-white/25
                            "
                        >
                            Status
                        </span>

                        <span
                            class="
                                text-[7px]
                                font-medium
                                text-white/60
                            "
                        >
                            Page Not Found
                        </span>

                    </div>

                </div>

            </div>


            <div
                class="
                    absolute
                    left-[2%]
                    top-[12%]
                    rounded-[20px]
                    border
                    border-black/[0.055]
                    bg-white
                    px-5
                    py-4
                    shadow-[0_18px_45px_rgba(0,0,0,.07)]
                "
            >
                <p
                    class="
                        text-[7px]
                        uppercase
                        tracking-[0.16em]
                        text-black/28
                    "
                >
                    HTTP
                </p>

                <p
                    class="
                        mt-2
                        text-[18px]
                        font-medium
                        text-black
                    "
                >
                    404
                </p>
            </div>


            <div
                class="
                    absolute
                    bottom-[10%]
                    right-[2%]
                    rotate-[4deg]
                    rounded-[20px]
                    bg-[#111]
                    px-5
                    py-4
                    shadow-[0_22px_55px_rgba(0,0,0,.16)]
                "
            >

                <p
                    class="
                        font-mono
                        text-[7px]
                        leading-5
                        text-white/70
                    "
                >
                    route → missing
                    <br>
                    request → 404
                    <br>
                    fallback → ready
                </p>

            </div>

        </div>

    </div>

</section>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const elements =
        document.querySelectorAll(
            '.error-reveal'
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