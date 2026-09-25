@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title ?? 'User Detail' }}</h1>
            <div class="action-buttons">
                <a href="{{ route('admin.userdetails.edit', $userDetail->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.userdetails.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.userdetails.index') }}">User Details</a></li>
                <li class="breadcrumb-item active">{{ $userDetail->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Personal Information -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Name:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Email:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->email ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Phone Number:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->phone_no }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>WhatsApp Number:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->whatsapp_no ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Address:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->address ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Date of Birth:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->date_of_birth ? $userDetail->date_of_birth->format('M d, Y') : 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Nationality:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->nationality ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passport Information -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Passport Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Passport Number:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->passport_number ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Passport Expiry:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->passport_expiry ? $userDetail->passport_expiry->format('M d, Y') : 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Product Applied:</strong></div>
                            <div class="col-sm-8">
                                @if($userDetail->product)
                                    <div>
                                        <strong>{{ $userDetail->product->heading }}</strong>
                                        @if($userDetail->product->product_types)
                                            <div class="mt-2">
                                                @php
                                                    $productTypes = $userDetail->product->product_types;
                                                    if (is_string($productTypes)) {
                                                        $productTypes = json_decode($productTypes, true) ?? [];
                                                    }
                                                    if (!is_array($productTypes)) {
                                                        $productTypes = [];
                                                    }
                                                @endphp
                                                                                                 @foreach($productTypes as $type)
                                                     <span class="badge badge-info mr-1 mb-1" style="background-color: #5C7C8F; color: white; font-weight: bold;">{{ $type }}</span>
                                                 @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Status:</strong></div>
                            <div class="col-sm-8">
                                @switch($userDetail->status)
                                    @case('pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @break
                                    @case('approved')
                                        <span class="badge badge-success">Approved</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                        @break
                                    @case('completed')
                                        <span class="badge badge-info">Completed</span>
                                        @break
                                    @default
                                        <span class="badge badge-secondary">{{ ucfirst($userDetail->status) }}</span>
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Emergency Contact -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Emergency Contact</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Contact Name:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->emergency_contact_name ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Contact Phone:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->emergency_contact_phone ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Relationship:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->emergency_contact_relationship ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Information -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Medical Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Medical Conditions:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->medical_conditions ?? 'None' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Allergies:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->allergies ?? 'None' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Medications:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->medications ?? 'None' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Travel Preferences -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Travel Preferences</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Dietary Restrictions:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->dietary_restrictions ?? 'None' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Special Requirements:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->special_requirements ?? 'None' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Preferred Accommodation:</strong></div>
                            <div class="col-sm-8">{{ $userDetail->preferred_accommodation ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                    </div>
                    <div class="card-body">
                                                 <div class="row mb-3">
                             <div class="col-sm-4"><strong>Document Proof:</strong></div>
                             <div class="col-sm-8">
                                 @if($userDetail->document_proof)
                                     <a href="{{ Storage::url($userDetail->document_proof) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                         <i class="fas fa-file-pdf"></i> View Document
                                     </a>
                                 @else
                                     <span class="text-muted">No document uploaded</span>
                                 @endif
                             </div>
                         </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Passport Copy:</strong></div>
                            <div class="col-sm-8">
                                @if($userDetail->passport_copy)
                                    <a href="{{ Storage::url($userDetail->passport_copy) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-file-pdf"></i> View Passport
                                    </a>
                                @else
                                    <span class="text-muted">No passport copy uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Notes -->
        @if($userDetail->admin_notes)
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Admin Notes</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $userDetail->admin_notes }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
