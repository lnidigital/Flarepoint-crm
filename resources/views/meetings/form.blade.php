<div class="form-inline">
             {!! Form::label('Date', __('Date'), ['class' => 'control-label']) !!}
            {!! Form::date('meeting_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
       
    </div>
    


    <div class="form-group">
        {!! Form::label('meeting_notes', __('Meeting Notes'), ['class' => 'control-label']) !!}
        {!! Form::textarea('meeting_notes', null, ['class' => 'form-control']) !!}
    </div>


     {{ Form::hidden('group_id', '1') }}
    
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}