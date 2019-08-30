@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.shops')] )

@section('content')

    @include('laracms.dashboard::partials.search')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('laracms::admin.menu.shops') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (count($shops))
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('laracms::admin.blocked') }}</th>
                                            <th>{{ __('laracms::admin.sandbox') }}</th>
                                            <th>{{ __('laracms::admin.name') }}</th>
                                            <th>{{ __('laracms::admin.owner') }}</th>
                                            <th>{{ __('laracms::admin.products') }}</th>
                                            <th>{{ __('laracms::admin.created_at') }}</th>
                                            <th>{{ __('laracms::admin.actions') }}</th>
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
                                            <td class="text-right">
                                                <a title="{{ __('laracms::admin.edit') }}"
                                                   href="{{ route('laracms.shops.edit', $shop->id) }}"
                                                   rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="{{ __('laracms::admin.delete') }}"
                                                   onclick="return confirmDelete('{{ route('laracms.shops.destroy', $shop->id) }}');"
                                                   href="javascript:void(0);" type="button"
                                                   rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $shops->links() }}
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
