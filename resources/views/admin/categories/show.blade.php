@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h1>{{ $category->label }}</h1>
        </header>

        <div class="">


            <p>Color: {{ $category->color }}</p>
            <time>Creata il: {{ $category->created_at }}</time><br>
            <time>Ultima modifica il: {{ $category->updated_at }}</time>
        </div>

        <hr>

        <footer class="d-flex align-items-center justify-content-between">
            <div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left mr-2"></i>Indietro
                </a>
            </div>
            <div class="d-flex align-items-center">
                <a class="btn btn-warning mx-2" href="{{ route('admin.categories.edit', $category) }}">
                    <i class="fa-solid fa-pencil mr-2"></i> Modifica
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                        <i class="fa-solid fa-trash mr-2"></i> Elimina
                    </button>
                </form>
            </div>
        </footer>
    @endsection
