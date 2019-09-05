@extends('laracms.dashboard::layouts.app', ['page' => 'Orders'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <form enctype="multipart/form-data" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <h3>Info</h3>
                        <div class="form-group row">
                            <label for="blocked" class="col-md-4 col-form-label text-md-right">{{ __('form.blocked') }}</label>

                            <div class="col-md-6">
                                <input id="blocked" type="checkbox" name="blocked" value="1" @if($shop->blocked ?: old('blocked')) checked @endif autofocus>
                                <input type="text" name="blocked_reason" value="{{ $shop->blocked ? $shop->blocked->reason : old('blocked_reason') }}">
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
                                <small>{{ __('form.xml_hint') }}</small>

                            </div>
                        </div>
                        @include('partials.shop.info')
                    </div>
                    <div class="col-md-6">
                        <h3>Delivery</h3>
                        @include('partials.shop.delivery')
                        <h3>Payment</h3>
                        @include('partials.shop.payment')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <h3>Worktime</h3>
                        @include('partials.shop.worktime')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('laracms::admin.update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="row">
                <div class="col-md-12">
                    <h3>Reviews</h3>
                    @include('partials.shop_comments')
                </div>
            </div>
        </div>
    </div>
@endsection
