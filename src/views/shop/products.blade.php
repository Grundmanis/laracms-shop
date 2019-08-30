@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.shop_products')] )

@section('content')

    @include('laracms.dashboard::partials.search')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('laracms::admin.shop_products') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (count($products))
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('laracms::admin.name') }}</th>
                                        <th>{{ __('laracms::admin.price') }}</th>
                                        <th>{{ __('laracms::admin.category') }}</th>
                                        <th>{{ __('laracms::admin.show') }}</th>
                                        <th>{{ __('laracms::admin.created_at') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->category }}</td>
                                            <td>
                                                <a target="_blank"
                                                   href="{{ LaravelLocalization::getLocalizedURL(App::getLocale(), $product->getLink()) }}">
                                                    {{ __('texts.open_in_shop') }}
                                                </a>
                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links() }}
                            </div>
                        @else
                            <blockquote>
                                <p class="blockquote blockquote-primary">
                                    {{ __('laracms::admin.no_records') }}
                                </p>
                            </blockquote>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
