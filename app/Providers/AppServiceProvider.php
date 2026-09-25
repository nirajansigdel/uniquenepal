<?php

namespace App\Providers;

use App\Models\About;
use App\Models\WorkCategory;
use App\Models\Country;
use App\Models\Favicon;
use App\Models\Service;
use App\Models\Category;
use App\Models\Company;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\BlogPostsCategory;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Translation helper function
        if (!function_exists('translated')) {
            function translated($model, $fieldName, $locale = null) {
                if (method_exists($model, 'getTranslated')) {
                    return $model->getTranslated($fieldName, $locale);
                }
                return $model->getAttribute($fieldName);
            }
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        

    // Check if Laravel is running in the console
    if (!app()->runningInConsole()) {
        $favicon = Favicon::latest()->first();
        View::share('favicon', $favicon);

        $sitesetting = SiteSetting::first();
        View::share('sitesetting', $sitesetting);

        // Share SEO settings globally (normalized to plain strings for the current locale)
        $seoSetting = SeoSetting::first();
        if ($seoSetting) {
            $locale = app()->getLocale();

            $normalize = function ($value) use ($locale) {
                if ($value === null) {
                    return null;
                }

                // If it's a string that looks like JSON, try to decode
                if (is_string($value)) {
                    $trimmed = trim($value);
                    $firstChar = $trimmed[0] ?? '';
                    if ($firstChar === '[' || $firstChar === '{') {
                        $decoded = json_decode($trimmed, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $value = $decoded;
                        } else {
                            return $trimmed;
                        }
                    } else {
                        return $trimmed;
                    }
                }

                // If it's an array, pick the localized or first non-empty string
                if (is_array($value)) {
                    $isAssoc = array_keys($value) !== range(0, count($value) - 1);
                    if ($isAssoc) {
                        if (isset($value[$locale]) && is_string($value[$locale]) && $value[$locale] !== '') {
                            return $value[$locale];
                        }
                        foreach ($value as $v) {
                            if (is_string($v) && $v !== '') {
                                return $v;
                            }
                        }
                        return null;
                    } else {
                        foreach ($value as $v) {
                            if (is_string($v) && $v !== '') {
                                return $v;
                            }
                        }
                        return null;
                    }
                }

                // Fallback: return as-is
                return $value;
            };

            // Normalize common SEO string fields (exclude schema_json which may need full JSON)
            foreach (['meta_title','meta_description','meta_keywords','canonical_url','heading_h1','image_description','meta_author','viewport'] as $field) {
                if (isset($seoSetting->$field)) {
                    $seoSetting->$field = $normalize($seoSetting->$field);
                }
            }
        }
        View::share('seoSetting', $seoSetting);

        // Other view composers can be added here in the same way
        View::composer('frontend.includes.navbar', function ($view) {
            $countries = Country::all();
            $testimonials = Testimonial::all();
            $workcategories = WorkCategory::all();
            $categories = Category::all();
            $blogpostcategories = BlogPostsCategory::all();
            $sitesetting = SiteSetting::first();


            $view->with([
                'countries' => $countries,
                'testimonials' => $testimonials,
                'workcategories' => $workcategories,
                'categories' => $categories,
                'blogpostcategories' => $blogpostcategories,
                'sitesetting' => $sitesetting
            ]);

        });

        view()->composer('frontend.includes.footer', function ($view) {
            $services = Service::all();
            $categories = Category::all();
            $workcategories = WorkCategory::all();
            $siteSettings = SiteSetting::first();
            $about = About::first();


            $view->with([
                'services' => $services,
                'workcategories' => $workcategories,
                'siteSettings' => $siteSettings,
                'categories' => $categories,
                'about' => $about,
                'sitesetting' => SiteSetting::first(),
            ]);

        });
    }
    }
}
