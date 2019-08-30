@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.banners')] )

@section('content')
    <form enctype="multipart/form-data" method="post">
        @include(view()->exists('laracms.shop.partials.register_form') ? 'laracms.shop.partials.register_form' : 'laracms.shop::partials.register_form', ['profile' => true])
    </form>
    <h3>Reviews</h3>
    @include(view()->exists('laracms.shop.partials.user_comments') ? 'laracms.shop.partials.user_comments' : 'laracms.shop::partials.user_comments')
@endsection
