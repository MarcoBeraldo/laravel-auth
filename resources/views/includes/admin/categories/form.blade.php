@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




@if ($category->exists)
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST" novalidate>
@endif


@csrf
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="label">Label</label>
            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label"
                required minlength="5" maxlength="50" value="{{ old('label', $category->label) }}">
            @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="color">color</label>
            <select class="form-control @error('color') is-invalid @enderror" id="color" name="color">
                <option value="">Seleziona colore</option>
                @foreach (config('colors') as $color)
                    <option @if (old('color', $category->color) === $color['value']) selected @endif value="{{ $color['value'] }}">
                        {{ $color['name'] }}</option>
                @endforeach
            </select>
            @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>




    <hr>
    <footer class="d-flex justify-content-between">
        <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">
            <i class="fa-solid fa-rotate-left mr-2"></i>Indietro
        </a>

        <button class="btn btn-success" type="submit">
            <i class="fa-solid-fa-floppy-disk">Salva</i>
        </button>

    </footer>
    </form>
