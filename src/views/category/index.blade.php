@extends('laracms.dashboard::layouts.app', ['page' => __('admin.menu.categories')])

@section('content')
    <div class="form-group">
        <a class="btn btn-success" href="{{ route('laracms.categories.create') }}">
            {{ __('texts.create') }}
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ __('texts.name') }}</th>
                <th>{{ __('texts.parent') }}</th>
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
                        <a href="{{ route('laracms.categories.edit', $category->id) }}">{{ __('texts.edit') }}</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.categories.destroy', $category->id) }}">{{ __('texts.delete') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
