<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'hero_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'hero_subtitle' => [
                'nullable',
                'string',
                'max:500',
            ],

            'about_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'about_text' => [
                'nullable',
                'string',
            ],

            'contact_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'contact_phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'linkedin_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'instagram_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'footer_text' => [
                'nullable',
                'string',
                'max:500',
            ],

            'seo_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            // SVG dahil logo
            'site_logo' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:4096',
            ],

            // SVG favicon da kullanılabilir
            'favicon' => [
                'nullable',
                'file',
                'mimes:ico,png,jpg,jpeg,webp,svg',
                'max:2048',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | DOSYALAR
        |--------------------------------------------------------------------------
        */

        $fileFields = [
            'site_logo',
            'favicon',
        ];

        foreach ($fileFields as $field) {

            if (!$request->hasFile($field)) {
                continue;
            }

            $file = $request->file($field);

            /*
             * Önce yeni dosyayı kaydediyoruz.
             * Kaydetme başarılı olduktan sonra eski dosyayı siliyoruz.
             */
            $path = $file->store('settings', 'public');

            $oldValue = Setting::where('key', $field)
                ->value('value');

            Setting::updateOrCreate(
                [
                    'key' => $field,
                ],
                [
                    'value' => $path,
                ]
            );

            if (
                !empty($oldValue)
                &&
                $oldValue !== $path
                &&
                Storage::disk('public')->exists($oldValue)
            ) {
                Storage::disk('public')->delete($oldValue);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | METİN ALANLARI
        |--------------------------------------------------------------------------
        */

        $textFields = [
            'site_name',

            'hero_title',
            'hero_subtitle',

            'about_title',
            'about_text',

            'contact_email',
            'contact_phone',

            'github_url',
            'linkedin_url',
            'instagram_url',

            'footer_text',

            'seo_title',
            'meta_description',
        ];

        foreach ($textFields as $field) {

            Setting::updateOrCreate(
                [
                    'key' => $field,
                ],
                [
                    'value' => $validated[$field] ?? null,
                ]
            );
        }


        return redirect()
            ->route('admin.settings.index')
            ->with(
                'success',
                'Site ayarları başarıyla güncellendi.'
            );
    }
}