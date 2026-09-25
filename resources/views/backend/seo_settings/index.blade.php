@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1>SEO Settings List</h1>

    <a href="{{ route('backend.seo_settings.create') }}" class="btn btn-success mb-3">Add New SEO Setting</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($seoSettings->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meta Titles</th>
                    <th>Meta Descriptions</th>
                    <th>Canonical URLs</th>
                    <th>Heading H1</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seoSettings as $seo)
                    <tr>
                        <td>{{ $seo->id }}</td>
                        <td>
                            @if($seo->meta_title)
                                @php $titles = json_decode($seo->meta_title, true); @endphp
                                @if(is_array($titles))
                                    <ul>
                                        @foreach($titles as $title)
                                            <li>{{ $title }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $seo->meta_title }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($seo->meta_description)
                                @php $desc = json_decode($seo->meta_description, true); @endphp
                                @if(is_array($desc))
                                    <ul>
                                        @foreach($desc as $d)
                                            <li>{{ $d }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $seo->meta_description }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($seo->canonical_url)
                                @php $urls = json_decode($seo->canonical_url, true); @endphp
                                @if(is_array($urls))
                                    <ul>
                                        @foreach($urls as $url)
                                            <li><a href="{{ $url }}" target="_blank">{{ $url }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ $seo->canonical_url }}" target="_blank">{{ $seo->canonical_url }}</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($seo->heading_h1)
                                @php $headings = json_decode($seo->heading_h1, true); @endphp
                                @if(is_array($headings))
                                    <ul>
                                        @foreach($headings as $head)
                                            <li>{{ $head }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $seo->heading_h1 }}
                                @endif
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('backend.seo_settings.edit', $seo->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('backend.seo_settings.destroy', $seo->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $seoSettings->links() }}

    @else
        <p>No SEO Settings found.</p>
    @endif
</div>
@endsection
