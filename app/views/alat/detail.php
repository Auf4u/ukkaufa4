<div style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
            Profil Aset <span style="font-weight: 400; color: #94a3b8;">/ Detail Teknis</span>
        </h1>
        <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Spesifikasi lengkap dan status ketersediaan inventaris laboratorium.</p>
    </div>
    <a href="<?= BASEURL; ?>/alat" class="modern-btn" style="background: white; color: var(--dark); border: 1px solid #e2e8f0;">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2.5rem; align-items: start;">
    
    <!-- Left Side: Visual Media -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem; animation: slideInLeft 0.5s ease-out;">
        <div class="glass-card" style="padding: 0; overflow: hidden; position: relative;">
            <div style="height: 350px; background: #f8fafc; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <?php if($data['alat']['gambar'] && $data['alat']['gambar'] != 'default.png') : ?>
                    <img src="<?= BASEURL; ?>/img/alat/<?= $data['alat']['gambar']; ?>" style="width: 100%; height: 100%; object-fit: cover; transition: 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <?php else : ?>
                    <div style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: linear-gradient(135deg, #f8fafc, #e2e8f0); color: #cbd5e1;">
                        <i class="fas fa-microscope" style="font-size: 5rem; margin-bottom: 15px;"></i>
                        <span style="font-size: 0.9rem; font-weight: 800; opacity: 0.5; letter-spacing: 2px;">GAMBAR TIDAK TERSEDIA</span>
                    </div>
                <?php endif; ?>
            </div>
            
            <div style="position: absolute; top: 20px; left: 20px;">
                <span style="background: var(--dark); color: white; padding: 6px 15px; border-radius: 10px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                    REF: AL-<?= str_pad($data['alat']['id_alat'], 4, '0', STR_PAD_LEFT); ?>
                </span>
            </div>
        </div>

        <div class="glass-card" style="padding: 1.5rem; text-align: center; border-bottom: 4px solid var(--primary);">
            <div style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">ID QR Code Inventaris</div>
            <div style="font-size: 3rem; color: var(--dark); opacity: 0.1;"><i class="fas fa-qrcode"></i></div>
            <p style="font-size: 0.75rem; color: #64748b; margin-top: 10px; font-weight: 600;">E-Label terdaftar dalam sistem aset sekolah.</p>
        </div>
    </div>

    <!-- Right Side: Technical Specs -->
    <div style="display: flex; flex-direction: column; gap: 2rem; animation: fadeInUp 0.5s ease-out;">
        <div class="glass-card" style="padding: 2.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
                <div>
                    <h2 style="font-weight: 800; font-size: 2rem; color: var(--dark); margin-bottom: 5px;"><?= $data['alat']['nama_alat']; ?></h2>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="background: #e0e7ff; color: #4338ca; padding: 4px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase;">
                            <i class="fas fa-tag"></i> Hardware
                        </span>
                        <span style="color: #94a3b8; font-weight: 700;">•</span>
                        <span style="color: #64748b; font-weight: 600; font-size: 0.85rem;">Terakhir Update: <?= date('d M Y'); ?></span>
                    </div>
                </div>
                
                <?php 
                    $badgeStyle = 'background: #ecfdf5; color: #059669;';
                    $icon = 'fa-check';
                    if($data['alat']['kondisi'] == 'Rusak Ringan') { $badgeStyle = 'background: #fff9db; color: #f59f00;'; $icon = 'fa-triangle-exclamation'; }
                    if($data['alat']['kondisi'] == 'Rusak Berat') { $badgeStyle = 'background: #fff5f5; color: #fa5252;'; $icon = 'fa-circle-xmark'; }
                ?>
                <div style="<?= $badgeStyle; ?> padding: 10px 18px; border-radius: 14px; font-weight: 800; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;">
                    <i class="fas <?= $icon; ?>"></i> <?= strtoupper($data['alat']['kondisi']); ?>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
                <div style="background: #f8fafc; padding: 1.5rem; border-radius: 20px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Total Unit</div>
                    <div style="display: flex; align-items: baseline; gap: 5px;">
                        <span style="font-size: 1.75rem; font-weight: 800; color: var(--dark);"><?= $data['alat']['stok']; ?></span>
                        <span style="font-weight: 700; color: #64748b; font-size: 0.9rem;">Tersedia</span>
                    </div>
                </div>
                <div style="background: #f8fafc; padding: 1.5rem; border-radius: 20px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Kelayakan Pinjam</div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <?php if($data['alat']['stok'] > 0 && $data['alat']['kondisi'] != 'Rusak Berat') : ?>
                            <i class="fas fa-circle-check" style="color: #10b981; font-size: 1.25rem;"></i>
                            <span style="font-weight: 800; color: #10b981; font-size: 1.1rem;">SIAP PAKAI</span>
                        <?php else : ?>
                            <i class="fas fa-circle-xmark" style="color: #ef4444; font-size: 1.25rem;"></i>
                            <span style="font-weight: 800; color: #ef4444; font-size: 1.1rem;">TIDAK TERSEDIA</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <h4 style="font-weight: 800; font-size: 1rem; color: var(--dark); margin-bottom: 1rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-file-lines" style="color: var(--primary);"></i> Deskripsi Teknis
                </h4>
                <div style="padding: 1.5rem; background: #ffffff; border-radius: 20px; border: 2px solid #f1f5f9; color: #475569; line-height: 1.7; font-weight: 500;">
                    <?= $data['alat']['deskripsi'] ?: 'Tidak ada deskripsi teknis untuk item ini.'; ?>
                </div>
            </div>

            <div style="display: flex; gap: 1rem;">
                <?php if($_SESSION['user_session']['role'] == 'peminjam' && $data['alat']['stok'] > 0 && $data['alat']['kondisi'] != 'Rusak Berat') : ?>
                    <a href="<?= BASEURL; ?>/peminjaman/ajukan/<?= $data['alat']['id_alat']; ?>" class="modern-btn btn-glass-primary" style="flex: 2; justify-content: center; padding: 1.25rem; font-size: 1rem;">
                        <i class="fas fa-hand-holding-medical"></i> Ajukan Peminjaman Sekarang
                    </a>
                <?php endif; ?>
                
                <?php if($_SESSION['user_session']['role'] == 'admin') : ?>
                    <a href="<?= BASEURL; ?>/alat" class="modern-btn" style="flex: 1; justify-content: center; background: #f8fafc; border: 1px solid #e2e8f0; color: var(--dark); text-decoration: none;">
                        <i class="fas fa-pen-to-square"></i> Edit Data
                    </a>
                    <a href="<?= BASEURL; ?>/alat/hapus/<?= $data['alat']['id_alat']; ?>" 
                       class="modern-btn" 
                       style="flex: 1; justify-content: center; background: #fff5f5; color: #fa5252; border: 1px solid #ffe3e3; text-decoration: none;"
                       onclick="return confirm('Hapus alat ini dari inventaris?');">
                        <i class="fas fa-trash-can"></i> Hapus
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Extra Note -->
        <div style="padding: 1.5rem; background: #f1f5f9; border-radius: 20px; border-left: 6px solid #64748b;">
            <p style="margin: 0; font-size: 0.85rem; color: #475569; font-weight: 600; line-height: 1.5;">
                <i class="fas fa-shield-halved" style="margin-right: 8px; color: #475569;"></i> 
                <strong>Standar Penggunaan:</strong> Alat ini memerlukan verifikasi fisik oleh petugas sebelum dan sesudah digunakan untuk menjamin integritas aset laboratorium.
            </p>
        </div>
    </div>
</div>
