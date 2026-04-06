@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary mb-0">
            {{ $article->title }}
        </h2>

        <!-- <a href="{{ route('kb.create') }}" class="btn btn-primary">
            + Create Article
        </a> -->
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-5">

            <p class="text-muted small mb-4">
                Published on {{ $article->created_at->format('d M Y') }}
            </p>

            <hr>

            <div class="mt-4" style="line-height: 1.8;">
                {!! $article->content !!}
            </div>

            <hr class="mt-5">

            <a href="{{ route('kb.index') }}" class="btn btn-outline-primary">
                ← Back to Knowledge Base
            </a>

        </div>
    </div>

</div>
@endsection