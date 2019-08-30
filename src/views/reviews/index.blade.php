@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.reviews')] )

@section('content')

    @include('laracms.dashboard::partials.search')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('laracms::admin.menu.reviews') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('texts.comment') }}</th>
                                    <th>{{ __('texts.user') }}</th>
                                    <th>{{ __('texts.model') }}</th>
                                    <th>{{ __('texts.created_at') }}</th>
                                    <th class="text-right">{{ __('laracms::admin.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reviews as $review)
                                    @continue(!$review->reviewable)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->text }}</td>
                                        <td>
                                            <a href="{{ route('laracms.customers.edit', $review->user_id) }}">
                                                {{ $review->user->full_name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($review->reviewable->shop_id)
                                                <a target="_blank" href="{{ route('product.show', [
                                $review->reviewable->shop->slug,
                                $review->reviewable->id,
                                $review->reviewable->name
                            ]) }}">
                                                    Product: {{ $review->reviewable->name }}
                                                </a>
                                            @else
                                                <a target="_blank" href="{{ route('shop', $review->reviewable->slug) }}">
                                                    {{ __('texts.shop') }}: {{ $review->reviewable->name }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $review->created_at }}</td>
                                        <td class="text-right">

                                            <a title="{{ __('laracms::admin.edit') }}"
                                               href="{{ route('laracms.reviews.edit', $review->id) }}" type="button"
                                               rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a title="{{ __('laracms::admin.delete') }}"
                                               onclick="return confirmDelete('{{ route('laracms.reviews.destroy', $review->id) }}');"
                                               href="javascript:void(0);"
                                               type="button"
                                               rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
