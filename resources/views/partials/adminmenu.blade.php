<div class="list-group panel">
   <a href="#departments" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
      class="sidebar-icon glyphicon glyphicon-list-alt"></i><span id="menu-txt">{{ __('Groups') }}</span>
   <i class="ion-chevron-up  arrow-up sidebar-arrow"></i></a>
   <div class="collapse" id="departments">
      <a href="{{ route('groups.index')}}"
         class="list-group-item childlist">{{ __('All Departments') }}</a>
      @if(Entrust::hasRole('administrator'))
      <a href="{{ route('groups.create')}}"
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