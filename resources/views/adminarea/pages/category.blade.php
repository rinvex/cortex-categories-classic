{{-- Master Layout --}}
@extends('cortex/foundation::adminarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ extract_title(Breadcrumbs::render()) }}
@endsection

@push('inline-scripts')
    {!! JsValidator::formRequest(Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest::class)->selector("#adminarea-cortex-categories-categories-create-form, #adminarea-cortex-categories-categories-{$category->getRouteKey()}-update-form")->ignore('.skip-validation') !!}
@endpush

{{-- Main Content --}}
@section('content')

    @includeWhen($category->exists, 'cortex/foundation::adminarea.partials.modal', ['id' => 'delete-confirmation'])

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ Breadcrumbs::render() }}</h1>
        </section>

        {{-- Main content --}}
        <section class="content">

            <div class="nav-tabs-custom">
                @includeWhen($category->exists, 'cortex/foundation::adminarea.partials.actions', ['name' => 'category', 'model' => $category, 'resource' => trans('cortex/categories::common.category'), 'routePrefix' => 'adminarea.cortex.categories.categories.'])
                {!! Menu::render('adminarea.cortex.categories.categories.tabs', 'nav-tab') !!}

                <div class="tab-content">

                    <div class="tab-pane active" id="details-tab">

                        @if ($category->exists)
                            {{ Form::model($category, ['url' => route('adminarea.cortex.categories.categories.update', ['category' => $category]), 'method' => 'put', 'id' => "adminarea-cortex-categories-categories-{$category->getRouteKey()}-update-form"]) }}
                        @else
                            {{ Form::model($category, ['url' => route('adminarea.cortex.categories.categories.store'), 'id' => 'adminarea-cortex-categories-categories-create-form']) }}
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
                                <div class="col-md-6">

                                    {{-- Category --}}
                                    <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                        {{ Form::label('parent_id', trans('cortex/categories::common.parent_category'), ['class' => 'control-label']) }}
                                        {{ Form::hidden('parent_id', '', ['class' => 'skip-validation']) }}
                                        {{ Form::select('parent_id', $ParentCategories, null, ['class' => 'form-control select2', 'data-width' => '100%', 'data-allow-clear' => 'true', 'placeholder' => trans('cortex/categories::common.parent_category')]) }}

                                        @if ($errors->has('parent_id'))
                                            <span class="help-block">{{ $errors->first('parent_id') }}</span>
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
