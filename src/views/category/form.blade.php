@extends('laracms.dashboard::layouts.app')

@include('laracms.dashboard::partials.summernote')

@section('content')
    <form method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="parent_category_id">Parent Category</label>
            <select class="form-control" name="parent_category_id" id="parent_category_id">
                <option value="">-</option>
                @foreach($categories as $parentCategory)
                    @continue(isset($category) && $category->id == $parentCategory->id )
                    <option @if(isset($category) && $category->parent_category_id == $parentCategory->id) selected @endif value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                @endforeach
            </select>
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
                        <textarea class="form-control" name="{{ $locale }}[name]">{{ formValue($category ?? null, 'name', $locale) }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
