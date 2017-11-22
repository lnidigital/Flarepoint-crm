@extends('layouts.master')
@section('heading')
    <h1>Create 1-to-1</h1>
@stop

@section('content')

    {!! Form::open([
            'route' => 'onetoones.store'
            ]) !!}

    @include('onetoones.form', ['submitButtonText' => __('Create 1-to-1')])

   

    {!! Form::close() !!}





@stop