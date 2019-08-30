@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.customers')] )

@section('content')

    @include('laracms.dashboard::partials.search')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('laracms::admin.menu.customers') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (count($customers))
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('aracms::admin.login') }}</th>
                                            <th>{{ __('aracms::admin.full_name') }}</th>
                                            <th>{{ __('aracms::admin.email') }}</th>
                                            <th>{{ __('aracms::admin.orders') }}</th>
                                            <th>{{ __('aracms::admin.reviews') }}</th>
                                            <th>{{ __('aracms::admin.blocked') }}</th>
                                            <th>{{ __('aracms::admin.created_at') }}</th>
                                            <th>{{ __('laracms::admin.actions') }}</th>
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
                                            <td>{{ $customer->blocked()->count() ? __('laracms::admin.yes') : __('laracms::admin.no') }}</td>
                                            <td>{{ $customer->created_at }}</td>
                                            <td class="text-right">
                                                <a title="{{ __('laracms::admin.edit') }}"
                                                   href="{{ route('laracms.customers.edit', $customer->id) }}"
                                                   rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="{{ __('laracms::admin.delete') }}"
                                                   onclick="return confirmDelete('{{ route('laracms.customers.destroy', $customer->id) }}');"
                                                   href="javascript:void(0);" type="button"
                                                   rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $customers->links() }}
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
