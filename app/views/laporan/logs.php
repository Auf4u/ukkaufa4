<div class="container-fluid">
    <h3 class="mt-3">Log Aktivitas Pengguna</h3>
    <p>Catatan semua aktivitas penting yang dilakukan oleh user.</p>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="logTable">
                    <thead class="bg-light">
                        <tr>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['logs'] as $log) : ?>
                        <tr>
                            <td width="200px"><?= $log['tanggal']; ?></td>
                            <td width="150px"><strong><?= $log['username']; ?></strong></td>
                            <td><?= $log['aktivitas']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
