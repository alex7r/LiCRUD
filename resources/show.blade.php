@extends('layouts.container')

@section('pageTitle', __('title.crud_show_'.$routes, ['title'=>$item->title,'id'=>$item->id]))
@section('headingTitle', __('heading.crud_show_'.$routes, ['title'=>$item->title,'id'=>$item->id]))

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li><a href="{{ URL::to($routes) }}">@lang('bread.crud_index_'.$routes)</a></li>
        <li class="active">@lang('bread.crud_show_'.$routes, ['title'=>$item->title,'id'=>$item->id])</li>
    </ol>
@endsection

@section('content')

    <h1>{{ $item->title }}</h1>
    @foreach($item->crudShow as $column)
        <td></td>
        <div class="styling__{{ $routes }}__{{ $column }}">
            {{ $item->$column }}
        </div>
    @endforeach

@endsection