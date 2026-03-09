<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> | LabApp Pro</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>const BASEURL = '<?= BASEURL; ?>';</script>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-inner">
            <div class="sidebar-brand">
                <div class="brand-logo" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border-radius: 12px; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3); border: 1px solid rgba(255,255,255,0.1);">
                    <i class="fas fa-microscope"></i>
                </div>
                <h2 style="font-size: 1.6rem; font-weight: 800; color: white; letter-spacing: -1px; margin: 0;">Lab<span style="color: var(--primary);">App</span> <span style="font-size: 0.65rem; background: var(--primary); padding: 2px 6px; border-radius: 6px; vertical-align: top; margin-left: 2px; font-weight: 800;">PRO</span></h2>
            </div>

            <nav class="nav-menu">
                <!-- Dashboard Section -->
                <div class="nav-item <?= ($data['judul'] == 'Dashboard') ? 'active' : ''; ?>">
                    <a href="<?= BASEURL; ?>" class="nav-link">
                        <i class="fas fa-house-chimney"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <?php if($_SESSION['user_session']['role'] == 'admin') : ?>
                    <div style="padding: 1.5rem 0.5rem 0.5rem; color: #475569; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.6;">Sistem & Inventaris</div>
                    <div class="nav-item <?= ($data['judul'] == 'Daftar Kategori') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/kategori" class="nav-link">
                            <i class="fas fa-tags"></i>
                            <span>Kategori Alat</span>
                        </a>
                    </div>
                    <div class="nav-item <?= ($data['judul'] == 'Daftar Alat') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/alat" class="nav-link">
                            <i class="fas fa-microchip"></i>
                            <span>Inventaris</span>
                        </a>
                    </div>
                    <div class="nav-item <?= ($data['judul'] == 'Manajemen User') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/user" class="nav-link">
                            <i class="fas fa-users-gear"></i>
                            <span>Manajemen User</span>
                        </a>
                    </div>

                    <div style="padding: 1.5rem 0.5rem 0.5rem; color: #475569; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.6;">Transaksi & Laporan</div>
                    <div class="nav-item <?= ($data['judul'] == 'Data Peminjaman') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/peminjaman" class="nav-link">
                            <i class="fas fa-hand-holding-box"></i>
                            <span>Peminjaman</span>
                        </a>
                    </div>
                    <div class="nav-item <?= ($data['judul'] == 'Data Pengembalian') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/pengembalian" class="nav-link">
                            <i class="fas fa-arrow-rotate-left"></i>
                            <span>Pengembalian</span>
                        </a>
                    </div>
                    <div class="nav-item <?= ($data['judul'] == 'Cetak Laporan') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/laporan" class="nav-link">
                            <i class="fas fa-chart-pie"></i>
                            <span>Cetak Laporan</span>
                        </a>
                    </div>
                    <div class="nav-item <?= ($data['judul'] == 'Log Aktivitas') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/laporan/logs" class="nav-link">
                            <i class="fas fa-receipt"></i>
                            <span>Log Sistem</span>
                        </a>
                    </div>
                <?php endif; ?>


                <?php if($_SESSION['user_session']['role'] == 'peminjam') : ?>
                    <div class="nav-item <?= ($data['judul'] == 'Daftar Alat (Peminjam)') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/alat/daftar" class="nav-link">
                            <i class="fas fa-magnifying-glass"></i>
                            <span>Cari & Pinjam</span>
                        </a>
                    </div>
                    <div class="nav-item <?= ($data['judul'] == 'Riwayat Peminjaman Saya') ? 'active' : ''; ?>">
                        <a href="<?= BASEURL; ?>/peminjaman/riwayat" class="nav-link">
                            <i class="fas fa-timeline"></i>
                            <span>Riwayat Saya</span>
                        </a>
                    </div>
                <?php endif; ?>
            </nav>

            <!-- User Info Sidebar Card -->
            <div class="sidebar-user">
                <div class="avatar" style="width: 32px; height: 32px; font-size: 0.8rem; flex-shrink: 0;">
                    <?= substr($_SESSION['user_session']['nama_lengkap'], 0, 1); ?>
                </div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name"><?= $_SESSION['user_session']['nama_lengkap']; ?></div>
                    <div class="sidebar-user-role"><?= $_SESSION['user_session']['role']; ?></div>
                </div>
                <a href="<?= BASEURL; ?>/auth/logout" style="color: #f43f5e; font-size: 1rem; opacity: 0.7; transition: 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7">
                    <i class="fas fa-power-off"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main id="main">
        <!-- Modern Navbar -->
        <header class="top-navbar">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Ketik untuk mencari...">
            </div>

            <div class="nav-actions">
                <button class="action-btn" title="Notifikasi"><i class="fas fa-bell"></i></button>
                <div class="profile-trigger">
                    <div style="text-align: right;">
                        <div style="font-weight: 700; font-size: 0.85rem; color: var(--dark);"><?= explode(' ', $_SESSION['user_session']['nama_lengkap'])[0]; ?></div>
                        <div style="font-size: 0.7rem; color: #64748b; font-weight: 700;">ONLINE</div>
                    </div>
                    <div class="avatar" style="width: 34px; height: 34px;">
                        <?= substr($_SESSION['user_session']['nama_lengkap'], 0, 1); ?>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Flash Messages -->
        <div style="margin-bottom: 2rem;">
            <?php Flasher::flash(); ?>
        </div>
