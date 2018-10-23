<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link " active-class="active">
                <i class="nav-icon fas fa-tachometer-alt icon-yellow"></i>
                    <p>
                    Dashboard
                    </p>
            </router-link>
        </li>
        @can('isSuperAdmin')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog icon-teal"></i>
              <p>
                Management
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fas fa-users nav-icon icon-indigo"></i>
                  <p>Users</p>
                </router-link>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <router-link to="/developer" class="nav-link">
                <i class="nav-icon fas fa-cogs icon-pink"></i>
                    <p>
                    Developer
                    </p>
            </router-link>
        </li>
        @endcan
        @can('isStudent')
          <li class="nav-item">
                <router-link to="/profile" class="nav-link">
                    <i class="nav-icon fas fa-user icon-orange"></i>
                        <p>
                        Profile
                        </p>
                </router-link>
            </li>
          @endcan
            <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                              <i class="nav-icon fas fa-power-off icon-red"></i>
                              <p>
                                  {{ __('Logout') }}
                              </p>
                    </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                </li>
        </ul>
      </nav>