# Dynamic Content Translation System Guide

This guide explains how to use the dynamic content translation system for content added from the admin panel backend.

## Overview

The translation system allows you to translate dynamic content (like products, events, posts, services, etc.) that is added through the admin panel. It works alongside the existing static translation system for UI elements.

## System Components

### 1. Database Structure

- **`translations` table**: Stores translations for any model using a polymorphic relationship
  - `translatable_type`: Model class name
  - `translatable_id`: Model ID
  - `locale`: Language code (en, es, etc.)
  - `field_name`: Field name to translate (heading, content, etc.)
  - `value`: Translated text

### 2. Core Components

- **`Translation` Model**: Handles translation data
- **`Translatable` Trait**: Adds translation methods to models
- **`TranslationService`**: Service class for translation operations
- **`TranslationController`**: Admin interface for managing translations

## Setup Instructions

### Step 1: Run Migration

```bash
php artisan migrate
```

This creates the `translations` table.

### Step 2: Add Translatable Trait to Models

Add the `Translatable` trait to any model that needs translation:

```php
use App\Traits\Translatable;

class Product extends Model
{
    use HasFactory, Translatable;
    // ...
}
```

Models already updated:
- `Product`
- `Event`

### Step 3: Update Controllers (Optional)

If you want to save translations when creating/updating models, inject `TranslationService`:

```php
use App\Services\TranslationService;

class ProductController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function store(Request $request)
    {
        $product = Product::create([...]);
        
        // Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($product, $request->all());
        }
        
        return redirect()->route('admin.products.index');
    }
}
```

## Usage

### In Admin Panel

1. **Access Translation Interface**:
   - Go to any model's index page (e.g., Products)
   - Click the "Translate" button next to an item
   - Or visit: `/admin/translations/{modelType}/{modelId}/edit`

2. **Add Translations**:
   - Fill in the translation fields for each language
   - Click "Save Translations"

### In Views (Frontend)

#### Method 1: Using the Trait Method

```blade
{{-- Get translated heading --}}
{{ $product->getTranslated('heading') }}

{{-- Get translated content for specific locale --}}
{{ $product->getTranslated('content', 'es') }}
```

#### Method 2: Using the Helper Function

```blade
{{-- Get translated field --}}
{{ translated($product, 'heading') }}

{{-- Get translated field for specific locale --}}
{{ translated($product, 'content', 'es') }}
```

#### Method 3: Using Magic Property

```blade
{{-- Access translated_heading --}}
{{ $product->translated_heading }}

{{-- Access translated_content --}}
{{ $product->translated_content }}
```

### In Controllers

```php
use App\Services\TranslationService;

class FrontViewController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        // Products will automatically use translated content
        // based on current locale
        return view('frontend.index', compact('products'));
    }
}
```

### Programmatic Usage

#### Save Translations

```php
use App\Services\TranslationService;

$translationService = app(TranslationService::class);

// Save single translation
$translationService->save($product, 'heading', 'Spanish Heading', 'es');

// Save multiple translations
$translations = [
    'heading' => [
        'en' => 'English Heading',
        'es' => 'Spanish Heading'
    ],
    'content' => [
        'en' => 'English Content',
        'es' => 'Spanish Content'
    ]
];
$translationService->saveMultiple($product, $translations);
```

#### Get Translations

```php
// Using the model trait
$heading = $product->getTranslated('heading');
$content = $product->getTranslated('content', 'es');

// Using the service
$heading = $translationService->get($product, 'heading');
$content = $translationService->get($product, 'content', 'es');
```

## Supported Models

Currently configured models:
- `Product` - Fields: heading, subtitle, content, location, transportation, package
- `Event` - Fields: heading, subtitle, content
- `Post` - Fields: title, description
- `Service` - Fields: title, description, keywords
- `About` - Fields: title, subtitle, description, content
- `Faq` - Fields: question, answer
- `Testimonial` - Fields: name, content, position
- `Category` - Fields: name, description
- `Country` - Fields: name, description
- `Team` - Fields: name, position, bio
- `Career` - Fields: title, description, requirements
- `WhyUs` - Fields: heading, subtitle, content

## Adding New Models

### Step 1: Add Translatable Trait

```php
use App\Traits\Translatable;

class YourModel extends Model
{
    use HasFactory, Translatable;
    // ...
}
```

### Step 2: Update TranslationController

Add your model to the `getModelClass()` method:

```php
protected function getModelClass($modelType)
{
    $models = [
        // ... existing models
        'yourmodel' => \App\Models\YourModel::class,
    ];
    return $models[$modelType] ?? null;
}
```

### Step 3: Add Translatable Fields

Add your model's translatable fields to `getTranslatableFields()`:

```php
protected function getTranslatableFields($model)
{
    $fields = [
        // ... existing fields
        'YourModel' => ['field1', 'field2', 'field3'],
    ];
    return $fields[class_basename($model)] ?? [];
}
```

## Best Practices

1. **Always provide fallback**: The system automatically falls back to the original field value if no translation exists
2. **Use consistent field names**: Keep field names consistent across models
3. **Translate all important fields**: Don't forget to translate titles, descriptions, and content
4. **Test translations**: Always test translations in both languages
5. **Keep original content**: The original content serves as the default/fallback

## Troubleshooting

### Translations not showing

1. Check if the model uses the `Translatable` trait
2. Verify translations exist in the database
3. Check current locale: `App::getLocale()`
4. Verify field names match exactly

### Translation interface not accessible

1. Check routes: `php artisan route:list | grep translation`
2. Verify authentication middleware
3. Check model type is registered in `TranslationController`

## API Reference

### Translatable Trait Methods

- `getTranslated($fieldName, $locale = null)`: Get translated value
- `setTranslation($fieldName, $value, $locale = null)`: Set translation
- `setTranslations(array $translations)`: Set multiple translations
- `getTranslationsForLocale($locale = null)`: Get all translations for locale
- `deleteTranslation($fieldName, $locale = null)`: Delete specific translation
- `deleteAllTranslations()`: Delete all translations

### TranslationService Methods

- `get($model, $fieldName, $locale = null)`: Get translation
- `save($model, $fieldName, $value, $locale = null)`: Save translation
- `saveMultiple($model, array $translations)`: Save multiple translations
- `saveFromRequest($model, array $requestData)`: Save from form request
- `getAll($model, $locale = null)`: Get all translations
- `delete($model, $fieldName, $locale = null)`: Delete translation
- `deleteAll($model)`: Delete all translations

## Examples

### Example 1: Displaying Translated Product

```blade
<div class="product">
    <h2>{{ $product->getTranslated('heading') }}</h2>
    <p class="subtitle">{{ $product->getTranslated('subtitle') }}</p>
    <div class="content">
        {!! $product->getTranslated('content') !!}
    </div>
    <p class="location">{{ $product->getTranslated('location') }}</p>
</div>
```

### Example 2: Creating Product with Translations

```php
$product = Product::create([
    'heading' => 'English Heading',
    'content' => 'English Content',
    // ... other fields
]);

// Add Spanish translations
$product->setTranslation('heading', 'Título en Español', 'es');
$product->setTranslation('content', 'Contenido en Español', 'es');
```

### Example 3: Bulk Translation Update

```php
$translations = [
    'heading' => [
        'en' => 'English Heading',
        'es' => 'Título en Español'
    ],
    'content' => [
        'en' => 'English Content',
        'es' => 'Contenido en Español'
    ]
];

$product->setTranslations($translations);
```

## Notes

- Translations are stored separately from the original content
- Original content serves as the default/fallback
- The system automatically uses the current locale
- You can override the locale when getting translations
- Translations are optional - if missing, original content is used

