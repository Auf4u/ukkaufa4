<div style="margin-bottom: 2.5rem;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
        Staff Station <span style="font-weight: 400; color: #94a3b8;">/ Monitoring</span>
    </h1>
    <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Panel Petugas: Pantau sirkulasi alat dan verifikasi pengajuan peminjam.</p>
</div>

<div class="grid-stats">
    <div class="glass-card" style="animation-delay: 0.1s; border-top: 4px solid var(--warning);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="stat-label">Butuh Persetujuan</div>
                <div class="stat-value"><?= $data['count_pinjam_pending']; ?></div>
            </div>
            <div class="card-icon" style="background: #fffbeb; color: var(--warning);"><i class="fas fa-file-signature"></i></div>
        </div>
        <a href="<?= BASEURL; ?>/peminjaman" class="modern-btn" style="margin-top: 1rem; padding: 0.5rem 1rem; font-size: 0.8rem; background: var(--warning); color: white; width: 100%; justify-content: center;">
            Proses Sekarang <i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i>
        </a>
    </div>

    <div class="glass-card" style="animation-delay: 0.2s; border-top: 4px solid var(--primary);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="stat-label">Alat di Peminjam</div>
                <div class="stat-value"><?= $data['count_pinjam_disetujui']; ?></div>
            </div>
            <div class="card-icon" style="background: #eef2ff; color: var(--primary);"><i class="fas fa-truck-fast"></i></div>
        </div>
        <a href="<?= BASEURL; ?>/pengembalian" class="modern-btn" style="margin-top: 1rem; padding: 0.5rem 1rem; font-size: 0.8rem; background: var(--primary); color: white; width: 100%; justify-content: center;">
            Cek Kendali <i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i>
        </a>
    </div>

    <div class="glass-card" style="animation-delay: 0.3s; border-top: 4px solid var(--danger);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="stat-label">Dana Kas Denda</div>
                <div class="stat-value" style="font-size: 1.25rem;">Rp <?= number_format($data['total_denda'], 0, ',', '.'); ?></div>
            </div>
            <div class="card-icon" style="background: #fef2f2; color: var(--danger);"><i class="fas fa-hand-holding-dollar"></i></div>
        </div>
        <a href="<?= BASEURL; ?>/pengembalian" class="modern-btn" style="margin-top: 1rem; padding: 0.5rem 1rem; font-size: 0.8rem; background: var(--danger); color: white; width: 100%; justify-content: center;">
            Riwayat Denda <i class="fas fa-history" style="font-size: 0.7rem;"></i>
        </a>
    </div>
</div>

<div class="glass-card" style="margin-top: 2rem; border-left: 6px solid #94a3b8;">
    <h3 style="font-weight: 700; margin-bottom: 1rem;">Instruksi Kerja Petugas:</h3>
    <ul style="color: #64748b; font-weight: 500; line-height: 1.8; padding-left: 1.25rem;">
        <li>Verifikasi kondisi fisik alat sebelum menyetujui peminjaman.</li>
        <li>Pastikan peminjam membawa Kartu Identitas saat pengambilan barang.</li>
        <li>Segera update status kondisi alat jika ditemukan kerusakan saat pengembalian.</li>
    </ul>
</div>
