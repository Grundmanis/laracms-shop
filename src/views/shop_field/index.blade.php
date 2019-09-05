@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.shop-fields')] )

@section('content')

    <div class="form-group">
        <a class="btn btn-success" href="{{ route('laracms.fields.create') }}">
            {{ __('laracms::admin.create') }}
        </a>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('laracms::admin.menu.shop-fields') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('texts.name') }}</th>
                                        <th>{{ __('texts.editable') }}</th>
                                        <th class="text-right">{{ __('laracms::admin.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($fields as $field)
                                    <tr>
                                        <td>{{ $field->id }}</td>
                                        <td>{{ $field->name }}</td>
                                        <td>{{ $field->not_editable ? 'No' : 'Yes' }}</td>
                                        <td class="text-right">

                                            <a title="{{ __('laracms::admin.edit') }}"
                                               href="{{ route('laracms.fields.edit', $field->id) }}" type="button"
                                               rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a title="{{ __('laracms::admin.delete') }}"
                                               onclick="return confirmDelete('{{ route('laracms.fields.destroy', $field->id) }}');"
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
                            {{ $fields->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
