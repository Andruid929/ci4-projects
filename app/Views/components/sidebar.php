<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <?php
    
    use App\Helpers\RolesHelper;
    
    $dashboardUrl = site_url('dashboard');
    
    if (auth()->user()->inGroup('admin')) {
        $dashboardUrl = site_url('dashboard/admin');
        
    } elseif (auth()->user()->inGroup('manager')) {
        $dashboardUrl = site_url('dashboard/manager');
    }
    ?>
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $dashboardUrl ?>">
        <div class="sidebar-brand-text mx-3">Employee manager</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= $dashboardUrl ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Summary -->
    <?php
    if (auth()->user()->inGroup(RolesHelper::ADMIN, RolesHelper::MANAGER)): ?>
    
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('summary') ?>">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Summary</span></a>
    </li>
    
    <?php
    endif; ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Requests
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= $dashboardUrl . '?page=deleted' ?>">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Deleted requests</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
