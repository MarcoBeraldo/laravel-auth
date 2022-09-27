@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h1>{{ $post->title }}</h1>
        </header>




        <div>
            <div>
                <p>{{ $post->text }}</p>
            </div> <time>Creato il: {{ $post->created_at }}</time>
            <time>Ultima modifica il: {{ $post->updated_at }}</time>
        </div>





        <footer class="d-flex align-items-center justify-content-end">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-rotate-left mr-2"></i>Indietro
            </a>
        </footer>
    @endsection
