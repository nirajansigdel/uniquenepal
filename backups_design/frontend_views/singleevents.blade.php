@extends('frontend.layouts.master')

@section('content')


<!-- ======= Single Event Section ======= -->
<section class="container-fluid bg-light py-5">
    <div class="container">
        
        <div class="row">
            <!-- Main Event Content -->
            <div class="col-lg-12">
                <div class="">
                    <div class="card-body p-4">
                        @if($event->image)
                            <div class="text-center mb-4">
                                <img src="{{ asset('uploads/events/' . $event->image) }}" 
                                     alt="{{ $event->heading }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>
                        @endif
                        
                        <p class="mb-3 text-primary">{{ $event->heading }}</p>
                        
                        
                        <div class="event-content">
                            {!! $event->content !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
           
        </div>
    </div>
</section>

@endsection