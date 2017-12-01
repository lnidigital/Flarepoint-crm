@extends('layouts.master')
@section('heading')
    Edit Meeting: ({{$meeting->id}})
@stop

@section('content')
    {!! Form::model($meeting, [
            'method' => 'PATCH',
            'route' => ['meetings.update', $meeting->id],
            ]) !!}
    @include('meetings.form', ['submitButtonText' => __('Save')])

    {!! Form::close() !!}

@stop