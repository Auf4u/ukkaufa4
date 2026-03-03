<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.875rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem;">Kategori Alat</h1>
        <p style="color: #64748b; font-weight: 500;">Kelola departemen dan pengelompokan inventaris alat.</p>
    </div>
    <button type="button" class="modern-btn btn-glass-primary tombolTambahDataKategori" data-toggle="modal" data-target="#formModalKategori"
            style="padding: 1rem 2rem; border-radius: 18px; background: linear-gradient(135deg, var(--primary), var(--secondary)); box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4); border: 1px solid rgba(255,255,255,0.1); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <i class="fas fa-folder-plus" style="font-size: 1.1rem;"></i> 
        <span style="letter-spacing: 1px; font-weight: 800;">TAMBAH KATEGORI</span>
    </button>
</div>

<div class="modern-table-card">
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Nama Kategori</th>
                    <th width="120px" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($data['kategori'] as $kg) : ?>
                <tr>
                    <td style="font-weight: 700; color: var(--primary);">#<?= $i++; ?></td>
                    <td>
                        <div style="font-weight: 700; color: #334155;"><?= $kg['nama_kategori']; ?></div>
                        <small style="color: #94a3b8;">ID: KAT-00<?= $kg['id_kategori']; ?></small>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?= BASEURL; ?>/kategori/ubah/<?= $kg['id_kategori']; ?>" 
                           class="action-link edit-link tampilModalUbahKategori" 
                           data-toggle="modal" 
                           data-target="#formModalKategori" 
                           data-id="<?= $kg['id_kategori']; ?>"
                           title="Edit Kategori">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <a href="<?= BASEURL; ?>/kategori/hapus/<?= $kg['id_kategori']; ?>" 
                           class="action-link delete-link" 
                           onclick="return confirm('Yakin ingin menghapus kategori ini? Semua alat dalam kategori ini mungkin akan terpengaruh.');"
                           title="Hapus Kategori">
                            <i class="fas fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Kategori -->
<div class="modal fade" id="formModalKategori" tabindex="-1" role="dialog" aria-labelledby="judulModalKategori" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModalKategori">Tambah Kategori Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background:none; border:none; font-size: 1.5rem;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= BASEURL; ?>/kategori/tambah" method="post">
        <div class="modal-body">
            <input type="hidden" name="id_kategori" id="id_kategori">
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori (ex: Elektronik, Kayu, dll)" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modern-btn" data-dismiss="modal" style="background: #f1f5f9; color: #64748b;">Batal</button>
            <button type="submit" class="modern-btn btn-glass-primary">Simpan Kategori</button>
        </div>
      </form>
    </div>
  </div>
</div>
