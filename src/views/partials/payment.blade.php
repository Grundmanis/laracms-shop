<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-12">
                <input id="riga_cash" value="1" @if(old('payment.riga_cash', isset($payments['riga_cash']))) checked @endif type="checkbox" name="payment[riga_cash]">
                <label for="riga_cash" class="col-form-label text-md-right">{{ __('form.riga_cash') }}</label>
            </div>
        </div><div class="form-group row">
            <div class="col-md-12">
                <input id="latvija_cash" value="1" @if(old('payment.latvija_cash', isset($payments['latvija_cash']))) checked @endif type="checkbox" name="payment[latvija_cash]">
                <label for="latvija_cash" class="col-form-label text-md-right">{{ __('form.latvija_cash') }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <input id="card_riga" value="1" @if(old('payment.card_riga', isset($payments['card_riga']))) checked @endif type="checkbox" name="payment[card_riga]">
                <label for="card_riga" class="col-form-label text-md-right">{{ __('form.card_riga') }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <input id="card_latvija" value="1" @if(old('payment.card_latvija', isset($payments['card_latvija']))) checked @endif type="checkbox" name="payment[card_latvija]">
                <label for="card_latvija" class="col-form-label text-md-right">{{ __('form.card_latvija') }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <input id="transaction_riga" value="1" @if(old('payment.transaction_riga', isset($payments['transaction_riga']))) checked @endif type="checkbox" name="payment[transaction_riga]">
                <label for="transaction_riga" class="col-form-label text-md-right">{{ __('form.transaction_riga') }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <input id="transaction_latvija" value="1" @if(old('payment.transaction_latvija', isset($payments['transaction_latvija']))) checked @endif type="checkbox" name="payment[transaction_latvija]">
                <label for="transaction_latvija" class="col-form-label text-md-right">{{ __('form.transaction_latvija') }}</label>
            </div>
        </div>
    </div>
</div>