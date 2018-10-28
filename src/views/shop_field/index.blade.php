@extends('laracms.dashboard::layouts.app', ['page' => 'Shop fields'])

@section('content')
    <div class="form-group">
        <a class="btn btn-success" href="{{ route('laracms.fields.create') }}">Create</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Editable</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($fields as $field)
                    <tr>
                        <td>{{ $field->id }}</td>
                        <td>{{ $field->name }}</td>
                        <td>{{ $field->not_editable ? 'No' : 'Yes' }}</td>
                        <td>
                            <a href="{{ route('laracms.fields.edit', $field->id) }}">Edit</a>
                            |
                            <a onclick="return confirm('Are you sure?')" href="{{ route('laracms.fields.destroy', $field->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $fields->links() }}
    </div>
@endsection
