@extends('layouts.master')
@section('heading')
    Edit Contact: ({{$contact->name}})
@stop

@section('content')
    {!! Form::model($contact, [
            'method' => 'PATCH',
            'route' => ['contacts.update', $contact->id],
            ]) !!}
    @include('contacts.form', ['submitButtonText' => __('Update contact')])

    {!! Form::close() !!}

@stop