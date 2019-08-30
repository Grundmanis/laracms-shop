@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.content')] )

@section('content')
    <form method="post">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('laracms::admin.menu.category') }}</h4>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="parent_category_id">{{ __('texts.parent_category') }}</label>
                    <select class="form-control" name="parent_category_id" id="parent_category_id">
                        <option value="">-</option>
                        @foreach($categories as $parentCategory)
                            @continue(isset($category) && $category->id == $parentCategory->id )
                            <option @if(isset($category) && $category->parent_category_id == $parentCategory->id) selected @endif value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
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
                                <textarea class="form-control" name="{{ $locale }}[name]">{{ formValue($category ?? null, 'name', $locale) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('laracms::admin.save') }}</button>

    </form>
@endsection
