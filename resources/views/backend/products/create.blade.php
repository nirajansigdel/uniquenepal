@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Create Product</div>

                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="heading">Heading</label>
                                <input type="text" name="heading" id="heading" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="package">Pack Rate</label>
                                <input type="text" name="package" id="package" class="form-control" />
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="original_price">Original Price (NPR)</label>
                                        <input type="number" name="original_price" id="original_price" class="form-control" step="0.01" min="0" placeholder="e.g., 20000" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discounted_price">Discounted Price (NPR)</label>
                                        <input type="number" name="discounted_price" id="discounted_price" class="form-control" step="0.01" min="0" placeholder="e.g., 15000" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="transportation">Type of Transportation</label>
                                <input type="text" name="transportation" id="transportation" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="date">Date of Travel / Event</label>
                                <input type="date" name="date" id="date" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration (Days/Nights)</label>
                                <input type="text" name="duration" id="duration" class="form-control"
                                    placeholder="e.g., 3 Days / 2 Nights" />
                            </div>
                            <div class="form-group">
                                <label for="people">No. of People</label>
                                <input type="number" name="people" id="people" class="form-control" min="1" />
                            </div>

                            <div class="form-group">
                                <label>Includes <small class="text-muted">(Up to 5 items)</small></label>
                                <ul id="includes-list" class="list-unstyled">
                                    <li class="mb-2 d-flex align-items-center">
                                        <input type="text" name="includes[]" class="form-control me-2"
                                            placeholder="Enter included item" required />
                                        <button type="button" class="btn btn-success btn-sm add-include" id="add-include-btn">+</button>
                                    </li>
                                </ul>
                                <small class="text-muted">Current items: <span id="includes-count">1</span>/5</small>
                            </div>

                            <div class="form-group">
                                <label>Excludes <small class="text-muted">(What's NOT included — up to 5 items)</small></label>
                                <ul id="excludes-list" class="list-unstyled">
                                    <li class="mb-2 d-flex align-items-center">
                                        <input type="text" name="excludes[]" class="form-control me-2"
                                            placeholder="Enter excluded item" />
                                        <button type="button" class="btn btn-success btn-sm add-exclude" id="add-exclude-btn">+</button>
                                    </li>
                                </ul>
                                <small class="text-muted">Current items: <span id="excludes-count">1</span>/5</small>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control summernote" rows="5"></textarea>
                            </div>

                            <div class="form-group pt-3">
                                <label for="images">Images (up to 6)</label>
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                                <small class="text-muted">You can select multiple images.</small>
                                <div class="mt-2 small text-muted">Selected: <span id="imagesCount">0</span></div>
								<div id="galleryPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
                            </div>

                            <div class="form-group pt-3">
                                <label for="videos">Video Clips <small class="text-muted">(short 3–5 second highlight clips)</small></label>
                                <input type="file" name="videos[]" id="videos" class="form-control" accept="video/*" multiple>
                                <small class="text-muted">You can select multiple short video clips (max 20MB each).</small>
                                <ul id="videosPreview" class="mt-2 small text-muted"></ul>
                            </div>
                            {{-- Project Type Selection --}}
                            <div class="form-group">
                                <label>Project Categories</label>
                                <ul style="list-style-type: none; padding-left: 0;">
                                                                        <li>
                                        <label><input type="checkbox" class="product-type" value="Post"
                            name="product_types[]">Post (activities)</label>
                                    </li>
                                    <li>
                                        <label><input type="checkbox" class="product-type" value="Destination"
                            name="product_types[]">Everest ( Destination)</label>
                                    </li>
                                    <li>
                                        <label><input type="checkbox" class="product-type" value="General"
                            name="product_types[]">Annapurna ( general)</label>
                                    </li>
                                    <li>
                                        <label><input type="checkbox" class="product-type" value="Festival"
                            name="product_types[]">Langtang ( festival)</label>
                                    </li>
                                    <li>
                                        <label><input type="checkbox" class="product-type" value="Couple"
                            name="product_types[]">Advanture ( couple)</label>
                                    </li>
                                    <li>
                                        <label><input type="checkbox" class="product-type" value="Group"
                            name="product_types[]">Dolpa ( group)</label>
                                    </li>

                                </ul>
                            </div>

                            <!-- Auto-Translate Section -->
                            <x-auto-translate-section-create
                                :fields="['heading', 'subtitle', 'content', 'location', 'transportation', 'package', 'includes', 'excludes']"
                                routeName="admin.translations.translate"
                            />

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                        {{-- Related Products Display --}}
                        <hr>
                        <div id="related-products-container"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const includesList = document.getElementById("includes-list");
            const addIncludeBtn = document.getElementById("add-include-btn");
            const includesCountSpan = document.getElementById("includes-count");

            let currentIncludesCount = 1;
            includesCountSpan.textContent = currentIncludesCount;

            addIncludeBtn.addEventListener("click", function () {
                if (currentIncludesCount < 5) {
                    const newLi = document.createElement("li");
                    newLi.classList.add("mb-2", "d-flex", "align-items-center");
                    newLi.innerHTML = `
                        <input type="text" name="includes[]" class="form-control me-2" placeholder="Enter included item" />
                        <button type="button" class="btn btn-danger remove-include">−</button>
                    `;
                    includesList.appendChild(newLi);
                    currentIncludesCount++;
                    includesCountSpan.textContent = currentIncludesCount;
                }
            });

            includesList.addEventListener("click", function (e) {
                if (e.target.classList.contains("remove-include")) {
                    e.target.closest("li").remove();
                    currentIncludesCount--;
                    includesCountSpan.textContent = currentIncludesCount;
                }
            });

            const excludesList = document.getElementById("excludes-list");
            const addExcludeBtn = document.getElementById("add-exclude-btn");
            const excludesCountSpan = document.getElementById("excludes-count");

            let currentExcludesCount = 1;
            excludesCountSpan.textContent = currentExcludesCount;

            addExcludeBtn.addEventListener("click", function () {
                if (currentExcludesCount < 5) {
                    const newLi = document.createElement("li");
                    newLi.classList.add("mb-2", "d-flex", "align-items-center");
                    newLi.innerHTML = `
                        <input type="text" name="excludes[]" class="form-control me-2" placeholder="Enter excluded item" />
                        <button type="button" class="btn btn-danger remove-exclude">−</button>
                    `;
                    excludesList.appendChild(newLi);
                    currentExcludesCount++;
                    excludesCountSpan.textContent = currentExcludesCount;
                }
            });

            excludesList.addEventListener("click", function (e) {
                if (e.target.classList.contains("remove-exclude")) {
                    e.target.closest("li").remove();
                    currentExcludesCount--;
                    excludesCountSpan.textContent = currentExcludesCount;
                }
            });

            const videosInput = document.getElementById("videos");
            const videosPreview = document.getElementById("videosPreview");
            if (videosInput) {
                videosInput.addEventListener("change", function () {
                    videosPreview.innerHTML = "";
                    Array.from(videosInput.files || []).forEach(function (file) {
                        const li = document.createElement("li");
                        li.textContent = file.name + " (" + (file.size / (1024 * 1024)).toFixed(1) + " MB)";
                        videosPreview.appendChild(li);
                    });
                });
            }
        });
    </script>

    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('imagePreview');

            while (preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '200px';
                    img.style.maxHeight = '200px';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
            $('.summernote').summernote({
                height: 200,
                focus: true
            });

            $('.product-type').on('change', function () {
                let selectedTypes = [];

                $('.product-type:checked').each(function () {
                    selectedTypes.push($(this).val());
                });

                if (selectedTypes.length > 0) {
                    // Placeholder for potential AJAX if needed in future
                } else {
                    $('#related-products-container').empty();
                }
            });
        });

		// Live preview with per-file remove using DataTransfer
		(function(){
			const input = document.getElementById('images');
			const preview = document.getElementById('galleryPreview');
			const counter = document.getElementById('imagesCount');

			function rebuildPreview(files) {
				counter.textContent = files.length;
				while (preview.firstChild) preview.removeChild(preview.firstChild);
				files.forEach((file, i) => {
					const reader = new FileReader();
					reader.onload = function (ev) {
						const wrap = document.createElement('div');
						wrap.style.width = '100px';
						wrap.style.height = '100px';
						wrap.style.position = 'relative';
						wrap.style.borderRadius = '6px';
						wrap.style.overflow = 'hidden';

						const img = document.createElement('img');
						img.src = ev.target.result;
						img.style.width = '100%';
						img.style.height = '100%';
						img.style.objectFit = 'cover';

						const btn = document.createElement('button');
						btn.type = 'button';
						btn.textContent = '×';
						btn.className = 'btn btn-sm btn-danger';
						btn.style.position = 'absolute';
						btn.style.top = '4px';
						btn.style.right = '4px';
						btn.addEventListener('click', function(){
							const dt = new DataTransfer();
							Array.from(input.files).forEach((f, idx) => { if (idx !== i) dt.items.add(f); });
							input.files = dt.files;
							rebuildPreview(Array.from(input.files));
						});

						wrap.appendChild(img);
						wrap.appendChild(btn);
						preview.appendChild(wrap);
					};
					reader.readAsDataURL(file);
				});
			}

			input.addEventListener('change', function(e){
				rebuildPreview(Array.from(input.files || []));
			});
		})();
    </script>
@endsection


