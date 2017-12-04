@extends('layouts.master')
@section('heading')
    <h1>Create organization</h1>
@stop

@section('content')

    {!! Form::open([
            'route' => 'organizations.store'
            ]) !!}

    @include('organizations.form', ['submitButtonText' => __('Save')])

   

    {!! Form::close() !!}





@stop