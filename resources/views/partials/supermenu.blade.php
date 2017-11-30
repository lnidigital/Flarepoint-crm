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