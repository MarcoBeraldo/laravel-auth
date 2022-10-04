@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




@if ($post->exists)
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST" novalidate>
@endif


@csrf
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                required minlength="5" maxlength="50" value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-4">
        <label for="category_id">Categoria</label>
        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
            <option value="">Nessuna categoria</option>
            @foreach ($categories as $category)
                <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                    {{ $category->label }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-12">
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required
                rows="8">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-11">
        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="url" class="form-control @error('image') is-invalid @enderror" id="image-field"
                name="image" value="{{ old('image', $post->image) }}">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-1">
        <div class="form-group">
            <img class="img-fluid pt-3"
                src="{{ $post->image ?? 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1200px-Picture_icon_BLACK.svg.png' }}"
                alt="post image preview" id="preview">
        </div>
    </div>

    @if (count($tags))
        <hr>
        <fieldset class="col-12">
            <h4>Tags</h4>

            @foreach ($tags as $tag)
                <div class="form-group form-check-inline">
                    <input type="checkbox" class="form-check-input" id="tag-{{ $tag->label }}" name="tags[]"
                        value="{{ $tag->id }}" @if (in_array($tag->id, old('tags', $prev_tags ?? []))) checked @endif>
                    <label for="tag-{{ $tag->label }}">{{ $tag->label }}</label>
                </div>
            @endforeach

        </fieldset>
    @endif

    <hr>
    <footer class="col-12 d-flex justify-content-between">
        <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">
            <i class="fa-solid fa-rotate-left mr-2"></i>Indietro
        </a>

        <button class="btn btn-success" type="submit">
            <i class="fa-solid-fa-floppy-disk">Salva</i>
        </button>

    </footer>
    </form>
