@extends('laracms.dashboard::layouts.app', ['page' => 'Buyers'])

@section('content')
    @include('laracms.dashboard::partials.search')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>email</th>
                    <th>first name</th>
                    <th>created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($buyers as $buyer)
                <tr>
                    <td>{{ $buyer->id }}</td>
                    <td>{{ $buyer->email }}</td>
                    <td>{{ $buyer->first_name }}</td>
                    <td>
                        <a href="{{ route('laracms.buyers.edit', $buyer->id) }}">Edit</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.buyers.destroy', $buyer->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $buyers->links() }}
    </div>
@endsection
