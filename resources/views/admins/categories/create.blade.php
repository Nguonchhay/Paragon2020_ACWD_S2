@extends('layouts.default')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">New Category</h1>
            <form action="{{ route('admin.category.store') }}" method="post">
                @csrf
                @include('admins.categories.includes.fields')
            </form>
        </div>
    </main>
@endsection