<p>
    {{ __('texts.set_0_if_delivery_for_free') }}
</p>
<br>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group row">
            <div class="col-md-12">
                <label for="in_office" class="col-form-label text-md-right">{{ __('form.in_office') }}</label>
                <input type="hidden" name="delivery[in_office][enabled]" value="0">
                <input id="in_office" value="1" @if(old('delivery.in_office', isset($deliveries['in_office']) && $deliveries['in_office']->enabled)) checked
                       @endif type="checkbox" name="delivery[in_office][enabled]"
                       autofocus>
                @if(empty($customer))
                    <input name="delivery[in_office][price]"
                           value="{{ old('delivery.in_office.price', isset($deliveries['in_office']) ? $deliveries['in_office']->price : '') }}"
                           class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label for="courier" class="col-form-label text-md-right">{{ __('form.courier') }}</label>
                <input type="hidden" name="delivery[courier][enabled]" value="0" checked>
                <input id="courier" value="1" @if(old('delivery.courier', isset($deliveries['courier']) && $deliveries['courier']->enabled)) checked
                       @endif type="checkbox" name="delivery[courier][enabled]"
                       autofocus>
                @if(empty($customer))
                    <input name="delivery[courier][price]"
                           value="{{ old('delivery.courier.price', isset($deliveries['courier']) ? $deliveries['courier']->price : '') }}"
                           class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label for="post" class="col-form-label text-md-right">{{ __('form.post') }}</label>
                <input type="hidden" name="delivery[post][enabled]" value="0" checked>
                <input id="post" value="1" @if(old('delivery.post', isset($deliveries['post']) && $deliveries['post']->enabled)) checked
                       @endif type="checkbox" name="delivery[post][enabled]"
                       autofocus>
                @if(empty($customer))
                    <input name="delivery[post][price]"
                           value="{{ old('delivery.post.price', isset($deliveries['post']) ? $deliveries['post']->price : '') }}"
                           class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label for="omniva" class="col-form-label text-md-right">{{ __('form.omniva') }}</label>
                <input type="hidden" name="delivery[omniva][enabled]" value="0" checked>
                <input id="omniva" value="1" @if(old('delivery.omniva', isset($deliveries['omniva']) && $deliveries['omniva']->enabled)) checked
                       @endif type="checkbox" name="delivery[omniva][enabled]"
                       autofocus>
                @if(empty($customer))
                    <input name="delivery[omniva][price]"
                           value="{{ old('delivery.omniva.price', isset($deliveries['omniva']) ? $deliveries['omniva']->price : '') }}"
                           class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label for="ps" class="col-form-label text-md-right">{{ __('form.ps') }}</label>
                <input type="hidden" name="delivery[ps][enabled]" value="0" checked>
                <input id="ps" value="1" @if(old('delivery.ps', isset($deliveries['ps']) && $deliveries['ps']->enabled)) checked
                       @endif type="checkbox" name="delivery[ps][enabled]"
                       autofocus>
                @if(empty($customer))
                    <input name="delivery[ps][price]"
                           value="{{ old('delivery.ps.price', isset($deliveries['ps']) ? $deliveries['ps']->price : '') }}"
                           class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                @endif
            </div>
        </div>
        @if (__('form.dpd') != '-')
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="dpd" class="col-form-label text-md-right">{{ __('form.dpd') }}</label>
                    <input type="hidden" name="delivery[dpd][enabled]" value="0" checked>
                    <input id="dpd" value="1" @if(old('delivery.dpd', isset($deliveries['dpd']) && $deliveries['dpd']->enabled)) checked
                           @endif type="checkbox" name="delivery[dpd][enabled]"
                           autofocus>
                    @if(empty($customer))
                        <input name="delivery[dpd][price]"
                               value="{{ old('delivery.dpd.price', isset($deliveries['dpd']) ? $deliveries['dpd']->price : '') }}"
                               class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                    @endif
                </div>
            </div>
        @endif
        @if (__('form.circle') != '-')
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="circle" class="col-form-label text-md-right">{{ __('form.circle') }}</label>
                    <input type="hidden" name="delivery[circle][enabled]" value="0" checked>
                    <input id="circle" value="1" @if(old('delivery.circle', isset($deliveries['circle']) && $deliveries['circle']->enabled)) checked
                           @endif type="checkbox" name="delivery[circle][enabled]"
                           autofocus>
                    @if(empty($customer))
                        <input name="delivery[circle][price]"
                               value="{{ old('delivery.circle.price', isset($deliveries['circle']) ? $deliveries['circle']->price : '') }}"
                               class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                    @endif
                </div>
            </div>
        @endif
        @if (__('form.cargo') != '-')
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="cargo" class="col-form-label text-md-right">{{ __('form.cargo') }}</label>
                    <input type="hidden" name="delivery[cargo][enabled]" value="0" checked>
                    <input id="cargo" value="1" @if(old('delivery.cargo', isset($deliveries['cargo']) && $deliveries['cargo']->enabled)) checked
                           @endif type="checkbox" name="delivery[cargo][enabled]"
                           autofocus>
                    @if(empty($customer))
                        <input name="delivery[cargo][price]"
                               value="{{ old('delivery.cargo.price', isset($deliveries['cargo']) ? $deliveries['cargo']->price : '') }}"
                               class="form-control" type="text" placeholder="{{ __('texts.price') }}">
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
