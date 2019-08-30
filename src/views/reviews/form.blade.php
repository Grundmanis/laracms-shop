@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.reviews')] )

@section('content')
    <form enctype="multipart/form-data" method="POST">
        @csrf


        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('laracms::admin.menu.reviews') }}</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('form.text') }}</label>
                    <div class="col-md-6">
                        <textarea name="text" id="" cols="30" rows="10" class="form-control">{{ old('text', $review->text) }}</textarea>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('menu.update_comment') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
