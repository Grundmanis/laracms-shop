<div class="form-group row">
    <label for="delivery" class="col-md-4 col-form-label text-md-right">{{ __('form.delivery') }}</label>
    <div class="col-md-6">
        <select name="delivery" id="delivery" class="form-control">
            <option @if(isset($user) && $user->delivery == 'in_office') selected @endif value="in_office">{{ __('form.in_office') }}</option>
            <option @if(isset($user) && $user->delivery == 'courier_riga') selected @endif value="courier_riga">{{ __('form.courier_riga') }}</option>
            <option @if(isset($user) && $user->delivery == 'courier_latvia') selected @endif value="courier_latvia">{{ __('form.courier_latvia') }}</option>
            <option @if(isset($user) && $user->delivery == 'pakomat') selected @endif value="pakomat">{{ __('form.pakomat') }}</option>
            <option @if(isset($user) && $user->delivery == 'post') selected @endif value="post">{{ __('form.post') }}</option>
        </select>
        <small>{{ __('form.hints.delivery') }}</small>
        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>
        {{--@if(empty($buyer))--}}
        {{--<input name="delivery[in_office][price]"--}}
        {{--value="{{ old('delivery.in_office.price', isset($deliveries['in_office']) ? $deliveries['in_office']->price : '') }}"--}}
        {{--class="form-control" type="text" placeholder="{{ __('texts.price') }}">--}}
        {{--@endif--}}
    </div>
</div>