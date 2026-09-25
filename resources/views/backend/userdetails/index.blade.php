@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title ?? 'User Details' }}</h1>
        </div>

        <!-- Alerts -->
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $page_title ?? 'User Details' }}</li>
            </ol>
        </nav>

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($userDetails ?? [] as $index => $userDetail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $userDetail->name }}</td>
                            <td>{{ $userDetail->email ?? 'N/A' }}</td>
                            <td>{{ $userDetail->phone_no }}</td>
                            <td>{{ $userDetail->product->heading ?? 'N/A' }}</td>
                            <td>{{ $userDetail->created_at ? $userDetail->created_at->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <button class="btn btn-sm btn-info toggle-details" data-id="{{ $index }}" aria-label="Toggle Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                        <tr class="user-details-row" id="details-{{ $index }}" style="display: none; background-color: #f9f9f9;">
                            <td colspan="7">
                                <div class="p-3">
                                    <p><strong>Address:</strong> {{ $userDetail->address ?? 'N/A' }}</p>
                                    <p><strong>Product Types:</strong>
                                        @php
                                            $productTypes = $userDetail->product->product_types ?? [];
                                            if (is_string($productTypes)) {
                                                $productTypes = json_decode($productTypes, true) ?? [];
                                            }
                                        @endphp
                                        @foreach($productTypes as $type)
                                            <span class="badge badge-primary">{{ $type }}</span>
                                        @endforeach
                                    </p>
                                    <p><strong>Document Proof:</strong>
                                        @if($userDetail->document_proof)
                                            <a href="{{ Storage::url($userDetail->document_proof) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-file-pdf"></i> View Document
                                            </a>
                                        @else
                                            <span class="text-muted">No document uploaded.</span>
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No user details found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($userDetails) && method_exists($userDetails, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $userDetails->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    console.log('Toggle script loaded'); // Debug line
    document.querySelectorAll('.toggle-details').forEach(button => {
        button.addEventListener('click', function () {
            console.log('Button clicked', this);
            const id = this.getAttribute('data-id');
            const detailsRow = document.getElementById('details-' + id);
            const icon = this.querySelector('i');

            if (!detailsRow) {
                console.error('Details row not found for id:', id);
                return;
            }

            // Use getComputedStyle to check visibility
            const isHidden = window.getComputedStyle(detailsRow).display === 'none';

            if (isHidden) {
                detailsRow.style.display = 'table-row';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                detailsRow.style.display = 'none';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});


</script>
@endpush
