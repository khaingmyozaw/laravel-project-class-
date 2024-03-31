
    @extends("layouts.app")
    @section("content")

        <div class="container" style="max-width: 800px">
            {{ $articles->links() }}

            @if (session("info"))
                <div class="alert alert-danger">
                    {{ session("info") }}
                </div>
                
            @endif

            @foreach($articles as $article)
                <div class="card mb-2">
                    <div class="card-body">
                        <h2 class="h4 card-title">{{ $article->title }}</h2>

                        <div class="mb-1">
                            <b class="fw-bold text-success">{{ $article->user->name }}</b>
                            <small class="text-muted">
                                Category: {{ $article->category->name }}.
                                {{ $article->created_at->diffForHumans() }}

                                Comments: {{ count($article->comments) }}
                            </small>
                        </div>
                        <div>
                            {{ $article->body }}
                        </div>
                        <a href="{{ url("/articles/detail/$article->id") }}">View Detail</a>
                    </div>
                </div>
            @endforeach

        </div>

    @endsection