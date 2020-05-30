<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Category ID</th>
                <th>Name</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>
                    <a href="{{ route('admin.category.create') }}">+ New</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr id="tr{{  $category->id }}">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}">Edit</a>
                        <a class="action-category-deletion" href="javascript:void(0)" data-id="{{  $category->id }}" data-url="{{ route('admin.category.deleteAjax', $category->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pagination">
    {{ $categories->links() }}
</div>