@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="referrals-table">
        <thead>
        <tr>
            <th>{{ __('From') }}</th>
            <th>{{ __('To') }}</th>
            <th>{{ __('Date') }}</th>
            @if(Entrust::can('referral-update'))
                <th></th>
            @endif
            @if(Entrust::can('referral-delete')) 
                <th></th>
            @endif
        </tr>
        </thead>
    </table>
    @if(Entrust::can('referral-create'))
      <a href="{{ route('referrals.create')}}" class="btn btn-primary">{{ __('+ Add New') }}</a>
    @endif
@stop

@push('scripts')
<script>
    $(function () {
        $('#referrals-table').DataTable({
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
            ajax: '{!! route('referrals.data') !!}',
            columns: [

                {data: 'from_name', name: 'from_contact_id'},
                {data: 'to_name', name: 'to_contact_id'},
                {data: 'referral_date_formatted', name: 'referral_date'},
                @if(Entrust::can('referral-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('referral-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush
