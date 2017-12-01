@extends('layouts.master')
@section('heading')
    Edit Guest ({{$guest->name}})
@stop

@section('content')
    {!! Form::model($guest, [
            'method' => 'PATCH',
            'route' => ['guests.update', $guest->id],
            ]) !!}
    @include('guests.form', ['submitButtonText' => __('Save')])

    {!! Form::close() !!}

@stop