# DOKUMENTASI SISTEM PEMINJAMAN ALAT

## 1. Flowchart Login
```mermaid
graph TD
    A[Mulai] --> B[Masukkan Username & Password]
    B --> C{Username ada?}
    C -- Tidak --> D[Alert: User tidak ditemukan]
    D --> B
    C -- Ya --> E{Password MD5 cocok?}
    E -- Tidak --> F[Alert: Password salah]
    F --> B
    E -- Ya --> G{Status Aktif?}
    G -- Tidak --> H[Alert: Akun dinonaktifkan]
    H --> B
    G -- Ya --> I[Set Session User]
    I --> J[Masuk ke Dashboard sesuai Role]
    J --> K[Selesai]
```

## 2. Flowchart Peminjaman
```mermaid
graph TD
    A[Mulai] --> B[Peminjam Cari Alat]
    B --> C[Klik Pinjam & Isi Form]
    C --> D[Kirim Pengajuan (Status: Menunggu)]
    D --> E[Petugas/Admin cek Data Peminjaman]
    E --> F{Setujui?}
    F -- Tidak --> G[Status: Ditolak]
    F -- Ya --> H[Status: Disetujui]
    H --> I[Stok Alat Berkurang Otomatis]
    G --> J[Selesai]
    I --> J
```

## 3. Flowchart Pengembalian
```mermaid
graph TD
    A[Mulai] --> B[Petugas Klik Kembalikan]
    B --> C[Pilih Tanggal Kembali & Kondisi]
    C --> D{Terlambat?}
    D -- Ya --> E[Hitung Denda Otomatis]
    D -- Tidak --> F[Denda = 0]
    E --> G[Simpan Data Pengembalian]
    F --> G
    G --> H[Stok Alat Bertambah Otomatis]
    H --> I[Status Peminjaman: Kembali]
    I --> J[Selesai]
```

## 4. Entity Relationship Diagram (ERD) - Ringkasan
- **Users** (1) ---- (N) **Peminjaman**
- **Users** (1) ---- (N) **Log Aktivitas**
- **Kategori** (1) ---- (N) **Alat**
- **Alat** (1) ---- (N) **Detail Peminjaman**
- **Peminjaman** (1) ---- (1) **Detail Peminjaman**
- **Peminjaman** (1) ---- (1) **Pengembalian**
