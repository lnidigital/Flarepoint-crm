<div class="form-group">
             {!! Form::label('Date', __('Date'), ['class' => 'control-label']) !!}
            {!! Form::date('referral_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        
    </div>
    <div class="form-inline">
        <div class="form-group col-sm-4 removeleft ">
            {!! Form::label('from_contact_id', __('From member'), ['class' => 'control-label']) !!}
            {!! Form::select('from_contact_id', $members, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4 removeleft ">
            {!! Form::label('to_contact_id', __('To member'), ['class' => 'control-label']) !!}
            {!! Form::select('to_contact_id', $members, null, ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group col-sm-4 removeleft ">
            {!! Form::label('meeting_id', __('Associated Meeting'), ['class' => 'control-label']) !!}
            {!! Form::select('meeting_id', $meetings, null, ['placeholder'=>'Select meeting', 'class' => 'form-control']) !!}
        </div>
     </div>


    <div class="form-group">
        {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>


    {{ Form::hidden('group_id', '1') }}
    {{ Form::hidden('referrer', '') }}
    
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}