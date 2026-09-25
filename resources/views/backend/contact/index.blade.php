@extends('backend.layouts.master')

@section('content')
<style>
    /* Remove any red borders or outlines */
    .card, .table, .table-responsive, .row, .col-md-3, .col-sm-6 {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
    }
    
    /* Ensure clean styling for summary cards */
    .card.bg-primary, .card.bg-success, .card.bg-info, .card.bg-warning {
        border: none !important;
        outline: none !important;
    }
    
    /* Remove any red borders from table */
    .table-bordered {
        border: 1px solid #dee2e6 !important;
    }
    
    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6 !important;
    }
</style>
    <!-- Content Wrapper. Contains page content -->

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

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</button></a>
        </div>
        
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Contact Messages</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $contacts->total() }}</h4>
                            <p class="mb-0">Total Messages</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-envelope fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $contacts->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                            <p class="mb-0">Today's Messages</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-calendar-day fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $contacts->where('created_at', '>=', now()->startOfWeek())->count() }}</h4>
                            <p class="mb-0">This Week</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-calendar-week fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $contacts->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
                            <p class="mb-0">This Month</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-calendar-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="5%">S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Service</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $serialNumber = ($contacts->currentPage() - 1) * $contacts->perPage() + 1;
                @endphp

                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $serialNumber }}</td>
                        <td>{{ $contact->name ?? '' }}</td>
                        <td>{{ $contact->email ?? 'N/A' }}</td>
                        <td>{{ $contact->phone_no ?? '' }}</td>
                        <td>{{ $contact->service ?? 'N/A' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                View Message
                            </button>
                        </td>
                        <td>{{ $contact->created_at->format('M d, Y') }}</td>
                        <td>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this contact message?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Message Modal -->
                    <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="messageModalLabel{{ $contact->id }}">Message from {{ $contact->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Name:</strong> {{ $contact->name }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Email:</strong> {{ $contact->email ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Phone:</strong> {{ $contact->phone_no }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Service:</strong> {{ $contact->service ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <strong>Message:</strong>
                                            <div class="mt-2 p-3 bg-light rounded">
                                                {{ $contact->message }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <strong>Submitted:</strong> {{ $contact->created_at->format('F d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                                                 </div>
                     </div>
                     @php
                    $serialNumber++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($contacts->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $contacts->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                @if ($page == $contacts->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if ($contacts->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $contacts->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav>

@stop
