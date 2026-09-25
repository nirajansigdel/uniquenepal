@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}" class="back-button">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Alert Messages -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $page_title }}</li>
            </ol>
        </nav>

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($abouts as $about)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $about->title ?? '' }}</td>
                            <td>{{ $about->subtitle ?? '' }}</td>
                            <td>
                                <img src="{{ asset('uploads/about/' . $about->image) }}" 
                                     class="table-image" 
                                     alt="{{ $about->title }}">
                            </td>
                            <td>{{ Str::limit(strip_tags($about->description), 200) }}</td>
                            <td>{{ Str::limit(strip_tags($about->content), 200) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.about-us.edit', $about->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($abouts, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $abouts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
