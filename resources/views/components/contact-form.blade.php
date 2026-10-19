@php
    $contactFormIsEnglish = app()->getLocale() === 'en';

    $contactFormAction = $contactFormIsEnglish
        ? route('en.contact.store', ['locale' => 'en'])
        : route('contact.store');
@endphp

<div>
    @if(session('success'))
        <div
            class="
                mb-6
                rounded-xl
                border
                border-green-400
                bg-green-100
                px-4
                py-3
                text-green-700
            "
        >
            {{ session('success') }}
        </div>
    @endif

    <form
        action="{{ $contactFormAction }}"
        method="POST"
        class="space-y-4"
    >
        @csrf

        <div>
            <label
                for="contact-name"
                class="mb-1 block font-medium text-slate-700"
            >
                {{ __('contact_form.name') }}
            </label>

            <input
                id="contact-name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="{{ __('contact_form.name_placeholder') }}"
                required
                autocomplete="name"
                class="
                    w-full
                    rounded-xl
                    border
                    border-slate-300
                    p-3
                    focus:border-slate-900
                    focus:outline-none
                "
            >

            @error('name')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="contact-email"
                class="mb-1 block font-medium text-slate-700"
            >
                {{ __('contact_form.email') }}
            </label>

            <input
                id="contact-email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="{{ __('contact_form.email_placeholder') }}"
                required
                autocomplete="email"
                class="
                    w-full
                    rounded-xl
                    border
                    border-slate-300
                    p-3
                    focus:border-slate-900
                    focus:outline-none
                "
            >

            @error('email')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="contact-subject"
                class="mb-1 block font-medium text-slate-700"
            >
                {{ __('contact_form.subject') }}
            </label>

            <input
                id="contact-subject"
                type="text"
                name="subject"
                value="{{ old('subject') }}"
                placeholder="{{ __('contact_form.subject_placeholder') }}"
                class="
                    w-full
                    rounded-xl
                    border
                    border-slate-300
                    p-3
                    focus:border-slate-900
                    focus:outline-none
                "
            >

            @error('subject')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="contact-message"
                class="mb-1 block font-medium text-slate-700"
            >
                {{ __('contact_form.message') }}
            </label>

            <textarea
                id="contact-message"
                name="message"
                rows="4"
                placeholder="{{ __('contact_form.message_placeholder') }}"
                required
                class="
                    w-full
                    rounded-xl
                    border
                    border-slate-300
                    p-3
                    focus:border-slate-900
                    focus:outline-none
                "
            >{{ old('message') }}</textarea>

            @error('message')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button
            type="submit"
            class="
                w-full
                rounded-xl
                bg-slate-900
                py-3
                font-medium
                text-white
                transition
                hover:bg-slate-800
            "
        >
            {{ __('contact_form.submit') }}
        </button>
    </form>
</div>