<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     *
     * @param Request $request
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLanguage(Request $request, $locale)
    {
        // Validate that the locale is supported
        $availableLocales = array_keys(config('app.available_locales'));
        
        if (!in_array($locale, $availableLocales)) {
            return redirect()->back()->with('error', __('Invalid language selected.'));
        }
        
        // Store the locale in session
        Session::put('locale', $locale);
        
        // Set the application locale
        App::setLocale($locale);
        
        return redirect()->back()->with('success', __('Language changed successfully.'));
    }
    
    /**
     * Get current language
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentLanguage()
    {
        return response()->json([
            'locale' => App::getLocale(),
            'name' => config('app.available_locales')[App::getLocale()] ?? App::getLocale()
        ]);
    }
    
    /**
     * Get available languages
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailableLanguages()
    {
        return response()->json(config('app.available_locales'));
    }
}
