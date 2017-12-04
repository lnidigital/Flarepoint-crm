<div class="form-group">
    {{ Form::label('image_path', __('Image'), ['class' => 'control-label']) }}
    {!! Form::file('image_path',  null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', __('E-mail'), ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', __('Password'), ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', __('Confirm password'), ['class' => 'control-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
<div class="form-group form-inline">
   
    {!! Form::label('organization', __('Assign organization'), ['class' => 'control-label']) !!}

    {!!
        Form::select('organization',
        $organizations, isset($user->organizations) ? $user->organizations[0]->id : null,
        ['placeholder' => 'Select organization', 'class' => 'form-control']) !!}
    
    {!! Form::label('groups', __('Assign group'), ['class' => 'control-label']) !!}

    {!!
        Form::select('group',
        $groups, isset($user->groups) ? $user->groups[0]->id : null,
        ['placeholder' => 'Select group', 'class' => 'form-control']) !!}

     {!! Form::label('roles', __('Assign role'), ['class' => 'control-label']) !!}
    {!!
        Form::select('roles',
        $roles,
        isset($user->role->role_id) ? $user->role->role_id : null,
        ['class' => 'form-control']) !!}

</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
