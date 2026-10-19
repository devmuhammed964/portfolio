@extends('layouts.site')
@php
    $legalIsEnglish = app()->getLocale() === 'en';
    $legalUrl = $legalIsEnglish
        ? route('en.legal', ['locale' => 'en'])
        : route('legal');
    $legalSiteName = $settings['site_name'] ?? 'Portfolyo';
    $legalSeoTitle = $legalIsEnglish
        ? ('Legal, Privacy & Cookie Policies | ' . $legalSiteName)
        : ('KVKK, Gizlilik ve Çerez Politikası | ' . $legalSiteName);
    $legalMetaDescription = $legalIsEnglish
        ? 'Legal information, privacy practices and cookie policies for this website.'
        : 'KVKK Aydınlatma Metni, Gizlilik Politikası ve Çerez Politikası; kişisel verilerin işlenmesi, korunması ve çerez kullanımı hakkında bilgiler.';
@endphp
@section('title', $legalSeoTitle)
@section(
    'meta_description',
    $legalMetaDescription
)
@section('canonical', $legalUrl)
@section(
    'robots',
    'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
)
@section('og_type', 'website')
@section(
    'og_image_alt',
    $legalSiteName . ' KVKK, gizlilik ve çerez politikaları'
)
@section('content')
<style>
    .legal-reveal {
        opacity: 0;
        transform: translateY(22px);
        transition:
            opacity .8s cubic-bezier(.22, 1, .36, 1),
            transform .8s cubic-bezier(.22, 1, .36, 1);
    }
    .legal-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .legal-tab {
        transition:
            background-color .3s ease,
            color .3s ease,
            border-color .3s ease,
            transform .3s ease;
    }
    .legal-tab.is-active {
        background: #111 !important;
        color: #fff !important;
        border-color: #111 !important;
    }
    .legal-tab:not(.is-active) {
        background: rgba(255, 255, 255, .60) !important;
        color: rgba(0, 0, 0, .55) !important;
        border-color: rgba(0, 0, 0, .07) !important;
    }
    .legal-tab:not(.is-active):hover {
        background: #fff !important;
        color: #111 !important;
        border-color: rgba(0, 0, 0, .12) !important;
        transform: translateY(-1px);
    }
    .legal-panel {
        display: none;
    }
    .legal-panel.is-active {
        display: block;
        animation:
            legalFade
            .45s
            cubic-bezier(.22, 1, .36, 1);
    }
    @keyframes legalFade {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .legal-content h2 {
        margin-top: 2rem;
        font-size: 1.35rem;
        line-height: 1.25;
        font-weight: 600;
        letter-spacing: -.025em;
        color: #111;
    }
    .legal-content h3 {
        margin-top: 1.5rem;
        font-size: 1rem;
        line-height: 1.5;
        font-weight: 600;
        color: #111;
    }
    .legal-content p {
        margin-top: .9rem;
        font-size: .9rem;
        line-height: 1.9;
        color: rgba(0, 0, 0, .56);
    }
    .legal-content ul {
        margin-top: .9rem;
        padding-left: 1.1rem;
    }
    .legal-content li {
        margin-top: .55rem;
        list-style: disc;
        font-size: .9rem;
        line-height: 1.8;
        color: rgba(0, 0, 0, .56);
    }
    @media (prefers-reduced-motion: reduce) {
        .legal-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .legal-panel.is-active {
            animation: none !important;
        }
    }
</style>
{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section
    class="
        bg-[#f3f4f5]
        pb-12
        pt-8
        lg:pb-16
        lg:pt-12
    "
>
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div class="legal-reveal max-w-[850px]">
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
                    Yasal Bilgilendirme
                </span>
                <span class="h-[5px] w-[5px] rounded-full bg-black"></span>
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
                    lg:text-[68px]
                "
            >
                Gizlilik ve
                <span class="text-black/35">
                    veri politikaları.
                </span>
            </h1>
            <p
                class="
                    mt-6
                    max-w-[650px]
                    text-[13px]
                    leading-7
                    text-black/42
                    sm:text-[15px]
                "
            >
                Kişisel verilerin işlenmesi, gizlilik uygulamaları ve internet
                sitesinde kullanılan çerezler hakkında detaylı bilgilere
                aşağıdaki sekmelerden ulaşabilirsiniz.
            </p>
        </div>
    </div>
</section>
{{-- ========================================================= --}}
{{-- TABS + CONTENT --}}
{{-- ========================================================= --}}
<section
    class="
        bg-[#f3f4f5]
        pb-24
        lg:pb-32
    "
>
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div
            class="
                legal-reveal
                grid
                grid-cols-1
                gap-8
                lg:grid-cols-[280px_1fr]
                lg:gap-14
            "
        >
            {{-- LEFT TABS --}}
            <aside>
                <div
                    class="
                        sticky
                        top-28
                        space-y-3
                    "
                >
                    <button
                        type="button"
                        class="
                            legal-tab
                            is-active
                            flex
                            w-full
                            items-center
                            justify-between
                            rounded-2xl
                            border
                            px-5
                            py-4
                            text-left
                            text-[11px]
                            font-medium
                        "
                        id="legal-tab-kvkk"
                        data-legal-tab="kvkk"
                        role="tab"
                        aria-selected="true"
                        aria-controls="legal-panel-kvkk"
                    >
                        <span>KVKK Aydınlatma Metni</span>
                        <span class="text-[9px] opacity-50">01</span>
                    </button>
                    <button
                        type="button"
                        class="
                            legal-tab
                            flex
                            w-full
                            items-center
                            justify-between
                            rounded-2xl
                            border
                            px-5
                            py-4
                            text-left
                            text-[11px]
                            font-medium
                        "
                        id="legal-tab-privacy"
                        data-legal-tab="privacy"
                        role="tab"
                        aria-selected="false"
                        aria-controls="legal-panel-privacy"
                    >
                        <span>Gizlilik Politikası</span>
                        <span class="text-[9px] opacity-50">02</span>
                    </button>
                    <button
                        type="button"
                        class="
                            legal-tab
                            flex
                            w-full
                            items-center
                            justify-between
                            rounded-2xl
                            border
                            px-5
                            py-4
                            text-left
                            text-[11px]
                            font-medium
                        "
                        id="legal-tab-cookies"
                        data-legal-tab="cookies"
                        role="tab"
                        aria-selected="false"
                        aria-controls="legal-panel-cookies"
                    >
                        <span>Çerez Politikası</span>
                        <span class="text-[9px] opacity-50">03</span>
                    </button>
                </div>
            </aside>
            {{-- RIGHT CONTENT --}}
            <div
                class="
                    rounded-[30px]
                    border
                    border-black/[0.055]
                    bg-white
                    p-7
                    shadow-[0_24px_80px_rgba(0,0,0,.04)]
                    sm:p-9
                    lg:p-12
                "
            >
                {{-- KVKK --}}
                <div
                    class="
                        legal-panel
                        legal-content
                        is-active
                    "
                    id="legal-panel-kvkk"
                    data-legal-panel="kvkk"
                    role="tabpanel"
                    aria-labelledby="legal-tab-kvkk"
                >
                    <div class="border-b border-black/[0.06] pb-7">
                        <span
                            class="
                                text-[8px]
                                font-medium
                                uppercase
                                tracking-[0.18em]
                                text-black/30
                            "
                        >
                            01 · KVKK
                        </span>
                        <h2 class="!mt-3 !text-[28px] sm:!text-[32px]">
                            Kişisel Verilerin Korunması Aydınlatma Metni
                        </h2>
                        <p>
                            Bu aydınlatma metni, internet sitesi üzerinden elde
                            edilen kişisel verilerin hangi amaçlarla işlendiği,
                            saklandığı ve korunduğu hakkında bilgilendirme amacıyla
                            hazırlanmıştır.
                        </p>
                    </div>
                    <h2>1. Veri Sorumlusu</h2>
                    <p>
                        6698 sayılı Kişisel Verilerin Korunması Kanunu kapsamında,
                        internet sitesi üzerinden işlenen kişisel veriler bakımından
                        veri sorumlusu, site sahibi ve hizmet sağlayıcıdır.
                    </p>
                    <h2>2. İşlenen Kişisel Veriler</h2>
                    <p>
                        İletişim formu veya doğrudan iletişim kanalları üzerinden
                        paylaşılan aşağıdaki bilgiler işlenebilir:
                    </p>
                    <ul>
                        <li>Ad ve soyad bilgisi</li>
                        <li>E-posta adresi</li>
                        <li>Telefon numarası</li>
                        <li>Mesaj ve talep içeriği</li>
                        <li>Teknik log ve bağlantı bilgileri</li>
                    </ul>
                    <h2>3. Kişisel Verilerin İşlenme Amaçları</h2>
                    <p>
                        Kişisel veriler aşağıdaki amaçlarla işlenebilir:
                    </p>
                    <ul>
                        <li>İletişim taleplerinin yanıtlanması</li>
                        <li>Proje ve iş birliği taleplerinin değerlendirilmesi</li>
                        <li>Sunulan hizmetlerle ilgili iletişimin yürütülmesi</li>
                        <li>Bilgi güvenliğinin sağlanması</li>
                        <li>Yasal yükümlülüklerin yerine getirilmesi</li>
                    </ul>
                    <h2>4. Kişisel Verilerin Aktarılması</h2>
                    <p>
                        Kişisel veriler, hukuki yükümlülükler veya hizmetin
                        yürütülmesi için gerekli durumlar dışında üçüncü kişilerle
                        paylaşılmaz. Yasal zorunluluk halinde yetkili kamu kurum ve
                        kuruluşlarıyla paylaşılabilir.
                    </p>
                    <h2>5. Saklama Süresi</h2>
                    <p>
                        Kişisel veriler, işlenme amacı için gerekli olan süre boyunca
                        ve ilgili mevzuatta öngörülen saklama süreleri dikkate
                        alınarak muhafaza edilir.
                    </p>
                    <h2>6. İlgili Kişinin Hakları</h2>
                    <p>
                        KVKK kapsamında kişisel veri sahipleri aşağıdaki haklara sahiptir:
                    </p>
                    <ul>
                        <li>Kişisel verilerinin işlenip işlenmediğini öğrenme</li>
                        <li>İşlenmişse buna ilişkin bilgi talep etme</li>
                        <li>İşlenme amacını öğrenme</li>
                        <li>Eksik veya yanlış işlenmiş verilerin düzeltilmesini isteme</li>
                        <li>Şartları oluşması halinde silinmesini veya yok edilmesini talep etme</li>
                    </ul>
                    <h2>7. Başvuru ve İletişim</h2>
                    <p>
                        Kişisel verilerinizle ilgili taleplerinizi internet
                        sitesinde yer alan iletişim kanalları üzerinden
                        iletebilirsiniz.
                    </p>
                </div>
                {{-- PRIVACY --}}
                <div
                    class="
                        legal-panel
                        legal-content
                    "
                    id="legal-panel-privacy"
                    data-legal-panel="privacy"
                    role="tabpanel"
                    aria-labelledby="legal-tab-privacy"
                    hidden
                >
                    <div class="border-b border-black/[0.06] pb-7">
                        <span
                            class="
                                text-[8px]
                                font-medium
                                uppercase
                                tracking-[0.18em]
                                text-black/30
                            "
                        >
                            02 · Gizlilik
                        </span>
                        <h2 class="!mt-3 !text-[28px] sm:!text-[32px]">
                            Gizlilik Politikası
                        </h2>
                        <p>
                            Bu gizlilik politikası, internet sitesini ziyaret eden
                            kullanıcıların bilgilerinin nasıl korunduğu ve işlendiği
                            konusunda bilgilendirme amacıyla hazırlanmıştır.
                        </p>
                    </div>
                    <h2>1. Bilgi Toplama</h2>
                    <p>
                        Site üzerinden yalnızca hizmetin sunulması, iletişim kurulması
                        ve kullanıcı deneyiminin geliştirilmesi için gerekli bilgiler
                        toplanabilir.
                    </p>
                    <h2>2. İletişim Formu</h2>
                    <p>
                        İletişim formu üzerinden gönderilen ad, e-posta, konu ve mesaj
                        bilgileri yalnızca ilgili talebin değerlendirilmesi ve
                        yanıtlanması amacıyla kullanılır.
                    </p>
                    <h2>3. Bilgi Güvenliği</h2>
                    <p>
                        Kullanıcı bilgilerinin yetkisiz erişim, kayıp, kötüye kullanım
                        veya değiştirilmesine karşı korunması amacıyla uygun teknik ve
                        idari tedbirlerin uygulanmasına özen gösterilir.
                    </p>
                    <h2>4. Üçüncü Taraf Bağlantıları</h2>
                    <p>
                        İnternet sitesinde GitHub, LinkedIn, Instagram veya harici
                        proje bağlantıları bulunabilir. Bu sitelerin gizlilik
                        uygulamalarından ilgili üçüncü taraflar sorumludur.
                    </p>
                    <h2>5. Bilgilerin Paylaşılması</h2>
                    <p>
                        Kullanıcıların kişisel bilgileri, açık rıza veya hukuki
                        zorunluluk bulunmadıkça üçüncü kişilere ticari amaçla
                        aktarılmaz.
                    </p>
                    <h2>6. Politika Güncellemeleri</h2>
                    <p>
                        Bu gizlilik politikası, mevzuat değişiklikleri veya internet
                        sitesinde sunulan hizmetlerdeki değişikliklere bağlı olarak
                        güncellenebilir.
                    </p>
                    <h2>7. İletişim</h2>
                    <p>
                        Gizlilik uygulamaları hakkında bilgi almak için iletişim
                        sayfasındaki kanallar üzerinden ulaşabilirsiniz.
                    </p>
                </div>
                {{-- COOKIES --}}
                <div
                    class="
                        legal-panel
                        legal-content
                    "
                    id="legal-panel-cookies"
                    data-legal-panel="cookies"
                    role="tabpanel"
                    aria-labelledby="legal-tab-cookies"
                    hidden
                >
                    <div class="border-b border-black/[0.06] pb-7">
                        <span
                            class="
                                text-[8px]
                                font-medium
                                uppercase
                                tracking-[0.18em]
                                text-black/30
                            "
                        >
                            03 · Çerezler
                        </span>
                        <h2 class="!mt-3 !text-[28px] sm:!text-[32px]">
                            Çerez Politikası
                        </h2>
                        <p>
                            Bu Çerez Politikası, internet sitesinde kullanılan
                            çerezler ve benzeri teknolojiler hakkında bilgi vermek
                            amacıyla hazırlanmıştır.
                        </p>
                    </div>
                    <h2>1. Çerez Nedir?</h2>
                    <p>
                        Çerezler, bir internet sitesini ziyaret ettiğinizde
                        tarayıcınız aracılığıyla cihazınıza kaydedilebilen küçük
                        metin dosyalarıdır.
                    </p>
                    <h2>2. Çerezlerin Kullanım Amaçları</h2>
                    <p>
                        Çerezler aşağıdaki amaçlarla kullanılabilir:
                    </p>
                    <ul>
                        <li>İnternet sitesinin düzgün çalışmasını sağlamak</li>
                        <li>Kullanıcı tercihlerini hatırlamak</li>
                        <li>Güvenlik işlemlerini desteklemek</li>
                        <li>Site performansını analiz etmek</li>
                        <li>Kullanıcı deneyimini geliştirmek</li>
                    </ul>
                    <h2>3. Kullanılan Çerez Türleri</h2>
                    <h3>Zorunlu Çerezler</h3>
                    <p>
                        İnternet sitesinin temel fonksiyonlarının çalışması için
                        gerekli olan çerezlerdir.
                    </p>
                    <h3>Performans ve Analiz Çerezleri</h3>
                    <p>
                        Ziyaretçilerin internet sitesini nasıl kullandığını anlamaya
                        ve performansı geliştirmeye yardımcı olan çerezlerdir.
                    </p>
                    <h3>Tercih Çerezleri</h3>
                    <p>
                        Dil, görünüm veya benzeri kullanıcı tercihlerinin
                        hatırlanmasına yardımcı olabilir.
                    </p>
                    <h2>4. Üçüncü Taraf Çerezleri</h2>
                    <p>
                        Google Analytics veya benzeri üçüncü taraf hizmetlerin
                        kullanılması halinde bu sağlayıcılar kendi çerezlerini
                        kullanabilir. Bu çerezler ilgili hizmet sağlayıcıların
                        politikalarına tabidir.
                    </p>
                    <h2>5. Çerezleri Yönetme</h2>
                    <p>
                        Tarayıcı ayarlarınız üzerinden çerezleri silebilir,
                        engelleyebilir veya belirli internet siteleri için çerez
                        kullanımını sınırlandırabilirsiniz.
                    </p>
                    <h2>6. Çerezlerin Devre Dışı Bırakılması</h2>
                    <p>
                        Bazı zorunlu çerezlerin devre dışı bırakılması internet
                        sitesinin belirli bölümlerinin düzgün çalışmamasına neden
                        olabilir.
                    </p>
                    <h2>7. Güncellemeler</h2>
                    <p>
                        Çerez politikası, kullanılan teknolojilerde veya ilgili
                        mevzuatta meydana gelen değişikliklere göre güncellenebilir.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    /*
    |--------------------------------------------------------------------------
    | REVEAL
    |--------------------------------------------------------------------------
    */
    const revealElements =
        document.querySelectorAll(
            '.legal-reveal'
        );
    if ('IntersectionObserver' in window) {
        const observer =
            new IntersectionObserver(
                function (entries, observerInstance) {
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
        revealElements.forEach(
            function (element) {
                observer.observe(element);
            }
        );
    } else {
        revealElements.forEach(
            function (element) {
                element.classList.add('is-visible');
            }
        );
    }
    /*
    |--------------------------------------------------------------------------
    | LEGAL TABS
    |--------------------------------------------------------------------------
    */
    const tabs =
        document.querySelectorAll(
            '.legal-tab[data-legal-tab]'
        );
    const panels =
        document.querySelectorAll(
            '.legal-panel[data-legal-panel]'
        );
    function activateTab(tabName) {
        tabs.forEach(
            function (tab) {
                const isSelected =
                    tab.dataset.legalTab === tabName;
                tab.classList.toggle(
                    'is-active',
                    isSelected
                );
                tab.setAttribute(
                    'aria-selected',
                    isSelected
                        ? 'true'
                        : 'false'
                );
            }
        );
        panels.forEach(
            function (panel) {
                const isSelected =
                    panel.dataset.legalPanel === tabName;
                panel.classList.toggle(
                    'is-active',
                    isSelected
                );
            }
        );
    }
    tabs.forEach(
        function (tab) {
            tab.addEventListener(
                'click',
                function () {
                    activateTab(
                        tab.dataset.legalTab
                    );
                }
            );
        }
    );
    /*
    |--------------------------------------------------------------------------
    | DEFAULT
    |--------------------------------------------------------------------------
    */
    const params = new URLSearchParams(window.location.search);
    const requestedTab = params.get('tab');
    const allowedTabs = ['kvkk', 'privacy', 'cookies'];
    activateTab(
        allowedTabs.includes(requestedTab)
            ? requestedTab
            : 'kvkk'
    );
});
</script>
@endsection
