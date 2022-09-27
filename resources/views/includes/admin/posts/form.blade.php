@if ($post->exists)
    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST">
@endif


@csrf
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" required minlength="5"
                maxlength="50" value="{{ old('title', $post->title) }}">

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" name="content" required rows="8">{{ old('content', $post->content) }}</textarea>

        </div>
    </div>
    <div class="col-11">
        <div class="form-group">
            <label for="image">Titolo</label>
            <input type="url" class="form-control" id="image-field" name="image"
                value="{{ old('image', $post->image) }}">
        </div>
    </div>
    <div class="col-1">
        <div class="form-group">
            <img class="img-fluid pt-3"
                src="{{ $post->image ?? 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1200px-Picture_icon_BLACK.svg.png' }}"
                alt="post image preview" id="preview">
        </div>
    </div>
    <hr>
    <footer class="d-flex justify-content-between">
        <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">
            <i class="fa-solid fa-rotate-left mr-2"></i>Indietro
        </a>

        <button class="btn btn-success" type="submit">
            <i class="fa-solid-fa-floppy-disk">Salva</i>
        </button>

    </footer>
    </form>
