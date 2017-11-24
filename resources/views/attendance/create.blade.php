@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="members-table">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Company') }}</th>
            <th>{{ __('Mail') }}</th>
            <th>{{ __('Number') }}</th>
            <th>{{ __('Attended?') }}</th>
            <th></th>
        </tr>
        </thead>
    </table>

@stop

@push('scripts')
<script>
    $(function () {
        $('#members-table').DataTable({
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
    });
</script>
@endpush
