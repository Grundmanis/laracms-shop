@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.order_items')] )

@section('content')    <div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('laracms::admin.menu.orders') }}</h4>
                </div>
                <div class="card-body">
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a target="_blank" href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a></td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->price }} &euro;</td>
                                    <td>{{ $item->qty * $item->price }} &euro;</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
