@extends('layouts.master')
@section('heading')
     <h1>Edit 1-to-1</h1>
@stop

@section('content')
    {!! Form::model($onetoone, [
            'method' => 'PATCH',
            'route' => ['onetoones.update', $onetoone->id],
            ]) !!}
    @include('onetoones.form', ['submitButtonText' => __('Save')])

    {!! Form::close() !!}

@stop