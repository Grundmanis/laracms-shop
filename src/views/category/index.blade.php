@extends('laracms.dashboard::layouts.app', ['page' => 'Categories'])

@section('content')
    <div class="form-group">
        <a class="btn btn-success" href="{{ route('laracms.categories.create') }}">Create</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Parent</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parentCategory ? $category->parentCategory->name : '-' }}</td>
                    <td>
                        <a href="{{ route('laracms.categories.edit', $category->id) }}">Edit</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.categories.destroy', $category->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
