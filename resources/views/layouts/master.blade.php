<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>{{config('app.name')}}</title>
      <link href="{{ URL::asset('css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('css/dropzone.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('css/jquery.atwho.min.css') }}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.css') }}">
      <link rel="stylesheet" href="{{ asset(elixir('css/app.css')) }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
   </head>
   <body>
      <div id="wrapper">
         <header class="main-header">
            <button type="button" class="navbar-toggle menu-txt-toggle" style=""><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <div class="navbar navbar-custom navbar-top">
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <img src="{{Auth::user()->getPicture()}}" class="user-image" alt="User Image">
                          <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                          <!-- User image -->
                          <li class="user-header">
                            <img src="{{Auth::user()->getPicture()}}" class="img-circle" alt="User Image">

                            <p>
                              {{Auth::user()->name}}
                              <small>{{Helper::getOrganizationName()}}</small>
                            </p>
                          </li>
                          <!-- Menu Body -->
                          <!-- Menu Footer-->
                          <li class="user-footer">
                            <div class="pull-left">
                              <a href="{{route('users.show', \Auth::id())}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                              <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                          </li>
                        </ul>
                      </li>
                  </ul>
               </div>
            </div>
         </header>
         <!-- /#sidebar-wrapper -->
         <!-- Sidebar menu -->
         <nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm" role="navigation">
            <div class="list-group panel">
               <p class=" list-group-item siderbar-top" title=""><img src="{{url('images/chamberedge-logo.png')}}" alt="" width="160px"></p>
               
               <div class="group-picker">
                 {!! Form::open(['route' => 'dashboard.store']) !!}
                 {!! Form::select('group_id', $groups, $selectedGroup, ['class' => 'form-control group-select','onchange'=>'this.form.submit();']) !!}
                 {{ csrf_field() }}
                 {!! Form::close() !!}
               </div>

               <div class="side-menu">

                @if(Entrust::hasRole('administrator'))
                  <el-tabs active-name="menu" style="width:100%">
                    <el-tab-pane label="Menu" name="menu">
                        @include('partials.usermenu')
                    </el-tab-pane>
                    <el-tab-pane label="Admin" name="admin">
                        @include('partials.adminmenu')
                    </el-tab-pane>
                  </el-tabs>
                 @elseif(Entrust::hasRole('super'))
                    <el-tabs active-name="menu" style="width:100%">
                      <el-tab-pane label="Menu" name="menu">
                          @include('partials.usermenu')
                      </el-tab-pane>
                      <el-tab-pane label="Admin" name="admin">
                          @include('partials.adminmenu')
                      </el-tab-pane>
                      <el-tab-pane label="Super" name="super">
                          @include('partials.supermenu')
                      </el-tab-pane>
                    </el-tabs>
                  @else
                    @include('partials.usermenu')
                  @endif

              </div>
            </div>
         </nav>
         <!-- Page Content -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
               <div class="row">
                @if($errors->any())
                <div class="alert alert-danger">
                   @foreach($errors->all() as $error)
                   <p>{{ $error }}</p>
                   @endforeach
                </div>
                @endif
                @if(Session::has('flash_message_warning'))
                <message message="{{ Session::get('flash_message_warning') }}" type="warning"></message>
                @endif
                @if(Session::has('flash_message'))
                <message message="{{ Session::get('flash_message') }}" type="success"></message>
                @endif

                  <div class="col-lg-12">
                     <h1>@yield('heading')</h1>
                     @yield('content')
                  </div>
               </div>
            </div>
         </div>
         <!-- /#page-content-wrapper -->
      </div>
      <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/dropzone.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/jasny-bootstrap.min.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/jquery.caret.min.js') }}"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
      @stack('scripts')
      <script>
        //window.onload = function () { document.getElementById("page-content-wrapper").style.display = "block"; }
      </script>
   </body>
</html>