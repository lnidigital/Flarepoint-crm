<a href="{{route('dashboard', \Auth::id())}}" class=" list-group-item" data-parent="#MainMenu"><i
class="sidebar-icon fa fa-bar-chart"></i><span id="menu-txt">{{ __('Dashboard') }}</span> </a>

<a href="{{route('meetings.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="sidebar-icon fa fa-pencil"></i><span id="menu-txt"> {{ __('Meetings') }}</span> </a>

<a href="{{route('members.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="sidebar-icon fa fa-users"></i><span id="menu-txt">{{ __('Members') }}</span> </a>

<a href="{{route('referrals.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-transfer"></i><span id="menu-txt">{{ __('Referrals') }}</span> </a>

<a href="{{route('onetoones.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-flash"></i><span id="menu-txt">{{ __('1-to-1s') }}</span> </a>

<a href="{{route('revenues.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-usd"></i><span id="menu-txt">{{ __('Revenues') }}</span> </a>

<a href="{{route('guests.index')}}" class=" list-group-item" data-parent="#MainMenu"><i class="glyphicon sidebar-icon glyphicon-sunglasses"></i><span id="menu-txt">{{ __('Guests') }}</span> </a>