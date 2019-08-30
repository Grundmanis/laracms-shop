@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.categories')] )

@section('content')
    <div class="form-group">
        <a class="btn btn-success" href="{{ route('laracms.categories.create') }}">
            {{ __('laracms::admin.create') }}
        </a>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('laracms::admin.menu.categories') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (count($categories))
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('texts.name') }}</th>
                                        <th>{{ __('texts.parent') }}</th>
                                        <th class="text-right">{{ __('laracms::admin.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->parentCategory ? $category->parentCategory->name : '-' }}</td>
                                            <td class="text-right">

                                                <a title="{{ __('laracms::admin.edit') }}"
                                                   href="{{ route('laracms.categories.edit', $category->id) }}" type="button"
                                                   rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="{{ __('laracms::admin.delete') }}"
                                                   onclick="return confirmDelete('{{ route('laracms.categories.destroy', $category->id) }}');"
                                                   href="javascript:void(0);"
                                                   type="button"
                                                   rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $categories->links() }}
                            </div>
                        @else
                            <blockquote>
                                <p class="blockquote blockquote-primary">
                                    {{ __('laracms::admin.no_records') }}
                                </p>
                            </blockquote>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
