<div style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
            Detail Transaksi <span style="font-weight: 400; color: #94a3b8;">/ #<?= $data['pinjam']['id_pinjam']; ?></span>
        </h1>
        <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Rincian lengkap pengajuan dan status peminjaman alat Anda.</p>
    </div>
    <a href="<?= BASEURL; ?>/peminjaman/riwayat" class="modern-btn" style="background: white; color: var(--dark); border: 1px solid #e2e8f0;">
        <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
    </a>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2.5rem; align-items: start;">
    <!-- Main Detail Card -->
    <div class="glass-card" style="padding: 0; overflow: hidden; animation: fadeInUp 0.5s ease-out;">
        <div style="padding: 2rem; background: linear-gradient(to right, #f8fafc, #ffffff); border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">ID Transaksi</div>
                    <div style="font-weight: 800; color: var(--dark); font-size: 1.1rem;">#TRX-<?= str_pad($data['pinjam']['id_pinjam'], 5, '0', STR_PAD_LEFT); ?></div>
                </div>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Status Saat Ini</div>
                <?php if($data['pinjam']['status'] == 'menunggu') : ?>
                    <span style="background: #fffbeb; color: #d97706; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fas fa-spinner fa-spin"></i> MENUNGGU
                    </span>
                <?php elseif($data['pinjam']['status'] == 'disetujui') : ?>
                    <span style="background: #ecfdf5; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fas fa-check-circle"></i> DISETUJUI
                    </span>
                <?php elseif($data['pinjam']['status'] == 'ditolak') : ?>
                    <span style="background: #fef2f2; color: #dc2626; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fas fa-times-circle"></i> DITOLAK
                    </span>
                <?php elseif($data['pinjam']['status'] == 'kembali') : ?>
                    <span style="background: #eff6ff; color: #2563eb; padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fas fa-circle-check"></i> TELAH KEMBALI
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div style="padding: 2.5rem;">
            <h4 style="font-weight: 800; color: var(--dark); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-box-open" style="color: var(--primary);"></i> Daftar Alat yang Dipinjam
            </h4>
            <div style="background: #f8fafc; border-radius: 20px; overflow: hidden; border: 1px solid #f1f5f9;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f1f5f9;">
                            <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; width: 80px;">Foto</th>
                            <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">Alat Laboratorium</th>
                            <th style="padding: 1.25rem; text-align: center; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">Jumlah</th>
                            <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">Kondisi Awal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['detail'] as $det) : ?>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 1.25rem;">
                                <div style="width: 60px; height: 60px; border-radius: 12px; background: #ffffff; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px solid #f1f5f9; box-shadow: 0 4px 8px rgba(0,0,0,0.02);">
                                    <?php if($det['gambar'] && file_exists('img/alat/' . $det['gambar'])) : ?>
                                        <img src="<?= BASEURL; ?>/img/alat/<?= $det['gambar']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else : ?>
                                        <i class="fas fa-camera" style="color: #cbd5e1; font-size: 1.2rem;"></i>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td style="padding: 1.25rem; font-weight: 700; color: var(--dark);"><?= $det['nama_alat']; ?></td>
                            <td style="padding: 1.25rem; text-align: center;">
                                <span style="background: #eef2ff; color: var(--primary); padding: 4px 12px; border-radius: 8px; font-weight: 800; font-size: 0.9rem;">
                                    <?= $det['jumlah']; ?> Unit
                                </span>
                            </td>
                            <td style="padding: 1.25rem; font-weight: 600; color: #64748b;">
                                <span style="display: inline-flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-shield-check" style="color: #10b981;"></i> <?= $det['kondisi']; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 2.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div style="padding: 1.5rem; background: #f8fafc; border-radius: 20px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Timeline Peminjaman</div>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Tanggal Pinjam</span>
                            <span style="font-weight: 700; color: var(--dark);"><?= date('d M Y', strtotime($data['pinjam']['tanggal_pinjam'])); ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Deadline Kembali</span>
                            <span style="font-weight: 700; color: #e11d48;"><?= date('d M Y', strtotime($data['pinjam']['tanggal_kembali_rencana'])); ?></span>
                        </div>
                    </div>
                </div>
                <div style="padding: 1.5rem; background: #f8fafc; border-radius: 20px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Catatan Tambahan</div>
                    <p style="font-size: 0.85rem; font-weight: 600; color: #475569; line-height: 1.5; font-style: italic; margin-bottom: 1rem;">
                        "<?= $data['pinjam']['catatan'] ?: 'Tidak ada catatan tambahan untuk transaksi ini.'; ?>"
                    </p>
                    <div style="font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Foto Bukti Fisik</div>
                    <div style="width: 100%; height: 150px; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; background: white;">
                        <?php if(isset($data['pinjam']['gambar_bukti']) && $data['pinjam']['gambar_bukti'] && file_exists('img/peminjaman/' . $data['pinjam']['gambar_bukti'])) : ?>
                            <a href="<?= BASEURL; ?>/img/peminjaman/<?= $data['pinjam']['gambar_bukti']; ?>" target="_blank">
                                <img src="<?= BASEURL; ?>/img/peminjaman/<?= $data['pinjam']['gambar_bukti']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1;">
                                <i class="fas fa-image" style="font-size: 2rem;"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <!-- Status Guide Card -->
        <div class="glass-card" style="padding: 2rem; animation: slideInLeft 0.5s ease-out; border-bottom: 6px solid var(--dark);">
            <h4 style="font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-circle-info"></i> Panduan Status
            </h4>
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #f59e0b; margin-top: 5px; flex-shrink: 0;"></span>
                    <div style="font-size: 0.8rem; font-weight: 600; color: #475569;">
                        <strong style="color: var(--dark);">Menunggu:</strong> Sedang dalam antrian verifikasi petugas.
                    </div>
                </div>
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #10b981; margin-top: 5px; flex-shrink: 0;"></span>
                    <div style="font-size: 0.8rem; font-weight: 600; color: #475569;">
                        <strong style="color: var(--dark);">Disetujui:</strong> Alat sudah divalidasi dan siap/sedang digunakan.
                    </div>
                </div>
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #ef4444; margin-top: 5px; flex-shrink: 0;"></span>
                    <div style="font-size: 0.8rem; font-weight: 600; color: #475569;">
                        <strong style="color: var(--dark);">Ditolak:</strong> Pengajuan tidak sesuai prosedur lab.
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action Card -->
        <div class="glass-card" style="padding: 1.5rem; background: var(--dark); color: white; border-radius: 20px; text-align: center;">
            <div style="font-size: 2.5rem; opacity: 0.2; margin-bottom: 1rem;"><i class="fas fa-print"></i></div>
            <h5 style="font-weight: 700; margin-bottom: 10px;">Cetak Bukti Pinjam?</h5>
            <p style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 1.5rem;">Gunakan bukti cetak untuk pengambilan alat di petugas lab.</p>
            <button class="modern-btn" style="width: 100%; justify-content: center; background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); font-size: 0.8rem;">
                <i class="fas fa-download"></i> Download E-Receipt
            </button>
        </div>
    </div>
</div>
