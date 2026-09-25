@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">All FAQs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($faqs->isEmpty())
        <p>No FAQs found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                   
                    <th>Question</th>
                    <th>Answer</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td>{{ $faq->question ? Str::limit($faq->question, 50) : 'Not set' }}</td>
                    <td>{{ Str::limit($faq->answer, 100) }}</td>
                   
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" 
                                  method="POST" 
                                  style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $faqs->links() }}
    @endif

    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary mt-3">Create New FAQ</a>
</div>
@endsection