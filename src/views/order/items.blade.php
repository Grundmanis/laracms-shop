@extends('laracms.dashboard::layouts.app', ['page' => 'Ordered items'])

@section('content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('texts.products') }}</th>
                    <th>{{ __('texts.qty') }}</th>
                    <th>{{ __('texts.price') }}</th>
                    <th>{{ __('texts.total') }}</th>
                    <th>{{ __('texts.created_at') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a target="_blank" href="{{ route('product.show', [$item->product->shop->slug, $item->product_id, $item->product->name]) }}">{{ $item->product->name }}</a></td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->price }} &euro;</td>
                        <td>{{ $item->qty * $item->price }} &euro;</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
