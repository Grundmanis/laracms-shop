@extends('laracms.dashboard::layouts.app', ['page' => __('texts.shops')])

@section('content')

    @include('laracms.dashboard::partials.search')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('texts.blocked') }}</th>
                    <th>{{ __('texts.sandbox') }}</th>
                    <th>{{ __('texts.name') }}</th>
                    <th>{{ __('texts.owner') }}</th>
                    <th>{{ __('texts.products') }}</th>
                    <th>{{ __('texts.created_at') }}</th>
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
                    <td><a href="{{ route('laracms.customers.edit', $shop->user_id) }}">{{ $shop->user->full_name }}</a></td>
                    <td>
                        <a href="{{ route('laracms.shops.products', $shop->id) }}">
                            {{ $shop->products()->count() }}
                            ({{ __('texts.show') }})
                        </a>
                    </td>
                    <td>{{ $shop->created_at }}</td>
                    <td>
                        <a href="{{ route('laracms.shops.edit', $shop->id) }}">{{ __('texts.edit') }}</a>
                        |
                        <a onclick="return confirm('{{ __('texts.are_you_sure') }}')"
                           href="{{ route('laracms.shops.destroy', $shop->id) }}">{{ __('texts.delete') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $shops->links() }}
    </div>
@endsection
