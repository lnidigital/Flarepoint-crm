@extends('layouts.master')
@section('heading')
    <h1>Create referral</h1>
@stop

@section('content')

    {!! Form::open([
            'route' => 'referrals.store'
            ]) !!}

    @include('referrals.form', ['submitButtonText' => __('Create Referral')])

   

    {!! Form::close() !!}





@stop