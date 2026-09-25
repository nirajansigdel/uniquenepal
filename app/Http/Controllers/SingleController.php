<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\SectionOnePicture;
use App\Models\Team;
use App\Models\About;
use App\Models\WorkCategory;
use App\Models\Country;
use App\Models\Service;
use App\Models\Category;
use App\Models\CoverImage;
use App\Models\Company;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use App\Models\DirectorMessage;
use App\Models\BlogPostsCategory;
use App\Models\ClientMessage;
use App\Models\MissionVisionValue;
use App\Models\SeoSetting;
use App\Models\WhyUs;
use App\Models\Product;
use App\Models\Event;
use App\Models\ProductOneMeta;
use App\Models\ProductTwoMeta;
use App\Models\ProductThreeMeta;
use App\Models\ProductFourMeta;
use App\Models\ProductFiveMeta;
use App\Models\SinglePageMeta;
use App\Models\SingleProductPageMeta;
use App\Models\AboutMeta;
use App\Models\ServiceMeta;
use App\Models\WhyMeta;
use App\Models\TestimonialMeta;
use App\Models\BlogMeta;
use App\Models\SingleBlogPageMeta;
use App\Models\SingleServicePageMeta;
use App\Models\GalleryMeta;
use App\Models\ContactMeta;
use App\Models\CareerMeta;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    // Removed: JSON-specific filter; using model scopeHasType instead
    public function render_about()
    {
       $about = About::first();
        $teams = Team::all();
        $posts = Post::with('category')->latest()->take(3)->get();
        $listservices = Service::latest()->take(5)->get();
        $message = DirectorMessage::all();
        $siteSetting = SiteSetting::first();
        $faqs = Faq::latest()->get();
        $missionVisionValues = MissionVisionValue::paginate(10);
        $aboutmeta=AboutMeta::first();
        return view('frontend.aboutus', compact('about', 'posts','faqs', 'listservices', 'message', 'siteSetting', 'teams','missionVisionValues','aboutmeta'));
    }

    public function render_team(Request $request)
    {
        $teams = Team::all();
        $page_title = 'Our Team';
        $services = Service::latest()->take(6)->get();
        $sitesetting = SiteSetting::first();
        $categories = Category::latest()->take(10)->get();
        $about = About::first();
        $posts = Post::with('category')->latest()->take(3)->get();
        $missionVisionValues = MissionVisionValue::paginate(10);
         $aboutmeta=AboutMeta::first();
        return view('frontend.team', compact('teams', 'sitesetting', 'categories', 'about', 'page_title', 'services', 'posts','missionVisionValues','aboutmeta'));
    }


    public function render_service()
    {
        $images = PhotoGallery::latest()->get();
        $categories = Category::all();
        $services = Service::latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();
        $serviceHead = Service::latest()->take(1)->get();
       $Sectionones = SectionOnePicture::latest()->get();
       $servicemeta=ServiceMeta::first();

        return view('frontend.services', compact('images', 'services', 'categories', 'sitesetting', 'about', 'serviceHead','Sectionones','servicemeta'));
    }

    public function render_whyus()
    {
        $clientMessages = ClientMessage::latest()->get();
        $whyUsItems = WhyUs::latest()->take(12)->get();
        $whyUsData = WhyUs::latest()->get();
        $Sectionones = SectionOnePicture::first();
        $whymeta=WhyMeta::first();

        return view('frontend.whyus', compact('whyUsItems', 'clientMessages', 'whyUsData', 'Sectionones','whymeta'));
    }

    public function render_testimonial()
    {
        $clientMessages = ClientMessage::latest()->get();
        $testimonials = Testimonial::latest()->take(12)->get();
         $testimonialmeta=TestimonialMeta::first();
        return view('frontend.testimonials', compact('testimonials', 'clientMessages','testimonialmeta'));
    }

    /**
     * ✅ Corrected render_faqs method
     */
    public function render_faqs()
    {
        $faqs = Faq::where('type', 'procurement')->latest()->get();


        return view('frontend.procurement', compact('faqs'));
    }

    public function render_blogpostcategory()
    {
        $blogpostcategories = BlogPostsCategory::all();
         $blogmeta=BlogMeta::first();
         $singleblogmeta=SingleBlogPageMeta::first();

        return view('frontend.blogpostcategories', compact('blogpostcategories','blogmeta','singleblogmeta'));
    }

    public function render_singleBlogpostcategory($slug)
    {
        $blogpostcategory = BlogPostsCategory::where('slug', $slug)->firstOrFail();
        $listblogs = BlogPostsCategory::where('slug', '!=', $slug)->latest()->get()->take(5);
          $blogmeta=BlogMeta::first();
         $singleblogmeta=SingleBlogPageMeta::first();
        return view('frontend.blogpostcategory', compact('blogpostcategory', 'listblogs' ,'blogmeta','singleblogmeta'));
    }

    public function render_singleService($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $images = PhotoGallery::latest()->get();
        $categories = Category::all();
        $services = Service::latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();
        $listservices = Service::where('slug', '!=', $slug)->get();
        $singleservicemeta=SingleServicePageMeta::first();

        return view('frontend.service', compact('service', 'images', 'services', 'categories', 'sitesetting', 'about', 'listservices','singleservicemeta'));
    }

    public function render_Countries()
    {
        $countries = Country::all();
        return view('frontend.countries', compact('countries'));
    }

    public function render_singleCountry($slug)
    {
        $country = Country::where('slug', $slug)->firstOrFail();
        $recommendedCountries = Country::where('slug', '!=', $slug)->get();

        return view('frontend.single', compact('country', 'recommendedCountries'));
    }

    public function render_singleCompany($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        return view('frontend.company', compact('company'));
    }

    public function render_singleworkCategory($slug)
    {
        $work_category = WorkCategory::where('slug', $slug)->firstOrFail();
        $listwork_category = WorkCategory::latest()->take(4)->get();

        return view('frontend.work_category', compact('work_category', 'listwork_category'));
    }

    public function render_singleCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $relatedCategories = Category::where('id', '!=', $category->id)->get();
        $posts = $category->posts()->paginate(10);

        return view('frontend.category', compact('category', 'relatedCategories', 'posts'));
    }

    public function render_singlePost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $category = $post->category;
        $relatedPosts = $category->posts()->where('id', '!=', $post->id)->get();

        return view('frontend.post', compact('post', 'relatedPosts'));
    }

    public function render_gallery()
    {
        $images = PhotoGallery::latest()->get();
        $categories = Category::all();
        $services = Service::latest()->get();
        $sitesetting = SiteSetting::first();
        $videos = VideoGallery::latest()->get();
        $gallerymeta=GalleryMeta::first();

        $videos = $videos->map(function ($video) {
            $video->embed_url = 'https://www.youtube.com/embed/' . $video->url;
            return $video;
        });

        $about = About::first();

        return view('frontend.galleries', compact('images', 'videos', 'services', 'categories', 'sitesetting', 'about' ,'gallerymeta'));
    }

    public function render_singleImage($slug)
    {
        $image = PhotoGallery::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $services = Service::latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();

        return view('frontend.singleImage', compact('image', 'services', 'categories', 'sitesetting', 'about'));
    }

    public function render_events(Request $request)
    {
        $query = Event::active()->latest();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('heading', 'like', "%{$searchTerm}%")
                    ->orWhere('subtitle', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $events = $query->paginate(9);
        $sitesetting = SiteSetting::first();

        $availableYears = Event::active()
            ->selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $availableMonths = Event::active()
            ->selectRaw('MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('month');

        return view('frontend.event', compact('events', 'sitesetting', 'availableYears', 'availableMonths'));
    }

    public function render_singleEvent($slug)
    {
        $event = Event::where('slug', $slug)->active()->firstOrFail();
        $sitesetting = SiteSetting::first();

        $relatedEvents = Event::active()
            ->where('id', '!=', $event->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.singleevents', compact('event', 'sitesetting', 'relatedEvents'));
    }

    public function teams()
    {
        $teams = Team::latest()->get();
        $categories = Category::all();
        $services = Service::latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();

        return view('portal.team', compact('teams', 'services', 'categories', 'sitesetting', 'about'));
    }

    public function render_contact()
    {
        $page_title = 'Contact Us';
        $googleMapsLink = SiteSetting::first()->google_maps_link;
        $contactmeta=ContactMeta::first();

        return view('frontend.contactpage', compact('page_title', 'googleMapsLink','contactmeta'));
    }



    public function render_products()
    {
        $type = request()->query('type');
        
        if ($type) {
            // Filter products by the selected category type via portable scope
            $products = Product::where('status', true)
                ->hasType($type)
                ->latest()
                ->paginate(12);
        } else {
            // Show all products if no type is specified
            $products = Product::where('status', true)->latest()->paginate(12);
        }
        
		$singlemeta = SinglePageMeta::first();
		
		return view('frontend.activities', compact('products', 'type', 'singlemeta'));
    }

    public function render_destinations()
    {
        $products = Product::where('status', true)
            ->hasType('Destination')
            ->latest()
            ->paginate(12);

		$ProductoneMeta = ProductOneMeta::first();

		return view('frontend.everest', compact('products', 'ProductoneMeta'));
    }
 public function render_general()
    {
        $products = Product::where('status', true)
            ->hasType('General')
            ->latest()
            ->paginate(12);

		$ProducttwoMeta = ProductTwoMeta::first();

		return view('frontend.annapurna', compact('products', 'ProducttwoMeta'));
    }
    public function render_festivals()
    {
        $products = Product::where('status', true)
            ->hasType('Festival')
            ->latest()
            ->paginate(12);

		$ProductthreeMeta = ProductThreeMeta::first();

		return view('frontend.langtang', compact('products', 'ProductthreeMeta'));
    }

    public function render_couples()
    {
        $products = Product::where('status', true)
            ->hasType('Couple')
            ->latest()
            ->paginate(12);

		$ProductfourMeta = ProductFourMeta::first();

		return view('frontend.adventure', compact('products', 'ProductfourMeta'));
    }

    public function render_groups()
    {
        $products = Product::where('status', true)
            ->hasType('Group')
            ->latest()
            ->paginate(12);

		$ProductfiveMeta = ProductFiveMeta::first();

		return view('frontend.poonhill', compact('products', 'ProductfiveMeta'));
    }

    public function render_posts()
    {
        $products = Product::where('status', true)
            ->hasType('Post')
            ->latest()
            ->paginate(12);

        return view('frontend.post', compact('products'));
    }

    public function render_singleProduct($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        
        // Get related products of the same type(s) as the current product
        $relatedProducts = Product::where('id', '!=', $id)
            ->where('status', true)
            ->where(function($query) use ($product) {
                // If the product has multiple types, find products that share at least one type
                if (is_array($product->product_types) && count($product->product_types) > 0) {
                    foreach ($product->product_types as $type) {
                        $query->orWhere(function($q) use ($type) {
                            $q->where('product_types', 'LIKE', '%"'.$type.'"%');
                        });
                    }
                }
            })
            ->latest()
            ->take(5)
            ->get();
            
		$singleproductpagemeta = SingleProductPageMeta::first();
			
		return view('frontend.productblade', compact('product', 'relatedProducts', 'singleproductpagemeta'));
    }
    

    public function showApplicationForm($id)
    {
        $product = Product::findOrFail($id);

        return view('frontend.apply', compact('product'));
    }




    public function indexproject(){
        $products = Product::latest()->get();
        return view('frontend.includes.indexproject', compact('products'));
    }



 public function render_career()
    {
        $careers = \App\Models\Career::where('status', true)->latest()->get();

        $careermeta=CareerMeta::first();

        return view('frontend.career', compact('careers', 'careermeta'));
    }
     public function render_volunteer()
    {
        $faqs = Faq::where('type', 'procurement')->latest()->get();

        return view('frontend.volunteer', compact('faqs'));
    }


public function render_SEO($id)
{
    $seoSetting = SeoSetting::findOrFail($id);
    return view('backend.seo_settings.show', compact('seoSetting'));
}



     public function render_applycareer()
    {
        // Get the first active career for the application form
        $career = \App\Models\Career::where('status', true)->first();

        if (!$career) {
            return redirect()->route('career')->with('error', 'No career opportunities available at the moment.');
        }

        return view('frontend.apply-career', compact('career'));
    }

}