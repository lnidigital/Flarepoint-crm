<div class="form-group">
             {!! Form::label('Date', __('Date'), ['class' => 'control-label']) !!}
            {!! Form::date('report_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        
    </div>
    <div class="form-inline">
        <div class="form-group col-sm-6 removeleft ">
            {!! Form::label('member_id', __('Member'), ['class' => 'control-label']) !!}
            {!! Form::select('member_id', $members, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6 removeleft ">
            {!! Form::label('amount', __('Amount'), ['class' => 'control-label']) !!}
            {!! 
                Form::text('amount',
                isset($data['amount']) ? $data['amount'] : null, 
                ['class' => 'form-control'])
            !!}
        </div>
        
     </div>


    <div class="form-group">
        {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>


     {{ Form::hidden('group_id', '1') }}
    
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}