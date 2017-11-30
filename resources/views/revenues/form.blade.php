<div class="form-inline">
    <div class="form-group col-sm-4 removeleft ">
        {!! Form::label('Date', __('Date'), ['class' => 'control-label']) !!}
        {!! Form::date('report_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-4 removeleft ">
        {!! Form::label('contact_id', __('Member'), ['class' => 'control-label']) !!}
        {!! Form::select('contact_id', $members, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-4 removeleft ">
        {!! Form::label('amount', __('Amount'), ['class' => 'control-label']) !!}
        {!! 
            Form::text('amount',
            isset($data['amount']) ? $data['amount'] : null, 
            ['class' => 'form-control'])
        !!}
    </div>
    
    
 </div>
<div class="form-inline">
    <div class="form-group col-sm-6 removeleft ">
        {!! Form::label('referral_id', __('Associated Referral'), ['class' => 'control-label']) !!}
        {!! Form::select('referral_id', $referrals, null, ['placeholder'=>'Select referral', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6 removeleft ">
        {!! Form::label('meeting_id', __('Associated Meeting'), ['class' => 'control-label']) !!}
        {!! Form::select('meeting_id', $meetings, null, ['placeholder'=>'Select meeting', 'class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

{{ Form::hidden('group_id', Helper::getGroupId()) }}
{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}