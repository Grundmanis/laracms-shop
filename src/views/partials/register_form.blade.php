@csrf

<div class="form-group row">
    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('form.avatar') }}</label>
    <div class="col-md-6">
        @if(isset($user) && $user->avatar)
            <div class="form-group">
                <img width="200" src="{{ $user->avatar }}" alt="">
            </div>
        @endif
        <input id="avatar"
               type="file"
               class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}"
               name="avatar"
               value="{{ old('avatar', isset($user) ? $user->avatar : '') }}">
            <small>{{ __('form.hints.avatar') }}</small>
        @if ($errors->has('avatar'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('avatar') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('form.first_name') }}</label>

    <div class="col-md-6">
        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name"
               value="{{ isset($user) ? $user->first_name : old('first_name') }}" required autofocus>

        <small>{{ __('form.hints.login') }}</small>
        @if ($errors->has('first_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('form.mail') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required>

        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('form.full_name') }}</label>

    <div class="col-md-6">
        <input id="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ isset($user) ? $user->full_name : old('full_name') }}" required>
        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>
        @if ($errors->has('full_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('full_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('form.phone') }}</label>

    <div class="col-md-6">
        <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
               value="{{ isset($user) ? $user->phone : old('phone') }}" required autofocus>
        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>

    @if ($errors->has('phone'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('form.address') }}</label>

    <div class="col-md-6">
        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
               value="{{ isset($user) ? $user->address : old('address') }}" required autofocus>
        <small>{{ __('form.hints.address') }}</small>
        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>

    @if ($errors->has('address'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('form.city') }}</label>

    <div class="col-md-6">
        <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city"
               value="{{ isset($user) ? $user->city : old('city') }}" required autofocus>
        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>

    @if ($errors->has('city'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>
</div>

@if (isset($user))
    @include('partials.shop.delivery', ['buyer' => true])
    @include('partials.shop.payment')
@endif

<div class="form-group row">
    <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('form.birthday') }}</label>

    <div class="col-md-6">
        <input id="birthday" type="text" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday"
               value="{{ isset($user) ? $user->birthday : old('birthday') }}" required autofocus>
        <small>{{ __('form.hints.birthday') }}</small>
        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>

        @if ($errors->has('birthday'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('birthday') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="nameday" class="col-md-4 col-form-label text-md-right">{{ __('form.nameday') }}</label>

    <div class="col-md-6">
        <input id="nameday" type="text" class="form-control{{ $errors->has('nameday') ? ' is-invalid' : '' }}" name="nameday"
               value="{{ isset($user) ? $user->nameday : old('nameday') }}" required autofocus>
        <small>{{ __('form.hints.nameday') }}</small>
        <small class="text[">{{ __('form.hints.sees_only_shop') }}</small>

        @if ($errors->has('nameday'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('nameday') }}</strong>
            </span>
        @endif
    </div>
</div>

@if (isset($user))
    <h3>{{ __('form.password_change') }}</h3>
@endif
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('form.password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  @if(!isset($profile)) required @endif>

        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('form.confirm_password') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(!isset($profile)) required @endif>
    </div>
</div>

@if (!isset($profile))
    <div class="form-group row">
        <label for="seller" class="col-md-4 col-form-label text-md-right">{{ __('form.seller') }}</label>

        <div class="col-md-6">
            <input id="seller" type="checkbox" name="seller" value="1" @if(isset($user) ? $user->seller : old('seller')) checked @endif autofocus>
        </div>
    </div>
@endif