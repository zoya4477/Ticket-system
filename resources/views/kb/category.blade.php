@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Articles in "{{ $category->name }}"</h2>

    @if($articles->isEmpty())
        <div class="alert alert-info">No articles found in this category.</div>
    @else
        <div class="list-group">
            @foreach($articles as $article)
                <a href="{{ route('kb.article', $article->id) }}" class="list-group-item list-group-item-action">
                    {{ $article->title }}
                </a>
            @endforeach
        </div>
    @endif

</div>
@endsection