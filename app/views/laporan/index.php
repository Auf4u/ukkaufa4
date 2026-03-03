<div style="margin-bottom: 2.5rem;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
        Pusat Laporan <span style="font-weight: 400; color: #94a3b8;">/ Export</span>
    </h1>
    <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Generate dokumen resmi peminjaman dan pengembalian untuk keperluan arsip.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
    <!-- Laporan Peminjaman -->
    <div class="glass-card" style="padding: 2rem; border-left: 6px solid var(--success);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
            <div>
                <div style="font-size: 0.75rem; font-weight: 800; color: var(--success); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Data Statistik</div>
                <h3 style="font-weight: 800; color: var(--dark);">Laporan Peminjaman</h3>
            </div>
            <div class="card-icon" style="background: #ecfdf5; color: var(--success);"><i class="fas fa-file-invoice"></i></div>
        </div>
        
        <div style="background: #f8fafc; border-radius: 16px; padding: 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 15px;">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--dark);"><?= $data['total_pinjaman']; ?></div>
            <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Total transaksi peminjaman tercatat</div>
        </div>

        <a href="<?= BASEURL; ?>/laporan/generate/peminjaman" class="modern-btn" target="_blank" style="width: 100%; justify-content: center; background: var(--success); color: white; padding: 1rem;">
            <i class="fas fa-print"></i> Generate PDF Peminjaman
        </a>
    </div>

    <!-- Laporan Pengembalian -->
    <div class="glass-card" style="padding: 2rem; border-left: 6px solid var(--primary);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
            <div>
                <div style="font-size: 0.75rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Data Statistik</div>
                <h3 style="font-weight: 800; color: var(--dark);">Laporan Pengembalian</h3>
            </div>
            <div class="card-icon" style="background: #eef2ff; color: var(--primary);"><i class="fas fa-undo-alt"></i></div>
        </div>
        
        <div style="background: #f8fafc; border-radius: 16px; padding: 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 15px;">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--dark);"><?= $data['total_kembali']; ?></div>
            <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Total alat yang telah dikembalikan</div>
        </div>

        <a href="<?= BASEURL; ?>/laporan/generate/pengembalian" class="modern-btn" target="_blank" style="width: 100%; justify-content: center; background: var(--primary); color: white; padding: 1rem;">
            <i class="fas fa-print"></i> Generate PDF Pengembalian
        </a>
    </div>
</div>

<?php if($_SESSION['user_session']['role'] == 'admin') : ?>
<div class="glass-card" style="margin-top: 2.5rem; border-style: dashed; border-width: 2px; background: transparent; text-align: center; padding: 3rem;">
    <div class="card-icon" style="background: #f1f5f9; color: #64748b; margin: 0 auto 1.5rem;"><i class="fas fa-tower-observation"></i></div>
    <h3 style="font-weight: 800; margin-bottom: 0.5rem;">Audit Trail & System Logs</h3>
    <p style="color: #64748b; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">Pantau jejak digital setiap pengguna untuk memastikan keamanan dan integritas data laboratorium.</p>
    <a href="<?= BASEURL; ?>/laporan/logs" class="modern-btn" style="background: var(--dark); color: white; padding: 0.8rem 2rem;">
        <i class="fas fa-list-check"></i> Buka Log Aktivitas
    </a>
</div>
<?php endif; ?>
