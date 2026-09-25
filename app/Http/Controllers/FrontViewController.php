<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\SeoSetting;
use App\Models\Team;
use App\Models\About;
// use App\Models\Service;

use App\Models\Course;

use App\Models\Contact;
use App\Models\Country;
use App\Models\Service;
use App\Models\Category;
use App\Models\CoverImage;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\PhotoGallery;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\BlogPostsCategory;
use App\Models\Client;
use App\Models\ClientMessage;
use App\Models\Message;
use App\Models\DirectorMessage;
use Carbon\Carbon;

class FrontViewController extends Controller
{
    public function index()
    {
        $sitesetting = SiteSetting::first();
        $teams = Team::first();
        $about = About::first();
        $services = Service::latest()->get()->take(6);
        $contacts = Contact::latest()->get();
        $blogs = BlogPostsCategory::latest()->get()->take(3);
        $testimonials = Testimonial::latest()->get()->take(10);
        $coverImages = CoverImage::all();
        $message = Message::latest()->first();
        $ceoMessage = DirectorMessage::latest()->first();
        $firstCategory = Category::first();
        $posts = $firstCategory ? $firstCategory->posts()->latest()->take(6)->get() : collect([]);
        $clients = Client::latest()->get();
        $clientMessages = ClientMessage::latest()->get();
        $images = PhotoGallery::latest()->get();
        $notifications = Notification::where('status', 1)->latest()->get();
        $products = \App\Models\Product::where('status', true)->latest()->get();
        $faqs = Faq::latest()->get();
         $seoSetting = SeoSetting::latest()->first();
         if ($seoSetting) {
             $locale = app()->getLocale();
             $normalize = function ($value) use ($locale) {
                 if ($value === null) {
                     return null;
                 }
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
                 return $value;
             };
             foreach (['meta_title','meta_description','meta_keywords','canonical_url','heading_h1','image_description','meta_author','viewport'] as $field) {
                 if (isset($seoSetting->$field)) {
                     $seoSetting->$field = $normalize($seoSetting->$field);
                 }
             }
         }
    
    
        return view('frontend.index', compact(
            'services',
            'contacts',
            'teams',
            'blogs',
            'sitesetting',
            'testimonials',
            'coverImages',
            'message',
            'ceoMessage',
            'clients',
            'about',
            'posts',
            'firstCategory',
            'clientMessages',
            'images',
            'notifications',
            'products',
            'faqs',
          'seoSetting',

        ));
    }
       

}