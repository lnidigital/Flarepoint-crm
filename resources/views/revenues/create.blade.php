@extends('layouts.master')
@section('heading')
    <h1>Report revenue</h1>
@stop

@section('content')

    {!! Form::open([
            'route' => 'revenues.store'
            ]) !!}

    @include('revenues.form', ['submitButtonText' => __('Add Revenue')])

   

    {!! Form::close() !!}


    


@stop