@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Search Results for "{{ $query }}"
    </h2>

    <!-- Articles -->
    <div class="mb-5">
        <h4 class="text-primary">Articles</h4>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @forelse($articles as $article)
                    <div class="mb-3 border-bottom pb-2">
                        <a href="{{ route('kb.article', $article->id) }}" class="fw-semibold">
                            {{ $article->title }}
                        </a>
                        <p class="small text-muted">
                            {{ Str::limit(strip_tags($article->content), 100) }}
                        </p>
                    </div>
                @empty
                    <p class="text-muted">No articles found.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- FAQs -->
    <div>
        <h4 class="text-success">FAQs</h4>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @forelse($faqs as $faq)
                    <div class="mb-3 border-bottom pb-2">
                        <strong>{{ $faq->question }}</strong>
                        <p class="small text-muted">
                            {{ Str::limit($faq->answer, 100) }}
                        </p>
                    </div>
                @empty
                    <p class="text-muted">No FAQs found.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection