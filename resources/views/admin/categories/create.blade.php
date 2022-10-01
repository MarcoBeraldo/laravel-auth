@extends('layouts.app')

@section('content')
    <header>
        <h1>Crea Categoria</h1>
    </header>
    <hr>
    <div class="container">

        @include('includes.admin.categories.form')
    </div>
@endsection
