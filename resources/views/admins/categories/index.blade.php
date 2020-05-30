@extends('layouts.default')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Categories</h1>
            @include('admins.categories.includes.table', ['categories' => $categories])
        </div>
    </main>
@endsection