@extends('layouts.default')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Categories</h1>
            <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                @csrf
                @method('put')
                @include('admins.categories.includes.fields', ['category' => $category])
            </form>
        </div>
    </main>
@endsection