@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit FAQ</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.faqs.update', $faq->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                

                {{-- Question --}}
                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <textarea class="form-control" id="question" name="question" rows="3">{{ old('question', $faq->question) }}</textarea>
                </div>
                
                
                {{-- Answer --}}
                <div class="mb-3">
                    <label for="answer" class="form-label">Answer <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="answer" name="answer" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                </div>

                <!-- Auto-Translate Section -->
                <x-auto-translate-section 
                    :model="$faq" 
                    :fields="['question', 'answer']"
                    routeName="admin.faqs.translate"
                    :modelId="$faq->id"
                />

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update FAQ</button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection