@extends('laracms.dashboard::layouts.app', ['page' => 'Seller'])

@section('content')
    <form enctype="multipart/form-data" method="post">

        @include('partials.shop.register_form', ['profile' => true])

        <div class="form-group row">
            <label for="blocked" class="col-md-4 col-form-label text-md-right">{{ __('form.blocked') }}</label>

            <div class="col-md-6">
                <input id="blocked" type="checkbox" name="blocked" value="1" @if($user->blocked ?: old('blocked')) checked @endif autofocus>
                <input type="text" name="blocked_reason" value="{{ $user->blocked ? $user->blocked->reason : old('blocked_reason') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="blocked_reason" class="col-md-4 col-form-label text-md-right">{{ __('form.blocked_reason') }}</label>

            <div class="col-md-6">

                <div class="form-group">
                    <input class="form-control" id="blocked_reason" type="text" name="blocked_reason" value="{{ $user->blocked ? $user->blocked->reason : old('blocked_reason') }}">
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <h3>Reviews</h3>

    @include('partials.shop.user_comments')
@endsection
