<div class="form-inline">
    <div class="form-group col-sm-3 removeleft ">
        {!! Form::label('Date', __('Date'), ['class' => 'control-label']) !!}
        {!! Form::date('referral_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-3 removeleft ">
        {!! Form::label('from_contact_id', __('From'), ['class' => 'control-label']) !!}
        {!! Form::select('from_contact_id', $contacts, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-3 removeleft ">
        {!! Form::label('to_contact_id', __('To'), ['class' => 'control-label']) !!}
        {!! Form::select('to_contact_id', $contacts, null, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group col-sm-3 removeleft ">
        {!! Form::label('meeting_id', __('Associated Meeting'), ['class' => 'control-label']) !!}
        {!! Form::select('meeting_id', $meetings, $meetingId, ['placeholder'=>'Select meeting', 'class' => 'form-control']) !!}
    </div>
 </div>


<div class="form-group">
    {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


{{ Form::hidden('referrer', '') }}
{{ Form::hidden('group_id', Helper::getGroupId()) }}

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
<a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>