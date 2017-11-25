

<div class="form-inline">
    <div class="form-group col-sm-6 removeleft">
        {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    {!! 
        Form::text('name',  
        isset($data['owners']) ? $data['owners'][0]['name'] : null, 
        ['class' => 'form-control']) 
    !!}
    </div>

    <div class="form-group col-sm-6 removeleft removeright">
        {!! Form::label('company_name', 'Company name:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('company_name',
            isset($data['name']) ? $data['name'] : null, 
            ['class' => 'form-control']) 
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
    {!! 
        Form::email('email',
        isset($data['email']) ? $data['email'] : null, 
        ['class' => 'form-control']) 
    !!}
</div>

<div class="form-group">
    {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
    {!! 
        Form::text('address',
        isset($data['address']) ? $data['address'] : null, 
        ['class' => 'form-control'])
    !!}
</div>

<div class="form-inline">
    <div class="form-group col-sm-6 removeleft ">
        {!! Form::label('city', 'City:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('city',
            isset($data['city']) ? $data['city'] : null,
            ['class' => 'form-control']) 
        !!}
    </div>
    <div class="form-group col-sm-3 removeleft">
        {!! Form::label('state', 'State:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('state',
             isset($data['state']) ? $data['state'] : null, 
             ['class' => 'form-control']) 
        !!}
    </div>
    <div class="form-group col-sm-3 removeleft">
        {!! Form::label('zipcode', 'Zip code:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('zipcode',
             isset($data['zipcode']) ? $data['zipcode'] : null, 
             ['class' => 'form-control']) 
        !!}
    </div>

    
</div>

<div class="form-inline">
    <div class="form-group col-sm-6 removeleft">
        {!! Form::label('primary_number', 'Primary Number:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('primary_number',  
            isset($data['phone']) ? $data['phone'] : null, 
            ['class' => 'form-control']) 
        !!}
    </div>

    <div class="form-group col-sm-6 removeleft removeright">
        {!! Form::label('secondary_number', 'Secondary Number:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('secondary_number',  
            null, 
            ['class' => 'form-control']) 
        !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('industry', 'Industry:', ['class' => 'control-label']) !!}
    {!!
        Form::select('industry_id',
        $industries,
        null,
        ['placeholder' => 'Select Industry', 'class' => 'form-control ui search selection top right pointing search-select',
        'id' => 'search-select'])
    !!}
</div>

{{ Form::hidden('group_id', '1') }}
{{ Form::hidden('user_id', '1') }}
{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}