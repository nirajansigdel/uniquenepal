@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title ?? 'Products' }}</h1>
            <div class="action-buttons">
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
                <a href="{{ url('admin') }}" class="back-button">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
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
                <li class="breadcrumb-item active">{{ $page_title ?? 'Products' }}</li>
            </ol>
        </nav>

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Heading</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Includes</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products ?? [] as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->heading ?? 'N/A' }}</td>
                            <td>{{ $product->location ?? 'N/A' }}</td>
                            <td>{{ optional($product->date)->format('Y-m-d') ?? 'N/A' }}</td>
                            <td>
                                @if(is_array($product->includes) && count($product->includes))
                                    <ul class="list-unstyled mb-0">
                                        @foreach(array_slice($product->includes, 0, 3) as $include)
                                            <li class="small text-muted">• {{ Str::limit($include, 30) }}</li>
                                        @endforeach
                                        @if(count($product->includes) > 3)
                                            <li class="small text-muted">+{{ count($product->includes) - 3 }} more</li>
                                        @endif
                                    </ul>
                                @else
                                    <span class="text-muted">No includes</span>
                                @endif
                            </td>
                            <td>
                                @if(is_array($product->images) && count($product->images))
                                    <img src="{{ asset('uploads/products/' . $product->images[0]) }}" 
                                         class="table-image" 
                                         alt="{{ $product->heading ?? 'Product Image' }}">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('admin.translations.edit', ['product', $product->id]) }}" class="btn btn-info btn-sm" title="Manage Translations">
                                        <i class="fas fa-language"></i> Translate
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($products) && method_exists($products, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 