<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link " >
                <i class="nav-icon fas fa-tachometer-alt icon-yellow"></i>
                    <p>
                    Dashboard
                    </p>
            </router-link>
        </li>
        @can('isSuperAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fas fa-users nav-icon icon-indigo"></i>
            <p>User Accounts</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/studentlist" class="nav-link">
            <i class="fas fa-address-card nav-icon icon-vividorange"></i>
            <p>Student List</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/program" class="nav-link">
            <i class="fas fa-tasks nav-icon icon-green"></i>
            <p>Manage Program</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/courses" class="nav-link">
            <i class="fas fa-clipboard-list nav-icon icon-blue"></i>
            <p>Manage Courses</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/curriculum" class="nav-link">
            <i class="fas fa-table nav-icon icon-teal"></i>
            <p>Manage Curriculum</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/manage_enrollment" class="nav-link">
            <i class="fas fa-archive nav-icon icon-cyan"></i>
            <p>Manage Enrollment</p>
          </router-link>
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
            <li class="nav-item">
              <router-link to="/enrollment" class="nav-link">
                <i class="fas fa-tasks nav-icon icon-green"></i>
                <p>Enrollment</p>
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