@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.banners')] )

@section('content')
    <form enctype="multipart/form-data" method="post">
        <div class="card">
            <div class="card-body">

                @include('partials.shop.register_form', ['profile' => true])

            </div>
            <div class="col-md-12">
                <div class="form-group mb-0">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ __('laracms::admin.update') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <h3>Reviews</h3>
    <div class="card">
        <div class="card-body">
            @include(view()->exists('laracms.shop.partials.user_comments') ? 'laracms.shop.partials.user_comments' : 'laracms.shop::partials.user_comments')
        </div>
    </div>
@endsection
