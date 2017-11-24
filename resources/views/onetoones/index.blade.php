@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="onetoones-table">
        <thead>
        <tr>
            <th>{{ __('From') }}</th>
            <th>{{ __('To') }}</th>
            <th>{{ __('Date') }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>

@stop

@push('scripts')
<script>
    $(function () {
        $('#onetoones-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('onetoones.data') !!}',
            columns: [

                {data: 'first_member_name', name: 'first_member_id'},    
                {data: 'second_member_name', name: 'second_member_id'},
                {data: 'onetoone_date', name: 'onetoone_date'},
                @if(Entrust::can('onetoone-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('onetoone-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush
