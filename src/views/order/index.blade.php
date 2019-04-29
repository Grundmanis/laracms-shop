@extends('laracms.dashboard::layouts.app', ['page' => __('admin.menu.orders')])

@section('content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('form.login') }}</th>
                    <th>{{ __('form.full_name') }}</th>
                    <th>{{ __('form.shop') }}</th>
                    <th>{{ __('texts.amount') }}</th>
                    <th>{{ __('form.delivery') }}</th>
                    <th>{{ __('texts.show') }}</th>
                    <th>{{ __('texts.created_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->first_name }}</td>
                        <td>
                            <a href="{{ route('laracms.customers.edit', $order->user_id) }}">
                                {{ $order->user->full_name }}
                            </a>
                        </td>
                        <td>{{ $order->shop->name }}</td>
                        <td>{{ $order->amount }} EUR </td>
                        <td>{{ $order->delivery }}</td>
                        <td><a href="{{ route('laracms.orders.items', $order->id) }}">{{ __('texts.see_products') }}</a></td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
