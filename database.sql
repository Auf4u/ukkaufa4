-- Database: db_peminjaman_alat
-- --------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_md5` varchar(255) NOT NULL, -- Application logic will use MD5
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
-- (Passwords are MD5 hashes of '12345')
--

INSERT INTO `users` (`username`, `password_md5`, `nama_lengkap`, `role`, `status`) VALUES
('admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Administrator', 'admin', 'aktif'),
('petugas', '827ccb0eea8a706c4c34a16891f84e7b', 'Petugas Lab', 'petugas', 'aktif'),
('siswa', '827ccb0eea8a706c4c34a16891f84e7b', 'Siswa Peminjam', 'peminjam', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kategori` (`nama_kategori`) VALUES
('Elektronik'),
('Mekanik'),
('Alat Ukur');

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `kondisi` varchar(50) NOT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT 'default.png',
  PRIMARY KEY (`id_alat`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `fk_alat_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `alat` (`nama_alat`, `id_kategori`, `stok`, `kondisi`, `deskripsi`) VALUES
('Multimeter Digital', 3, 10, 'Baik', 'Multimeter digital presisi tinggi'),
('Oscilloscope', 1, 5, 'Baik', 'Osiloskop 2 channel'),
('Obeng Set', 2, 15, 'Baik', 'Set obeng lengkap');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali_rencana` date NOT NULL,
  `status` enum('menunggu','disetujui','ditolak','kembali','telat') NOT NULL DEFAULT 'menunggu',
  `gambar_bukti` varchar(255) DEFAULT 'default_bukti.png',
  `catatan` text,
  PRIMARY KEY (`id_pinjam`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `fk_peminjaman_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjam` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_pinjam` (`id_pinjam`),
  KEY `id_alat` (`id_alat`),
  CONSTRAINT `fk_detail_pinjam` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_alat` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_kembali` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjam` int(11) NOT NULL,
  `tanggal_dikembalikan` date NOT NULL,
  `denda` int(11) NOT NULL DEFAULT 0,
  `kondisi_akhir` text,
  PRIMARY KEY (`id_kembali`),
  KEY `id_pinjam` (`id_pinjam`),
  CONSTRAINT `fk_pengembalian_pinjam` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `fk_log_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
