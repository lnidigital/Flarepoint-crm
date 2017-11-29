<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Grow CRM</title>
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
               
               {!! Form::open(['route' => 'dashboard.store']) !!}
               {!! Form::select('group_id', $groups, $selectedGroup, ['class' => 'form-control group-select','onchange'=>'this.form.submit();']) !!}
               {{ csrf_field() }}
               {!! Form::close() !!}

               <a href="{{route('dashboard', \Auth::id())}}" class=" list-group-item" data-parent="#MainMenu"><i
                  class="sidebar-icon fa fa-bar-chart"></i><span id="menu-txt">{{ __('Dashboard') }}</span> </a>
               <a href="{{route('meetings.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="sidebar-icon fa fa-pencil"></i><span id="menu-txt"> {{ __('Meetings') }}</span> </a>
               
               <a href="{{route('members.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="sidebar-icon fa fa-users"></i><span id="menu-txt">{{ __('Members') }}</span> </a>

               <a href="{{route('referrals.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-transfer"></i><span id="menu-txt">{{ __('Referrals') }}</span> </a>
               
               <a href="{{route('onetoones.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-flash"></i><span id="menu-txt">{{ __('1-to-1s') }}</span> </a>
               
               <a href="{{route('revenues.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-usd"></i><span id="menu-txt">{{ __('Revenues') }}</span> </a>
               
               <a href="{{route('guests.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-sunglasses"></i><span id="menu-txt">{{ __('Guests') }}</span> </a>
               
            </div>
            @if(Entrust::hasRole('administrator'))
            <div class="list-group panel">
               <a href="#departments" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                  class="sidebar-icon glyphicon glyphicon-list-alt"></i><span id="menu-txt">{{ __('Groups') }}</span>
               <i class="ion-chevron-up  arrow-up sidebar-arrow"></i></a>
               <div class="collapse" id="departments">
                  <a href="{{ route('departments.index')}}"
                     class="list-group-item childlist">{{ __('All Departments') }}</a>
                  @if(Entrust::hasRole('administrator'))
                  <a href="{{ route('departments.create')}}"
                     class="list-group-item childlist">{{ __('New Department') }}</a>
                  @endif
               </div>
               <a href="#user" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                  class="sidebar-icon fa fa-users"></i><span id="menu-txt">{{ __('Users') }}</span>
               <i class="ion-chevron-up  arrow-up sidebar-arrow"></i></a>
               <div class="collapse" id="user">
                  <a href="{{ route('users.index')}}" class="list-group-item childlist">{{ __('Users All') }}</a>
                  @if(Entrust::can('user-create'))
                  <a href="{{ route('users.create')}}"
                     class="list-group-item childlist">{{ __('New User') }}</a>
                  @endif
               </div>
            </div>
            @endif
            <div class="list-group panel">
               @if(Entrust::hasRole('administrator'))
               <a href="#settings" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                  class="glyphicon sidebar-icon glyphicon-cog"></i><span id="menu-txt">{{ __('Settings') }}</span>
               <i class="ion-chevron-up  arrow-up sidebar-arrow"></i></a>
               <div class="collapse" id="settings">
                  <a href="{{ route('settings.index')}}"
                     class="list-group-item childlist">{{ __('Overall Settings') }}</a>
                  <a href="{{ route('roles.index')}}"
                     class="list-group-item childlist">{{ __('Role Management') }}</a>
                  <a href="{{ route('integrations.index')}}"
                     class="list-group-item childlist">{{ __('Integrations') }}</a>
               </div>
               @endif
            </div>
            @if(Entrust::hasRole('super'))
            <div class="list-group panel">
               <a href="#clients" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                  class="glyphicon sidebar-icon glyphicon-tag"></i><span id="menu-txt">{{ __('Clients') }}</span>
               <i class="ion-chevron-up  arrow-up sidebar-arrow"></i></a>
               <div class="collapse" id="clients">
                  <a href="{{ route('clients.index')}}" class="list-group-item childlist">{{ __('All Clients') }}</a>
                  @if(Entrust::can('client-create'))
                  <a href="{{ route('clients.create')}}"
                     class="list-group-item childlist">{{ __('New Client') }}</a>
                  @endif
               </div>
               <a href="#leads" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                  class="glyphicon sidebar-icon glyphicon-hourglass"></i><span id="menu-txt">{{ __('Leads') }}</span>
               <i class="ion-chevron-up  arrow-up sidebar-arrow"></i></a>
               <div class="collapse" id="leads">
                  <a href="{{ route('leads.index')}}" class="list-group-item childlist">{{ __('All Leads') }}</a>
                  @if(Entrust::can('lead-create'))
                  <a href="{{ route('leads.create')}}"
                     class="list-group-item childlist">{{ __('New Lead') }}</a>
                  @endif
               </div>
            </div>
            @endif
         </nav>
         <!-- Page Content -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <h1>@yield('heading')</h1>
                     @yield('content')
                  </div>
               </div>
            </div>
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
   </body>
</html>