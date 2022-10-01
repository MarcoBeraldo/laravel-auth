@extends('layouts.app')

@section('content')
    <div class="container">

        <header class="d-flex justify-content-between align-items-center">
            <h1>Lista Categorie</h1>
            <a class="btn btn-success" href="{{ route('admin.categories.create') }}">
                <i class="fa-solid fa-plus mr-2"></i>
                Nuova Categoria
            </a>
        </header>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <td scope="col">Titolo</td>
                    <td scope="col">Color</td>

                    <td scope="col">Creato il</td>
                    <td scope="col">Modificato il</td>
                    <td>Azioni</td>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->label }}</td>

                        <td>{{ $category->color }}</td>

                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td class="d-flex">
                            <a class="btn btn-sm btn-primary mx-2" href="{{ route('admin.categories.show', $category) }}">
                                <i class="fa-solid fa-eye mr-2"></i> Vedi
                            </a>
                            <a class="btn btn-sm btn-warning mx-2" href="{{ route('admin.categories.edit', $category) }}">
                                <i class="fa-solid fa-pencil mr-2"></i> Modifica
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                class="delete-form">
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
                        <td colspan="7">
                            <h3 class="text-center">Nessuna categoria</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <nav class="mt-3">
            @if ($categories->hasPages())
                {{ $categories->links() }}
            @endif

        </nav>
    </div>
@endsection
