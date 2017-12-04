<div class="form-inline">
    <div class="form-group col-sm-6 removeleft ">
        {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
        {!! 
            Form::text('name',  
            isset($group->name) ? $group->name : null, 
            ['class' => 'form-control']) 
        !!}
    </div>

    <div class="form-group col-sm-6 removeleft ">
        {!! Form::label('organization_id', __('Organization'), ['class' => 'control-label']) !!}
        {!! Form::select('organization_id', $organizations, null, ['class' => 'form-control']) !!}
    </div>
    
 </div>

{{ Form::hidden('user_id', Auth::id()) }}
{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
<a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>