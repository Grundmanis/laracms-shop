@extends('laracms.dashboard::layouts.app', ['page' => 'Sellers'])

@section('content')
    @include('laracms.dashboard::partials.search')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Blocked</th>
                    <th>email</th>
                    <th>first name</th>
                    <th>created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($sellers as $seller)
                <tr>
                    <td>{{ $seller->id }}</td>
                    <td>{{ $seller->blocked ? 'Yes' : 'No' }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->first_name }}</td>
                    <td>
                        <a href="{{ route('laracms.customers.edit', $seller->id) }}">Edit</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.customers.destroy', $seller->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $sellers->links() }}
    </div>
@endsection
