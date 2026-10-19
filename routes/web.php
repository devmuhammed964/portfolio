<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ProjectController;

use App\Http\Controllers\ServiceController;

use App\Http\Controllers\MessageController;

use App\Http\Controllers\SettingController;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\PostController;

use App\Http\Controllers\ReferenceController;

use App\Models\Project;

use App\Models\Service;

use App\Models\Setting;

use App\Models\Reference;

use App\Models\Message;

use App\Models\Post;

use Illuminate\Support\Facades\Route;

/*

\|--------------------------------------------------------------------------

\| Frontend

\|--------------------------------------------------------------------------

*/

/*

\|--------------------------------------------------------------------------

\| Ana Sayfa

\|--------------------------------------------------------------------------

*/

Route::get('/', function () {

    $projects = Project::latest()->get();

    $services = Service::orderBy('order', 'asc')->get();

    $settings = Setting::pluck('value', 'key')->toArray();

    $references = Reference::where('is_active', true)

        ->orderBy('sort_order')

        ->orderByDesc('id')

        ->take(3)

        ->get();

    return view('welcome', compact(

        'projects',

        'services',

        'settings',

        'references'

    ));

})->name('home');

/*

\|--------------------------------------------------------------------------

\| Hakkımızda

\|--------------------------------------------------------------------------

*/

Route::get('/hakkimizda', function () {

    $settings = Setting::pluck('value', 'key')->toArray();

    return view('hakkimizda', compact(

        'settings'

    ));

})->name('about');

/*

\|--------------------------------------------------------------------------

\| Hizmetler

\|--------------------------------------------------------------------------

*/

Route::get('/hizmetler', function () {

    $services = Service::orderBy('order', 'asc')->get();

    $settings = Setting::pluck('value', 'key')->toArray();

    return view('hizmetler', compact(

        'services',

        'settings'

    ));

})->name('services.index');

/*

\|--------------------------------------------------------------------------

\| İletişim

\|--------------------------------------------------------------------------

*/

Route::get('/contact', [ContactController::class, 'index'])

    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])

    ->name('contact.store');

/*

\|--------------------------------------------------------------------------

\| Haberler

\|--------------------------------------------------------------------------

*/

Route::get('/haberler', [PostController::class, 'index'])

    ->name('news.index');

Route::get('/haberler/{slug}', [PostController::class, 'show'])

    ->name('news.show');

/*

\|--------------------------------------------------------------------------

\| Projeler

\|--------------------------------------------------------------------------

*/

Route::get('/projeler', [ProjectController::class, 'index'])

    ->name('projects.index');

Route::get('/projeler/{id}', [ProjectController::class, 'show'])

    ->name('projects.show');

/*

\|--------------------------------------------------------------------------

\| Referanslar

\|--------------------------------------------------------------------------

*/

Route::get('/referanslar', [ReferenceController::class, 'index'])

    ->name('references.index');

/*

\|--------------------------------------------------------------------------

\| Yasal Bilgilendirme

\|--------------------------------------------------------------------------

|

\| KVKK, Gizlilik Politikası ve Çerez Politikası

\| tek sayfa içerisinde sekmeli olarak gösterilir.

|

*/

Route::get('/yasal', function () {

    $settings = Setting::pluck('value', 'key')->toArray();

    return view('legal', compact(

        'settings'

    ));

})->name('legal');

/*

\|--------------------------------------------------------------------------

\| Eski Login Adresi

\|--------------------------------------------------------------------------

*/

/*

\|--------------------------------------------------------------------------

\| Sitemap

\|--------------------------------------------------------------------------

*/

/*

\|--------------------------------------------------------------------------

\| English Frontend

\|--------------------------------------------------------------------------

*/

Route::prefix('{locale}')

    ->where(['locale' => 'en'])

    ->middleware('locale')

    ->name('en.')

    ->group(function () {

        Route::get('/', function () {

            $projects = Project::latest()->get();

            $services = Service::orderBy('order', 'asc')->get();

            $settings = Setting::pluck('value', 'key')->toArray();

            $references = Reference::where('is_active', true)

                ->orderBy('sort_order')

                ->orderByDesc('id')

                ->take(3)

                ->get();

            return view('welcome', compact(

                'projects',

                'services',

                'settings',

                'references'

            ));

        })->name('home');

        Route::get('/about', function () {

            $settings = Setting::pluck('value', 'key')->toArray();

            return view('hakkimizda', compact('settings'));

        })->name('about');

        Route::get('/services', function () {

            $services = Service::orderBy('order', 'asc')->get();

            $settings = Setting::pluck('value', 'key')->toArray();

            return view('hizmetler', compact(

                'services',

                'settings'

            ));

        })->name('services.index');

        Route::get('/contact', [ContactController::class, 'index'])

            ->name('contact');

        Route::post('/contact', [ContactController::class, 'store'])

            ->name('contact.store');

        Route::get('/news', [PostController::class, 'index'])

            ->name('news.index');

        Route::get('/news/{slug}', [PostController::class, 'show'])

            ->name('news.show');

        Route::get('/projects', [ProjectController::class, 'index'])

            ->name('projects.index');

        Route::get('/projects/{id}', [ProjectController::class, 'show'])

            ->name('projects.show');

        Route::get('/references', [ReferenceController::class, 'index'])

            ->name('references.index');

        Route::get('/legal', function () {

            $settings = Setting::pluck('value', 'key')->toArray();

            return view('legal', compact('settings'));

        })->name('legal');

    });

Route::get('/sitemap.xml', function () {
    $projects = Project::query()
        ->latest('updated_at')
        ->get();

    $posts = Post::query()
        ->latest('updated_at')
        ->get();

    $urls = collect([
        [
            'loc' => route('home'),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ],
        [
            'loc' => route('about'),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ],
        [
            'loc' => route('services.index'),
            'changefreq' => 'monthly',
            'priority' => '0.9',
        ],
        [
            'loc' => route('projects.index'),
            'lastmod' => optional($projects->first())->updated_at?->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ],
        [
            'loc' => route('news.index'),
            'lastmod' => optional($posts->first())->updated_at?->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'loc' => route('references.index'),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ],
        [
            'loc' => route('contact'),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ],
        [
            'loc' => route('legal'),
            'changefreq' => 'yearly',
            'priority' => '0.3',
        ],

        // English pages
        [
            'loc' => route('en.home', ['locale' => 'en']),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ],
        [
            'loc' => route('en.about', ['locale' => 'en']),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ],
        [
            'loc' => route('en.services.index', ['locale' => 'en']),
            'changefreq' => 'monthly',
            'priority' => '0.9',
        ],
        [
            'loc' => route('en.projects.index', ['locale' => 'en']),
            'lastmod' => optional($projects->first())->updated_at?->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ],
        [
            'loc' => route('en.news.index', ['locale' => 'en']),
            'lastmod' => optional($posts->first())->updated_at?->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'loc' => route('en.references.index', ['locale' => 'en']),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ],
        [
            'loc' => route('en.contact', ['locale' => 'en']),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ],
    ]);

    foreach ($projects as $project) {
        $lastmod = optional($project->updated_at)->toAtomString();

        $urls->push([
            'loc' => route('projects.show', $project->id),
            'lastmod' => $lastmod,
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ]);

        $urls->push([
            'loc' => route('en.projects.show', [
                'locale' => 'en',
                'id' => $project->id,
            ]),
            'lastmod' => $lastmod,
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ]);
    }

    foreach ($posts as $post) {
        $lastmod = optional($post->updated_at)->toAtomString();

        $urls->push([
            'loc' => route('news.show', $post->slug),
            'lastmod' => $lastmod,
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ]);

        $urls->push([
            'loc' => route('en.news.show', [
                'locale' => 'en',
                'slug' => $post->slug,
            ]),
            'lastmod' => $lastmod,
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ]);
    }

    return response()
        ->view('sitemap', compact('urls'))
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

/*

\|--------------------------------------------------------------------------

\| Admin Panel

\|--------------------------------------------------------------------------

*/

Route::middleware(['auth'])

    ->prefix('admin')

    ->name('admin.')

    ->group(function () {

        /*

        |--------------------------------------------------------------------------

        | Dashboard

        |--------------------------------------------------------------------------

        */

        Route::get('/', function () {

            $projectCount = Project::count();

            $serviceCount = Service::count();

            $referenceCount = Reference::count();

            $messageCount = Message::count();

            return view('admin.dashboard', compact(

                'projectCount',

                'serviceCount',

                'referenceCount',

                'messageCount'

            ));

        })->name('dashboard');

        /*

        |--------------------------------------------------------------------------

        | Projeler

        |--------------------------------------------------------------------------

        */

        Route::get(

            '/projects',

            [ProjectController::class, 'adminIndex']

        )->name('projects.index');

        Route::get(

            '/projects/create',

            [ProjectController::class, 'create']

        )->name('projects.create');

        Route::post(

            '/projects',

            [ProjectController::class, 'store']

        )->name('projects.store');

        Route::get(

            '/projects/{project}/edit',

            [ProjectController::class, 'edit']

        )->name('projects.edit');

        Route::put(

            '/projects/{project}',

            [ProjectController::class, 'update']

        )->name('projects.update');

        Route::delete(

            '/projects/{project}',

            [ProjectController::class, 'destroy']

        )->name('projects.destroy');

        /*

        |--------------------------------------------------------------------------

        | Hizmetler

        |--------------------------------------------------------------------------

        */

        Route::get(

            '/services',

            [ServiceController::class, 'index']

        )->name('services.index');

        Route::get(

            '/services/create',

            [ServiceController::class, 'create']

        )->name('services.create');

        Route::post(

            '/services',

            [ServiceController::class, 'store']

        )->name('services.store');

        Route::get(

            '/services/{service}/edit',

            [ServiceController::class, 'edit']

        )->name('services.edit');

        Route::put(

            '/services/{service}',

            [ServiceController::class, 'update']

        )->name('services.update');

        Route::delete(

            '/services/{service}',

            [ServiceController::class, 'destroy']

        )->name('services.destroy');

        /*

        |--------------------------------------------------------------------------

        | Haberler

        |--------------------------------------------------------------------------

        */

        Route::get(

            '/posts',

            [PostController::class, 'adminIndex']

        )->name('posts.index');

        Route::get(

            '/posts/create',

            [PostController::class, 'create']

        )->name('posts.create');

        Route::post(

            '/posts',

            [PostController::class, 'store']

        )->name('posts.store');

        Route::get(

            '/posts/{post}/edit',

            [PostController::class, 'edit']

        )->name('posts.edit');

        Route::put(

            '/posts/{post}',

            [PostController::class, 'update']

        )->name('posts.update');

        Route::delete(

            '/posts/{post}',

            [PostController::class, 'destroy']

        )->name('posts.destroy');

        /*

        |--------------------------------------------------------------------------

        | Referanslar

        |--------------------------------------------------------------------------

        */

        Route::get(

            '/references',

            [ReferenceController::class, 'adminIndex']

        )->name('references.index');

        Route::get(

            '/references/create',

            [ReferenceController::class, 'create']

        )->name('references.create');

        Route::post(

            '/references',

            [ReferenceController::class, 'store']

        )->name('references.store');

        Route::get(

            '/references/{reference}/edit',

            [ReferenceController::class, 'edit']

        )->name('references.edit');

        Route::put(

            '/references/{reference}',

            [ReferenceController::class, 'update']

        )->name('references.update');

        Route::delete(

            '/references/{reference}',

            [ReferenceController::class, 'destroy']

        )->name('references.destroy');

        /*

        |--------------------------------------------------------------------------

        | Mesajlar

        |--------------------------------------------------------------------------

        */

        Route::get(

            '/messages',

            [MessageController::class, 'index']

        )->name('messages.index');

        Route::get(

            '/messages/{message}',

            [MessageController::class, 'show']

        )->name('messages.show');

        Route::delete(

            '/messages/{message}',

            [MessageController::class, 'destroy']

        )->name('messages.destroy');

        /*

        |--------------------------------------------------------------------------

        | Site Ayarları

        |--------------------------------------------------------------------------

        */

        Route::get(

            '/settings',

            [SettingController::class, 'index']

        )->name('settings.index');

        Route::post(

            '/settings',

            [SettingController::class, 'update']

        )->name('settings.update');

    });

/*

\|--------------------------------------------------------------------------

\| Dashboard Uyumluluk Rotası

\|--------------------------------------------------------------------------

*/

Route::middleware(['auth'])->get('/dashboard', function () {

    $projectCount = Project::count();

    $serviceCount = Service::count();

    $referenceCount = Reference::count();

    $messageCount = Message::count();

    return view('admin.dashboard', compact(

        'projectCount',

        'serviceCount',

        'referenceCount',

        'messageCount'

    ));

})->name('dashboard');

/*

\|--------------------------------------------------------------------------

\| Profil

\|--------------------------------------------------------------------------

*/

Route::middleware(['auth'])->group(function () {

    Route::get(

        '/profile',

        [ProfileController::class, 'edit']

    )->name('profile.edit');

    Route::patch(

        '/profile',

        [ProfileController::class, 'update']

    )->name('profile.update');

    Route::delete(

        '/profile',

        [ProfileController::class, 'destroy']

    )->name('profile.destroy');

});

/*

\|--------------------------------------------------------------------------

\| Authentication

\|--------------------------------------------------------------------------

*/

require __DIR__.'/auth.php';

/*

\|--------------------------------------------------------------------------

\| 404 Fallback

\|--------------------------------------------------------------------------

|

\| Yukarıdaki hiçbir route ile eşleşmeyen istekler buraya düşer.

\| 404 sayfası layouts.site kullandığı için site ayarlarını da gönderiyoruz.

|

*/

Route::fallback(function () {

    $settings = Setting::pluck('value', 'key')->toArray();

    return response()->view(

        'errors.404',

        compact('settings'),

        404

    );

});
