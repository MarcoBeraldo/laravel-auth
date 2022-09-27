@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h1>{{ $post->title }}</h1>
        </header>

        <div class="clearfix">
            @if ($post->image)
                <img class="float-left mr-2" src="{{ $post->image }}" alt="{{ $post->slug }}">
            @endif
            <p>{{ $post->content }}</p>
            <time>Creato il: {{ $post->created_at }}</time><br>
            <time>Ultima modifica il: {{ $post->updated_at }}</time>
        </div>

        <hr>

        <footer class="d-flex align-items-center justify-content-between">
            <div>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left mr-2"></i>Indietro
                </a>
            </div>
            <div class="d-flex align-items-center">
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                        <i class="fa-solid fa-trash mr-2"></i> Elimina
                    </button>
                </form>
            </div>
        </footer>
    @endsection
