@extends('laracms.dashboard::layouts.app', ['page' => 'Shops'])

@section('content')

    @include('laracms.dashboard::partials.search')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Blocked</th>
                    <th>Sandbox</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Products</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td>{{ $shop->blocked ? 'Yes' : 'No' }}</td>
                    <td>{{ $shop->sandbox ? 'Yes' : 'No' }}</td>
                    <td>{{ $shop->name }}</td>
                    <td><a href="{{ route('laracms.sellers.edit', $shop->user_id) }}">{{ $shop->user->fullName }}</a></td>
                    <td>
                        <a href="{{ route('laracms.shops.products', $shop->id) }}">
                            {{ $shop->products()->count() }}
                            (show)
                        </a>
                    </td>
                    <td>{{ $shop->created_at }}</td>
                    <td>
                        <a href="{{ route('laracms.shops.edit', $shop->id) }}">Edit</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.shops.destroy', $shop->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $shops->links() }}
    </div>
@endsection
