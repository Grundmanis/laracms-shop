@extends('laracms.dashboard::layouts.app', ['page' => 'Buyers'])

@section('content')
    @include('laracms.dashboard::partials.search')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>E-mail</th>
                    <th>Full name</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>
                        <a href="{{ route('laracms.customers.edit', $customer->id) }}">Edit</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.customers.destroy', $customer->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $customers->links() }}
    </div>
@endsection
