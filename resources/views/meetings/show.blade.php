@extends('layouts.master')
@section('heading')
@stop
@section('content')
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
    </script>
@endpush
    <div class="row">
        @include('partials.meetingheader')
    </div>
    <div class="col-lg-12">
        <el-tabs active-name="attendance" style="width:100%">
            <el-tab-pane label="Attendance ({{count($attendedMembers)}})" name="attendance">
                <table class="table table-hover" id="member-attendance-table">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                        </tr>
                    </thead>
                </table>
                @if(Entrust::can('attendance-update'))
                  <a href="{{ url('/attendance/' . $meeting->id . '/edit') }}" class="btn btn-primary">Update Attendance</a> 
                @endif
                

            </el-tab-pane>
            <el-tab-pane label="Guests ({{count($attendedGuests)}})" name="guests">
                <table class="table table-hover" id="guest-attendance-table">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                        </tr>
                    </thead>
                </table>
                <a href="{{ url('/attendance/' . $meeting->id . '/edit') }}" class="btn btn-primary">Update Attendance</a>
                <a href="{{ route('guests.create', 'referrer=/meetings/'.$meeting->id) }}" class="btn btn-primary">Add New Guest</a>
            </el-tab-pane>
            <el-tab-pane label="Referrals ({{count($meetingReferrals)}})" name="referrals">
              <table class="table table-hover">
                <table class="table table-hover" id="referrals-table">
                        <thead>
                        <tr>
                            <th>{{ __('From') }}</th>
                            <th>{{ __('To') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                        </thead>
                    </table>
                    <a href="{{ route('referrals.create', 'referrer=/meetings/'.$meeting->id) }}" class="btn btn-primary">Add New Referral</a>
            </el-tab-pane>
            <el-tab-pane label="1-to-1s ({{count($onetoones)}})" name="onetoones">
                 <table class="table table-hover" id="onetoones-table">
                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                        </thead>
                    </table>
                    <a href="{{ route('onetoones.create', 'referrer=/meetings/'.$meeting->id) }}" class="btn btn-primary">Add New 1-to-1</a>
            </el-tab-pane>
          </el-tabs>

    </div>
    
@stop

@push('scripts')
<script>
        

    $(function () {
        $('#member-attendance-table').DataTable({
            processing: true,
            serverSide: true,
            searching:false,
            bLengthChange: false,
            ajax: '{!! route('attendance.meetingdata', ['meetingid' => $meeting->id,'statusid'=>'1']) !!}',
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'email', name: 'email'},
                {data: 'primary_number', name: 'primary_number'}
            ]
        });
    });

    $(function () {
        $('#guest-attendance-table').DataTable({
            processing: true,
            serverSide: true,
            searching:false,
            bLengthChange: false,
            ajax: '{!! route('attendance.meetingdata', ['meetingid' => $meeting->id,'statusid'=>'2']) !!}',
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'email', name: 'email'},
                {data: 'primary_number', name: 'primary_number'}
            ]
        });
    });

    $(function () {
        $('#referrals-table').DataTable({
            processing: true,
            serverSide: true,
            searching:false,
            bLengthChange: false,
            ajax: '{!! route('referrals.meetingdata', ['meetingid' => $meeting->id]) !!}',
            columns: [

                {data: 'from_name', name: 'from_contact_id'},
                {data: 'to_name', name: 'to_contact_id'},
                {data: 'referral_date_formatted', name: 'referral_date'}
            ]
        });
    });

    $(function () {
        $('#onetoones-table').DataTable({
            processing: true,
            serverSide: true,
            searching:false,
            bLengthChange: false,
            ajax: '{!! route('onetoones.meetingdata', ['meetingid' => $meeting->id]) !!}',
            columns: [

                {data: 'first_name', name: 'first_contact_id'},
                {data: 'second_name', name: 'second_contact_id'},
                {data: 'onetoone_date_formatted', name: 'onetoone_date'}
            ]
        });
    });
    
</script>
@endpush