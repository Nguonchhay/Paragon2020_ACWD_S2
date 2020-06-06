<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Category Name</th>
                <th>Title</th>
                <th>Author</th>
                <th>Creator Name</th>
                <th>
                    <a href="{{ route('admin.post.create') }}">+ New</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if($post->category)
                            {{ $post->category->name }}
                        @endif
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->author }}</td>
                    <td>{{ $post->creator->name }}</td>
                    <td>
                        <a href="{{ route('admin.post.show', $post->id) }}">Show</a> |
                        <a href="{{ route('admin.post.edit', $post->id) }}">Edit</a> |
                        @if(empty($post->category))
                            <a href="#">Reasign Category</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pagination">
    {{ $posts->links() }}
</div>