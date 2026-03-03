<div style="margin-bottom: 2.5rem;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
        Riwayat Saya <span style="font-weight: 400; color: #94a3b8;">/ Aktivitas</span>
    </h1>
    <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Pantau status peminjaman dan riwayat pengembalian alat praktikum Anda.</p>
</div>

<div class="glass-card" style="padding: 2.5rem; animation: fadeInUp 0.5s ease-out;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="font-weight: 800; color: var(--dark);">Daftar Transaksi</h3>
        <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Menampilkan <?= count($data['peminjaman']); ?> aktivitas</div>
    </div>

    <div class="table-responsive">
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
            <thead>
                <tr style="text-align: left;">
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">No</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Tanggal Pinjam</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Rencana Kembali</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Status</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['peminjaman'])) : ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 4rem; color: #94a3b8; font-weight: 600;">
                            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"><i class="fas fa-folder-open"></i></div>
                            Belum ada riwayat peminjaman yang tercatat.
                        </td>
                    </tr>
                <?php endif; ?>

                <?php $i = 1; foreach($data['peminjaman'] as $p) : ?>
                <tr style="background: white; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: 0.3s;" onmouseover="this.style.transform='scale(1.002)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.06)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.03)'">
                    <td style="padding: 1.25rem 1rem; border-radius: 16px 0 0 16px; font-weight: 700; color: #64748b;"><?= $i++; ?>.</td>
                    <td style="padding: 1.25rem 1rem;">
                        <div style="font-weight: 700; color: var(--dark);"><?= date('d M Y', strtotime($p['tanggal_pinjam'])); ?></div>
                        <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 600;">Mulai Peminjaman</div>
                    </td>
                    <td style="padding: 1.25rem 1rem;">
                        <div style="font-weight: 700; color: #475569;"><?= date('d M Y', strtotime($p['tanggal_kembali_rencana'])); ?></div>
                        <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 600;">Target Dikembalikan</div>
                    </td>
                    <td style="padding: 1.25rem 1rem;">
                        <?php if($p['status'] == 'menunggu') : ?>
                            <span style="background: #fffbeb; color: #d97706; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-spinner fa-spin"></i> MENUNGGU
                            </span>
                        <?php elseif($p['status'] == 'disetujui') : ?>
                            <span style="background: #ecfdf5; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-check-circle"></i> DISEJUJI
                            </span>
                        <?php elseif($p['status'] == 'ditolak') : ?>
                            <span style="background: #fef2f2; color: #dc2626; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-times-circle"></i> DITOLAK
                            </span>
                        <?php elseif($p['status'] == 'kembali') : ?>
                            <span style="background: #eff6ff; color: #2563eb; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-hand-holding-heart"></i> KEMBALI
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 1.25rem 1rem; border-radius: 0 16px 16px 0; text-align: right; display: flex; gap: 8px; justify-content: flex-end;">
                        <?php if($p['status'] == 'menunggu') : ?>
                            <a href="<?= BASEURL; ?>/peminjaman/batal/<?= $p['id_pinjam']; ?>" class="modern-btn" style="padding: 0.6rem 1.2rem; font-size: 0.8rem; background: #fee2e2; color: #dc2626; font-weight: 800; display: inline-flex; border: 1px solid #fecaca;" onclick="return confirm('Batalkan pengajuan peminjaman ini?');">
                                BATAL <i class="fas fa-times" style="font-size: 0.7rem; margin-left: 8px;"></i>
                            </a>
                        <?php endif; ?>
                        <a href="<?= BASEURL; ?>/peminjaman/detail/<?= $p['id_pinjam']; ?>" class="modern-btn" style="padding: 0.6rem 1.2rem; font-size: 0.8rem; background: #f1f5f9; color: var(--dark); font-weight: 800; display: inline-flex; border: 1px solid #e2e8f0;">
                            DETAIL <i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-left: 8px;"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="glass-card" style="margin-top: 2rem; border-left: 6px solid var(--primary); background: #f8fafc;">
    <div style="display: flex; gap: 20px; align-items: center;">
        <div style="width: 50px; height: 50px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.25rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            <i class="fas fa-info-circle"></i>
        </div>
        <div>
            <div style="font-weight: 800; color: var(--dark); font-size: 0.95rem;">Butuh bantuan dengan pengajuan?</div>
            <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Silakan hubungi petugas lab di ruang inventaris jika status pengajuan tidak berubah dalam 24 jam.</p>
        </div>
    </div>
</div>
