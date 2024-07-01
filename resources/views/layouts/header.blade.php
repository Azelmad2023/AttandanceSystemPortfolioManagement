   <!-- Top Bar Start -->
   <div class="topbar">

       <!-- LOGO -->
       {{-- <div class="topbar-left" style="display: flex; justify-content: center; align-items: center;">
           <a href="/" class="logo">
               <span>
                   <h1 style="color: #ffffff; font-size: 20px; font-family: 'Pacifico', cursive;">Attandance</h1>
               </span>
               <i>
                   <h1 style="font-family: 'Pacifico', cursive;">A</h1>
               </i>
           </a>
       </div> --}}

       <div class="topbar-left" style="display:flex; align-items:center; justify-content:center; background:#6c757d;">
           <a href="/" class="logo">
               {{-- <img src="{{ asset('assets/images/logpfe.jpg') }}" alt="Logo"
                   style="width: 65px; height: 65px; border-radius: 50%; object-fit: contain; "> --}}
               <img src="{{ asset('assets/images/GAFLOGO.JPEG ') }}" alt="Logo"
                   style="width: 50px; height: 50px; border-radius: 50%; object-fit: contain; ">
           </a>
       </div>

       <nav class="navbar-custom">
           <ul class="navbar-right d-flex list-inline float-right mb-0">

               <!-- full screen -->
               <li class="dropdown notification-list d-none d-md-block">
                   <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                       <i class="mdi mdi-fullscreen noti-icon"></i>
                   </a>
               </li>


               <li class="dropdown notification-list">
                   <div class="dropdown notification-list nav-pro-img">
                       <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown"
                           href="#" role="button" aria-haspopup="false" aria-expanded="false">
                           Admin
                       </a>
                       <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item text-danger" href="{{ route('admin_logout') }}"
                               onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i
                                   class="mdi mdi-power text-danger"></i> {{ __('Logout') }}</a>
                           <form id="logout-form" action="{{ route('admin_logout') }}" method="get"
                               style="display: none;">
                               @csrf
                           </form>
                       </div>
                   </div>
               </li>

           </ul>

           <ul class="list-inline menu-left mb-0">
               <li class="float-left">
                   <button class="button-menu-mobile  open-left waves-effect">
                       <i class="mdi mdi-menu"></i>
                   </button>
               </li>
           </ul>

       </nav>

   </div>
   <!-- Top Bar End -->
