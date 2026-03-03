<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.875rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem;">Kelola Pengguna</h1>
        <p style="color: #64748b; font-weight: 500;">Manajemen akses dan hak akses untuk Admin, Petugas, dan Peminjam.</p>
    </div>
    <button type="button" class="modern-btn btn-glass-primary tombolTambahDataUser" data-toggle="modal" data-target="#formModalUser"
            style="padding: 1rem 2rem; border-radius: 18px; background: linear-gradient(135deg, var(--primary), var(--secondary)); box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4); border: 1px solid rgba(255,255,255,0.1); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <i class="fas fa-user-plus" style="font-size: 1.1rem;"></i> 
        <span style="letter-spacing: 1px; font-weight: 800;">TAMBAH USER BARU</span>
    </button>
</div>

<div class="modern-table-card">
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>Nama & Username</th>
                    <th>Hak Akses (Role)</th>
                    <th>Status Akun</th>
                    <th width="150px" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($data['users'] as $user) : ?>
                <tr>
                    <td style="font-weight: 700; color: var(--primary);">#<?= $i++; ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="avatar" style="width: 38px; height: 38px; font-size: 0.9rem; flex-shrink: 0;">
                                <?= substr($user['nama_lengkap'], 0, 1); ?>
                            </div>
                            <div>
                                <div style="font-weight: 700; color: #334155;"><?= $user['nama_lengkap']; ?></div>
                                <small style="color: #94a3b8;"><i class="fas fa-at"></i> <?= $user['username']; ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                            $roleIcon = 'fa-user-tie';
                            $roleColor = '#6366f1';
                            if($user['role'] == 'petugas') { $roleIcon = 'fa-user-shield'; $roleColor = '#8b5cf6'; }
                            if($user['role'] == 'peminjam') { $roleIcon = 'fa-user-graduate'; $roleColor = '#10b981'; }
                        ?>
                        <span class="status-badge" style="background: rgba(<?= hexdec(substr($roleColor,1,2)); ?>, <?= hexdec(substr($roleColor,3,2)); ?>, <?= hexdec(substr($roleColor,5,2)); ?>, 0.1); color: <?= $roleColor; ?>;">
                            <i class="fas <?= $roleIcon; ?>"></i> <?= ucfirst($user['role']); ?>
                        </span>
                    </td>
                    <td>
                        <?php if($user['status'] == 'aktif') : ?>
                            <span class="status-badge badge-success">
                                <i class="fas fa-check-circle"></i> Aktif
                            </span>
                        <?php else : ?>
                            <span class="status-badge badge-danger">
                                <i class="fas fa-ban"></i> Non-Aktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="<?= BASEURL; ?>/user/ubah/<?= $user['id_user']; ?>" 
                               class="action-link edit-link tampilModalUbahUser" 
                               data-toggle="modal" 
                               data-target="#formModalUser" 
                               data-id="<?= $user['id_user']; ?>"
                               title="Edit User">
                                <i class="fas fa-user-pen"></i>
                            </a>
                            <a href="<?= BASEURL; ?>/user/hapus/<?= $user['id_user']; ?>" 
                               class="action-link delete-link" 
                               onclick="return confirm('Hapus pengguna ini? Semua data aktivitas pengguna ini akan hilang.');"
                               title="Hapus User">
                                <i class="fas fa-user-xmark"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal User -->
<div class="modal fade" id="formModalUser" tabindex="-1" role="dialog" aria-labelledby="judulModalUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 28px; border: 1px solid rgba(255,255,255,0.2); overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
      <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #f1f5f9; padding: 1.5rem 2rem;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="width: 42px; height: 42px; background: var(--secondary); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; box-shadow: 0 8px 16px rgba(168, 85, 247, 0.2);">
                <i class="fas fa-user-plus"></i>
            </div>
            <h5 class="modal-title" id="judulModalUser" style="font-weight: 800; color: var(--dark); letter-spacing: -0.5px;">Data Keanggotaan User</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background:none; border:none; font-size: 1.5rem; color: #94a3b8; transition: 0.3s; padding: 0;" onmouseover="this.style.color='var(--danger)'" onmouseout="this.style.color='#94a3b8'">
            <i class="fas fa-times"></i>
        </button>
      </div>
      <form action="<?= BASEURL; ?>/user/tambah" method="post">
        <div class="modal-body" style="padding: 2.5rem 2rem; background: #ffffff;">
            <input type="hidden" name="id_user" id="id_user">
            
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <!-- Full Name -->
                <div class="form-group">
                    <label for="nama" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Nama Lengkap Pengguna</label>
                    <div style="position: relative;">
                        <i class="fas fa-id-card" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap" required
                               style="width: 100%; border-radius: 12px; padding: 0.85rem 1rem 0.85rem 3.5rem; border: 2px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; transition: 0.3s;">
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <!-- Username -->
                    <div class="form-group">
                        <label for="username" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">ID / Username</label>
                        <div style="position: relative;">
                            <i class="fas fa-at" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                            <input type="text" class="form-control" id="username" name="username" placeholder="ex: admin01" required
                                   style="width: 100%; border-radius: 12px; padding: 0.85rem 1rem 0.85rem 3.5rem; border: 2px solid #e2e8f0; font-weight: 700; font-size: 0.9rem; color: var(--secondary);">
                        </div>
                    </div>
                    <!-- Role -->
                    <div class="form-group">
                        <label for="role" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Level Hak Akses</label>
                        <select class="form-control" id="role" name="role" required
                                style="width: 100%; border-radius: 12px; height: auto; padding: 0.85rem 1rem; border: 2px solid #e2e8f0; font-weight: 600; font-size: 0.9rem;">
                            <option value="admin">Level: Administrator</option>
                            <option value="petugas">Level: Petugas Lab</option>
                            <option value="peminjam">Level: Peminjam / Siswa</option>
                        </select>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Kata Sandi (Keamanan)</label>
                    <div style="position: relative;">
                        <i class="fas fa-key" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••"
                               style="width: 100%; border-radius: 12px; padding: 0.85rem 1rem 0.85rem 3.5rem; border: 2px solid #e2e8f0; font-weight: 600; font-size: 0.95rem;">
                    </div>
                    <div id="passwordHint" style="display:none; margin-top: 10px; padding: 8px 12px; background: #eff6ff; border-radius: 8px; border: 1px solid #dbeafe;">
                        <small style="color: #2563eb; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-circle-info"></i> Kosongkan jika password tidak diubah.
                        </small>
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group" id="statusGroup" style="display:none;">
                    <label for="status" style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 8px;">Status Aktivitas Akun</label>
                    <select class="form-control" id="status" name="status"
                            style="width: 100%; border-radius: 12px; height: auto; padding: 0.85rem 1rem; border: 2px solid #e2e8f0; font-weight: 700; font-size: 0.9rem;">
                        <option value="aktif">🟢 Aktif (Izin Akses Penuh)</option>
                        <option value="nonaktif">🔴 Non-Aktif (Akses Dicekal)</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="padding: 1.5rem 2rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; gap: 1rem; justify-content: flex-end;">
            <button type="button" class="modern-btn" data-dismiss="modal" style="background: transparent; color: #64748b; font-weight: 700; border: none;">Batal</button>
            <button type="submit" class="modern-btn btn-glass-primary" style="background: var(--secondary); padding: 0.85rem 2rem; border-radius: 14px; font-weight: 800; font-size: 0.95rem; box-shadow: 0 10px 20px rgba(168, 85, 247, 0.2);">
                <i class="fas fa-user-check" style="margin-right: 8px;"></i> Simpan Data User
            </button>
        </div>
      </form>
    </div>
  </div>
</div>
