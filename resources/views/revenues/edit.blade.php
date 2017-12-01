@extends('layouts.master')
@section('heading')
    Edit Revenue 
@stop

@section('content')
    {!! Form::model($revenue, [
            'method' => 'PATCH',
            'route' => ['revenues.update', $revenue->id],
            ]) !!}
    @include('revenues.form', ['submitButtonText' => __('Save')])

    {!! Form::close() !!}

@stop