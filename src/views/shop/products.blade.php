@extends('laracms.dashboard::layouts.app', ['page' => __('texts.products')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            @include('laracms.dashboard::partials.search')

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('texts.name') }}</th>
                            <th>{{ __('texts.price') }}</th>
                            <th>{{ __('texts.category') }}</th>
                            <th>{{ __('texts.show') }}</th>
                            <th>{{ __('texts.created_at') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category }}</td>
                                <td><a target="_blank" href="{{ $product->getLink() }}">{{ __('texts.open_in_shop') }}</a></td>
                                <td>{{ $product->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
