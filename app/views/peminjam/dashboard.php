<div style="margin-bottom: 2.5rem;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--dark); letter-spacing: -1.5px; margin-bottom: 0.5rem;">
        Student Portal <span style="font-weight: 400; color: #94a3b8;">/ Dashboard</span>
    </h1>
    <p style="color: #64748b; font-weight: 500; font-size: 1.1rem;">Selamat datang di LabApp. Pinjam alat laboratorium dengan cepat dan mudah.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
    <!-- Action Search -->
    <div class="glass-card" style="padding: 2.5rem; text-align: center; border-bottom: 6px solid var(--primary);">
        <div class="card-icon" style="width: 80px; height: 80px; font-size: 2.5rem; background: #eef2ff; color: var(--primary); margin: 0 auto 1.5rem;">
            <i class="fas fa-magnifying-glass"></i>
        </div>
        <h2 style="font-weight: 800; margin-bottom: 1rem;">Cari & Pinjam Alat</h2>
        <p style="color: #64748b; font-weight: 500; margin-bottom: 2rem;">Jelajahi katalog alat laboratorium yang tersedia untuk dipinjam hari ini.</p>
        <a href="<?= BASEURL; ?>/alat/daftar" class="modern-btn btn-glass-primary" style="width: 100%; justify-content: center; padding: 1.25rem;">
            Buka Katalog <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Action History -->
    <div class="glass-card" style="padding: 2.5rem; text-align: center; border-bottom: 6px solid var(--accent);">
        <div class="card-icon" style="width: 80px; height: 80px; font-size: 2.5rem; background: #fff1f2; color: var(--accent); margin: 0 auto 1.5rem;">
            <i class="fas fa-timeline"></i>
        </div>
        <h2 style="font-weight: 800; margin-bottom: 1rem;">Riwayat Aktivitas</h2>
        <p style="color: #64748b; font-weight: 500; margin-bottom: 2rem;">Pantau status peminjaman Anda dan lihat daftar alat yang sedang dipinjam.</p>
        <a href="<?= BASEURL; ?>/peminjaman/riwayat" class="modern-btn" style="width: 100%; justify-content: center; padding: 1.25rem; background: #1e293b; color: white;">
            Lihat Riwayat <i class="fas fa-clock-rotate-left"></i>
        </a>
    </div>
</div>

<div class="glass-card" style="margin-top: 2.5rem; background: linear-gradient(135deg, #f8fafc, #f1f5f9); color: var(--dark);">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="font-size: 2rem; color: var(--primary);"><i class="fas fa-lightbulb"></i></div>
        <p style="font-weight: 600; font-size: 0.95rem; color: #475569;">
            <strong>Tips:</strong> Kembalikan alat tepat waktu untuk menjaga reputasi peminjaman Anda di Laboratorium.
        </p>
    </div>
</div>
