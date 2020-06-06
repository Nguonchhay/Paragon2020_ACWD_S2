@extends('layouts.default')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Posts</h1>
            @include('admins.posts.includes.table', ['posts' => $posts])
        </div>
    </main>
@endsection