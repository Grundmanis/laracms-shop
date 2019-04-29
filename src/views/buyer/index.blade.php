@extends('laracms.dashboard::layouts.app', ['page' => __('admin.menu.customers')])

@section('content')
    @include('laracms.dashboard::partials.search')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('texts.login') }}</th>
                    <th>{{ __('texts.full_name') }}</th>
                    <th>{{ __('texts.email') }}</th>
                    <th>{{ __('texts.orders') }}</th>
                    <th>{{ __('texts.reviews') }}</th>
                    <th>{{ __('texts.blocked') }}</th>
                    <th>{{ __('texts.created_at') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->orders()->count() }}</td>
                    <td>{{ $customer->reviews()->count() }}</td>
                    <td>{{ $customer->blocked()->count() ? 'Да' : 'Нет' }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>
                        <a href="{{ route('laracms.customers.edit', $customer->id) }}">{{ __('texts.edit') }}</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.customers.destroy', $customer->id) }}">{{ __('texts.delete') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $customers->links() }}
    </div>
@endsection
