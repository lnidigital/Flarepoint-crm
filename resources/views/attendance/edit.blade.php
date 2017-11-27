@extends('layouts.master')
@section('heading')

@stop

@section('content')

{!! Form::open([
            'route' => 'attendance.store',
            'class' => 'ui-form'
            ]) !!}
    
    <table class="table table-hover " id="members-table">
        <h3>{{ __('Members') }}</h3>
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Attended?') }}</th>
            <th></th>
        </tr>
        @foreach ($members as $member)
            <tr>
                <td>{{$member->name}}</td>
                <td><input name="member[{{$member->id}}]" type="checkbox" value="{{$member->id}}" class="field" {{ Helper::checkMeetingAttended($meeting->id, $member->id)}}></td>
            </tr>
        @endforeach
        </thead>
    </table>

    <table class="table table-hover " id="guests-table">
        <h3>{{ __('Guests') }}</h3>
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Attended?') }}</th>
            <th></th>
        </tr>
        @foreach ($guests as $guest)
            <tr>
                <td>{{$guest->name}}</td>
                <td><input name="guest[{{$guest->id}}]" type="checkbox" value="{{$guest->id}}" class="field" {{ Helper::checkMeetingAttended($meeting->id, $guest->id)}}></td>
            </tr>
        @endforeach
        </thead>
    </table>


{{ Form::hidden('group_id', '1') }}
{{ Form::hidden('meeting_id', $meeting->id) }}
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

@stop

@push('scripts')
<script>
    $(function () {
        $('#members-table1').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('members.data') !!}',
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'email', name: 'email'},
                {data: 'primary_number', name: 'primary_number'},
                @if(Entrust::can('attendance-update'))   
                { 
                	data: 'edit', render: function ( data, type, row ) {
                    if ( type === 'display' ) {
                        return '<input type="checkbox" class="editor-active">';
                    }
                    return data;
                },
                 },
                @endif
              

            ]
        });

        $('#guests-table1').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('guests.data') !!}',
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'email', name: 'email'},
                {data: 'primary_number', name: 'primary_number'},
                @if(Entrust::can('attendance-update'))   
                { 
                    data: 'edit', render: function ( data, type, row ) {
                    if ( type === 'display' ) {
                        return '<input type="checkbox" class="editor-active">';
                    }
                    return data;
                },
                 },
                @endif
              

            ]
        });
    });
</script>
@endpush
