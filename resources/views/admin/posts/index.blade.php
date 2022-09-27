@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h1>Lista Post</h1>
        </header>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <td scope="col">Titolo</td>
                    <td scope="col">Slug</td>
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
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary mx-2" href="{{ route('admin.posts.show', $post) }}">Vedi</a>
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
    </div>
@endsection
