@extends('admin.layouts.app')

@section('title', 'Yeni Hizmet Ekle | Portfolio Admin')

@section('page-title', 'Yeni Hizmet Ekle')

@section('content')

<div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_320px]">

    <section>

        <div class="mb-8">

            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-400">

                Hizmet Yönetimi

            </span>

            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">

                Yeni bir hizmet oluşturun

            </h2>

            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400">

                Hizmet başlığını, açıklamasını, görselini, ikon bilgisini ve sıralama değerini ekleyin.

            </p>

        </div>

        <form

            action="{{ route('admin.services.store') }}"

            method="POST"

            enctype="multipart/form-data"

            class="overflow-hidden rounded-[28px] border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20"

        >

            @csrf

            <div class="space-y-8 p-6 sm:p-8">

                {{-- TITLE --}}

                <div>

                    <label

                        for="title"

                        class="mb-2 block text-sm font-medium text-slate-300"

                    >

                        Hizmet Başlığı

                    </label>

                    <input

                        id="title"

                        type="text"

                        name="title"

                        value="{{ old('title') }}"

                        required

                        placeholder="Örn. Web Tasarım"

                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"

                    >

                    @error('title')

                        <p class="mt-2 text-xs text-red-400">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <div>

                    <label for="title_en" class="mb-2 block text-sm font-medium text-slate-300">

                        Hizmet Başlığı (İngilizce)

                    </label>

                    <input

                        id="title_en"

                        type="text"

                        name="title_en"

                        value="{{ old('title_en') }}"

                        placeholder="Example: Web Design"

                        class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"

                    >

                    @error('title_en')

                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>

                    @enderror

                    <p class="mt-2 text-xs text-slate-500">

                        Boş bırakırsanız İngilizce sayfada Türkçe başlık gösterilir.

                    </p>

                </div>

                {{-- DESCRIPTION --}}

                <div>

                    <label

                        for="description"

                        class="mb-2 block text-sm font-medium text-slate-300"

                    >

                        Açıklama

                    </label>

                    <textarea

                        id="description"

                        name="description"

                        rows="7"

                        required

                        placeholder="Hizmeti detaylı şekilde açıklayın..."

                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"

                    >{{ old('description') }}</textarea>

                    @error('description')

                        <p class="mt-2 text-xs text-red-400">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <div>

                    <label for="description_en" class="mb-2 block text-sm font-medium text-slate-300">

                        Açıklama (İngilizce)

                    </label>

                    <textarea

                        id="description_en"

                        name="description_en"

                        rows="7"

                        placeholder="Describe the service in detail..."

                        class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm leading-6 text-white outline-none transition placeholder:text-slate-600 focus:border-slate-500 focus:ring-4 focus:ring-white/5"

                    >{{ old('description_en') }}</textarea>

                    @error('description_en')

                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>

                    @enderror

                    <p class="mt-2 text-xs text-slate-500">

                        Boş bırakırsanız İngilizce sayfada Türkçe açıklama gösterilir.

                    </p>

                </div>

                {{-- IMAGE --}}

                <div>

                    <label

                        for="image"

                        class="mb-2 block text-sm font-medium text-slate-300"

                    >

                        Hizmet Görseli

                    </label>

                    <div

                        class="

                            relative

                            overflow-hidden

                            rounded-[22px]

                            border

                            border-dashed

                            border-white/15

                            bg-slate-900/60

                            p-6

                        "

                    >

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                            {{-- PREVIEW --}}

                            <div

                                id="imagePreviewWrapper"

                                class="

                                    flex

                                    h-32

                                    w-full

                                    shrink-0

                                    items-center

                                    justify-center

                                    overflow-hidden

                                    rounded-2xl

                                    border

                                    border-white/10

                                    bg-black/20

                                    sm:w-48

                                "

                            >

                                <img

                                    id="imagePreview"

                                    src=""

                                    alt=""

                                    class="hidden h-full w-full object-cover"

                                >

                                <div

                                    id="imagePlaceholder"

                                    class="text-center"

                                >

                                    <svg

                                        xmlns="http\://www.w3.org/2000/svg"

                                        viewBox="0 0 24 24"

                                        fill="none"

                                        stroke="currentColor"

                                        stroke-width="1.5"

                                        class="mx-auto h-7 w-7 text-slate-600"

                                    >

                                        <rect x="3" y="3" width="18" height="18" rx="3"/>

                                        <circle cx="8.5" cy="8.5" r="1.5"/>

                                        <path d="m21 15-5-5L5 21"/>

                                    </svg>

                                    <p class="mt-2 text-xs text-slate-600">

                                        Görsel önizleme

                                    </p>

                                </div>

                            </div>

                            {{-- INPUT --}}

                            <div class="flex-1">

                                <input

                                    id="image"

                                    type="file"

                                    name="image"

                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"

                                    class="

                                        block

                                        w-full

                                        cursor-pointer

                                        rounded-xl

                                        border

                                        border-white/10

                                        bg-slate-950/70

                                        text-sm

                                        text-slate-400

                                        file:mr-4

                                        file:border-0

                                        file:bg-white

                                        file:px-4

                                        file:py-3

                                        file:text-sm

                                        file:font-semibold

                                        file:text-slate-950

                                        hover:file:bg-slate-200

                                    "

                                >

                                <p class="mt-3 text-xs leading-5 text-slate-500">

                                    JPG, PNG veya WEBP yükleyebilirsiniz. Yatay görseller kullanmanız önerilir.

                                </p>

                                @error('image')

                                    <p class="mt-2 text-xs text-red-400">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                {{-- ICON + ORDER --}}

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label for="icon" class="mb-2 block text-sm font-medium text-slate-300">
                            İkon
                        </label>

                        <select
                            id="icon"
                            name="icon"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"
                        >
                            <option value="web" {{ old('icon') === 'web' ? 'selected' : '' }}>Web Tasarım</option>
                            <option value="mobile" {{ old('icon') === 'mobile' ? 'selected' : '' }}>Mobil / Uygulama</option>
                            <option value="dashboard" {{ old('icon') === 'dashboard' ? 'selected' : '' }}>Dashboard / Yönetim Paneli</option>
                            <option value="brand" {{ old('icon') === 'brand' ? 'selected' : '' }}>Marka / Tasarım</option>
                            <option value="seo" {{ old('icon') === 'seo' ? 'selected' : '' }}>SEO</option>
                            <option value="api" {{ old('icon') === 'api' ? 'selected' : '' }}>API / Entegrasyon</option>
                            <option value="ecommerce" {{ old('icon') === 'ecommerce' ? 'selected' : '' }}>E-Ticaret</option>
                            <option value="database" {{ old('icon') === 'database' ? 'selected' : '' }}>Veritabanı</option>
                            <option value="server" {{ old('icon') === 'server' ? 'selected' : '' }}>Sunucu / Hosting</option>
                            <option value="support" {{ old('icon') === 'support' ? 'selected' : '' }}>Bakım / Destek</option>
                        </select>

                        @error('icon')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror

                    </div>

                    <div>

                        <label

                            for="order"

                            class="mb-2 block text-sm font-medium text-slate-300"

                        >

                            Sıralama

                        </label>

                        <input

                            id="order"

                            type="number"

                            name="order"

                            value="{{ old('order', 0) }}"

                            min="0"

                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3.5 text-sm text-white outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-white/5"

                        >

                        <p class="mt-2 text-xs text-slate-500">

                            Küçük değerler önce gösterilir.

                        </p>

                        @error('order')

                            <p class="mt-2 text-xs text-red-400">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                </div>

            </div>

            {{-- FOOTER --}}

            <div class="flex flex-col-reverse gap-3 border-t border-white/10 bg-black/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">

                <p class="text-xs text-slate-500">

                    Kaydettiğiniz hizmet doğrudan sistemde oluşturulacaktır.

                </p>

                <div class="flex gap-3">

                    <a

                        href="{{ route('admin.services.index') }}"

                        class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"

                    >

                        Vazgeç

                    </a>

                    <button

                        type="submit"

                        class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200"

                    >

                        Hizmeti Kaydet

                    </button>

                </div>

            </div>

        </form>

    </section>

    {{-- SIDEBAR --}}

    <aside class="xl:pt-[118px]">

        <div class="sticky top-8 space-y-4">

            <div class="rounded-[24px] border border-white/10 bg-white/[0.035] p-5">

                <p class="text-sm font-semibold text-white">

                    Hizmet İpuçları

                </p>

                <div class="mt-5 space-y-4">

                    <div class="flex gap-3">

                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">

                            01

                        </span>

                        <p class="text-sm leading-6 text-slate-400">

                            Hizmet başlığını kısa ve net tutun.

                        </p>

                    </div>

                    <div class="flex gap-3">

                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">

                            02

                        </span>

                        <p class="text-sm leading-6 text-slate-400">

                            Açıklama alanında hizmetin sağladığı faydayı anlatın.

                        </p>

                    </div>

                    <div class="flex gap-3">

                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">

                            03

                        </span>

                        <p class="text-sm leading-6 text-slate-400">

                            Hizmet sayfasında güçlü görünmesi için yatay ve kaliteli bir görsel kullanın.

                        </p>

                    </div>

                    <div class="flex gap-3">

                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/5 text-xs font-semibold text-slate-400">

                            04

                        </span>

                        <p class="text-sm leading-6 text-slate-400">

                            Sıralama değeri düşük olan hizmetler önce gösterilir.

                        </p>

                    </div>

                </div>

            </div>

            <div class="rounded-[24px] border border-white/10 bg-gradient-to-br from-white/[0.06] to-transparent p-5">

                <p class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">

                    Durum

                </p>

                <div class="mt-3 flex items-center gap-2">

                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>

                    <p class="text-sm font-medium text-slate-300">

                        Hizmet modülü aktif

                    </p>

                </div>

            </div>

        </div>

    </aside>

</div>

{{-- IMAGE PREVIEW --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const imageInput =

        document.getElementById('image');

    const imagePreview =

        document.getElementById('imagePreview');

    const imagePlaceholder =

        document.getElementById('imagePlaceholder');

    if (!imageInput) {

        return;

    }

    imageInput.addEventListener(

        'change',

        function (event) {

            const file =

                event.target.files[0];

            if (!file) {

                imagePreview.src = '';

                imagePreview.classList.add(

                    'hidden'

                );

                imagePlaceholder.classList.remove(

                    'hidden'

                );

                return;

            }

            const reader =

                new FileReader();

            reader.onload =

                function (readerEvent) {

                    imagePreview.src =

                        readerEvent.target.result;

                    imagePreview.classList.remove(

                        'hidden'

                    );

                    imagePlaceholder.classList.add(

                        'hidden'

                    );

                };

            reader.readAsDataURL(

                file

            );

        }

    );

});

</script>

@endsection
