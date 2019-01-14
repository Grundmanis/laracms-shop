@extends('laracms.dashboard::layouts.app', ['page' => 'Orders'])

@section('content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Show</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            <a href="{{ route('laracms.customers.edit', $order->user_id) }}">
                                {{ $order->user->full_name }}
                            </a>
                        </td>
                        <td>{{ $order->amount }}</td>
                        <td><a href="{{ route('laracms.orders.items', $order->id) }}">see products</a></td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
