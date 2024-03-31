@extends("layouts.app")
@section("content")

    <div class="container" style="max-width: 800px">
        <form method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <div class="mb-2">
                <label>Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-2">
                <label>Body</label>
                <textarea name="body" class="form-control"></textarea>
            </div>
            <div class="mb-2">
                <label>Category</label>
                <select name="category_id" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                        {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>

@endsection