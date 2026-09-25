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
