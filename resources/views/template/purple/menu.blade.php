<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
            <div class="nav-profile-image">
                <img src="{{ asset('template/purple/images/faces/face1.jpg') }}" alt="profile" />
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
            </div>
            <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">{{ auth()->user()->nama }}</span>
                <span class="text-secondary text-small">{{ ucfirst(auth()->user()->level) }}</span>
            </div>
            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item @if(empty(Request::segment(1))) active @endif">
            <a class="nav-link" href="{{ route('home') }}">
            <span class="menu-title">Home</span>
            <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @php
            $sub_menu_dashboard = array("dashboard")
        @endphp
        <li class="nav-item @if(in_array(Request::segment(1),$sub_menu_dashboard)) active @endif">
            <a class="nav-link" data-bs-toggle="collapse" href="#dashboard" aria-expanded="@if(in_array(Request::segment(1),$sub_menu_dashboard)) false @else true @endif" aria-controls="page-layouts">
            <span class="menu-title">Dashboard</span>
            <i class="menu-arrow"></i>
            <i class="fa fa-dashboard menu-icon"></i>
            </a>
            <div class="collapse @if(in_array(Request::segment(1),$sub_menu_dashboard)) show @endif" id="dashboard">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2) == 'dashboard-produksi') active @endif" href="{{ route('dashboard.produksi') }}">Dashboard Produksi</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(2) == 'dashboard-keuangan') active @endif" href="{{ route('dashboard.keuangan') }}">Dashboard Keuangan</a>
                    </li>
                    
                </ul>
            </div>
        </li>

        @if(auth()->user()->level == "admin")
        
        
        <li class="nav-item @if(Request::segment(1) == 'periode') active @endif">
            <a class="nav-link" href="{{ route('periode') }}">
            <span class="menu-title">Periode</span>
            <i class="mdi mdi-calendar-multiple menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if(Request::segment(1) == 'rkap') active @endif">
            <a class="nav-link" href="{{ route('rkap') }}">
            <span class="menu-title">RKAP</span>
            <i class="mdi mdi-bulletin-board menu-icon"></i>
            </a>
        </li>

        @php
            $sub_menu_entitas = array("entitas","kategori-project","project")
        @endphp
        <li class="nav-item @if(in_array(Request::segment(1),$sub_menu_entitas)) active @endif">
            <a class="nav-link" data-bs-toggle="collapse" href="#Project" aria-expanded="@if(in_array(Request::segment(1),$sub_menu_entitas)) false @else true @endif" aria-controls="page-layouts">
            <span class="menu-title">Project</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
            <div class="collapse @if(in_array(Request::segment(1),$sub_menu_entitas)) show @endif" id="Project">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'entitas') active @endif" href="{{ route('entitas') }}">Entitas</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'kategori-project') active @endif" href="{{ route('kategori_project') }}">Kategori Project</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'project') active @endif" href="{{ route('project') }}">Project</a>
                    </li>
                </ul>
            </div>
        </li>

        @php
            $sub_menu_tenaga_kerja = array("job-type","job","tenaga-kerja")
        @endphp
        <li class="nav-item @if(in_array(Request::segment(1),$sub_menu_tenaga_kerja)) active @endif">
            <a class="nav-link" data-bs-toggle="collapse" href="#tenaga-kerja" aria-expanded="@if(in_array(Request::segment(1),$sub_menu_tenaga_kerja)) false @else true @endif" aria-controls="page-layouts">
            <span class="menu-title">SDM</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
            <div class="collapse @if(in_array(Request::segment(1),$sub_menu_tenaga_kerja)) show @endif" id="tenaga-kerja">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'job-type') active @endif" href="{{ route('job_type') }}">Tipe Jabatan</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'job') active @endif" href="{{ route('job') }}">Jabatan</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'tenaga-kerja') active @endif" href="{{ route('tenaga_kerja') }}">Tenaga Kerja</a>
                    </li>
                </ul>
            </div>
        </li>
        @php
            $keuangan = array("pbl","pbl-project")
        @endphp
        <li class="nav-item @if(in_array(Request::segment(1),$keuangan)) active @endif">
        <a class="nav-link" data-bs-toggle="collapse" href="#keuangan" aria-expanded="@if(in_array(Request::segment(1),$keuangan)) false @else true @endif" aria-controls="page-layouts">
            <span class="menu-title">Keuangan</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
            <div class="collapse @if(in_array(Request::segment(1),$keuangan)) show @endif" id="keuangan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'pbl') active @endif"  href="{{ route('pbl') }}">PBL</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link @if(Request::segment(1) == 'pbl-project') active @endif" href="{{ route('pbl_project') }}">PBL Produksi</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item @if(Request::segment(1) == 'user') active @endif">
            <a class="nav-link" href="{{ route('user') }}">
            <span class="menu-title">User</span>
            <i class="fa fa-user menu-icon"></i>
            </a>
        </li>

        @endif
    </ul>
</nav>
<!-- partial -->