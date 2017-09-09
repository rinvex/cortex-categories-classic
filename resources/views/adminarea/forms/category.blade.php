{{-- Master Layout --}}
@extends('cortex/foundation::adminarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ config('app.name') }} » {{ trans('cortex/foundation::common.adminarea') }} » {{ trans('cortex/categories::common.categories') }} » {{ $category->exists ? $category->name : trans('cortex/categories::common.create_category') }}
@stop

@push('scripts')
    {!! JsValidator::formRequest(Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest::class)->selector('#adminarea-categories-save') !!}
@endpush

{{-- Main Content --}}
@section('content')

    @if($category->exists)
        @include('cortex/foundation::common.partials.confirm-deletion', ['type' => 'category'])
    @endif

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $category->exists ? $category->name : trans('cortex/categories::common.create_category') }}</h1>
            <!-- Breadcrumbs -->
            {{ Breadcrumbs::render() }}
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details-tab" data-toggle="tab">{{ trans('cortex/categories::common.details') }}</a></li>
                    @if($category->exists) <li><a href="{{ route('adminarea.categories.logs', ['category' => $category]) }}">{{ trans('cortex/categories::common.logs') }}</a></li> @endif
                    @if($category->exists && $currentUser->can('delete-categories', $category)) <li class="pull-right"><a href="#" data-toggle="modal" data-target="#delete-confirmation" data-item-href="{{ route('adminarea.categories.delete', ['category' => $category]) }}" data-item-name="{{ $category->slug }}"><i class="fa fa-trash text-danger"></i></a></li> @endif
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="details-tab">

                        @if ($category->exists)
                            {{ Form::model($category, ['url' => route('adminarea.categories.update', ['category' => $category]), 'method' => 'put', 'id' => 'adminarea-categories-save']) }}
                        @else
                            {{ Form::model($category, ['url' => route('adminarea.categories.store'), 'id' => 'adminarea-categories-save']) }}
                        @endif

                            <div class="row">

                                <div class="col-md-6">

                                    {{-- Name --}}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {{ Form::label('name', trans('cortex/categories::common.name'), ['class' => 'control-label']) }}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categories::common.name'), 'data-slugify' => '#slug', 'required' => 'required', 'autofocus' => 'autofocus']) }}

                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    {{-- Slug --}}
                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                        {{ Form::label('slug', trans('cortex/categories::common.slug'), ['class' => 'control-label']) }}
                                        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('cortex/categories::common.slug'), 'required' => 'required']) }}

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

                </div>

            </div>


        </section>

    </div>

@endsection
