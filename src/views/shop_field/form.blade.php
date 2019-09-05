@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.shop-fields')] )

@section('content')
    <form method="post">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('laracms::admin.menu.category') }}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="not_editable" checked value="0">
                            <input type="checkbox" name="not_editable"
                                   {{ old('not_editable', isset($field) ? $field->not_editable : '') ? 'checked' : '' }}
                                   value="1"> {{ __('texts.not_editable') }}
                        </label>
                    </div>
                </div>
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul id="tabs" class="nav nav-tabs" role="tablist">
                            @foreach($locales as $key => $locale)
                                <li class="nav-item">
                                    <a class="nav-link @if(!$key) active @endif" data-toggle="tab" href="#{{ $locale }}"
                                       role="tab" aria-expanded="true">{{ $locale }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="my-tab-content" class="tab-content text-center">
                    @foreach($locales as $key => $locale)
                        <div class="tab-pane @if(!$key) active @endif" id="{{ $locale }}" role="tabpanel"
                             aria-expanded="true">
                            <div class="form-group">
                                <label for="">{{ __('laracms::admin.name') }}</label>
                                <input class="form-control" name="{{ $locale }}[name]" value="{{ formValue($field ?? null, 'name', $locale) }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('texts.save') }}</button>
    </form>
@endsection
