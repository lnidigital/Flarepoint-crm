@extends('layouts.master')
@section('heading')
    <h1>Create group</h1>
@stop

@section('content')

    {!! Form::open([
            'route' => 'groups.store'
            ]) !!}

    @include('groups.form', ['submitButtonText' => __('Save')])

   

    {!! Form::close() !!}





@stop