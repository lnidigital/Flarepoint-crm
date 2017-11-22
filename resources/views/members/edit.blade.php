@extends('layouts.master')
@section('heading')
    Edit Member ({{$member->name}})
@stop

@section('content')
    {!! Form::model($member, [
            'method' => 'PATCH',
            'route' => ['members.update', $member->id],
            ]) !!}
    @include('members.form', ['submitButtonText' => __('Update member')])

    {!! Form::close() !!}

@stop