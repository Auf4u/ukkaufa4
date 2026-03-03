<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.875rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem;">Antrian Peminjaman</h1>
        <p style="color: #64748b; font-weight: 500;">Kelola persetujuan, penolakan, dan proses pengembalian alat.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <div class="glass-card" style="padding: 0.5rem 1.25rem; background: #ecfdf5; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 10px;">
            <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></div>
            <span style="font-size: 0.8rem; font-weight: 700; color: #065f46;">Auto-Stock Sync Active</span>
        </div>
    </div>
</div>

<div class="modern-table-card">
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>Informasi Peminjam</th>
                    <th>Waktu Pengajuan</th>
                    <th>Rencana Kembali</th>
                    <th style="text-align: center;">Status</th>
                    <th width="200px" style="text-align: center;">Aksi Kendali</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($data['peminjaman'] as $p) : ?>
                <tr style="transition: 0.3s;">
                    <td style="font-weight: 700; color: var(--primary);">#<?= $i++; ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="avatar" style="width: 38px; height: 38px; font-size: 0.9rem; flex-shrink: 0; background: #f1f5f9; color: var(--dark);">
                                <?= substr($p['nama_lengkap'], 0, 1); ?>
                            </div>
                            <div>
                                <div style="font-weight: 700; color: #334155;"><?= $p['nama_lengkap']; ?></div>
                                <small style="color: #94a3b8;"><i class="fas fa-id-badge"></i> ID Transaksi: PI-<?= $p['id_pinjam']; ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: #475569; font-size: 0.9rem;"><?= date('d M Y', strtotime($p['tanggal_pinjam'])); ?></div>
                        <small style="color: #cbd5e1; font-weight: 500;">Oleh Siswa Terdaftar</small>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: #e11d48; font-size: 0.9rem;"><?= date('d M Y', strtotime($p['tanggal_kembali_rencana'])); ?></div>
                        <small style="color: #cbd5e1; font-weight: 500;">Batas Maksimum</small>
                    </td>
                    <td style="text-align: center;">
                        <?php if($p['status'] == 'menunggu') : ?>
                            <span class="status-badge" style="background: #fffbeb; color: #d97706; padding: 6px 14px;">
                                <i class="fas fa-clock fa-spin"></i> Menunggu
                            </span>
                        <?php elseif($p['status'] == 'disetujui') : ?>
                            <span class="status-badge" style="background: #ecfdf5; color: #059669; padding: 6px 14px;">
                                <i class="fas fa-check-circle"></i> Berlangsung
                            </span>
                        <?php elseif($p['status'] == 'ditolak') : ?>
                            <span class="status-badge" style="background: #fef2f2; color: #dc2626; padding: 6px 14px;">
                                <i class="fas fa-times-circle"></i> Ditolak
                            </span>
                        <?php elseif($p['status'] == 'kembali') : ?>
                            <span class="status-badge" style="background: #eff6ff; color: #2563eb; padding: 6px 14px;">
                                <i class="fas fa-history"></i> Selesai
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="<?= BASEURL; ?>/peminjaman/detail/<?= $p['id_pinjam']; ?>" class="action-link" style="background: #f1f5f9; color: #64748b;" title="Buka Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <?php if($p['status'] == 'menunggu') : ?>
                                <a href="<?= BASEURL; ?>/peminjaman/setujui/<?= $p['id_pinjam']; ?>" 
                                   class="action-link" style="background: #ecfdf5; color: #059669;" 
                                   onclick="return confirm('Setujui pengajuan alat ini? Stok akan otomatis terpotong.');"
                                   title="Setujui">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="<?= BASEURL; ?>/peminjaman/tolak/<?= $p['id_pinjam']; ?>" 
                                   class="action-link" style="background: #fef2f2; color: #dc2626;" 
                                   onclick="return confirm('Tolak pengajuan ini?');"
                                   title="Tolak">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if($p['status'] == 'disetujui') : ?>
                                <a href="<?= BASEURL; ?>/pengembalian/proses/<?= $p['id_pinjam']; ?>" 
                                   class="action-btn" style="background: var(--dark); color: white; border-radius: 10px; padding: 5px 15px; font-size: 0.75rem; font-weight: 800; text-decoration: none; display: flex; align-items: center; gap: 8px;"
                                   title="Proses Pengembalian">
                                    <i class="fas fa-rotate-left"></i> KEMBALI
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="glass-card" style="margin-top: 2rem; background: #eff6ff; border-left: 6px solid #2563eb;">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 45px; height: 45px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #2563eb; font-size: 1.2rem; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.1);">
            <i class="fas fa-robot"></i>
        </div>
        <div>
            <div style="font-weight: 800; color: #1e3a8a; font-size: 0.95rem;">Sistem Antrian Cerdas</div>
            <p style="color: #3b82f6; font-size: 0.85rem; font-weight: 600; margin: 0;">Persetujuan otomatis memotong stok gudang. Pastikan fisik alat sudah diserahkan sebelum mengklik setujui.</p>
        </div>
    </div>
</div>
