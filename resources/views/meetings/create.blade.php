@extends('layouts.master')
@section('heading')
    <h1>Create meeting</h1>
@stop

@section('content')

    {!! Form::open([
            'route' => 'meetings.store'
            ]) !!}

    @include('meetings.form', ['submitButtonText' => __('Create Meeting')])

   

    {!! Form::close() !!}





@stop