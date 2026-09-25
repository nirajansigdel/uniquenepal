@extends('backend.layouts.master')

@section('content')
<div class="container">
	<h3>Create Navigate Item</h3>

	@if($errors->any())
	<div class="alert alert-danger">
		<ul class="mb-0">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<form action="{{ route('admin.navigate.store') }}" method="POST" enctype="multipart/form-data" class="card p-3">
		@csrf

		<div class="row g-3">
			<div class="col-md-6">
				<label class="form-label">Title</label>
				<input type="text" name="title" class="form-control" value="{{ old('title') }}">
			</div>
			<div class="col-md-6">
				<label class="form-label">Subtitle</label>
				<input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
			</div>
			<div class="col-md-6">
				<label class="form-label">Link</label>
				<input type="text" name="link" class="form-control" value="{{ old('link') }}">
			</div>
			<div class="col-md-3">
				<label class="form-label">Position</label>
				<input type="number" name="position" class="form-control" value="{{ old('position',0) }}">
			</div>
			<div class="col-md-3 d-flex align-items-center">
				<div class="form-check mt-4">
					<input class="form-check-input" type="checkbox" name="status" value="1" id="status" checked>
					<label class="form-check-label" for="status">
						Active
					</label>
				</div>
			</div>

			<div class="col-12">
				<label class="form-label">Image</label>
				<input type="file" name="image" class="form-control">
			</div>

			<div class="col-12">
				<label class="form-label d-block">Show On Sections (choose any)</label>
				<div class="row">
					@php
						$opts = [
							'show_everest' => 'Everest',
							'show_annapurna' => 'Annapurna',
							'show_langtang' => 'Langtang',
							'show_poonhill' => 'Poonhill',
							'show_adventure' => 'Adventure',
							'show_activities' => 'Activities',
						];
					@endphp
					@foreach($opts as $name => $label)
						<div class="col-md-4">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1">
								<label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<!-- Auto-Translate (Create) -->
		<x-auto-translate-section-create 
			:fields="['title','subtitle']"
			routeName="admin.translations.translate"
		/>

		<div class="mt-3">
			<button class="btn btn-primary">Create</button>
			<a href="{{ route('admin.navigate.index') }}" class="btn btn-secondary">Cancel</a>
		</div>
	</form>
</div>
@endsection


