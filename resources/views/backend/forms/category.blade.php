{{-- Master Layout --}}
@extends('cortex/foundation::backend.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ config('app.name') }} » {{ trans('cortex/foundation::common.backend') }} » {{ trans('cortex/categorizable::common.categories') }} » {{ $category->exists ? $category->slug : trans('cortex/categorizable::common.create_category') }}
@stop

@push('scripts')
    {!! JsValidator::formRequest(Cortex\Categorizable\Http\Requests\Backend\CategoryFormRequest::class)->selector('#backend-categories-save') !!}
@endpush

{{-- Main Content --}}
@section('content')

    @if($category->exists)
        @include('cortex/foundation::backend.partials.confirm-deletion', ['type' => 'category'])
    @endif

    <div class="content-wrapper">
        <!-- Breadcrumbs -->
        <section class="content-header">
            <h1>{{ $category->exists ? $category->slug : trans('cortex/categorizable::common.create_category') }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.home') }}"><i class="fa fa-dashboard"></i> {{ trans('cortex/foundation::common.backend') }}</a></li>
                <li><a href="{{ route('backend.categories.index') }}">{{ trans('cortex/categorizable::common.categories') }}</a></li>
                <li class="active">{{ $category->exists ? $category->slug : trans('cortex/categorizable::common.create_category') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details-tab" data-toggle="tab">{{ trans('cortex/categorizable::common.details') }}</a></li>
                    @if($category->exists) <li><a href="{{ route('backend.categories.logs', ['category' => $category]) }}">{{ trans('cortex/categorizable::common.logs') }}</a></li> @endif
                    @if($category->exists && $currentUser->can('delete-categories', $category)) <li class="pull-right"><a href="#" data-toggle="modal" data-target="#delete-confirmation" data-item-href="{{ route('backend.categories.delete', ['category' => $category]) }}" data-item-name="{{ $category->slug }}"><i class="fa fa-trash text-danger"></i></a></li> @endif
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="details-tab">

                        @if ($category->exists)
                            {{ Form::model($category, ['url' => route('backend.categories.update', ['category' => $category]), 'method' => 'put', 'id' => 'backend-categories-save']) }}
                        @else
                            {{ Form::model($category, ['url' => route('backend.categories.store'), 'id' => 'backend-categories-save']) }}
                        @endif

                            <div class="row">

                                <div class="col-md-6">

                                    {{-- Name --}}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {{ Form::label('name', trans('cortex/categorizable::common.name'), ['class' => 'control-label']) }}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categorizable::common.name'), 'data-slugify' => '#slug', 'required' => 'required', 'autofocus' => 'autofocus']) }}

                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    {{-- Slug --}}
                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                        {{ Form::label('slug', trans('cortex/categorizable::common.slug'), ['class' => 'control-label']) }}
                                        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categorizable::common.slug'), 'required' => 'required']) }}

                                        @if ($errors->has('slug'))
                                            <span class="help-block">{{ $errors->first('slug') }}</span>
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12">

                                    {{-- Description --}}
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        {{ Form::label('description', trans('cortex/categorizable::common.description'), ['class' => 'control-label']) }}
                                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categorizable::common.description'), 'rows' => 3]) }}

                                        @if ($errors->has('description'))
                                            <span class="help-block">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="pull-right">
                                        {{ Form::button(trans('cortex/categorizable::common.reset'), ['class' => 'btn btn-default btn-flat', 'type' => 'reset']) }}
                                        {{ Form::button(trans('cortex/categorizable::common.submit'), ['class' => 'btn btn-primary btn-flat', 'type' => 'submit']) }}
                                    </div>

                                    @include('cortex/foundation::backend.partials.timestamps', ['model' => $category])

                                </div>

                            </div>

                        {{ Form::close() }}

                    </div>

                </div>

            </div>


        </section>

    </div>

@endsection
