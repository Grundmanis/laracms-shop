<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('form.shop_name') }} <span></span></label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
               value="{{ old('name', isset($shop) ? $shop->name : '') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('form.logo') }} <span></span></label>
    <div class="col-md-6">
        @if (isset($shop))
            <img src="{{ asset('logos/' . $shop->logo) }}" alt="">
        @endif
        <input id="logo"
               type="file"
               class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}"
               name="logo"
               value="{{ old('logo', isset($shop) ? $shop->logo : '') }}">
        @if ($errors->has('logo'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('logo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="reg_number" class="col-md-4 col-form-label text-md-right">{{ __('form.reg_number') }}
        <span></span></label>
    <div class="col-md-6">
        <input id="reg_number" type="text" class="form-control{{ $errors->has('reg_number') ? ' is-invalid' : '' }}"
               name="reg_number"
               value="{{ old('reg_number', isset($shop) ? $shop->reg_number : '') }}" required autofocus>

        @if ($errors->has('reg_number'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reg_number') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('form.phone') }} <span></span></label>
    <div class="col-md-6">
        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
               value="{{ old('phone', isset($shop) ? $shop->phone : '') }}" required autofocus>

        @if ($errors->has('phone'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="second_phone" class="col-md-4 col-form-label text-md-right">{{ __('form.second_phone') }}</label>
    <div class="col-md-6">
        <input id="second_phone" type="text" class="form-control{{ $errors->has('second_phone') ? ' is-invalid' : '' }}"
               name="second_phone"
               value="{{ old('second_phone', isset($shop) ? $shop->second_phone : '') }}" autofocus>

        @if ($errors->has('second_phone'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('second_phone') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="manager_phone" class="col-md-4 col-form-label text-md-right">{{ __('form.manager_phone') }}</label>
    <div class="col-md-6">
        <input id="manager_phone" type="text"
               class="form-control{{ $errors->has('manager_phone') ? ' is-invalid' : '' }}" name="manager_phone"
               value="{{ old('manager_phone', isset($shop) ? $shop->manager_phone : '') }}" autofocus>

        @if ($errors->has('manager_phone'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('manager_phone') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('form.email') }} <span></span></label>
    <div class="col-md-6">
        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
               value="{{ old('email', isset($shop) ? $shop->email : '') }}" required autofocus>

        @if ($errors->has('email'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="second_email" class="col-md-4 col-form-label text-md-right">{{ __('form.second_email') }}</label>
    <div class="col-md-6">
        <input id="second_email" type="text" class="form-control{{ $errors->has('second_email') ? ' is-invalid' : '' }}"
               name="second_email"
               value="{{ old('second_email', isset($shop) ? $shop->second_email : '') }}" autofocus>

        @if ($errors->has('second_email'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('second_email') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('form.address') }} <span></span></label>
    <div class="col-md-6">
        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
               name="address"
               value="{{ old('address', isset($shop) ? $shop->address : '') }}" required autofocus>

        @if ($errors->has('address'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
        @endif
    </div>
</div>

@foreach(\Grundmanis\Laracms\Modules\Shop\Models\ShopField::get() as $field)
    @continue(isset($shop) && $field->not_editable)
        <div class="form-group row">
            <label for="field_{{ $field->id }}" class="col-md-4 col-form-label text-md-right">{{ $field->name }} <span></span></label>
            <div class="col-md-6">
                <input id="field_{{ $field->id }}" required type="text" class="form-control"
                       name="fields[{{ $field->id }}]"
                       value="{{ old('fields.' . $field->id, isset($fieldValues) && isset($fieldValues[$field->id]) ? $fieldValues[$field->id]->value : '') }}">

                @if ($errors->has('fields.' . $field->id))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('fields.' . $field->id) }}</strong>
                    </span>
                @endif
            </div>
        </div>
@endforeach