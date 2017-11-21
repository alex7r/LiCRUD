@extends('layouts.container')

@section('pageTitle', __('title.crud_index_'.$routes))
@section('headingTitle', __('heading.crud_index_'.$routes))

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">home</a></li>
{{--        <li><a href="{{ URL::to($routes) }}">@lang('bread.crud_index_'.$routes)</a></li>--}}
{{--        <li><a href="{{ URL::to($routes.'/create') }}">@lang('bread.crud_create_'.$routes)</a>--}}
        <li class="active">@lang('bread.crud_index_'.$routes)</li>
    </ol>
@endsection

@section('content')
    <table class="table table-striped table-bordered">
        <?php if(!$items->isEmpty()){
            ?>
            <thead>
            <tr>
                <?php
                $columns = $items[0]->crudIndex;
                array_map(function($column)use($routes){
                ?>
                <th>@lang($routes.'.crud_index_'.$column)</th>
                <?php
                },$columns);
                ?>
                <th>
                    <a class="btn btn-small btn-success" href="{{ URL::to($routes.'/create') }}">@lang($routes.'.crud_index_action_create')</a>
                </th>
            </tr>
            </thead>
            <?php
        } ?>
        <tbody>
        @foreach($items as $key => $value)
            <tr>
                @foreach($columns as $column)
                    <td>{{ $value->$column }}</td>
                @endforeach
                <td>
                    {{ Form::open(array('url' => $routes.'/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit(__($routes.'.crud_index_action_delete'), array('class' => 'btn btn-warning btn-xs')) }}
                    {{ Form::close() }}
                    <a class="btn btn-xs btn-success" href="{{ URL::to($routes.'/' . $value->id) }}">@lang($routes.'.crud_index_action_show')</a>
                    <a class="btn btn-xs btn-info" href="{{ URL::to($routes.'/' . $value->id . '/edit') }}">@lang($routes.'.crud_index_action_edit')</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection