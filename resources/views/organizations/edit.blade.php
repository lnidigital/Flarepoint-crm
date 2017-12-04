@extends('layouts.master')
@section('heading')
    Edit organization: {{$organization->name}}
@stop

@section('content')
    {!! Form::model($organization, [
            'method' => 'PATCH',
            'route' => ['organizations.update', $organization->id],
            ]) !!}
    @include('organizations.form', ['submitButtonText' => __('Save')])

    {!! Form::close() !!}

@stop