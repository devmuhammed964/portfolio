@extends('layouts.site')

@php

    $aboutIsEnglish = app()->getLocale() === 'en';

    $aboutUrl = $aboutIsEnglish

        ? route('en.about', ['locale' => 'en'])

        : route('about');

    $contactUrl = $aboutIsEnglish

        ? route('en.contact', ['locale' => 'en'])

        : route('contact');

    $siteName = $settings['site_name'] ?? 'Portfolyo';

    $copy = $aboutIsEnglish ? [

        'seo_title' => 'About Me – Full Stack Developer | ' . $siteName,

        'seo_description' => 'Full Stack Developer focused on Laravel, PHP, modern web applications, admin panels, API integrations, databases and scalable digital products.',

        'hero_eyebrow' => 'About Me',

        'hero_title_1' => 'I build digital products',

        'hero_title_2' => 'from idea to production.',

        'hero_text' => 'I graduated from Konya Technical University Computer Programming. I am currently completing my bachelor’s degree in Management Information Systems at Necmettin Erbakan University through DGS. For more than 2 years, I have been working at Sekiz Creative as a Full Stack Developer and taking an active role in software development, interfaces, backend systems, databases and digital products.',

        'profile' => 'Profile',

        'profile_title_1' => 'Full Stack',

        'profile_title_2' => 'Developer',

        'profile_footer' => 'Design · Development · Product',

        'approach_eyebrow' => 'My Approach',

        'approach_title_1' => 'Beyond writing code,',

        'approach_title_2' => 'I build working products.',

        'approach_text' => 'I approach projects together with user experience, software architecture, performance and business goals.',

        'principles' => [

            [

                '01',

                'Product-Oriented Development',

                'I evaluate projects not only as code, but together with user needs, business goals and sustainable development.'

            ],

            [

                '02',

                'End-to-End Development',

                'I take an active role across interface, backend, database, API, management panel and deployment processes.'

            ],

            [

                '03',

                'Sustainable Architecture',

                'I focus on maintainable and scalable systems that can continue to evolve after launch.'

            ],

        ],

        'journey_eyebrow' => 'Education & Experience',

        'journey_title_1' => 'My development journey',

        'journey_title_2' => 'continues academically and professionally.',

        'education' => 'Education',

        'experience' => 'Experience',

        'ktu' => 'Konya Technical University',

        'ktu_program' => 'Computer Programming',

        'ktu_status' => 'Graduate',

        'neu' => 'Necmettin Erbakan University',

        'neu_program' => 'Management Information Systems',

        'neu_status' => 'Bachelor’s Degree · Continuing via DGS',

        'academic_focus' => 'Curriculum Vitae',

        'academic_focus_title' => 'Review My CV',

        'academic_focus_text' => 'Take a closer look at my education, experience, technical skills and professional background.',

        'academic_focus_button' => 'View CV',

        'sekiz' => 'Sekiz Creative',

        'role' => 'Full Stack Developer',

        'duration' => '2+ Years',

        'experience_text' => 'Software development, digital products, admin panels, API integrations, database architecture, interface development, deployment and maintenance processes.',

        'interactive' => 'Sekiz Interactive',

        'interactive_role' => 'Full Stack Developer',

        'interactive_text' => 'I work on software products, web applications, management systems, integrations and scalable digital solutions.',

        'stack_eyebrow' => 'Technology Stack',

        'stack_title_1' => 'Technologies I use',

        'stack_title_2' => 'across different layers.',

        'stack_text' => 'I select technologies according to the needs of the project and work across frontend, backend, mobile, databases and development tooling.',

        'process_eyebrow' => 'Process',

        'process_title_1' => 'From problem',

        'process_title_2' => 'to working product.',

        'process_text' => 'I keep the process clear, measurable and open to improvement from first idea to production.',

        'process' => [

            [

                '01',

                'Analysis',

                'I clarify needs, users, business goals and technical requirements.'

            ],

            [

                '02',

                'Architecture & Interface',

                'I establish the information architecture, interface and technical foundation.'

            ],

            [

                '03',

                'Development',

                'I build frontend, backend, database, APIs and management layers as required.'

            ],

            [

                '04',

                'Launch & Improve',

                'I deploy the product, monitor performance and keep it ready for further development.'

            ],

        ],

        'cta_eyebrow' => 'Work Together',

        'cta_title_1' => 'Have an idea?',

        'cta_title_2' => 'Let’s turn it into a working product.',

        'cta_text' => 'For a software project, digital product, corporate platform or custom solution, we can plan the process together.',

        'cta_button' => 'Get in Touch',

    ] : [

        'seo_title' => 'Hakkımda – Full Stack Developer | ' . $siteName,

        'seo_description' => 'Laravel, PHP, modern web uygulamaları, yönetim panelleri, API entegrasyonları, veritabanları ve ölçeklenebilir dijital ürünler geliştiren Full Stack Developer.',

        'hero_eyebrow' => 'Hakkımda',

        'hero_title_1' => 'Fikirden yayına kadar',

        'hero_title_2' => 'dijital ürünler geliştiriyorum.',

        'hero_text' => 'Konya Teknik Üniversitesi Bilgisayar Programcılığı mezunuyum. Eğitimime Necmettin Erbakan Üniversitesi Yönetim Bilişim Sistemleri bölümünde DGS ile lisans düzeyinde devam ediyorum. 2 yılı aşkın süredir Sekiz Creative bünyesinde Full Stack Developer olarak yazılım geliştirme, arayüz, backend, veritabanı ve dijital ürün süreçlerinde aktif rol alıyorum.',

        'profile' => 'Profil',

        'profile_title_1' => 'Full Stack',

        'profile_title_2' => 'Developer',

        'profile_footer' => 'Tasarım · Geliştirme · Ürün',

        'approach_eyebrow' => 'Yaklaşımım',

        'approach_title_1' => 'Kod yazmanın ötesinde,',

        'approach_title_2' => 'çalışan ürünler geliştiriyorum.',

        'approach_text' => 'Her projeyi kullanıcı deneyimi, yazılım mimarisi, performans ve iş hedefleriyle birlikte ele alıyorum.',

        'principles' => [

            [

                '01',

                'Ürün Odaklı Geliştirme',

                'Projeleri yalnızca kod olarak değil; kullanıcı ihtiyacı, iş hedefi ve sürdürülebilir geliştirme süreciyle birlikte değerlendiriyorum.'

            ],

            [

                '02',

                'Uçtan Uca Geliştirme',

                'Arayüz, backend, veritabanı, API, yönetim paneli ve yayın süreçlerinin tamamında aktif rol alıyorum.'

            ],

            [

                '03',

                'Sürdürülebilir Mimari',

                'Bakımı kolay, ölçeklenebilir ve yayından sonra geliştirilmeye devam edebilen sistemler kurmaya odaklanıyorum.'

            ],

        ],

        'journey_eyebrow' => 'Eğitim & Deneyim',

        'journey_title_1' => 'Gelişim yolculuğum',

        'journey_title_2' => 'akademik ve profesyonel olarak devam ediyor.',

        'education' => 'Eğitim',

        'experience' => 'Deneyim',

        'ktu' => 'Konya Teknik Üniversitesi',

        'ktu_program' => 'Bilgisayar Programcılığı',

        'ktu_status' => 'Mezun',

        'neu' => 'Necmettin Erbakan Üniversitesi',

        'neu_program' => 'Yönetim Bilişim Sistemleri',

        'neu_status' => 'Lisans · DGS ile devam ediyor',

        'academic_focus' => 'Özgeçmiş',

        'academic_focus_title' => 'CV’mi İncele',

        'academic_focus_text' => 'Eğitim, deneyim, teknik yetkinlikler ve profesyonel geçmişimin tamamını tek yerde inceleyebilirsin.',

        'academic_focus_button' => 'CV’yi Görüntüle',

        'sekiz' => 'Sekiz Creative',

        'role' => 'Full Stack Developer',

        'duration' => '2+ Yıl',

        'experience_text' => 'Yazılım geliştirme, dijital ürünler, yönetim panelleri, API entegrasyonları, veritabanı mimarisi, arayüz geliştirme, deployment ve bakım süreçleri.',

        'interactive' => 'Sekiz Interactive',

        'interactive_role' => 'Full Stack Developer',

        'interactive_text' => 'Yazılım ürünleri, web uygulamaları, yönetim sistemleri, entegrasyonlar ve ölçeklenebilir dijital çözümler üzerinde çalışıyorum.',

        'stack_eyebrow' => 'Teknoloji Stack',

        'stack_title_1' => 'Farklı katmanlarda',

        'stack_title_2' => 'kullandığım teknolojiler.',

        'stack_text' => 'Projeye göre doğru teknolojiyi seçiyor; frontend, backend, mobil, veritabanı ve geliştirme araçlarını birlikte kullanıyorum.',

        'process_eyebrow' => 'Çalışma Süreci',

        'process_title_1' => 'Problemden',

        'process_title_2' => 'çalışan ürüne.',

        'process_text' => 'İlk fikirden canlıya çıkışa kadar süreci sade, ölçülebilir ve geliştirilebilir tutuyorum.',

        'process' => [

            [

                '01',

                'Analiz',

                'İhtiyacı, kullanıcıyı, iş hedeflerini ve teknik gereksinimleri netleştiriyorum.'

            ],

            [

                '02',

                'Mimari & Arayüz',

                'Doğru bilgi mimarisini, kullanıcı arayüzünü ve teknik altyapıyı oluşturuyorum.'

            ],

            [

                '03',

                'Geliştirme',

                'İhtiyaca göre frontend, backend, veritabanı, API ve yönetim katmanlarını geliştiriyorum.'

            ],

            [

                '04',

                'Yayın & Gelişim',

                'Ürünü yayına alıyor, performansı takip ediyor ve sonraki geliştirmelere hazır tutuyorum.'

            ],

        ],

        'cta_eyebrow' => 'Birlikte Çalışalım',

        'cta_title_1' => 'Bir fikrin mi var?',

        'cta_title_2' => 'Çalışan bir ürüne dönüştürelim.',

        'cta_text' => 'Yazılım projesi, dijital ürün, kurumsal platform veya özel bir çözüm için süreci birlikte planlayabiliriz.',

        'cta_button' => 'İletişime Geç',

    ];

    $technologies = [

        ['HTML5', 'Frontend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg'],

        ['CSS3', 'Frontend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg'],

        ['JavaScript', 'Frontend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg'],

        ['React', 'Frontend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg'],

        ['Next.js', 'Frontend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nextjs/nextjs-original.svg'],

        ['Bootstrap', 'Frontend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg'],

        ['Tailwind CSS', 'Frontend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg'],

        ['React Native', 'Mobile', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg'],

        ['Flutter', 'Mobile', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/flutter/flutter-original.svg'],

        ['Node.js', 'Backend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg'],

        ['PHP', 'Backend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg'],

        ['Laravel', 'Backend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg'],

        ['Python', 'Backend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg'],

        ['Django', 'Backend', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/django/django-plain.svg'],

        ['C', 'Language', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/c/c-original.svg'],

        ['MySQL', 'Database', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg'],

        ['PostgreSQL', 'Database', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postgresql/postgresql-original.svg'],

        ['SQLite', 'Database', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/sqlite/sqlite-original.svg'],

        ['Firebase', 'Platform', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/firebase/firebase-original.svg'],

        ['Supabase', 'Platform', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/supabase/supabase-original.svg'],

        ['Docker', 'Tool', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg'],

        ['Postman', 'Tool', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postman/postman-original.svg'],

        ['REST API', 'Architecture', null],

    ];

    $numbers = $aboutIsEnglish

        ? [

            ['2+', 'Years Professional Experience'],

            ['2', 'University Education Paths'],

            ['20+', 'Technologies & Tools'],

            ['Full Stack', 'End-to-End Development'],

        ]

        : [

            ['2+', 'Yıl Profesyonel Deneyim'],

            ['2', 'Üniversite Eğitim Süreci'],

            ['20+', 'Teknoloji & Araç'],

            ['Full Stack', 'Uçtan Uca Geliştirme'],

        ];

@endphp

@section('title', $copy['seo_title'])

@section('meta_description', $copy['seo_description'])

@section('canonical', $aboutUrl)

@section('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')

@section('og_type', 'website')

@section('og_image_alt', $copy['seo_title'])

@section('content')

<style>

    .about-reveal {

        opacity: 0;

        transform: translateY(24px);

        transition:

            opacity .8s cubic-bezier(.22, 1, .36, 1),

            transform .8s cubic-bezier(.22, 1, .36, 1);

    }

    .about-reveal.is-visible {

        opacity: 1;

        transform: translateY(0);

    }

    .about-logo {

        transition:

            transform .5s cubic-bezier(.22, 1, .36, 1),

            opacity .4s ease;

    }

    .about-logo-card {

        transition:

            transform .5s cubic-bezier(.22, 1, .36, 1),

            border-color .4s ease,

            background-color .4s ease,

            box-shadow .4s ease;

    }

    .about-education-item:hover .about-logo-card,

    .about-experience-item:hover .about-logo-card {

        transform: translateY(-5px) scale(1.035);

        border-color: rgba(255,255,255,.18);

        background: rgba(255,255,255,.065);

        box-shadow: 0 18px 42px rgba(0,0,0,.22);

    }

    .about-education-item:hover .about-logo,

    .about-experience-item:hover .about-logo {

        transform: scale(1.08);

        opacity: 1;

    }

    @media (prefers-reduced-motion: reduce) {

        .about-reveal {

            opacity: 1 !important;

            transform: none !important;

            transition: none !important;

        }

        .about-logo,

        .about-logo-card {

            transition: none !important;

        }

    }

</style>

{{-- HERO --}}

<section class="relative overflow-hidden bg-[#f3f4f5] pb-20 pt-10 lg:pb-28 lg:pt-16">

    <div class="pointer-events-none absolute left-1/2 top-[24%] h-[520px] w-[900px] -translate-x-1/2 rounded-full bg-white/80 blur-[120px]"></div>

    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">

        <div class="grid grid-cols-1 items-center gap-14 lg:grid-cols-[1.05fr_.95fr] lg:gap-20">

            <div class="about-reveal">

                <div class="flex items-center gap-3">

                    <span class="h-px w-9 bg-black/20"></span>

                    <span class="text-[9px] font-medium uppercase tracking-[0.24em] text-black/40">

                        {{ $copy['hero_eyebrow'] }}

                    </span>

                    <span class="h-[5px] w-[5px] rounded-full bg-black"></span>

                </div>

                <h1 class="mt-8 max-w-[860px] text-[46px] font-medium leading-[1.02] tracking-[-0.05em] text-[#111] sm:text-[60px] lg:text-[72px] xl:text-[80px]">

                    {{ $copy['hero_title_1'] }}

                    <span class="block text-black/35">

                        {{ $copy['hero_title_2'] }}

                    </span>

                </h1>

                <p class="mt-8 max-w-[720px] text-[14px] leading-7 text-black/45 sm:text-[16px] sm:leading-8">

                    {{ $copy['hero_text'] }}

                </p>

            </div>

            <div

                class="about-reveal relative min-h-[440px] lg:min-h-[520px]"

                style="transition-delay: 100ms;"

            >

                <div class="absolute left-[7%] top-[8%] h-[82%] w-[82%] rounded-full border border-black/[0.05]"></div>

                <div class="absolute bottom-[8%] left-[13%] w-[74%] rotate-[-2deg] rounded-[30px] bg-[#0c0c0c] p-7 text-white shadow-[0_30px_80px_rgba(0,0,0,.18)] transition-all duration-700 hover:-translate-y-2 hover:rotate-0 sm:p-9">

                    <div class="flex items-center justify-between">

                        <span class="text-[8px] uppercase tracking-[0.20em] text-white/35">

                            {{ $copy['profile'] }}

                        </span>

                        <span class="h-2 w-2 rounded-full bg-white/70"></span>

                    </div>

                    <div class="mt-16">

                        <p class="text-[34px] font-medium leading-[1.03] tracking-[-0.05em] sm:text-[42px]">

                            {{ $copy['profile_title_1'] }}

                            <br>

                            {{ $copy['profile_title_2'] }}

                        </p>

                    </div>

                    <div class="mt-14 border-t border-white/[0.08] pt-5">

                        <span class="text-[8px] uppercase tracking-[0.18em] text-white/40">

                            {{ $copy['profile_footer'] }}

                        </span>

                    </div>

                </div>

                <div class="absolute left-[1%] top-[14%] rounded-[20px] border border-black/[0.055] bg-white px-5 py-4 shadow-[0_18px_45px_rgba(0,0,0,.07)]">

                    <p class="text-[7px] uppercase tracking-[0.16em] text-black/30">

                        {{ $copy['education'] }}

                    </p>

                    <p class="mt-2 text-[11px] font-medium text-black/70">

                        KTÜ · NEÜ

                    </p>

                </div>

                <div class="absolute right-[1%] top-[18%] rotate-[4deg] rounded-[20px] bg-[#111] px-5 py-4 text-white shadow-[0_22px_60px_rgba(0,0,0,.18)]">

                    <p class="text-[7px] uppercase tracking-[0.16em] text-white/30">

                        {{ $copy['experience'] }}

                    </p>

                    <p class="mt-2 text-[11px] font-medium">

                        Sekiz Creative · 2+

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- APPROACH --}}

<section class="bg-[#f3f4f5] py-20 lg:py-28">

    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[.72fr_1.28fr] lg:gap-20">

            <div class="about-reveal lg:sticky lg:top-28 lg:self-start">

                <div class="flex items-center gap-3">

                    <span class="h-px w-8 bg-black/20"></span>

                    <span class="text-[9px] font-medium uppercase tracking-[0.24em] text-black/40">

                        {{ $copy['approach_eyebrow'] }}

                    </span>

                </div>

                <h2 class="mt-6 max-w-[470px] text-[36px] font-medium leading-[1.08] tracking-[-0.04em] text-[#111] sm:text-[44px]">

                    {{ $copy['approach_title_1'] }}

                    <span class="text-black/35">

                        {{ $copy['approach_title_2'] }}

                    </span>

                </h2>

                <p class="mt-5 max-w-[440px] text-[13px] leading-7 text-black/40">

                    {{ $copy['approach_text'] }}

                </p>

            </div>

            <div class="space-y-4">

                @foreach($copy['principles'] as $principle)

                    <div

                        class="about-reveal group grid grid-cols-[auto_1fr_auto] items-center gap-6 rounded-[24px] border border-black/[0.055] bg-white/70 px-6 py-7 shadow-[0_14px_40px_rgba(0,0,0,.025)] transition-all duration-500 hover:-translate-y-1 hover:bg-white hover:shadow-[0_22px_60px_rgba(0,0,0,.07)] sm:px-8"

                        style="transition-delay: {{ $loop->index * 80 }}ms;"

                    >

                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-[#111] text-[9px] font-medium text-white">

                            {{ $principle[0] }}

                        </span>

                        <div>

                            <h3 class="text-[19px] font-medium tracking-[-0.025em] text-[#111]">

                                {{ $principle[1] }}

                            </h3>

                            <p class="mt-2 max-w-[650px] text-[12px] leading-6 text-black/38">

                                {{ $principle[2] }}

                            </p>

                        </div>

                        <span class="hidden text-black/20 transition-all duration-300 group-hover:translate-x-1 group-hover:text-black sm:block">

                            →

                        </span>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</section>

{{-- EDUCATION & EXPERIENCE --}}

<section class="bg-[#111] py-20 text-white lg:py-24">

    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">

        <div class="about-reveal mb-12">

            <span class="text-[9px] font-medium uppercase tracking-[0.24em] text-white/35">

                {{ $copy['journey_eyebrow'] }}

            </span>

            <h2 class="mt-5 max-w-[820px] text-[36px] font-medium leading-[1.08] tracking-[-0.04em] sm:text-[46px]">

                {{ $copy['journey_title_1'] }}

                <span class="text-white/35">

                    {{ $copy['journey_title_2'] }}

                </span>

            </h2>

        </div>

        <div class="grid grid-cols-1 gap-px overflow-hidden rounded-[26px] border border-white/[0.08] bg-white/[0.08] lg:grid-cols-2">

            {{-- EDUCATION --}}

            <div class="about-reveal bg-[#111] p-7 sm:p-9">

                <span class="text-[8px] uppercase tracking-[0.18em] text-white/30">

                    {{ $copy['education'] }}

                </span>

                <div class="mt-8">

                    {{-- KONYA TEKNİK --}}

                    <div class="about-education-item group flex items-start gap-6">

                        <div class="about-logo-card flex h-[92px] w-[92px] shrink-0 items-center justify-center rounded-[22px] border border-white/[0.08] bg-white/[0.035] p-2.5">

                            <img

                                src="{{ asset('logo/konya-teknik.png') }}"

                                alt="{{ $copy['ktu'] }}"

                                class="about-logo max-h-full max-w-full object-contain opacity-90"

                            >

                        </div>

                        <div class="min-w-0 flex-1 pt-1">

                            <h3 class="text-[21px] font-medium text-white">

                                {{ $copy['ktu'] }}

                            </h3>

                            <p class="mt-2 text-[13px] text-white/55">

                                {{ $copy['ktu_program'] }}

                            </p>

                            <span class="mt-3 inline-flex rounded-full border border-white/10 px-3 py-1.5 text-[8px] uppercase tracking-[0.14em] text-white/40 transition-all duration-300 group-hover:border-white/20 group-hover:text-white/65">

                                {{ $copy['ktu_status'] }}

                            </span>

                        </div>

                    </div>

                    {{-- NECMETTİN ERBAKAN --}}

                    <div class="about-education-item group mt-8 flex items-start gap-6 border-t border-white/[0.08] pt-8">

                        <div class="about-logo-card flex h-[92px] w-[92px] shrink-0 items-center justify-center rounded-[22px] border border-white/[0.08] bg-white/[0.035] p-2.5">

                            <img

                                src="{{ asset('logo/necmettin.png') }}"

                                alt="{{ $copy['neu'] }}"

                                class="about-logo max-h-full max-w-full object-contain opacity-90"

                            >

                        </div>

                        <div class="min-w-0 flex-1 pt-1">

                            <h3 class="text-[21px] font-medium text-white">

                                {{ $copy['neu'] }}

                            </h3>

                            <p class="mt-2 text-[13px] text-white/55">

                                {{ $copy['neu_program'] }}

                            </p>

                            <span class="mt-3 inline-flex rounded-full border border-white/10 px-3 py-1.5 text-[8px] uppercase tracking-[0.14em] text-white/40 transition-all duration-300 group-hover:border-white/20 group-hover:text-white/65">

                                {{ $copy['neu_status'] }}

                            </span>

                        </div>

                    </div>

                    {{-- CV CARD --}}

                    <div class="mt-8 border-t border-white/[0.08] pt-8">

                        <a

                            href="{{ asset('cv/muhammed-cicek-cv.pdf') }}"

                            target="_blank"

                            rel="noopener noreferrer"
                            aria-label="{{ $copy['academic_focus_title'] }}"
                            class="group relative block overflow-hidden rounded-[22px] border border-white/[0.08] bg-white/[0.025] p-5 transition-all duration-500 hover:-translate-y-1 hover:border-white/[0.16] hover:bg-white/[0.05] hover:shadow-[0_18px_42px_rgba(0,0,0,.18)]"

                        >

                            <div class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full border border-white/[0.05] transition-transform duration-700 group-hover:scale-125"></div>

                            <div class="relative z-10 flex items-start gap-5">

                                <div class="flex h-[58px] w-[58px] shrink-0 items-center justify-center rounded-[16px] border border-white/[0.08] bg-white/[0.04]">

                                    <svg

                                        viewBox="0 0 24 24"

                                        fill="none"

                                        class="h-6 w-6 text-white/75 transition-transform duration-500 group-hover:-translate-y-0.5 group-hover:scale-110"

                                        stroke="currentColor"

                                        stroke-width="1.5"

                                        stroke-linecap="round"

                                        stroke-linejoin="round"

                                    >

                                        <path d="M7 3.5h7l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z"/>

                                        <path d="M14 3.5V7h3"/>

                                        <path d="M9 11h6"/>

                                        <path d="M9 14h6"/>

                                        <path d="M9 17h4"/>

                                    </svg>

                                </div>

                                <div class="min-w-0 flex-1">

                                    <span class="text-[7px] uppercase tracking-[0.18em] text-white/30">

                                        {{ $copy['academic_focus'] }}

                                    </span>

                                    <h3 class="mt-2 text-[18px] font-medium text-white">

                                        {{ $copy['academic_focus_title'] }}

                                    </h3>

                                    <p class="mt-2 max-w-[470px] text-[11px] leading-6 text-white/42">

                                        {{ $copy['academic_focus_text'] }}

                                    </p>

                                    <div class="mt-4 flex items-center gap-2 text-[9px] font-medium text-white/55 transition-colors duration-300 group-hover:text-white">

                                        <span>{{ $copy['academic_focus_button'] }}</span>

                                        <svg

                                            viewBox="0 0 24 24"

                                            fill="none"

                                            class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"

                                            stroke="currentColor"

                                            stroke-width="1.6"

                                        >

                                            <path d="M5 12h14"/>

                                            <path d="m14 7 5 5-5 5"/>

                                        </svg>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

            {{-- EXPERIENCE --}}

            <div

                class="about-reveal bg-[#111] p-7 sm:p-9"

                style="transition-delay: 100ms;"

            >

                <span class="text-[8px] uppercase tracking-[0.18em] text-white/30">

                    {{ $copy['experience'] }}

                </span>

                <div class="about-experience-item group mt-8">

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">

                        <div class="flex items-start gap-6">

                            <div class="about-logo-card flex h-[92px] w-[92px] shrink-0 items-center justify-center rounded-[22px] border border-white/[0.08] bg-white/[0.035] p-2.5">

                                <img

                                    src="{{ asset('logo/sekizcreative.png') }}"

                                    alt="Sekiz Creative"

                                    class="about-logo max-h-full max-w-full object-contain opacity-90"

                                >

                            </div>

                            <div class="pt-1">

                                <h3 class="text-[24px] font-medium text-white">

                                    {{ $copy['sekiz'] }}

                                </h3>

                                <p class="mt-2 text-[14px] text-white/60">

                                    {{ $copy['role'] }}

                                </p>

                            </div>

                        </div>

                        <span class="w-fit rounded-full border border-white/10 px-3 py-1.5 text-[8px] uppercase tracking-[0.14em] text-white/40 transition-all duration-300 group-hover:border-white/20 group-hover:text-white/65">

                            {{ $copy['duration'] }}

                        </span>

                    </div>

                    <p class="mt-8 max-w-[600px] border-t border-white/[0.08] pt-8 text-[12px] leading-7 text-white/45">

                        {{ $copy['experience_text'] }}

                    </p>

                </div>

                {{-- SEKIZ INTERACTIVE --}}

                <div class="about-experience-item group mt-8 border-t border-white/[0.08] pt-8">

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">

                        <div class="flex items-start gap-6">

                            <div class="about-logo-card flex h-[92px] w-[92px] shrink-0 items-center justify-center rounded-[22px] border border-white/[0.08] bg-white/[0.035] p-2.5">

                                <img

                                    src="{{ asset('logo/sekizinteractive.png') }}"

                                    alt="Sekiz Interactive"
                                    width="92"
                                    height="92"
                                    loading="lazy"
                                    decoding="async"
                                    class="about-logo max-h-full max-w-full object-contain opacity-90"

                                >

                            </div>

                            <div class="pt-1">

                                <h3 class="text-[24px] font-medium text-white">

                                    {{ $copy['interactive'] }}

                                </h3>

                                <p class="mt-2 text-[14px] text-white/60">

                                    {{ $copy['interactive_role'] }}

                                </p>

                            </div>

                        </div>

                    </div>

                    <p class="mt-8 max-w-[600px] border-t border-white/[0.08] pt-8 text-[12px] leading-7 text-white/45">

                        {{ $copy['interactive_text'] }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- TECHNOLOGIES --}}

<section class="bg-[#f3f4f5] py-20 lg:py-28">

    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">

        <div class="about-reveal flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <span class="h-px w-8 bg-black/20"></span>

                    <span class="text-[9px] font-medium uppercase tracking-[0.24em] text-black/40">

                        {{ $copy['stack_eyebrow'] }}

                    </span>

                </div>

                <h2 class="mt-5 max-w-[720px] text-[36px] font-medium leading-[1.08] tracking-[-0.04em] text-[#111] sm:text-[46px]">

                    {{ $copy['stack_title_1'] }}

                    <span class="text-black/35">

                        {{ $copy['stack_title_2'] }}

                    </span>

                </h2>

            </div>

            <p class="max-w-[430px] text-[12px] leading-6 text-black/38">

                {{ $copy['stack_text'] }}

            </p>

        </div>

        <div class="mt-12 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @foreach($technologies as $tech)

                <div class="about-reveal group flex min-h-[86px] items-center gap-4 rounded-[18px] border border-black/[0.055] bg-white/70 px-5 py-4 shadow-[0_10px_30px_rgba(0,0,0,.025)] transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-[0_18px_45px_rgba(0,0,0,.06)]">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-[13px] border border-black/[0.06] bg-white">

                        @if($tech[2])

                            <img

                                src="{{ $tech[2] }}"

                                alt="{{ $tech[0] }}"

                                loading="lazy"

                                class="h-7 w-7 object-contain"

                            >

                        @else

                            <span class="text-[8px] font-semibold text-black/50">

                                API

                            </span>

                        @endif

                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-[13px] font-medium text-black/80">

                            {{ $tech[0] }}

                        </p>

                        <p class="mt-1 text-[8px] uppercase tracking-[0.14em] text-black/30">

                            {{ $tech[1] }}

                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- NUMBERS --}}

<section class="bg-[#111] py-16 text-white lg:py-20">

    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">

        <div class="about-reveal grid grid-cols-2 gap-y-10 divide-x divide-white/[0.08] md:grid-cols-4">

            @foreach($numbers as $number)

                <div class="px-6 first:pl-0 lg:px-10">

                    <p class="text-[36px] font-medium tracking-[-0.05em] text-white lg:text-[48px]">

                        {{ $number[0] }}

                    </p>

                    <p class="mt-3 max-w-[180px] text-[8px] uppercase leading-5 tracking-[0.15em] text-white/30">

                        {{ $number[1] }}

                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- PROCESS --}}

<section class="bg-[#f3f4f5] py-20 lg:py-28">

    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">

        <div class="about-reveal flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <span class="h-px w-8 bg-black/20"></span>

                    <span class="text-[9px] font-medium uppercase tracking-[0.24em] text-black/40">

                        {{ $copy['process_eyebrow'] }}

                    </span>

                </div>

                <h2 class="mt-5 max-w-[650px] text-[36px] font-medium leading-[1.08] tracking-[-0.04em] text-[#111] sm:text-[44px]">

                    {{ $copy['process_title_1'] }}

                    <span class="text-black/35">

                        {{ $copy['process_title_2'] }}

                    </span>

                </h2>

            </div>

            <p class="max-w-[430px] text-[12px] leading-6 text-black/38 lg:text-right">

                {{ $copy['process_text'] }}

            </p>

        </div>

        <div class="mt-12 grid grid-cols-1 border-t border-black/[0.07] md:grid-cols-4">

            @foreach($copy['process'] as $step)

                <div

                    class="about-reveal border-b border-black/[0.07] py-8 md:border-b-0 md:border-r md:px-7 md:first:pl-0 md:last:border-r-0 md:last:pr-0"

                    style="transition-delay: {{ $loop->index * 80 }}ms;"

                >

                    <span class="text-[10px] font-medium text-black/25">

                        {{ $step[0] }}

                    </span>

                    <h3 class="mt-8 text-[21px] font-medium tracking-[-0.025em] text-[#111]">

                        {{ $step[1] }}

                    </h3>

                    <p class="mt-3 max-w-[250px] text-[11px] leading-6 text-black/38">

                        {{ $step[2] }}

                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- CTA --}}

<section class="bg-[#f3f4f5] px-6 pb-20 lg:px-10 lg:pb-28">

    <div class="about-reveal relative mx-auto max-w-[1400px] overflow-hidden rounded-[36px] bg-[#0a0a0a] px-7 py-16 text-white shadow-[0_30px_90px_rgba(0,0,0,.15)] sm:px-10 lg:px-16 lg:py-20">

        <div class="pointer-events-none absolute -bottom-[160px] left-1/2 h-[260px] w-[900px] -translate-x-1/2 rounded-[50%] border-t border-white/[0.10]"></div>

        <div class="relative z-10 flex flex-col gap-10 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <span class="text-[8px] font-medium uppercase tracking-[0.20em] text-white/30">

                    {{ $copy['cta_eyebrow'] }}

                </span>

                <h2 class="mt-5 max-w-[820px] text-[38px] font-medium leading-[1.05] tracking-[-0.045em] text-white sm:text-[48px] lg:text-[58px]">

                    {{ $copy['cta_title_1'] }}

                    <span class="text-white/35">

                        {{ $copy['cta_title_2'] }}

                    </span>

                </h2>

                <p class="mt-6 max-w-[620px] text-[12px] leading-6 text-white/40">

                    {{ $copy['cta_text'] }}

                </p>

            </div>

            <a

                href="{{ $contactUrl }}"

                class="group inline-flex w-fit shrink-0 items-center gap-4 rounded-full bg-white px-6 py-4 text-[10px] font-medium text-black transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_15px_40px_rgba(255,255,255,.14)]"

            >

                {{ $copy['cta_button'] }}

                <svg

                    viewBox="0 0 24 24"

                    fill="none"

                    class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"

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

        document.querySelectorAll('.about-reveal');

    if ('IntersectionObserver' in window) {

        const observer =

            new IntersectionObserver(

                function (entries, observerInstance) {

                    entries.forEach(

                        function (entry) {

                            if (!entry.isIntersecting) {

                                return;

                            }

                            entry.target.classList.add('is-visible');

                            observerInstance.unobserve(

                                entry.target

                            );

                        }

                    );

                },

                {

                    threshold: .12,

                    rootMargin: '0px 0px -40px 0px'

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