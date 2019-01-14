<div class="form-group row">
    <label for="payment" class="col-md-4 col-form-label text-md-right">{{ __('form.payment') }}</label>
    <div class="col-md-6">
        <select name="payment" id="payment" class="form-control">
            <option @if(isset($user) && $user->payment == 'card') selected @endif value="card">{{ __('form.card') }}</option>
            <option @if(isset($user) && $user->payment == 'cash') selected @endif value="cash">{{ __('form.cash') }}</option>
            <option @if(isset($user) && $user->payment == 'transaction') selected @endif value="transaction">{{ __('form.transaction') }}</option>
            <option @if(isset($user) && $user->payment == 'paypal') selected @endif value="paypal">{{ __('form.paypal') }}</option>
        </select>
        <small>{{ __('form.hints.payment') }}</small>
        <small class="text-danger d-block">{{ __('form.hints.sees_only_shop') }}</small>
    </div>
</div>