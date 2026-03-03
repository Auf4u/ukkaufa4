<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
            Katalog Alat <span style="font-weight: 400; color: #94a3b8;">/ Peminjaman</span>
        </h1>
        <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Temukan dan ajukan peminjaman alat praktik dengan mudah.</p>
    </div>
</div>

<!-- Search and Filter (Visual Only for now as requested UI focus) -->
<div class="glass-card" style="padding: 1.5rem; margin-bottom: 3rem; display: flex; gap: 1rem; align-items: center; background: rgba(255,255,255,0.6);">
    <div style="flex: 1; position: relative;">
        <i class="fas fa-search" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
        <input type="text" placeholder="Ketik nama alat atau merk untuk mencari..." 
               style="width: 100%; padding: 0.85rem 1rem 0.85rem 3.5rem; border-radius: 14px; border: 2px solid #f1f5f9; outline: none; transition: 0.3s; font-family: inherit; font-weight: 600;">
    </div>
    <select style="padding: 0.85rem 1.5rem; border-radius: 14px; border: 2px solid #f1f5f9; outline: none; background: white; font-weight: 600; color: #475569;">
        <option>Semua Kategori</option>
        <?php foreach($data['kategori'] as $kg) : ?>
            <option><?= $kg['nama_kategori']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
    <?php foreach($data['alat'] as $al) : ?>
    <div class="glass-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s ease;">
        <!-- Image Header -->
        <div style="height: 180px; background: #f1f5f9; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 15px; right: 15px; z-index: 10;">
                <span class="status-badge <?= ($al['stok'] > 0) ? 'badge-success' : 'badge-danger'; ?>" style="box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    <?= ($al['stok'] > 0) ? '<i class="fas fa-check-circle"></i> Tersedia' : '<i class="fas fa-times-circle"></i> Habis'; ?>
                </span>
            </div>
            
            <?php if($al['gambar'] && $al['gambar'] != 'default.png') : ?>
                <img src="<?= BASEURL; ?>/img/alat/<?= $al['gambar']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
            <?php else : ?>
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 3rem;">
                    <i class="fas fa-microscope"></i>
                </div>
            <?php endif; ?>

            <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 15px; background: linear-gradient(transparent, rgba(0,0,0,0.6));">
                <span style="font-size: 0.7rem; font-weight: 800; color: white; background: var(--primary); padding: 4px 10px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <?= $al['nama_kategori']; ?>
                </span>
            </div>
        </div>

        <!-- Content Body -->
        <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
            <h3 style="font-weight: 800; font-size: 1.25rem; color: var(--dark); margin-bottom: 0.5rem; line-height: 1.2;"><?= $al['nama_alat']; ?></h3>
            <p style="color: #64748b; font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.25rem; flex: 1;">
                <?= (strlen($al['deskripsi']) > 80) ? substr($al['deskripsi'], 0, 80) . '...' : $al['deskripsi']; ?>
            </p>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; background: #f8fafc; padding: 10px 15px; border-radius: 12px;">
                <div>
                    <div style="font-size: 0.7rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Stok Ready</div>
                    <div style="font-weight: 800; color: <?= ($al['stok'] > 0) ? 'var(--dark)' : 'var(--danger)'; ?>;"><?= $al['stok']; ?> <small>Unit</small></div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.7rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Kondisi</div>
                    <div style="font-weight: 700; color: #475569; font-size: 0.9rem;"><?= $al['kondisi']; ?></div>
                </div>
            </div>

            <?php if($al['stok'] > 0) : ?>
                <a href="<?= BASEURL; ?>/peminjaman/ajukan/<?= $al['id_alat']; ?>" class="modern-btn btn-glass-primary" style="width: 100%; justify-content: center; padding: 1rem;">
                    <i class="fas fa-hand-holding-medical"></i> Ajukan Pinjam
                </a>
            <?php else : ?>
                <button class="modern-btn" disabled style="width: 100%; justify-content: center; background: #e2e8f0; color: #94a3b8; cursor: not-allowed;">
                    Stok Tidak Tersedia
                </button>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
