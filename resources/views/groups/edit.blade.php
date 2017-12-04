@extends('layouts.master')
@section('heading')
    Edit group: {{$group->name}}
@stop

@section('content')
    {!! Form::model($group, [
            'method' => 'PATCH',
            'route' => ['groups.update', $group->id],
            ]) !!}
    @include('groups.form', ['submitButtonText' => __('Save')])

    {!! Form::close() !!}

@stop