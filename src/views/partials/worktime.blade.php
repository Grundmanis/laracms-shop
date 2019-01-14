<div class="form-group row">
    <label for="monday" class="col-md-4 col-form-label text-md-right">{{ __('form.monday') }}</label>
    <div class="col-md-6 form-inline">
        <input id="monday" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[monday][from]"
               value="{{ old('work_time.monday.from') }}" autofocus>
        - <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[monday][to]"
                 value="{{ old('work_time.monday.to') }}" autofocus>

        @if ($errors->has('work_time[monday][from]'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[monday][from]') }}</strong>
                                    </span>
        @endif
        @if ($errors->has('monday'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[monday][to]') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="tuesday" class="col-md-4 col-form-label text-md-right">{{ __('form.tuesday') }}</label>
    <div class="col-md-6 form-inline">
        <input id="tuesday" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[tuesday][from]"
               value="{{ old('work_time.tuesday.from') }}" autofocus>
        - <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[tuesday][to]"
                 value="{{ old('work_time.tuesday.to') }}" autofocus>

        @if ($errors->has('work_time[tuesday][from]'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[tuesday][from]') }}</strong>
                                    </span>
        @endif
        @if ($errors->has('tuesday'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[tuesday][to]') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="wednesday" class="col-md-4 col-form-label text-md-right">{{ __('form.wednesday') }}</label>
    <div class="col-md-6 form-inline">
        <input id="wednesday" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[wednesday][from]"
               value="{{ old('work_time.wednesday.from') }}" autofocus>
        - <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[wednesday][to]"
                 value="{{ old('work_time.wednesday.to') }}" autofocus>

        @if ($errors->has('work_time[wednesday][from]'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[wednesday][from]') }}</strong>
                                    </span>
        @endif
        @if ($errors->has('wednesday'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[wednesday][to]') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="thursday" class="col-md-4 col-form-label text-md-right">{{ __('form.thursday') }}</label>
    <div class="col-md-6 form-inline">
        <input id="thursday" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[thursday][from]"
               value="{{ old('work_time.thursday.from') }}" autofocus>
        - <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[thursday][to]"
                 value="{{ old('work_time.thursday.to') }}" autofocus>

        @if ($errors->has('work_time[thursday][from]'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[thursday][from]') }}</strong>
                                    </span>
        @endif
        @if ($errors->has('thursday'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[thursday][to]') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="friday" class="col-md-4 col-form-label text-md-right">{{ __('form.friday') }}</label>
    <div class="col-md-6 form-inline">
        <input id="friday" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[friday][from]"
               value="{{ old('work_time.friday.from') }}" autofocus>
        - <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[friday][to]"
                 value="{{ old('work_time.friday.to') }}" autofocus>

        @if ($errors->has('work_time[friday][from]'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[friday][from]') }}</strong>
                                    </span>
        @endif
        @if ($errors->has('friday'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[friday][to]') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="saturday" class="col-md-4 col-form-label text-md-right">{{ __('form.saturday') }}</label>
    <div class="col-md-6 form-inline">
        <input id="saturday" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[saturday][from]"
               value="{{ old('work_time.saturday.from') }}" autofocus>
        - <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[saturday][to]"
                 value="{{ old('work_time.saturday.to') }}" autofocus>

        @if ($errors->has('work_time[saturday][from]'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[saturday][from]') }}</strong>
                                    </span>
        @endif
        @if ($errors->has('saturday'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[saturday][to]') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="sunday" class="col-md-4 col-form-label text-md-right">{{ __('form.sunday') }}</label>
    <div class="col-md-6 form-inline">
        <input id="sunday" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[sunday][from]"
               value="{{ old('work_time.sunday.from') }}" autofocus>
        - <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="work_time[sunday][to]"
                 value="{{ old('work_time.sunday.to') }}" autofocus>

        @if ($errors->has('work_time[sunday][from]'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[sunday][from]') }}</strong>
                                    </span>
        @endif
        @if ($errors->has('sunday'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('work_time[sunday][to]') }}</strong>
                                    </span>
        @endif
    </div>
</div>