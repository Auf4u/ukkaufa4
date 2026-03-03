<div style="margin-bottom: 2.5rem;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
        Penyelesaian <span style="font-weight: 400; color: #94a3b8;">/ Pengembalian Alat</span>
    </h1>
    <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Verifikasi kondisi fisik dan hitung denda sebelum menutup transaksi.</p>
</div>

<div style="display: grid; grid-template-columns: 1.2fr 1.8fr; gap: 2.5rem; align-items: start;">
    
    <!-- Left: Transaction Summary -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="glass-card" style="padding: 2.5rem; animation: slideInLeft 0.5s ease-out; background: linear-gradient(135deg, #ffffff, #f8fafc);">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 2rem;">
                <div style="width: 50px; height: 50px; background: #fff7ed; color: #ea580c; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">ID Peminjaman</div>
                    <div style="font-weight: 800; color: var(--dark); font-size: 1.25rem;">#PI-<?= str_pad($data['pinjam']['id_pinjam'], 5, '0', STR_PAD_LEFT); ?></div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b; font-weight: 600; font-size: 0.9rem;">Rencana Kembali:</span>
                    <span style="font-weight: 800; color: var(--dark);" id="rencana_kembali"><?= $data['pinjam']['tanggal_kembali_rencana']; ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b; font-weight: 600; font-size: 0.9rem;">Status Saat Ini:</span>
                    <span style="background: #ecfdf5; color: #059669; padding: 4px 10px; border-radius: 8px; font-size: 0.7rem; font-weight: 800;">BERJALAN</span>
                </div>
            </div>

            <div style="background: #f1f5f9; padding: 1.5rem; border-radius: 20px;">
                <div style="font-size: 0.7rem; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 15px; display: flex; justify-content: space-between;">
                    Estimasi Denda <span>Rp 5.000 / Hari</span>
                </div>
                <div style="display: flex; align-items: flex-end; gap: 10px;">
                    <div style="font-size: 1.75rem; font-weight: 800; color: var(--dark);" id="fine-preview">Rp 0</div>
                    <div style="font-size: 0.8rem; font-weight: 700; color: #ef4444; margin-bottom: 5px;" id="late-days">0 Hari Terlambat</div>
                </div>
            </div>
        </div>

        <div class="glass-card" style="padding: 1.5rem; background: #eff6ff; border-left: 6px solid #2563eb;">
            <div style="display: flex; gap: 15px; align-items: center;">
                <i class="fas fa-robot" style="color: #2563eb; font-size: 1.5rem;"></i>
                <p style="margin:0; font-size: 0.8rem; font-weight: 600; color: #1e40af; line-height: 1.4;">
                    Sistem otomatis menghitung denda berdasarkan selisih tanggal pengembalian real-time.
                </p>
            </div>
        </div>
    </div>

    <!-- Right: Process Form -->
    <div class="glass-card" style="padding: 3rem; animation: fadeInUp 0.5s ease-out; background: #ffffff;">
        <h3 style="font-weight: 800; font-size: 1.5rem; margin-bottom: 2.5rem; display: flex; align-items: center; gap: 15px; color: var(--dark);">
            <div style="width: 44px; height: 44px; background: #fff7ed; color: #ea580c; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                <i class="fas fa-file-signature"></i>
            </div>
            Form Pengembalian
        </h3>

        <form action="<?= BASEURL; ?>/pengembalian/simpan" method="post">
            <input type="hidden" name="id_pinjam" value="<?= $data['pinjam']['id_pinjam']; ?>">
            <input type="hidden" name="tanggal_kembali_rencana" value="<?= $data['pinjam']['tanggal_kembali_rencana']; ?>">

            <div style="margin-bottom: 1.75rem;">
                <label style="display: block; font-weight: 700; color: #475569; font-size: 0.85rem; margin-bottom: 10px;">Tanggal Dikembalikan</label>
                <div style="position: relative;">
                    <i class="fas fa-calendar-check" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="date" name="tanggal_dikembalikan" id="tgl_kembali_real" value="<?= date('Y-m-d'); ?>" required
                        style="width: 100%; padding: 1rem 1.25rem 1rem 3.5rem; border-radius: 16px; border: 2px solid #f1f5f9; outline: none; transition: 0.3s; font-weight: 700; font-family: inherit;">
                </div>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <label style="display: block; font-weight: 700; color: #475569; font-size: 0.85rem; margin-bottom: 10px;">Kondisi Fisik Terakhir</label>
                <div style="position: relative;">
                    <i class="fas fa-magnifying-glass-chart" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <select name="kondisi_akhir" required
                        style="width: 100%; padding: 1rem 1.25rem 1rem 3.5rem; border-radius: 16px; border: 2px solid #f1f5f9; outline: none; transition: 0.3s; font-weight: 700; appearance: none; background: white;">
                        <option value="Sama dengan asal">🟢 Sama dengan Asal (Normal)</option>
                        <option value="Sangat Baik">💠 Sangat Baik (Mulus)</option>
                        <option value="Rusak">🔴 Rusak (Perlu Perbaikan)</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 3rem;">
                <a href="<?= BASEURL; ?>/peminjaman" class="modern-btn" style="flex: 1; justify-content: center; background: #f1f5f9; color: #64748b;">Batal</a>
                <button type="submit" class="modern-btn" style="flex: 2; justify-content: center; background: #f59e0b; color: white; padding: 1rem; box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);" 
                    onclick="return confirm('Selesaikan proses pengembalian alat ini?')">
                    Tutup Transaksi & Simpan <i class="fas fa-check-double" style="margin-left: 10px;"></i>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    function calculateFine() {
        const rencana = new Date(document.getElementById('rencana_kembali').innerText);
        const real = new Date(document.getElementById('tgl_kembali_real').value);
        
        // Reset hours for clean comparison
        rencana.setHours(0,0,0,0);
        real.setHours(0,0,0,0);
        
        const diffTime = real - rencana;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        const finePreview = document.getElementById('fine-preview');
        const lateDays = document.getElementById('late-days');
        
        if (diffDays > 0) {
            const fine = diffDays * 5000;
            finePreview.innerText = 'Rp ' + fine.toLocaleString('id-ID');
            lateDays.innerText = diffDays + ' Hari Terlambat';
            lateDays.style.color = '#ef4444';
        } else {
            finePreview.innerText = 'Rp 0';
            lateDays.innerText = 'Tepat Waktu';
            lateDays.style.color = '#10b981';
        }
    }

    document.getElementById('tgl_kembali_real').addEventListener('change', calculateFine);
    window.addEventListener('load', calculateFine);
</script>
