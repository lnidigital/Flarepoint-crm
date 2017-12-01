@extends('layouts.master')
@section('heading')
    Edit Member ({{$contact->name}})
@stop

@section('content')
    {!! Form::model($contact, [
            'method' => 'PATCH',
            'route' => ['members.update', $contact->id],
            ]) !!}
    @include('members.form', ['submitButtonText' => __('Save')])

    {!! Form::close() !!}

@stop