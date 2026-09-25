<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Controllers\{
    FaqController,
    PostController,
    TeamController,
    AboutController,
    AdminController,
    WorkCategoryController,
    SearchController,
    SingleController,
    ContactController,
    CountryController,
    FaviconController,
    ServiceController,
    CategoryController,
    FrontViewController,
    CoverImageController,
    CompanyController,
    SiteSettingController,
    TestimonialController,
    VisitorBookController,
    PhotoGalleryController,
    ApplicationController,
    VideoGalleryController,
    StudentDetailController,
    UserManagementController,
    ClientMessageController,
    BlogPostsCategoryController,
    Auth\ResetPasswordController,
    CeoMessageController,
    ClientController,
    WhyUsController,
    EventController,
    // ProjectController, // Commented out - controller doesn't exist
    NotificationController,
    CareerController,
    CareerApplicationController,
    ProductController,
    ProductCommentController,
    UserDetailController,
    SeoSettingController,
    BlogMetaController,
    ContactMetaController,
    AboutMetaController,
    ServiceMetaController,
    WhyMetaController,
    GalleryMetaController,
    CareerMetaController,
    TestimonialMetaController,
    ProductOneMetaController,
    ProductTwoMetaController,
    ProductThreeMetaController,
    ProductFourMetaController,
    ProductFiveMetaController,
    SinglePageMetaController,
    SingleProductPageMetaController,
    SingleBlogPageMetaController,
    SingleServicePageMetaController,
    MissionVisionValueController,
    SectionOnePictureController,
    SectionTwoPictureController,
    SectionThreePictureController,
    SectionFourPictureController,
    LanguageController,
    TranslationController,
    NavigateItemController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🌐 Language switching
Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/api/current-language', [LanguageController::class, 'getCurrentLanguage'])->name('language.current');
Route::get('/api/available-languages', [LanguageController::class, 'getAvailableLanguages'])->name('language.available');



// ========================
// 🌐 Frontend Routes
// ========================
Route::get('/', [FrontViewController::class, 'index'])->name('index');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/demo-translations', function() {
    return view('frontend.demo-translations');
})->name('demo.translations');
Route::post('/contactpage', [ContactController::class, 'store'])->name('Contact.store');

// 📄 Static Pages
Route::get('/contactpage', [SingleController::class, 'render_contact'])->name('Contact');
Route::get('/aboutus', [SingleController::class, 'render_about'])->name('About');
Route::get('/whyus', [SingleController::class, 'render_whyus'])->name('whyus');
Route::get('/history', [SingleController::class, 'render_history'])->name('history');
Route::get('/procurement', [SingleController::class, 'render_faqs'])->name('frontend.procurement'); 
Route::get('/testimonails', [SingleController::class, 'render_testimonial'])->name('testimonails');

// 📰 Blog & Categories
Route::get('/blogs', [SingleController::class, 'render_blogpostcategory'])->name('blogs');
Route::get('/blog/{slug}', [SingleController::class, 'render_singleBlogpostcategory'])->name('blog');
Route::get('/singlecategory/{slug}', [SingleController::class, 'render_singleCategory'])->name('singleCategory');
Route::get('/singlepost/{slug}', [SingleController::class, 'render_singlePost'])->name('singlePost');

// 👥 Team & Services
Route::get('/team', [SingleController::class, 'render_team'])->name('Team');
Route::get('/services', [SingleController::class, 'render_service'])->name('Service');
Route::get('/singleservice/{slug}', [SingleController::class, 'render_singleService'])->name('SingleService');

// 🌏 Countries & Companies
Route::get('/countries', [SingleController::class, 'render_Countries'])->name('Countries');
Route::get('/singlecountry/{slug}', [SingleController::class, 'render_singleCountry'])->name('singleCountry');
Route::get('/singlecompany/{slug}', [SingleController::class, 'render_singleCompany'])->name('singleCompany');
Route::get('/singleworkcategory/{slug}', [SingleController::class, 'render_singleworkCategory'])->name('singleworkCategory');

// 📷 Gallery & Events
Route::get('/gallery', [SingleController::class, 'render_gallery'])->name('Gallery');
Route::get('/gallerys/{slug}', [SingleController::class, 'render_singleImage'])->name('singleImage');
Route::get('/events', [SingleController::class, 'render_events'])->name('events');
Route::get('/singleevent/{slug}', [SingleController::class, 'render_singleEvent'])->name('singleEvent');

// 📢 Applications
Route::get('/apply/{id}', [SingleController::class, 'showApplicationForm'])->name('apply');
Route::post('/apply/{id}', [ApplicationController::class, 'store'])->name('apply.store');

// 🛒 Products (Frontend)
Route::get('/products', [SingleController::class, 'render_products'])->name('products.index.front');
Route::get('/annapurna', [SingleController::class, 'render_general'])->name('general.index.front');
Route::get('/everest', [SingleController::class, 'render_destinations'])->name('destinations.index.front');
Route::get('/langtang', [SingleController::class, 'render_festivals'])->name('festivals.index.front');
Route::get('/adventure', [SingleController::class, 'render_couples'])->name('couples.index.front');
Route::get('/poonhill', [SingleController::class, 'render_groups'])->name('groups.index.front');
Route::get('/posts', [SingleController::class, 'render_posts'])->name('posts.index.front');
Route::get('/products/{id}', [SingleController::class, 'render_singleProduct'])->name('products.detail');
Route::post('/products/{product}/comments', [ProductCommentController::class, 'store'])->name('products.comments.store');

// Extra static pages (optional)
Route::get('/career', [SingleController::class, 'render_career'])->name('career');
Route::get('/volunteer', [SingleController::class, 'render_volunteer'])->name('volunteer');
Route::get('/applycareer', [SingleController::class, 'render_applycareer'])->name('applycareer');

// Career Applications
Route::post('/career-applications', [CareerApplicationController::class, 'store'])->name('career-applications.store');

// ========================
// 🔐 Authentication Routes
// ========================
Auth::routes();
Route::post('/change-password', [ResetPasswordController::class, 'updatePassword'])
    ->name('changePassword')->middleware('auth');

// ========================
// 🛠 Backend (Admin) Routes
// ========================
Route::prefix('/admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

	// Resource Controllers
	Route::resources([
        'site-settings' => SiteSettingController::class,
        'cover-images' => CoverImageController::class,
        'about-us' => AboutController::class,
        'ceomessage' => CeoMessageController::class,
        'client' => ClientController::class,
        'services' => ServiceController::class,
        'categories' => CategoryController::class,
        'posts' => PostController::class,
        'photo-galleries' => PhotoGalleryController::class,
        'video-galleries' => VideoGalleryController::class,
        'testimonials' => TestimonialController::class,
        'visitors-book' => VisitorBookController::class,
        'blog-posts-categories' => BlogPostsCategoryController::class,
        'work_categories' => WorkCategoryController::class,
        'teams' => TeamController::class,
        'faqs' => FaqController::class,
        'events' => EventController::class,
        'countries' => CountryController::class,
        'companies' => CompanyController::class,
        'student-details' => StudentDetailController::class,
        'contacts' => ContactController::class,
        'favicons' => FaviconController::class,
        'client_messages' => ClientMessageController::class,
        // 'demands' => DemandController::class, // deprecated
        // 'projects' => ProjectController::class, // Commented out - controller doesn't exist
        'products' => ProductController::class,
        'notifications' => NotificationController::class,
        'careers' => CareerController::class,
        'seo_settings' => SeoSettingController::class, 
        'blogmeta' => BlogMetaController::class,
        'contactmeta' => ContactMetaController::class,
        'aboutmeta' => AboutMetaController::class,
        'servicemeta' => ServiceMetaController::class,
        'whymeta' => WhyMetaController::class,
        'gallerymeta' => GalleryMetaController::class,
        'careermeta' => CareerMetaController::class,
        'testimonialmeta' => TestimonialMetaController::class,
        'productonemeta' => ProductOneMetaController::class,
        'producttwometa' => ProductTwoMetaController::class,
        'productthreemeta' => ProductThreeMetaController::class,
        'productfourmeta' => ProductFourMetaController::class,
        'productfivemeta' => ProductFiveMetaController::class,
        'singlepagemeta' => SinglePageMetaController::class,
        'singleproductpagemeta' => SingleProductPageMetaController::class,
        'singleblogpagemeta' => SingleBlogPageMetaController::class,
        'singleservicepagemeta' => SingleServicePageMetaController::class,
        'missionvisionvalue'=> MissionVisionValueController::class,
        'sectiononepicture' => SectionOnePictureController::class,
        'sectiontwopicture' => SectionTwoPictureController::class,
        'sectionthreepicture' => SectionThreePictureController::class,
        'sectionfourpicture' => SectionFourPictureController::class,
        // 'userdetails' => UserDetailController::class, // Simplified - only display data
	], [
		// Normalize parameter names to avoid odd singularization (e.g., productonemetum)
		'parameters' => [
			'productonemeta' => 'productonemeta',
			'producttwometa' => 'producttwometa',
			'productthreemeta' => 'productthreemeta',
			'productfourmeta' => 'productfourmeta',
			'productfivemeta' => 'productfivemeta',
			'singlepagemeta' => 'singlepagemeta',
			'singleproductpagemeta' => 'singleproductpagemeta',
			'singleblogpagemeta' => 'singleblogpagemeta',
			'singleservicepagemeta' => 'singleservicepagemeta',
		],
	]);

    Route::delete('products/{product}/images/{index}', [ProductController::class, 'deleteImage'])->name('products.images.destroy');
    Route::delete('products/{product}/videos/{index}', [ProductController::class, 'deleteVideo'])->name('products.videos.destroy');
    // Translation routes
    Route::get('/translations/{modelType}/{modelId}/edit', [TranslationController::class, 'edit'])->name('translations.edit');
    Route::put('/translations/{modelType}/{modelId}', [TranslationController::class, 'update'])->name('translations.update');
    
    // Auto-translate routes
    Route::post('/about-us/{id}/translate', [AboutController::class, 'translate'])->name('about-us.translate');
    Route::post('/products/{product}/translate', [ProductController::class, 'translate'])->name('products.translate');
    Route::post('/posts/{post}/translate', [PostController::class, 'translate'])->name('posts.translate');
    Route::post('/services/{service}/translate', [ServiceController::class, 'translate'])->name('services.translate');
    Route::post('/faqs/{faq}/translate', [FaqController::class, 'translate'])->name('faqs.translate');
    Route::post('/testimonials/{testimonial}/translate', [TestimonialController::class, 'translate'])->name('testimonials.translate');
    Route::post('/categories/{category}/translate', [CategoryController::class, 'translate'])->name('categories.translate');
    Route::post('/countries/{country}/translate', [CountryController::class, 'translate'])->name('countries.translate');
    Route::post('/teams/{team}/translate', [TeamController::class, 'translate'])->name('teams.translate');
    Route::post('/careers/{career}/translate', [CareerController::class, 'translate'])->name('careers.translate');
    Route::post('/whyus/{whyus}/translate', [WhyUsController::class, 'translate'])->name('whyus.translate');
    Route::post('/cover-images/{coverImage}/translate', [CoverImageController::class, 'translate'])->name('cover-images.translate');
    Route::post('/ceomessage/{directorMessage}/translate', [CeomessageController::class, 'translate'])->name('ceomessage.translate');
    Route::post('/missionvisionvalue/{missionVisionValue}/translate', [MissionVisionValueController::class, 'translate'])->name('missionvisionvalue.translate');
    Route::post('/blog-posts-categories/{blogPostsCategory}/translate', [BlogPostsCategoryController::class, 'translate'])->name('blog-posts-categories.translate');
    
    // Generic translation route for create pages (no model ID required)
    Route::post('/translations/translate', [TranslationController::class, 'translateGeneric'])->name('translations.translate');

Route::prefix('backend')->name('backend.')->group(function () {
    Route::resource('seo_settings', SeoSettingController::class);
});





// Navigate items
	Route::resource('navigate', NavigateItemController::class);


    // Notifications Status Toggle
    Route::patch('/notifications/{id}/toggle-status', [NotificationController::class, 'toggleStatus'])->name('notifications.toggle-status');

    // Careers Status Toggle
    Route::patch('/careers/{id}/toggle-status', [CareerController::class, 'toggleStatus'])->name('careers.toggle-status');

    // Career Applications Management
    Route::get('/career-applications', [CareerApplicationController::class, 'index'])->name('career-applications.index');
    Route::get('/career-applications/{application}', [CareerApplicationController::class, 'show'])->name('career-applications.show');
    Route::patch('/career-applications/{application}/update-status', [CareerApplicationController::class, 'updateStatus'])->name('career-applications.update-status');
    Route::delete('/career-applications/{application}', [CareerApplicationController::class, 'destroy'])->name('career-applications.destroy');

    // Applications Management (now using userdetails)
    Route::get('/applications', [ApplicationController::class, 'adminIndex'])->name('applications.index');
    Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');

    // User Details Management (Read Only)
    Route::get('/userdetails', [UserDetailController::class, 'index'])->name('userdetails.index');
    Route::get('/userdetails/{id}', [UserDetailController::class, 'show'])->name('userdetails.show');
});

// ========================
// 🎯 WhyUs Section (Backend)
// ========================
Route::prefix('backend')->name('backend.')->group(function () {
    Route::get('/whyus', [WhyUsController::class, 'index'])->name('whyus.index');
    Route::get('/whyus/create', [WhyUsController::class, 'create'])->name('whyus.create');
    Route::post('/whyus/store', [WhyUsController::class, 'store'])->name('whyus.store');
    Route::get('/whyus/{id}/edit', [WhyUsController::class, 'edit'])->name('whyus.edit');
    Route::put('/whyus/{id}', [WhyUsController::class, 'update'])->name('whyus.update');
    Route::delete('/whyus/{id}', [WhyUsController::class, 'destroy'])->name('whyus.destroy');
});

// ========================
// 🎯 Events Section (Backend alias)
// ========================
Route::prefix('backend')->name('backend.')->group(function () {
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
});


Route::get('/events/{slug}', [EventController::class, 'show'])
     ->name('singleevents');

    Route::prefix('backend/seo_settings')->name('backend.seo_settings.')->group(function () {
    Route::get('/', [SeoSettingController::class, 'index'])->name('index');            // List all SEO settings
    Route::get('/create', [SeoSettingController::class, 'create'])->name('create');    // Show create form
    Route::post('/', [SeoSettingController::class, 'store'])->name('store');           // Store new SEO setting
    Route::get('/{id}/edit', [SeoSettingController::class, 'edit'])->name('edit');     // Show edit form
    Route::put('/{id}', [SeoSettingController::class, 'update'])->name('update');      // Update SEO setting
    Route::delete('/{id}', [SeoSettingController::class, 'destroy'])->name('destroy'); // Delete SEO setting
});
