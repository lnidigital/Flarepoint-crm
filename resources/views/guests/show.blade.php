@extends('layouts.master')
@section('heading')
@stop
@section('content')

@include('partials.guestheader')

    <div class="col-sm-10 contact-activity">
        <el-tabs active-name="referrals-given">
            <el-tab-pane label="Referrals &rArr; ({{$activity['referralsgiven']}})" name="referrals-given">
                <table class="table table-hover " id="referrals-given-table">
                    <thead>
                        <tr>
                            <th>{{ __('From') }}</th>
                            <th>{{ __('To') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                    </thead>
                </table>
            </el-tab-pane>
            <el-tab-pane label="Referrals &lArr; ({{$activity['referralsreceived']}})" name="referrals-received">
                <table class="table table-hover " id="referrals-received-table">
                    <thead>
                        <tr>
                            <th>{{ __('From') }}</th>
                            <th>{{ __('To') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                    </thead>
                </table>
            </el-tab-pane>
            <el-tab-pane label="1-on-1s ({{$activity['onetoones']}})" name="oneonones">
                <table class="table table-hover" id="oneonones-table">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                    </thead>
                </table>
            </el-tab-pane>
            <el-tab-pane label="Revenues ({{$activity['revenues']}})" name="revenues">
                <table class="table table-hover" id="revenues-table">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Amount') }}</th>
                        </tr>
                    </thead>
                </table>
            </el-tab-pane>
            <el-tab-pane label="Meetings ({{$activity['meetings']}})" name="meetings">
                 <table class="table table-hover" id="meetings-table">
                    <thead>
                        <tr>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Description') }}</th>
                        </tr>
                    </thead>
                </table>
            </el-tab-pane>
          </el-tabs>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top
            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true,
                    content: $this.find('#popover_content_wrapper').html()
                });
            });
        });

        $(function () {
            $('#referrals-given-table').DataTable({
                processing: true,
                serverSide: true,
                searching:false,
                order: [[2, "desc"]],
                bLengthChange: false,
                ajax: '{!! route('referrals.datagiven', ['id' => $guest->id]) !!}',
                columns: [

                    {data: 'from_name', name: 'from_contact_id'},
                    {data: 'to_name', name: 'to_contact_id'},
                    {data: 'referral_date_formatted', name: 'referral_date'}
                ]
            });
        });

        $(function () {
            $('#referrals-received-table').DataTable({
                processing: true,
                serverSide: true,
                searching:false,
                order: [[2, "desc"]],
                bLengthChange: false,
                ajax: '{!! route('referrals.datareceived', ['id' => $guest->id]) !!}',
                columns: [

                    {data: 'from_name', name: 'from_contact_id'},
                    {data: 'to_name', name: 'to_contact_id'},
                    {data: 'referral_date_formatted', name: 'referral_date'}
                ]
            });
        });

        $(function () {
            $('#oneonones-table').DataTable({
                processing: true,
                serverSide: true,
                searching:false,
                order: [[2, "desc"]],
                bLengthChange: false,
                ajax: '{!! route('onetoones.contactdata', ['id' => $guest->id]) !!}',
                columns: [

                    {data: 'first_contact_name', name: 'first_contact_id'},    
                    {data: 'second_contact_name', name: 'second_contact_id'},
                    {data: 'onetoone_date_formatted', name: 'onetoone_date'}

                ]
            });
        });

        $(function () {
            $('#guests-table').DataTable({
                processing: true,
                serverSide: true,
                searching:false,
                order: [[2, "desc"]],
                bLengthChange: false,
                ajax: '{!! route('guests.contactdata', ['id' => $guest->id]) !!}',
                columns: [

                    {data: 'namelink', name: 'name'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'email', name: 'email'}
                ]
            });
        });  

        $(function () {
            $('#revenues-table').DataTable({
                processing: true,
                serverSide: true,
                bLengthChange: false,
                searching:false,
                order: [[2, "desc"]],
                bLengthChange: false,
                ajax: '{!! route('revenues.contactdata', ['id' => $guest->id]) !!}',
                columns: [

                    {data: 'name', name: 'contact_id'},
                    {data: 'amount_formatted', name: 'amount'},
                    {data: 'report_date_formatted', name: 'report_date'}
                ]
            });
        });

        $(function () {
            $('#meetings-table').DataTable({
                processing: true,
                serverSide: true,
                bLengthChange: false,
                searching:false,
                order: [[0, "desc"]],
                bLengthChange: false,
                ajax: '{!! route('meetings.contactdata', ['id' => $guest->id]) !!}',
                columns: [

                    {data: 'datelink', name: 'meeting_date'},
                    {data: 'meeting_notes_short', name: 'meeting_notes'}
                ]
            });
        });
    </script>
@endpush