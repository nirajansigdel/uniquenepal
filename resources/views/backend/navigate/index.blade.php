@extends('backend.layouts.master')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h3>Navigate Items</h3>
		<a href="{{ route('admin.navigate.create') }}" class="btn btn-primary">Add Item</a>
	</div>

	@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

	<div class="card">
		<div class="card-body table-responsive">
			<table class="table align-middle">
				<thead>
					<tr>
						<th>Title</th>
						<th>Shown On</th>
						<th>Position</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($items as $item)
						<tr>
							<td>{{ $item->title }}</td>
							<td>
								<small>
									@if($item->show_everest) Everest @endif
									@if($item->show_annapurna) {{ $item->show_everest ? '|' : '' }} Annapurna @endif
									@if($item->show_langtang) | Langtang @endif
									@if($item->show_poonhill) | Poonhill @endif
									@if($item->show_adventure) | Adventure @endif
									@if($item->show_activities) | Activities @endif
								</small>
							</td>
							<td>{{ $item->position }}</td>
							<td>
								<span class="badge bg-{{ $item->status ? 'success' : 'secondary' }}">{{ $item->status ? 'Active' : 'Hidden' }}</span>
							</td>
							<td class="d-flex gap-2">
								<a href="{{ route('admin.navigate.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
								<form action="{{ route('admin.navigate.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this item?')">
									@csrf @method('DELETE')
									<button class="btn btn-sm btn-danger">Delete</button>
								</form>
							</td>
						</tr>
					@empty
						<tr><td colspan="5" class="text-center text-muted">No items found.</td></tr>
					@endforelse
				</tbody>
			</table>
			{{ $items->links() }}
		</div>
	</div>
</div>
@endsection


