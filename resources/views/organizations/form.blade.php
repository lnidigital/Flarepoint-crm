<div class="form-group">
        {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
        {!! 
            Form::text('name',  
            isset($organization->name) ? $organization->name : null, 
            ['class' => 'form-control']) 
        !!}
</div>
<div class="form-group">
    @if(Entrust::hasRole('super'))
        {!! Form::label('user_id', __('User'), ['class' => 'control-label']) !!}
        {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
    @else
        {{ Form::hidden('user_id', Auth::id()) }}
    @endif
</div>
<div class="form-group">
{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
<a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
</div>