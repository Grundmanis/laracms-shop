@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.shops')] )

@section('content')
    <form enctype="multipart/form-data" method="POST">
        @csrf

        <div class="row no-styled-checkboxes">
            <div class="col-md-6">
                <h3>{{ __('texts.info') }}</h3>
                <div class="form-group row">
                    <label for="blocked" class="col-md-4 col-form-label text-md-right">{{ __('form.blocked') }}</label>

                    <div class="col-md-6">
                        <input id="blocked" type="checkbox" name="blocked" value="1" @if($shop->blocked ?: old('blocked')) checked @endif autofocus>
                        <input class="form-control" placeholder="{{ __('form.block_reason') }}" type="text" name="blocked_reason" value="{{ $shop->blocked ? $shop->blocked->reason : old('blocked_reason') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sandbox" class="col-md-4 col-form-label text-md-right">{{ __('form.sandbox') }}</label>

                    <div class="col-md-6">
                        <input id="sandbox" type="checkbox" name="sandbox" value="1" @if($shop->sandbox ?: old('sandbox')) checked @endif autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="xml" class="col-md-4 col-form-label text-md-right">{{ __('form.xml') }}</label>
                    <div class="col-md-6 form-inline">
                        <input id="xml" type="text" class="form-control{{ $errors->has('xml') ? ' is-invalid' : '' }}" name="xml"
                               value="{{ old('xml', $shop->xml) }}" autofocus>
                        <br>
                        <small>
                        @if($shop->xml_updated_at)
                            {{ __('texts.last_update') }} {{ $shop->xml_updated_at }}
                        @else
                            {{ __('texts.wasnt_updated_yet') }}
                        @endif
                        </small>

                    </div>
                </div>
                @include(view()->exists('laracms.shop.partials.info') ? 'laracms.shop.partials.info' : 'laracms.shop::partials.info', ['admin' => true])
            </div>
            <div class="col-md-6">
                <h3>{{ __('texts.delivery') }}</h3>
                @include(view()->exists('laracms.shop.partials.delivery') ? 'laracms.shop.partials.delivery' : 'laracms.shop::partials.delivery')
                <h3>{{ __('texts.payment') }}</h3>
                @include(view()->exists('laracms.shop.partials.payment') ? 'laracms.shop.partials.payment' : 'laracms.shop::partials.payment')
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <h3>{{ __('texts.worktime') }}</h3>
                @include(view()->exists('laracms.shop.partials.worktime') ? 'laracms.shop.partials.worktime' : 'laracms.shop::partials.worktime')
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('menu.update_shop') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <div class="row">
        <div class="col-md-12">
            <h3>{{ __('texts.reviews') }}</h3>
            @include(view()->exists('laracms.shop.partials.shop_comments') ? 'laracms.shop.partials.shop_comments' : 'laracms.shop::partials.shop_comments')
        </div>
    </div>
@endsection
