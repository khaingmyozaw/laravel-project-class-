
    @extends("layouts.app")
    @section("content")

        <div class="container" style="max-width: 800px">.

            @if (session('info'))
                <div class="alert alert-danger">{{ session('info') }}</div>
            @endif
            
            <div class="card mb-2">
                <div class="card-body">
                    <h2 class="h4 card-title">{{ $article->title }}</h2>

                    <div class="mb-1">
                        <b class="fw-bold text-success">{{ $article->user->name }}</b>
                        <small class="text-muted">
                            Category: {{ $article->category->name }}.
                            {{ $article->created_at->diffForHumans() }}
                        </small>
                        <small class="text-info">
                            (updated {{ $article->updated_at->diffForHumans() }})
                        </small>
                    </div>
                    <div>
                        {{ $article->body }}
                    </div>

                    @auth
                        @can('delete-article', $article)
                            <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-sm btn-outline-info mt-3 me-3">Edit</a>
                            <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-sm btn-outline-danger mt-3">Delete</a>
                        @endcan
                    @endauth
                </div>
            </div>

            <ul class="list-group">
                <li class="list-group-item active">
                    Comments ({{ count($article->comments) }})
                </li>
                @foreach ($article->comments as $comment)
                    <li class="list-group-item my-1">
                        @auth {{-- Authentication --}}
                            @can('delete-comment', $comment) {{-- Autherization --}}
                                <a href="{{ url("/comments/delete/$comment->id" )}}" class="btn-close float-end"></a>
                            @endcan
                        @endauth
                        <b class="text-success">{{ $comment->user->name }}</b>
                        <small class="text-info">({{ $comment->created_at->diffForHumans() }})</small> <br>
                        {{ $comment->content }}
                    </li>
                @endforeach
            </ul>

            @auth
                <form action="{{ url('/comments/add' )}}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea name="content" class="form-control my-2"></textarea>
                    <button class="btn btn-secondary">Add comment</button>
                </form>
            @endauth

        </div>

    @endsection