@extends('layouts.default')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">New Post</h1>
            <form action="{{ route('admin.post.store') }}" method="post">
                @csrf
                @include('admins.posts.includes.fields', ['categories' => $categories])
            </form>
        </div>
    </main>
@endsection