@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="revenues-table">
        <thead>
        <tr>
            <th>{{ __('Member') }}</th>
            <th>{{ __('Amount') }}</th>
            <th>{{ __('Report Date') }}</th>
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
        $('#revenues-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('revenues.data') !!}',
            columns: [

                {data: 'name', name: 'member_id'},
                {data: 'amount', render: $.fn.dataTable.render.number( ',', '.', 2 )},
                {data: 'report_date', name: 'report_date'},
                @if(Entrust::can('revenue-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('revenue-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush
