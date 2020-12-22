<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Beridarah</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Bd</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item">
                <a href="<?= 'http://' . $_SERVER['SERVER_NAME']; ?>/beridarah/dashboard" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Daftar Menu</li>
            <?php if ($_SESSION['level'] == "admin") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= 'http://' . $_SERVER['SERVER_NAME']; ?>/beridarah/dashboard/donor"><i class="fas fa-hand-holding-heart"></i> <span>Jadi Pendonor</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= 'http://' . $_SERVER['SERVER_NAME']; ?>/beridarah/dashboard/request"><i class="fas fa-stethoscope"></i> <span>Request Donor Darah</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= 'http://' . $_SERVER['SERVER_NAME']; ?>/beridarah/dashboard/user"><i class="fas fa-user"></i> <span>User</span></a>
                </li>
            <?php } ?>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?= 'http://' . $_SERVER['SERVER_NAME']; ?>/beridarah/logout.php" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> KELUAR
            </a>
        </div>
    </aside>
</div>