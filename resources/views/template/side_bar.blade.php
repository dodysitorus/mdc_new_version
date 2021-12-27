<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Medan Dental Center</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MDC</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Starter</li>
            @if(auth()->user()->role=='Super Admin')
            <li><a class="nav-link" href="{{route('user.index')}}"><i class="fas fa-id-card-alt"></i> <span>User</span></a></li>
            @endif
            <li><a class="nav-link" href="{{route('klinik.index')}}"><i class="fas fa-clinic-medical"></i> <span>Klinik</span></a></li>
            <li><a class="nav-link" href="{{route('dokter.index')}}"><i class="fas fa-user-md"></i> <span>Dokter</span></a></li>
            <li><a class="nav-link" href="{{route('layanan.index')}}"><i class="fas fa-briefcase-medical"></i> <span>Layanan</span></a></li>
            <li><a class="nav-link" href="{{route('pasien.index')}}"><i class="fas fa-diagnoses"></i> <span>Pasien</span></a></li>
            <li><a class="nav-link" href="{{route('pasien_member.index')}}"><i class="fas fa-diagnoses"></i> <span>Pasien Member</span></a></li>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://www.medandentalcenter.com/" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> About Us
            </a>
        </div>
    </aside>
</div>
