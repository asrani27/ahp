
<section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    
    <li class="header">DATA MASTER</li>
    
    
    <li class="{{ (request()->is('superadmin/user*')) ? 'active' : '' }}"><a href="/superadmin/user"><i class="fa fa-check"></i> <span>Data User</span></a></li>
    <li class="{{ (request()->is('superadmin/kategori*')) ? 'active' : '' }}"><a href="/superadmin/kategori"><i class="fa fa-check"></i> <span>Data Kriteria</span></a></li>
    <li class="{{ (request()->is('superadmin/guru*')) ? 'active' : '' }}"><a href="/superadmin/guru"><i class="fa fa-check"></i> <span>Data Guru</span></a></li>
    <li class="{{ (request()->is('superadmin/ahp*')) ? 'active' : '' }}"><a href="/superadmin/ahp"><i class="fa fa-check"></i> <span>SPK AHP</span></a></li>

    {{-- <li class="header">DATA LAPORAN</li>
    <li class="{{ (request()->is('superadmin/laporan*')) ? 'active' : '' }}"><a href="/superadmin/laporan"><i class="fa fa-check"></i> <span>Laporan</span></a></li> --}}

    <li class="header">SETTING</li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    
    @endif
    </ul>
    
</section>