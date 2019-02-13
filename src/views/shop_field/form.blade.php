@extends('laracms.dashboard::layouts.app', ['page' => 'Shop fields'])

@include('laracms.dashboard::partials.summernote')

@section('content')
    <form method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="hidden" name="not_editable" checked value="0">
                    <input type="checkbox" name="not_editable"
                           {{ old('not_editable', isset($field) ? $field->not_editable : '') ? 'checked' : '' }}
                           value="1"> Not editable
                </label>
            </div>
        </div>

        <!-- Nav tabs -->
        <div class="form-group">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($locales as $key => $locale)
                    <li role="presentation" @if(!$key) class="active" @endif>
                        <a href="#{{ $locale }}" data-toggle="tab">
                            {{ $locale }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <label title="name">Name</label>

            @foreach($locales as $key => $locale)
                <div class="tab-pane @if(!$key) active @endif" id="{{ $locale }}">
                    <div class="form-group">
                        <input class="form-control" name="{{ $locale }}[name]" value="{{ formValue($field ?? null, 'name', $locale) }}">
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
