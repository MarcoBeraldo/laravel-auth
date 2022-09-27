@extends('layouts.app')

@section('content')
    <div class="container">

        <header class="d-flex justify-content-between align-items-center">
            <h1>Lista Post</h1>
            <a class="btn btn-success" href="{{ route('admin.posts.create') }}">
                <i class="fa-solid fa-plus mr-2"></i>
                Crea Post
            </a>
        </header>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <td scope="col">Titolo</td>
                    <td scope="col">Slug</td>
                    <td scope="col">Stato</td>
                    <td scope="col">Creato il</td>
                    <td scope="col">Modificato il</td>
                    <td>Azioni</td>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->is_published ? 'Pubblicato' : 'Non Pubblicato' }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td class="d-flex">
                            <a class="btn btn-sm btn-primary mx-2" href="{{ route('admin.posts.show', $post) }}">
                                <i class="fa-solid fa-eye mr-2"></i> Vedi
                            </a>
                            <a class="btn btn-sm btn-warning mx-2" href="{{ route('admin.posts.edit', $post) }}">
                                <i class="fa-solid fa-pencil mr-2"></i> Modifica
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="fa-solid fa-trash mr-2"></i> Elimina
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <h3 class="text-center">Nessun Post</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <nav class="mt-3">
            @if ($posts->hasPages())
                {{ $posts->links() }}
            @endif

        </nav>
    </div>
@endsection
