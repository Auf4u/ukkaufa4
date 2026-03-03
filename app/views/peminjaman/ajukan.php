<div style="margin-bottom: 2.5rem;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
        Konfirmasi <span style="font-weight: 400; color: #94a3b8;">/ Pengajuan Pinjam</span>
    </h1>
    <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Selesaikan detail pengajuan untuk memproses peminjaman alat.</p>
</div>

<div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2.5rem; align-items: start;">
    
    <!-- Left: Equipment Profile Card -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="glass-card" style="padding: 0; overflow: hidden; animation: slideInLeft 0.5s ease-out;">
            <div style="height: 250px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                <?php if($data['alat']['gambar'] && $data['alat']['gambar'] != 'default.png') : ?>
                    <img src="<?= BASEURL; ?>/img/alat/<?= $data['alat']['gambar']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else : ?>
                    <div style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: linear-gradient(135deg, #f8fafc, #e2e8f0); color: #cbd5e1;">
                        <i class="fas fa-camera" style="font-size: 3rem; margin-bottom: 10px;"></i>
                        <span style="font-size: 0.8rem; font-weight: 700; opacity: 0.5;">FOTO TIDAK TERSEDIA</span>
                    </div>
                <?php endif; ?>
                <div style="position: absolute; top: 20px; left: 20px;">
                    <span style="background: var(--primary); color: white; padding: 6px 15px; border-radius: 10px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                        <?= $data['alat']['nama_kategori'] ?? 'Kategori'; ?>
                    </span>
                </div>
            </div>
            <div style="padding: 2rem;">
                <h2 style="font-weight: 800; font-size: 1.75rem; color: var(--dark); margin-bottom: 1rem;"><?= $data['alat']['nama_alat']; ?></h2>
                <p style="color: #64748b; line-height: 1.6; margin-bottom: 2rem;"><?= $data['alat']['deskripsi']; ?></p>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="background: #f1f5f9; padding: 1rem; border-radius: 16px; text-align: center;">
                        <div style="font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px;">Kondisi</div>
                        <div style="font-weight: 700; color: var(--dark);"><?= $data['alat']['kondisi']; ?></div>
                    </div>
                    <div style="background: #f1f5f9; padding: 1rem; border-radius: 16px; text-align: center;">
                        <div style="font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px;">Stok Ready</div>
                        <div style="font-weight: 700; color: var(--dark);"><?= $data['alat']['stok']; ?> Unit</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card" style="padding: 1.5rem; background: #fffbeb; border-left: 6px solid #f59e0b; animation: slideInLeft 0.7s ease-out;">
            <h4 style="color: #92400e; font-weight: 800; margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-circle-exclamation"></i> Ketentuan Lab
            </h4>
            <ul style="color: #92400e; font-size: 0.85rem; font-weight: 600; padding-left: 1.25rem; line-height: 1.5;">
                <li>Cek fisik alat sebelum meninggalkan lab.</li>
                <li>Status peminjaman harus disetujui petugas.</li>
                <li>Denda keterlambatan berlaku otomatis.</li>
            </ul>
        </div>
    </div>

    <!-- Right: Application Form -->
    <div class="glass-card" style="padding: 3rem; animation: fadeInUp 0.5s ease-out;">
        <h3 style="font-weight: 800; font-size: 1.5rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 15px;">
            <div style="width: 40px; height: 40px; background: #eef2ff; color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                <i class="fas fa-file-pen"></i>
            </div>
            Detail Pengajuan
        </h3>

        <form action="<?= BASEURL; ?>/peminjaman/proses_ajukan" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_alat" value="<?= $data['alat']['id_alat']; ?>">

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; color: #475569; font-size: 0.9rem; margin-bottom: 0.75rem;">Upload Foto Kondisi Alat</label>
                <div style="position: relative; background: #f8fafc; border: 2px dashed #e2e8f0; padding: 1.5rem; border-radius: 16px; text-align: center; transition: 0.3s;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='#e2e8f0'">
                    <i class="fas fa-camera" style="font-size: 1.5rem; color: #94a3b8; margin-bottom: 10px; display: block;"></i>
                    <input type="file" name="gambar_bukti" accept="image/*" required style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                    <span style="font-size: 0.8rem; color: #64748b; font-weight: 600;">Klik atau seret foto ke sini untuk bukti kondisi alat</span>
                </div>
                <small style="color: #94a3b8; font-weight: 600; font-size: 0.75rem; margin-top: 5px; display: block;">Wajib melampirkan foto bukti fisik alat sebelum meminjam.</small>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; color: #475569; font-size: 0.9rem; margin-bottom: 0.75rem;">Jumlah yang Dipinjam</label>
                <div style="position: relative;">
                    <i class="fas fa-layer-group" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="number" name="jumlah" min="1" max="<?= $data['alat']['stok']; ?>" value="1" required
                        style="width: 100%; padding: 1rem 1.25rem 1rem 3.5rem; border-radius: 16px; border: 2px solid #f1f5f9; outline: none; transition: 0.3s; font-weight: 700;">
                </div>
                <small style="color: #94a3b8; font-weight: 600; font-size: 0.75rem; margin-top: 5px; display: block;">Maksimum peminjaman: <?= $data['alat']['stok']; ?> unit</small>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-weight: 700; color: #475569; font-size: 0.9rem; margin-bottom: 0.75rem;">Mulai Peminjaman</label>
                    <div style="position: relative;">
                        <i class="fas fa-calendar-check" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d'); ?>" required
                            style="width: 100%; padding: 1rem 1.25rem 1rem 3.5rem; border-radius: 16px; border: 2px solid #f1f5f9; outline: none; transition: 0.3s; font-weight: 700; font-family: inherit;">
                    </div>
                </div>
                <div>
                    <label style="display: block; font-weight: 700; color: #475569; font-size: 0.9rem; margin-bottom: 0.75rem;">Rencana Pengembalian</label>
                    <div style="position: relative;">
                        <i class="fas fa-calendar-arrow-down" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="date" name="tanggal_kembali_rencana" id="tgl_kembali" required
                            style="width: 100%; padding: 1rem 1.25rem 1rem 3.5rem; border-radius: 16px; border: 2px solid #f1f5f9; outline: none; transition: 0.3s; font-weight: 700; font-family: inherit;">
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 3rem;">
                <a href="<?= BASEURL; ?>/alat/daftar" class="modern-btn" style="flex: 1; justify-content: center; background: #f1f5f9; color: #64748b;">Batal</a>
                <button type="submit" class="modern-btn btn-glass-primary" style="flex: 2; justify-content: center; padding: 1rem;" 
                    onclick="return confirm('Kirimkan pengajuan peminjaman ini?')">
                    Konfirmasi Pinjam <i class="fas fa-paper-plane" style="margin-left: 10px;"></i>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    // Auto-set return date to +3 days from today
    window.addEventListener('load', function() {
        const today = new Date();
        const returnDate = new Date(today);
        returnDate.setDate(today.getDate() + 3);
        
        const year = returnDate.getFullYear();
        const month = String(returnDate.getMonth() + 1).padStart(2, '0');
        const day = String(returnDate.getDate()).padStart(2, '0');
        
        document.getElementById('tgl_kembali').value = `${year}-${month}-${day}`;
    });
</script>
