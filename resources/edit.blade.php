@extends('layouts.container')

@section('pageTitle', __('title.crud_edit_'.$routes, ['title'=>$item->title,'id'=>$item->id]))
@section('headingTitle', __('heading.crud_edit_'.$routes, ['title'=>$item->title,'id'=>$item->id]))

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li><a href="{{ URL::to($routes) }}">@lang('bread.crud_index_'.$routes)</a></li>
        <li class="active">@lang('bread.crud_edit_'.$routes, ['title'=>$item->title,'id'=>$item->id])</li>
    </ol>
@endsection

@section('content')

    {{ HTML::ul($errors->all()) }}

    {{ Form::model($item, array('route' => array($routes.'.update', $item->id), 'method' => 'PUT')) }}

    @foreach($item->crudCreate as $column => $type)
        <div class="form-group">
            {{ Form::label($column, __($routes.'.crud_edit_label_'.$column)) }}
            {{ Form::$type($column, Input::old($column), array('class' => 'form-control')) }}
        </div>
    @endforeach

    {{ Form::submit(__($routes.'.crud_edit_primary_action'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endsection