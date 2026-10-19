@extends('layouts.site')

@php
    $newsDetailIsEnglish = app()->getLocale() === 'en';

    $newsIndexUrl = $newsDetailIsEnglish
        ? route('en.news.index', ['locale' => 'en'])
        : route('news.index');

    $newsCanonical = $newsDetailIsEnglish
        ? route('en.news.show', ['locale' => 'en', 'slug' => $post->slug])
        : route('news.show', $post->slug);

    $newsSiteName = $settings['site_name'] ?? 'Portfolyo';

    $newsDisplayTitle = $newsDetailIsEnglish && !empty($post->title_en)
        ? $post->title_en
        : $post->title;

    $newsDisplaySummary = $newsDetailIsEnglish
        ? (
            !empty($post->summary_en)
                ? $post->summary_en
                : (!empty($post->content_en)
                    ? \Illuminate\Support\Str::limit(strip_tags($post->content_en), 220)
                    : ($post->summary ?: null))
        )
        : ($post->summary ?: null);

    $newsDisplayContent = $newsDetailIsEnglish && !empty($post->content_en)
        ? $post->content_en
        : $post->content;

    $newsSeoTitle = $newsDisplayTitle . ' | ' . $newsSiteName;

    $newsSeoDescription = \Illuminate\Support\Str::limit(
        trim(strip_tags($newsDisplaySummary ?: $newsDisplayContent ?: '')),
        155
    );

    $newsOgImage = !empty($post->image)
        ? asset('storage/' . $post->image)
        : null;

    $newsPublishedAt = $post->published_at ?? $post->created_at;
    $newsModifiedAt = $post->updated_at ?? $post->created_at;

    $newsPublishedCarbon = $newsPublishedAt
        ? \Carbon\Carbon::parse($newsPublishedAt)
        : null;

    $newsModifiedCarbon = $newsModifiedAt
        ? \Carbon\Carbon::parse($newsModifiedAt)
        : null;
@endphp

@section('title', $newsSeoTitle)
@section('meta_description', $newsSeoDescription)
@section('canonical', $newsCanonical)
@section('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')
@section('og_type', 'article')
@section('og_image_alt', $newsDisplayTitle)

@if($newsOgImage)
    @section('og_image', $newsOgImage)
@endif

@if($newsPublishedCarbon)
    @section('published_time', $newsPublishedCarbon->toIso8601String())
@endif

@if($newsModifiedCarbon)
    @section('modified_time', $newsModifiedCarbon->toIso8601String())
@endif

@section('content')

<section class="bg-[#f3f4f5] py-16 lg:py-24">
    <div class="mx-auto max-w-4xl px-6">
        <a
            href="{{ $newsIndexUrl }}"
            aria-label="{{ __('news_detail.back_all') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-950"
        >
            ← {{ __('news_detail.back_all') }}
        </a>

        <article class="mt-10">
            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">
                    {{ __('news_detail.badge') }}
                </span>

                @if($newsPublishedCarbon)
                    <time
                        datetime="{{ $newsPublishedCarbon->toIso8601String() }}"
                        class="text-xs font-medium text-slate-400"
                    >
                        {{ $newsPublishedCarbon->format('d.m.Y') }}
                    </time>
                @endif
            </div>

            <h1 class="mt-6 text-4xl font-semibold leading-tight tracking-[-0.04em] text-slate-950 md:text-6xl">
                {{ $newsDisplayTitle }}
            </h1>

            @if(!empty($newsDisplaySummary))
                <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-500">
                    {{ $newsDisplaySummary }}
                </p>
            @endif

            @if(!empty($post->image))
                <figure class="mt-10 overflow-hidden rounded-[30px] border border-slate-200 bg-slate-100">
                    <img
                        src="{{ asset('storage/' . $post->image) }}"
                        alt="{{ $newsDisplayTitle }}"
                        width="1400"
                        height="900"
                        fetchpriority="high"
                        decoding="async"
                        class="max-h-[650px] w-full object-cover"
                    >
                </figure>
            @endif

            <div class="mt-12">
                <div class="whitespace-pre-line text-base leading-8 text-slate-700 md:text-[17px]">
                    {{ $newsDisplayContent }}
                </div>
            </div>

            <div class="mt-14 border-t border-slate-200 pt-8">
                <a
                    href="{{ $newsIndexUrl }}"
                    aria-label="{{ __('news_detail.back_news') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-slate-900 transition hover:text-slate-600"
                >
                    ← {{ __('news_detail.back_news') }}
                </a>
            </div>
        </article>
    </div>
</section>

@endsection
