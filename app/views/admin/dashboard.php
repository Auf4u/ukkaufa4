<!-- Welcome Section -->
<div style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
            Control Center <span style="font-weight: 400; color: #94a3b8;">/ Overview</span>
        </h1>
        <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Selamat datang kembali, Administrator. Berikut adalah ringkasan performa sistem hari ini.</p>
    </div>
    <div style="text-align: right;">
        <div style="font-size: 0.85rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Server Status</div>
        <div style="display: flex; align-items: center; gap: 8px; background: #ecfdf5; color: #10b981; padding: 6px 12px; border-radius: 10px; font-weight: 700; font-size: 0.8rem;">
            <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; display: block; animation: pulse-glow 2s infinite;"></span>
            SYSTEM OPERATIONAL
        </div>
    </div>
</div>

<!-- Stats Horizontal -->
<div class="grid-stats">
    <div class="glass-card" style="animation-delay: 0.1s; border-top: 4px solid #6366f1;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="stat-label">Total Inventaris</div>
                <div class="stat-value"><?= $data['count_alat']; ?></div>
            </div>
            <div class="card-icon icon-blue"><i class="fas fa-boxes-stacked"></i></div>
        </div>
        <div style="margin-top: 1rem; font-size: 0.8rem; color: #10b981; font-weight: 700;">
            <i class="fas fa-arrow-up"></i> Terdata di sistem
        </div>
    </div>

    <div class="glass-card" style="animation-delay: 0.2s; border-top: 4px solid #a855f7;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="stat-label">Pengajuan Aktif</div>
                <div class="stat-value"><?= $data['count_pinjam_pending']; ?></div>
            </div>
            <div class="card-icon icon-purple"><i class="fas fa-clock-pulse"></i></div>
        </div>
        <div style="margin-top: 1rem; font-size: 0.8rem; color: #f59e0b; font-weight: 700;">
            <i class="fas fa-hourglass-half"></i> Menunggu tinjauan
        </div>
    </div>

    <div class="glass-card" style="animation-delay: 0.3s; border-top: 4px solid #10b981;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="stat-label">Total Pengguna</div>
                <div class="stat-value"><?= $data['count_user']; ?></div>
            </div>
            <div class="card-icon icon-emerald"><i class="fas fa-users-viewfinder"></i></div>
        </div>
        <div style="margin-top: 1rem; font-size: 0.8rem; color: #64748b; font-weight: 700;">
            Hak akses terkelola
        </div>
    </div>

    <div class="glass-card" style="animation-delay: 0.4s; border-top: 4px solid #f43f5e;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="stat-label">Total Kas Denda</div>
                <div class="stat-value" style="font-size: 1.25rem;">Rp <?= number_format($data['total_denda'], 0, ',', '.'); ?></div>
            </div>
            <div class="card-icon icon-rose"><i class="fas fa-hand-holding-dollar"></i></div>
        </div>
        <div style="margin-top: 1rem; font-size: 0.8rem; color: #ef4444; font-weight: 700;">
            <i class="fas fa-triangle-exclamation"></i> Dari keterlambatan
        </div>
    </div>
</div>

<!-- Main Grid -->
<div style="display: grid; grid-template-columns: 1.8fr 1fr; gap: 2rem; margin-top: 2.5rem;">
    
    <!-- Recent Activity Feed -->
    <div class="glass-card" style="padding: 2rem; animation-delay: 0.5s;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 style="font-weight: 800; letter-spacing: -0.5px;">Aktivitas Terakhir Sistem</h3>
            <a href="<?= BASEURL; ?>/laporan/logs" style="text-decoration: none; color: var(--primary); font-size: 0.85rem; font-weight: 700;">Lihat Semua Log <i class="fas fa-arrow-right"></i></a>
        </div>

        <div style="position: relative;">
            <div style="position: absolute; left: 15px; top: 0; bottom: 0; width: 2px; background: #f1f5f9;"></div>
            
            <?php foreach($data['recent_logs'] as $log) : ?>
            <div style="display: flex; gap: 20px; margin-bottom: 1.5rem; position: relative;">
                <div style="width: 32px; height: 32px; background: white; border: 2px solid var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 1; font-size: 0.7rem; color: var(--primary);">
                    <i class="fas fa-circle"></i>
                </div>
                <div>
                    <div style="font-weight: 700; color: #334155; font-size: 0.95rem;"><?= $log['aktivitas']; ?></div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 4px;">
                        <span style="font-size: 0.8rem; color: #94a3b8; font-weight: 600;"><i class="fas fa-user"></i> <?= $log['username']; ?></span>
                        <span style="font-size: 0.8rem; color: #cbd5e1;">•</span>
                        <span style="font-size: 0.8rem; color: #94a3b8;"><i class="far fa-clock"></i> <?= date('H:i, d M', strtotime($log['tanggal'])); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Quick Actions & System Info -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <!-- Quick Actions -->
        <div class="glass-card" style="padding: 2rem; animation-delay: 0.6s; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;">
            <h3 style="margin-bottom: 1.5rem; font-weight: 800;">Aksi Cepat</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <a href="<?= BASEURL; ?>/alat" class="modern-btn" style="background: rgba(255,255,255,0.1); color: white; justify-content: center; font-size: 0.8rem; padding: 1rem; border: 1px solid rgba(255,255,255,0.2);">
                    <i class="fas fa-plus"></i> Alat Baru
                </a>
                <a href="<?= BASEURL; ?>/user" class="modern-btn" style="background: rgba(255,255,255,0.1); color: white; justify-content: center; font-size: 0.8rem; padding: 1rem; border: 1px solid rgba(255,255,255,0.2);">
                    <i class="fas fa-user-plus"></i> User Baru
                </a>
                <a href="<?= BASEURL; ?>/laporan/logs" class="modern-btn" style="grid-column: span 2; background: white; color: var(--primary); justify-content: center; font-size: 0.9rem; padding: 1rem;">
                    <i class="fas fa-file-shield"></i> Audit Log Sistem
                </a>
            </div>
        </div>

        <!-- System Guard Info -->
        <div class="glass-card" style="padding: 1.5rem; animation-delay: 0.7s; border-left: 6px solid #f59e0b;">
            <h4 style="margin-bottom: 10px; display:flex; align-items:center; gap:8px;">
                <i class="fas fa-shield-halved" style="color: #f59e0b;"></i> Security Audit
            </h4>
            <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                Sistem mendeteksi <strong><?= $data['count_user']; ?></strong> personel aktif dengan <strong><?= $data['count_pinjam_pending']; ?></strong> transaksi yang memerlukan otorisasi administrator hari ini.
            </p>
        </div>
    </div>

</div>
