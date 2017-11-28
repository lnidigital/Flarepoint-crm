<div class="form-group">
             {!! Form::label('Date', __('Date'), ['class' => 'control-label']) !!}
            {!! Form::date('onetoone_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        
    </div>
    <div class="form-inline">
        <div class="form-group col-sm-4 removeleft ">
            {!! Form::label('first_contact_id', __('First member'), ['class' => 'control-label']) !!}
            {!! Form::select('first_contact_id', $members, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4 removeleft ">
            {!! Form::label('second_contact_id', __('Second member'), ['class' => 'control-label']) !!}
            {!! Form::select('second_contact_id', $members, null, ['class' => 'form-control']) !!}
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


    {{ Form::hidden('referrer', '') }}
    {{ Form::hidden('group_id', Helper::getGroupId()) }}
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}