{{-- Master Layout --}}
@extends('cortex/foundation::adminarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ extract_title(Breadcrumbs::render()) }}
@endsection

@push('inline-scripts')
    {!! JsValidator::formRequest(Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest::class)->selector("#adminarea-categories-create-form, #adminarea-categories-{$category->getRouteKey()}-update-form")->ignore('.skip-validation') !!}
@endpush

{{-- Main Content --}}
@section('content')

    @includeWhen($category->exists, 'cortex/foundation::common.partials.modal', ['id' => 'delete-confirmation'])

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ Breadcrumbs::render() }}</h1>
        </section>

        {{-- Main content --}}
        <section class="content">

            <div class="nav-tabs-custom">
                @if($category->exists && $currentUser->can('delete', $category))
                    <div class="pull-right">
                        <a href="#" data-toggle="modal" data-target="#delete-confirmation"
                           data-modal-action="{{ route('adminarea.categories.destroy', ['category' => $category]) }}"
                           data-modal-title="{!! trans('cortex/foundation::messages.delete_confirmation_title') !!}"
                           data-modal-button="<a href='#' class='btn btn-danger' data-form='delete' data-token='{{ csrf_token() }}'><i class='fa fa-trash-o'></i> {{ trans('cortex/foundation::common.delete') }}</a>"
                           data-modal-body="{!! trans('cortex/foundation::messages.delete_confirmation_body', ['resource' => trans('cortex/categories::common.category'), 'identifier' => $category->name]) !!}"
                           title="{{ trans('cortex/foundation::common.delete') }}" class="btn btn-default" style="margin: 4px"><i class="fa fa-trash text-danger"></i>
                        </a>
                    </div>
                @endif
                {!! Menu::render('adminarea.categories.tabs', 'nav-tab') !!}

                <div class="tab-content">

                    <div class="tab-pane active" id="details-tab">

                        @if ($category->exists)
                            {{ Form::model($category, ['url' => route('adminarea.categories.update', ['category' => $category]), 'method' => 'put', 'id' => "adminarea-categories-{$category->getRouteKey()}-update-form"]) }}
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
                                        {{ Form::textarea('description', null, ['class' => 'form-control tinymce', 'placeholder' => trans('cortex/categories::common.description'), 'rows' => 3]) }}

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

                </div>

            </div>

        </section>

    </div>

@endsection
