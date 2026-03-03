<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.875rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem;">Inventaris Alat</h1>
        <p style="color: #64748b; font-weight: 500;">Kelola ketersediaan dan kondisi aset laboratorium.</p>
    </div>
    <?php if($_SESSION['user_session']['role'] == 'admin') : ?>
    <button type="button" class="modern-btn btn-glass-primary tombolTambahDataAlat" data-toggle="modal" data-target="#formModalAlat"
            style="padding: 1rem 2rem; border-radius: 18px; background: linear-gradient(135deg, var(--primary), var(--secondary)); box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4); border: 1px solid rgba(255,255,255,0.1); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <i class="fas fa-plus-circle" style="font-size: 1.1rem;"></i> 
        <span style="letter-spacing: 0.5px;">TAMBAH ALAT BARU</span>
    </button>
    <?php endif; ?>
</div>

<div class="modern-table-card">
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status Kondisi</th>
                    <th width="150px" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($data['alat'] as $al) : ?>
                <tr>
                    <td style="font-weight: 700; color: var(--primary);">#<?= $i++; ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #f1f5f9; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #e2e8f0;">
                                <?php if($al['gambar'] && $al['gambar'] != 'default.png') : ?>
                                    <img src="<?= BASEURL; ?>/img/alat/<?= $al['gambar']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else : ?>
                                    <i class="fas fa-microchip" style="color: #cbd5e1; font-size: 1.2rem;"></i>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div style="font-weight: 700; color: #334155;"><?= $al['nama_alat']; ?></div>
                                <small style="color: #94a3b8;"><?= substr($al['deskripsi'], 0, 50); ?>...</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge" style="background: #e0e7ff; color: #4338ca;">
                            <i class="fas fa-tag" style="font-size: 0.7rem;"></i> <?= $al['nama_kategori']; ?>
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 800; font-size: 1.1rem; <?= ($al['stok'] <= 5) ? 'color: var(--danger);' : 'color: var(--success);'; ?>">
                            <?= $al['stok']; ?> <small style="font-weight: 500; font-size: 0.8rem; color: #94a3b8;">Unit</small>
                        </div>
                    </td>
                    <td>
                        <?php 
                            $badgeClass = 'badge-success';
                            $icon = 'fa-check-circle';
                            if($al['kondisi'] == 'Rusak Ringan') { $badgeClass = 'badge-warning'; $icon = 'fa-exclamation-triangle'; }
                            if($al['kondisi'] == 'Rusak Berat') { $badgeClass = 'badge-danger'; $icon = 'fa-times-circle'; }
                        ?>
                        <span class="status-badge <?= $badgeClass; ?>">
                            <i class="fas <?= $icon; ?>"></i> <?= $al['kondisi']; ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="<?= BASEURL; ?>/alat/detail/<?= $al['id_alat']; ?>" class="action-link" style="background: #f1f5f9; color: #64748b;" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if($_SESSION['user_session']['role'] == 'admin') : ?>
                            <a href="<?= BASEURL; ?>/alat/ubah/<?= $al['id_alat']; ?>" 
                               class="action-link edit-link tampilModalUbahAlat" 
                               data-toggle="modal" 
                               data-target="#formModalAlat" 
                               data-id="<?= $al['id_alat']; ?>"
                               title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="<?= BASEURL; ?>/alat/hapus/<?= $al['id_alat']; ?>" 
                               class="action-link delete-link" 
                               onclick="return confirm('Hapus alat ini dari inventaris?');"
                               title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Enhanced Pagination -->
    <nav class="mt-5">
        <div style="display: flex; justify-content: center; gap: 10px; align-items: center;">
            <a href="<?= BASEURL; ?>/alat/<?= $data['current_page'] - 1; ?>" 
               class="modern-btn <?= ($data['current_page'] <= 1) ? 'disabled' : ''; ?>" 
               style="padding: 0.5rem 1rem; background: #f1f5f9; color: #64748b; <?= ($data['current_page'] <= 1) ? 'pointer-events: none; opacity: 0.5;' : ''; ?>">
                <i class="fas fa-chevron-left"></i> Prev
            </a>
            
            <?php for($i = 1; $i <= $data['total_pages']; $i++) : ?>
                <a href="<?= BASEURL; ?>/alat/<?= $i; ?>" 
                   class="modern-btn" 
                   style="width: 40px; height: 40px; padding: 0; justify-content: center; <?= ($i == $data['current_page']) ? 'background: var(--primary); color: white;' : 'background: white; color: #64748b; border: 1px solid #e2e8f0;'; ?>">
                    <?= $i; ?>
                </a>
            <?php endfor; ?>

            <a href="<?= BASEURL; ?>/alat/<?= $data['current_page'] + 1; ?>" 
               class="modern-btn <?= ($data['current_page'] >= $data['total_pages']) ? 'disabled' : ''; ?>" 
               style="padding: 0.5rem 1rem; background: #f1f5f9; color: #64748b; <?= ($data['current_page'] >= $data['total_pages']) ? 'pointer-events: none; opacity: 0.5;' : ''; ?>">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </nav>
</div>

<!-- Modal Alat -->
<div class="modal fade" id="formModalAlat" tabindex="-1" role="dialog" aria-labelledby="judulModalAlat" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 28px; border: 1px solid rgba(255,255,255,0.2); overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
      <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #f1f5f9; padding: 1.5rem 2rem;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="width: 42px; height: 42px; background: var(--primary); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);">
                <i class="fas fa-microchip"></i>
            </div>
            <h5 class="modal-title" id="judulModalAlat" style="font-weight: 800; color: var(--dark); letter-spacing: -0.5px;">Data Inventaris Alat</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background:none; border:none; font-size: 1.5rem; color: #94a3b8; transition: 0.3s; padding: 0;" onmouseover="this.style.color='var(--danger)'" onmouseout="this.style.color='#94a3b8'">
            <i class="fas fa-times"></i>
        </button>
      </div>
      <form action="<?= BASEURL; ?>/alat/tambah" method="post" enctype="multipart/form-data">
        <div class="modal-body" style="padding: 2.5rem 2rem; background: #ffffff;">
            <input type="hidden" name="id_alat" id="id_alat">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                <!-- Left Side: Basic Info -->
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    <div style="padding: 1.5rem; background: #f8fafc; border-radius: 20px; border: 1px solid #f1f5f9;">
                        <h6 style="font-weight: 800; font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle"></i> Informasi Dasar
                        </h6>
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label for="nama_alat" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Nama Lengkap Alat</label>
                            <input type="text" class="form-control" id="nama_alat" name="nama_alat" placeholder="Masukan nama merk/type" required
                                   style="border-radius: 12px; padding: 0.75rem 1rem; border: 2px solid #e2e8f0; font-weight: 600; font-size: 0.9rem; transition: 0.3s;">
                        </div>
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label for="id_kategori" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Kategori Inventaris</label>
                            <select class="form-control" id="id_kategori" name="id_kategori" required
                                    style="border-radius: 12px; height: auto; padding: 0.75rem 1rem; border: 2px solid #e2e8f0; font-weight: 600; font-size: 0.9rem;">
                                 <option value="">Pilih Kategori...</option>
                                 <?php foreach($data['kategori'] as $kg) : ?>
                                    <option value="<?= $kg['id_kategori']; ?>"><?= $kg['nama_kategori']; ?></option>
                                 <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="stok" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Jumlah Kuantitas</label>
                            <input type="number" class="form-control" id="stok" name="stok" min="0" placeholder="0" required
                                   style="border-radius: 12px; padding: 0.75rem 1rem; border: 2px solid #e2e8f0; font-weight: 700; font-size: 0.95rem; color: var(--primary);">
                        </div>
                    </div>
                </div>

                <!-- Right Side: Details & Media -->
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    <div style="padding: 1.25rem; background: #ffffff; border-radius: 20px; border: 2px solid #f1f5f9;">
                         <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label for="kondisi" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Status Kondisi Barang</label>
                            <select class="form-control" id="kondisi" name="kondisi" required
                                    style="border-radius: 12px; height: auto; padding: 0.75rem 1rem; border: 2px solid #e2e8f0; font-weight: 600; font-size: 0.9rem;">
                                <option value="Baik">🟢 Kondisi Baik (Siap Pakai)</option>
                                <option value="Rusak Ringan">🟡 Rusak Ringan (Perlu Cek)</option>
                                <option value="Rusak Berat">🔴 Rusak Berat (Mati Total)</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label for="deskripsi" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Spesifikasi / Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tambahkan spesifikasi teknis alat..."
                                      style="border-radius: 16px; padding: 1rem; border: 2px solid #e2e8f0; font-size: 0.85rem; line-height: 1.6; font-weight: 500;"></textarea>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 10px;">Foto Produk Alat</label>
                            <div style="padding: 1.25rem; border: 2px dashed #cbd5e1; border-radius: 16px; text-align: center; background: #f8fafc; transition: 0.3s;" 
                                 onmouseover="this.style.borderColor='var(--primary)'; this.style.background='#f0f9ff'" 
                                 onmouseout="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc'">
                                <input type="file" id="gambar" name="gambar" style="display: none;">
                                <label for="gambar" style="cursor: pointer; margin: 0; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <i class="fas fa-cloud-arrow-up" style="font-size: 1.5rem; color: var(--primary);"></i>
                                    <span style="font-weight: 800; font-size: 0.8rem; color: #475569;">Klik untuk pilih file foto</span>
                                    <span style="font-size: 0.65rem; color: #94a3b8; font-weight: 600;">PNG, JPG atau WEBP (Maks. 2MB)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="padding: 1.5rem 2rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; gap: 1rem; justify-content: flex-end;">
            <button type="button" class="modern-btn" data-dismiss="modal" style="background: transparent; color: #64748b; font-weight: 700; border: none;">Batal</button>
            <button type="submit" class="modern-btn btn-glass-primary" style="padding: 0.85rem 2rem; border-radius: 14px; font-weight: 800; font-size: 0.95rem;">
                <i class="fas fa-save" style="margin-right: 8px;"></i> Simpan Ke Inventaris
            </button>
        </div>
      </form>
    </div>
  </div>
</div>
