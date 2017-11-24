@extends('layouts.master')
@section('heading')
    Edit Referral 
@stop

@section('content')
    {!! Form::model($referral, [
            'method' => 'PATCH',
            'route' => ['referrals.update', $referral->id],
            ]) !!}
    @include('referrals.form', ['submitButtonText' => __('Update referral')])

    {!! Form::close() !!}

@stop