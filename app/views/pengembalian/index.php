<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.875rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem;">Arsip Pengembalian</h1>
        <p style="color: #64748b; font-weight: 500;">Daftar aset laboratorium yang telah berhasil dikembalikan ke gudang.</p>
    </div>
    <div class="glass-card" style="padding: 0.5rem 1.25rem; background: #eff6ff; border: 1px solid #dbeafe; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-history" style="color: #2563eb;"></i>
        <span style="font-size: 0.8rem; font-weight: 700; color: #1e40af;">Total: <?= count($data['pengembalian']); ?> Aset</span>
    </div>
</div>

<div class="modern-table-card">
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>Peminjam</th>
                    <th>Waktu Aktivitas</th>
                    <th style="text-align: center;">Durasi Keterlambatan</th>
                    <th style="text-align: center;">Total Denda</th>
                    <th style="text-align: center;">Kondisi Akhir</th>
                    <th width="100px" style="text-align: center;">Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['pengembalian'])) : ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 4rem; color: #94a3b8; font-weight: 600;">
                            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"><i class="fas fa-box-open"></i></div>
                            Belum ada data pengembalian yang tercatat.
                        </td>
                    </tr>
                <?php endif; ?>

                <?php $i = 1; foreach($data['pengembalian'] as $pk) : ?>
                <?php 
                    $tgl_rencana = new DateTime($pk['tanggal_kembali_rencana']);
                    $tgl_kembali = new DateTime($pk['tanggal_dikembalikan']);
                    $late_days = 0;
                    if($tgl_kembali > $tgl_rencana) {
                        $diff = $tgl_kembali->diff($tgl_rencana);
                        $late_days = $diff->days;
                    }
                ?>
                <tr>
                    <td style="font-weight: 700; color: var(--primary);">#<?= $i++; ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="avatar" style="width: 38px; height: 38px; font-size: 0.85rem; flex-shrink: 0; background: #f8fafc; color: var(--dark); border: 2px solid #e2e8f0;">
                                <?= substr($pk['nama_lengkap'], 0, 1); ?>
                            </div>
                            <div>
                                <div style="font-weight: 700; color: #334155;"><?= $pk['nama_lengkap']; ?></div>
                                <small style="color: #94a3b8;"><i class="fas fa-check-circle" style="color: #10b981;"></i> Status: Verifikasi Selesai</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: #475569; font-size: 0.85rem;">
                            <i class="fas fa-calendar-day" style="width: 15px; color: #94a3b8;"></i> <?= date('d M Y', strtotime($pk['tanggal_dikembalikan'])); ?>
                        </div>
                        <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 500; margin-top: 4px;">Asal Pinjam: <?= date('d/m/y', strtotime($pk['tanggal_pinjam'])); ?></div>
                    </td>
                    <td style="text-align: center;">
                        <?php if($late_days > 0) : ?>
                            <div style="font-weight: 800; color: #ef4444; font-size: 0.9rem;"><?= $late_days; ?> Hari</div>
                            <small style="color: #94a3b8; font-weight: 600; font-size: 0.65rem;">@ Rp 5.000 / Hari</small>
                        <?php else : ?>
                            <span style="color: #10b981; font-weight: 700; font-size: 0.85rem;">Tepat Waktu</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if($pk['denda'] > 0) : ?>
                            <span style="background: #fef2f2; color: #dc2626; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; border: 1px solid #fee2e2;">
                                Rp <?= number_format($pk['denda'], 0, ',', '.'); ?>
                            </span>
                        <?php else : ?>
                            <span style="background: #ecfdf5; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; border: 1px solid #d1fae5;">
                                <i class="fas fa-check"></i> NIHIL
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <?php 
                            $kondisiClass = 'background: #f1f5f9; color: #475569;';
                            $iconKondisi = 'fa-info-circle';
                            if($pk['kondisi_akhir'] == 'Sangat Baik' || $pk['kondisi_akhir'] == 'Sama dengan asal') {
                                $kondisiClass = 'background: #f0f9ff; color: #0369a1;';
                                $iconKondisi = 'fa-shield-heart';
                            } elseif($pk['kondisi_akhir'] == 'Rusak') {
                                $kondisiClass = 'background: #fff7ed; color: #9a3412;';
                                $iconKondisi = 'fa-triangle-exclamation';
                            }
                        ?>
                        <span style="<?= $kondisiClass; ?> padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas <?= $iconKondisi; ?>"></i> <?= $pk['kondisi_akhir']; ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?= BASEURL; ?>/peminjaman/detail/<?= $pk['id_pinjam']; ?>" class="action-link" style="background: #f1f5f9; color: #64748b;" title="Buka Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
