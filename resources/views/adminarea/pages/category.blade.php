{{-- Master Layout --}}
@extends('cortex/foundation::adminarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ config('app.name') }} » {{ trans('cortex/foundation::common.adminarea') }} » {{ trans('cortex/categories::common.categories') }} » {{ $category->exists ? $category->name : trans('cortex/categories::common.create_category') }}
@endsection

@push('inline-scripts')
    {!! JsValidator::formRequest(Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest::class)->selector("#adminarea-categories-create-form, #adminarea-categories-{$category->getKey()}-update-form") !!}
@endpush

{{-- Main Content --}}
@section('content')

    @if($category->exists)
        @include('cortex/foundation::common.partials.confirm-deletion')
    @endif

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ Breadcrumbs::render() }}</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="nav-tabs-custom">
                @if($category->exists && $currentUser->can('delete-categories', $category)) <div class="pull-right"><a href="#" data-toggle="modal" data-target="#delete-confirmation" data-modal-action="{{ route('adminarea.categories.delete', ['category' => $category]) }}" data-modal-title="{!! trans('cortex/foundation::messages.delete_confirmation_title') !!}" data-modal-body="{!! trans('cortex/foundation::messages.delete_confirmation_body', ['type' => 'category', 'name' => $category->slug]) !!}" title="{{ trans('cortex/foundation::common.delete') }}" class="btn btn-default" style="margin: 4px"><i class="fa fa-trash text-danger"></i></a></div> @endif
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details-tab" data-toggle="tab">{{ trans('cortex/categories::common.details') }}</a></li>
                    @if($category->exists) <li><a href="#logs-tab" data-toggle="tab">{{ trans('cortex/categories::common.logs') }}</a></li> @endif
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="details-tab">

                        @if ($category->exists)
                            {{ Form::model($category, ['url' => route('adminarea.categories.update', ['category' => $category]), 'method' => 'put', 'id' => "adminarea-categories-{$category->getKey()}-update-form"]) }}
                        @else
                            {{ Form::model($category, ['url' => route('adminarea.categories.store'), 'id' => 'adminarea-categories-create-form']) }}
                        @endif

                            <div class="row">

                                <div class="col-md-4">

                                    {{-- Name --}}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {{ Form::label('name', trans('cortex/categories::common.name'), ['class' => 'control-label']) }}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categories::common.name'), 'data-slugify' => '[name="slug"]', 'required' => 'required', 'autofocus' => 'autofocus']) }}

                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-4">

                                    {{-- Slug --}}
                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                        {{ Form::label('slug', trans('cortex/categories::common.slug'), ['class' => 'control-label']) }}
                                        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categories::common.slug'), 'required' => 'required']) }}

                                        @if ($errors->has('slug'))
                                            <span class="help-block">{{ $errors->first('slug') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-2">

                                    {{-- Style --}}
                                    <div class="form-group{{ $errors->has('style') ? ' has-error' : '' }}">
                                        {{ Form::label('style', trans('cortex/categories::common.style'), ['class' => 'control-label']) }}
                                        {{ Form::text('style', null, ['class' => 'form-control style-picker', 'placeholder' => trans('cortex/categories::common.style'), 'data-placement' => 'bottomRight', 'readonly' => 'readonly']) }}

                                        @if ($errors->has('style'))
                                            <span class="help-block">{{ $errors->first('style') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-2">

                                    {{-- Icon --}}
                                    <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                                        {{ Form::label('icon', trans('cortex/categories::common.icon'), ['class' => 'control-label']) }}

                                        <div class="input-group">
                                            {{ Form::text('icon', null, ['class' => 'form-control icon-picker', 'placeholder' => trans('cortex/categories::common.icon'), 'data-placement' => 'bottomRight', 'readonly' => 'readonly']) }}

                                            <div class="input-group-addon">
                                                <i style="width: 18px !important;"></i>
                                            </div>
                                        </div>

                                        @if ($errors->has('icon'))
                                            <span class="help-block">{{ $errors->first('icon') }}</span>
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12">

                                    {{-- Description --}}
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        {{ Form::label('description', trans('cortex/categories::common.description'), ['class' => 'control-label']) }}
                                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categories::common.description'), 'rows' => 3]) }}

                                        @if ($errors->has('description'))
                                            <span class="help-block">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="pull-right">
                                        {{ Form::button(trans('cortex/categories::common.submit'), ['class' => 'btn btn-primary btn-flat', 'type' => 'submit']) }}
                                    </div>

                                    @include('cortex/foundation::adminarea.partials.timestamps', ['model' => $category])

                                </div>

                            </div>

                        {{ Form::close() }}

                    </div>

                    @if($category->exists)

                        <div class="tab-pane" id="logs-tab">
                            {!! $logs->table(['class' => 'table table-striped table-hover responsive dataTableBuilder', 'id' => "adminarea-categories-{$category->getKey()}-logs-table"]) !!}
                        </div>

                    @endif

                </div>

            </div>


        </section>

    </div>

@endsection

@if($category->exists)

    @push('head-elements')
        <meta name="turbolinks-cache-control" content="no-cache">
    @endpush

    @push('styles')
        <link href="{{ mix('css/datatables.css', 'assets') }}" rel="stylesheet">
    @endpush

    @push('vendor-scripts')
        <script src="{{ mix('js/datatables.js', 'assets') }}" defer></script>
    @endpush

    @push('inline-scripts')
        {!! $logs->scripts() !!}
    @endpush

@endif
