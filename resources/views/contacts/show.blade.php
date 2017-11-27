@extends('layouts.master')
    @section('content')
    @include('partials.contactheader')
<div class="col-sm-8">
  <el-tabs active-name="referrals" style="width:100%">
    <el-tab-pane label="Referrals" name="referrals">
        <table class="table table-hover" id="referrals-table">
        <h3>{{ __('Referrals made') }}</h3>
            <thead>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Deadline') }}</th>
                    <th>
                        <select name="status" id="status-task">
                        <option value="" disabled selected>{{ __('Status') }}</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="all">All</option>
                        </select>
                    </th>
                </tr>
            </thead>
        </table>
    </el-tab-pane>
    <el-tab-pane label="1-on-1s" name="oneonones">
      <table class="table table-hover">
        <table class="table table-hover" id="oneonones-table">
                <h3>{{ __('1-on-1s completed') }}</h3>
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Client') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Deadline') }}</th>
                    <th>
                        <select name="status" id="status-lead">
                        <option value="" disabled selected>{{ __('Status') }}</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="all">All</option>
                        </select>
                    </th>
                </tr>
                </thead>
            </table>
    </el-tab-pane>
    <el-tab-pane label="Guests" name="guests">
         <table class="table table-hover" id="guests-table">
                <h3>{{ __('Guests invited') }}</h3>
                <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Company') }}</th>
                    <th>{{ __('Primary number') }}</th>
                </tr>
                </thead>
            </table>
    </el-tab-pane>
    <el-tab-pane label="Revenues" name="revenues">
         <table class="table table-hover" id="revenues-table">
                <h3>{{ __('Revenues reported') }}</h3>
                <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Company') }}</th>
                    <th>{{ __('Primary number') }}</th>
                </tr>
                </thead>
            </table>
    </el-tab-pane>
  </el-tabs>
  </div>
   @stop 
@push('scripts')
        <script>
        $('#pagination a').on('click', function (e) {
            e.preventDefault();
            var url = $('#search').attr('action') + '?page=' + page;
            $.post(url, $('#search').serialize(), function (data) {
                $('#posts').html(data);
            });
        });

            $(function () {
              var table = $('#tasks-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.taskdata', ['id' => $contact->id]) !!}',
                    columns: [

                        {data: 'titlelink', name: 'title'},
                        {data: 'client_id', name: 'Client', orderable: false, searchable: false},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'deadline', name: 'deadline'},
                        {data: 'status', name: 'status', orderable: false},
                    ]
                });

                $('#status-task').change(function() {
                selected = $("#status-task option:selected").val();
                    if(selected == 'open') {
                        table.columns(4).search(1).draw();
                    } else if(selected == 'closed') {
                        table.columns(4).search(2).draw();
                    } else {
                         table.columns(4).search( '' ).draw();
                    }
              });  

          });
            $(function () {
                $('#clients-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.clientdata', ['id' => $contact->id]) !!}',
                    columns: [

                        {data: 'clientlink', name: 'name'},
                        {data: 'company_name', name: 'company_name'},
                        {data: 'primary_number', name: 'primary_number'},

                    ]
                });
            });

            $(function () {
              var table = $('#leads-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.leaddata', ['id' => $contact->id]) !!}',
                    columns: [

                        {data: 'titlelink', name: 'title'},
                        {data: 'client_id', name: 'Client', orderable: false, searchable: false},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'contact_date', name: 'contact_date'},
                        {data: 'status', name: 'status', orderable: false},
                    ]
                });

              $('#status-lead').change(function() {
                selected = $("#status-lead option:selected").val();
                    if(selected == 'open') {
                        table.columns(4).search(1).draw();
                    } else if(selected == 'closed') {
                        table.columns(4).search(2).draw();
                    } else {
                         table.columns(4).search( '' ).draw();
                    }
              });  
          });
        </script>
@endpush


