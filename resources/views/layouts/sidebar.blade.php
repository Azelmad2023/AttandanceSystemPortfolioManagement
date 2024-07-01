      <!-- ========== Left Sidebar Start ========== -->
      <div class="left side-menu">
          <div class="slimscroll-menu" id="remove-scroll">

              <!--- Sidemenu -->
              <!-- Log on to codeastro.com for more projects! -->
              <div id="sidebar-menu">

                  <!-- Left Menu Start -->
                  <ul class="metismenu" id="side-menu">
                      <li class="menu-title">Outils</li>
                      {{-- <li class="menu-title">Main</li> --}}
                      <li class="">
                          <a href="/"
                              class="waves-effect {{ request()->is('admin') || request()->is('admin/*') ? 'mm active' : '' }}">
                              <i class="ti-home"></i> <span> Tableau de Bord </span>
                          </a>
                      </li>


                      <li>
                          <a href="{{ route('admin_dashboard') }}"
                              class="waves-effect {{ request()->is('employees') || request()->is('/employees/*') ? 'mm active' : '' }}"><i
                                  class="ti-user"></i><span> Enregistrer la Présence </span></a>
                      </li>
                      <!-- Log on to codeastro.com for more projects! -->
                      <li class="menu-title">Les Rapports</li>

                      <li class="">
                          <a href="{{ route('admin.monthRapportView') }}"
                              class="waves-effect {{ request()->is('schedule') || request()->is('schedule/*') ? 'mm active' : '' }}">
                              <i class="ti-time"></i> <span> Rapport Mensuel </span>
                          </a>
                      </li>
                      <li class="">
                          <a href="{{ route('admin.teacherRapport') }}"
                              class="waves-effect {{ request()->is('check') || request()->is('check/*') ? 'mm active' : '' }}">
                              <i class="dripicons-to-do"></i> <span> Rapport Formateurs </span>
                          </a>
                      </li>
                      {{-- <li class="">
                          <a href=""
                              class="waves-effect {{ request()->is('sheet-report') || request()->is('sheet-report/*') ? 'mm active' : '' }}">
                      <i class="dripicons-to-do"></i> <span> Sheet Report </span>
                      </a>
                      </li>

                      <li class="">
                          <a href="" class="waves-effect {{ request()->is('attendance') || request()->is('attendance/*') ? 'mm active' : '' }}">
                              <i class="ti-calendar"></i> <span> Attendance Logs </span>
                          </a>
                      </li> --}}
                      <!-- <li class="menu-title">End</li> -->
                      {{-- <li class="">
                          <a href=""
                              class="waves-effect {{ request()->is('finger_device') || request()->is('finger_device/*') ? 'mm active' : '' }}">
                      <i class="fas fa-fingerprint"></i> <span> Biometric Device </span>
                      </a>
                      </li> --}}

                  </ul>
                  <!-- Log on to codeastro.com for more projects! -->
              </div>
              <!-- Sidebar -->
              <div class="clearfix"></div>

          </div>
          <!-- Sidebar -left -->

      </div>
      <!-- Left Sidebar End -->

      <style>

      </style>
