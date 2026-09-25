@php
	$items = \App\Models\NavigateItem::where('status', true)->get();
	$sections = [
		'everest' => ['label' => 'Everest Region', 'flag' => 'show_everest'],
		'annapurna' => ['label' => 'Annapurna Region', 'flag' => 'show_annapurna'],
		'langtang' => ['label' => 'Langtang Region', 'flag' => 'show_langtang'],
		'poonhill' => ['label' => 'Poonhill', 'flag' => 'show_poonhill'],
		'adventure' => ['label' => 'Adventure', 'flag' => 'show_adventure'],
		'activities' => ['label' => 'Activities', 'flag' => 'show_activities'],
	];
@endphp

<style>

        .fornewwdesign{
            margin-top: -50px !important;
        }
    
	.navigate-section { position: relative; overflow: hidden; color: rgba(255, 255, 255, 0.7); }
	.navigate-section .container { position: relative; z-index: 1; }
	.navigate-section .extralarger { color: #fff; }
	.section-title { font-weight: 700; margin-bottom: 20px; }

	.navigate-card { position: relative; overflow: hidden; border-radius:3px; }
	
	.navigate-card img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform .4s ease, filter .4s ease; 
	filter: brightness(1.2); /* Add filter transition */
}

.navigate-card:hover img {   /* Slight zoom */
	filter: brightness(1.3);  /* Slightly brighter */
}

/* Optional: soften the overlay on hover */
.navigate-card::after {
	content: "";
	position: absolute;
	inset: 0;
	background: linear-gradient(to top, rgba(0,0,0,.55), rgba(0,0,0,.1));
	transition: background .4s ease;
}

.navigate-card:hover::after {
	background: linear-gradient(to top, rgba(0,0,0,.45), rgba(0,0,0,.05));
}

	/* Centered overlay content */
	.navigate-overlay {
		position: absolute;
		inset: 0;
		z-index: 2;
		display: flex;
		flex-direction: column;
		align-items: center;
	
		padding: 16px;
		text-align: center;
		top:70%
	}
	.navigate-desc {
		color: #fff;
		font-size: 15px;
		margin-bottom: 12px;
		text-shadow: 0 2px 6px rgba(0,0,0,.6);
		max-width: 85%;
	}
	/* Elevated pill button in center */
	.navigate-btn {
	background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold-dark) 100%);
	border: none;
	font-weight: 600;
	padding: 12px 18px;
	text-transform: uppercase;
	color: var(--charcoal);
	box-shadow: 0 6px 16px rgba(201, 161, 90, 0.35);
	letter-spacing: .5px;
	display: inline-flex;
	align-items: center;
	text-decoration: none;
	justify-content: center;
	transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease;
}

.navigate-btn:hover {
	transform: translateY(-1px);
	box-shadow: 0 8px 20px rgba(201, 161, 90, 0.45);
	opacity: .95;
}

	/* Single uniform height for all cards */
	.uniform-card { height: 300px; }
	/* Flex layout */
	.navigate-flex { display: flex; flex-wrap: wrap; gap: 2rem; }
	.navigate-item { flex: 1 1 100%; }
	@media (min-width: 992px) {
		/* First two items → col-6, others → col-4 */
		.navigate-item.wide { flex: 0 0 calc(50% - 1rem); }
		.navigate-item.narrow { flex: 0 0 calc(32.8% - 1rem); }
	}
</style>

<section class="navigate-section  fornewwdesign py-5 section-reveal">
	<svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
		<path d="M1460,60 C 1220,10 1080,160 840,100 S 420,-10 190,80 S -20,210 -60,130" />
		<circle cx="1330" cy="560" r="75" />
	</svg>
	<div class="container">
		<div class="text-center mb-4">
			<p class="heading justify-content-center">Choose Your Himalaya</p>
			<p class="extralarger">Six Regions. One Unforgettable Journey.</p>
		</div>
		<div class="navigate-flex">
			@php $shown = 0; @endphp
			@foreach($sections as $key => $meta)
				@php
					$item = $items->first(fn($i) => $i->{$meta['flag']});
				@endphp
				@if($item)
				@php $shown++; $sizeClass = $shown <= 2 ? 'wide' : 'narrow'; @endphp
				<div class="navigate-item {{ $sizeClass }}">
					<div class="navigate-card uniform-card">
						@if($item->image)
							<img src="{{ asset('uploads/navigate/'.$item->image) }}" alt="{{ $item->title }}">
						@endif
						<div class="navigate-overlay">
							@php
								$locale = app()->getLocale();
								$titleOut = method_exists($item, 'getTranslated') ? ($item->getTranslated('title', $locale) ?? $item->title) : $item->title;
								$subtitleOut = method_exists($item, 'getTranslated') ? ($item->getTranslated('subtitle', $locale) ?? $item->subtitle) : $item->subtitle;
							@endphp
							@if($subtitleOut)<p class="navigate-desc">{{ $subtitleOut }}</p>@endif
							@if($item->link)
								<a href="{{ $item->link }}" class="navigate-btn">{{ $titleOut }}</a>
							@else
								<span class=" navigate-btn">{{ $titleOut }}</span>
							@endif
						</div>
					</div>
				</div>
				@endif
			@endforeach
		</div>
	</div>
</section>
