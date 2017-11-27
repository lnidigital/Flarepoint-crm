@extends('layouts.master')
    @section('content')
    @include('partials.userheader')
<div class="col-sm-8">
  
  </div>
  <div class="col-sm-4">

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
                    ajax: '{!! route('users.taskdata', ['id' => $user->id]) !!}',
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
                    ajax: '{!! route('users.clientdata', ['id' => $user->id]) !!}',
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
                    ajax: '{!! route('users.leaddata', ['id' => $user->id]) !!}',
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


