@extends('layouts.container')

@section('pageTitle', __('title.crud_create_'.$routes))
@section('headingTitle', __('heading.crud_create_'.$routes))

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li><a href="{{ URL::to($routes) }}">@lang('bread.crud_index_'.$routes)</a></li>
        <li class="active">@lang('bread.crud_create_'.$routes)</li>
    </ol>
@endsection

@section('content')

    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url' => $routes)) }}

    @foreach($item->crudCreate as $column => $type)
    <div class="form-group">
        {{ Form::label($column, __($routes.'.crud_create_label_'.$column)) }}
        {{ Form::$type($column, Input::old($column), array('class' => 'form-control')) }}
    </div>
    @endforeach

    {{ Form::submit(__($routes.'.crud_create_primary_action'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endsection