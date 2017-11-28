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
        </tr>
        </thead>
    </table>

      @if(Entrust::can('revenue-create'))
      <a href="{{ route('revenues.create')}}" class="btn btn-primary">{{ __('+ Add New') }}</a>
      @endif
@stop

@push('scripts')
<script>
    $(function () {
        $('#revenues-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Blfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "bLengthChange": false,
            ajax: '{!! route('revenues.data') !!}',
            columns: [

                {data: 'name', name: 'contact_id'},
                {data: 'amount_formatted', name: 'amount'},
                {data: 'report_date_formatted', name: 'report_date'},
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
