<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul']; ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        
        body { 
            font-family: 'Inter', sans-serif; 
            padding: 40px; 
            color: #1e293b;
            line-height: 1.5;
        }
        
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .kop-surat h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .kop-surat p { margin: 5px 0; font-size: 14px; color: #475569; }
        
        .title-box {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .title-box h2 { 
            margin: 0; 
            font-size: 18px; 
            text-decoration: underline;
            text-transform: uppercase;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
            font-size: 13px;
        }
        
        th, td { 
            border: 1px solid #cbd5e1; 
            padding: 12px 10px; 
            text-align: left; 
        }
        
        th { 
            background-color: #f8fafc; 
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        
        tr:nth-child(even) { background-color: #fcfcfc; }
        
        .status-pill {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid #ccc;
        }
        
        .footer-signing {
            margin-top: 60px;
            display: flex;
            justify-content: flex-end;
        }
        
        .sign-box {
            width: 250px;
            text-align: center;
        }
        
        .sign-box p { margin: 0; font-size: 14px; }
        .sign-space { height: 80px; }
        
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <h1>SISTEM INFORMASI INVENTARIS LAB</h1>
        <p>LABORATORIUM TEKNIK INFORMATIKA - SMK NEGERI INDONESIA</p>
        <p>Jl. Pendidikan No. 45, Jakarta Selatan | Telp: (021) 12345678</p>
    </div>

    <div class="title-box">
        <h2><?= $data['judul']; ?></h2>
        <p style="font-size: 12px; margin-top: 5px;">Periode Laporan: <?= date('d M Y'); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama Peminjam</th>
                <th>Tgl Pinjam</th>
                <?php if(strpos($data['judul'], 'Peminjaman') !== false) : ?>
                    <th>Status</th>
                    <th>Kembali (Plan)</th>
                <?php else : ?>
                    <th>Tgl Kembali</th>
                    <th>Denda</th>
                    <th>Kondisi Akhir</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($data['laporan'] as $l) : ?>
            <tr>
                <td align="center"><?= $i++; ?></td>
                <td style="font-weight: 700;"><?= $l['nama_lengkap']; ?></td>
                <td><?= date('d/m/Y', strtotime($l['tanggal_pinjam'])); ?></td>
                
                <?php if(strpos($data['judul'], 'Peminjaman') !== false) : ?>
                    <td><span class="status-pill"><?= $l['status']; ?></span></td>
                    <td><?= date('d/m/Y', strtotime($l['tanggal_kembali_rencana'])); ?></td>
                <?php else : ?>
                    <td><?= date('d/m/Y', strtotime($l['tanggal_dikembalikan'])); ?></td>
                    <td style="color: <?= ($l['denda'] > 0) ? '#e11d48' : '#000'; ?>">
                        Rp <?= number_format($l['denda'], 0, ',', '.'); ?>
                    </td>
                    <td><?= $l['kondisi_akhir']; ?></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer-signing">
        <div class="sign-box">
            <p>Jakarta, <?= date('d F Y'); ?></p>
            <p>Petugas Inventaris,</p>
            <div class="sign-space"></div>
            <p><strong><?= $_SESSION['user_session']['nama_lengkap']; ?></strong></p>
            <p style="font-size: 11px; color: #64748b;">NIP. ____________________</p>
        </div>
    </div>

</body>
</html>
