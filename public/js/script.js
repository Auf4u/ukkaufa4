$(function () {

    // MODAL KATEGORI
    $('.tombolTambahDataKategori').on('click', function () {
        $('#judulModalKategori').html('Tambah Kategori Alat');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle" style="margin-right: 8px;"></i> Tambah Data');
        $('.modal-content form').attr('action', BASEURL + '/kategori/tambah');
        $('#nama_kategori').val('');
        $('#id_kategori').val('');
    });

    $('.tampilModalUbahKategori').on('click', function () {
        $('#judulModalKategori').html('Ubah Kategori Alat');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-save" style="margin-right: 8px;"></i> Ubah Data');
        $('.modal-content form').attr('action', BASEURL + '/kategori/ubah');

        const id = $(this).data('id');

        $.ajax({
            url: BASEURL + '/kategori/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#nama_kategori').val(data.nama_kategori);
                $('#id_kategori').val(data.id_kategori);
            }
        });
    });

    // MODAL ALAT
    $('.tombolTambahDataAlat').on('click', function () {
        $('#judulModalAlat').html('Tambah Alat Baru');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-save" style="margin-right: 8px;"></i> Simpan Ke Inventaris');
        $('.modal-content form').attr('action', BASEURL + '/alat/tambah');
        // Clear inputs
        $('#id_alat').val('');
        $('#nama_alat').val('');
        $('#id_kategori').val('');
        $('#stok').val('');
        $('#kondisi').val('Baik');
        $('#deskripsi').val('');
    });

    $('.tampilModalUbahAlat').on('click', function () {
        $('#judulModalAlat').html('Ubah Data Alat');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-save" style="margin-right: 8px;"></i> Update Data');
        $('.modal-content form').attr('action', BASEURL + '/alat/ubah');

        const id = $(this).data('id');

        $.ajax({
            url: BASEURL + '/alat/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#id_alat').val(data.id_alat);
                $('#nama_alat').val(data.nama_alat);
                $('#id_kategori').val(data.id_kategori);
                $('#stok').val(data.stok);
                $('#kondisi').val(data.kondisi);
                $('#deskripsi').val(data.deskripsi);
            }
        });
    });

    // MODAL USER
    $('.tombolTambahDataUser').on('click', function () {
        $('#judulModalUser').html('Tambah User Baru');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-user-plus" style="margin-right: 8px;"></i> Simpan User');
        $('.modal-content form').attr('action', BASEURL + '/user/tambah');

        $('#id_user').val('');
        $('#username').val('');
        $('#nama').val('');
        $('#password').attr('required', true);
        $('#passwordHint').hide();
        $('#statusGroup').hide();
    });

    $('.tampilModalUbahUser').on('click', function () {
        $('#judulModalUser').html('Ubah Data User');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-user-check" style="margin-right: 8px;"></i> Update User');
        $('.modal-content form').attr('action', BASEURL + '/user/ubah');

        $('#password').attr('required', false);
        $('#passwordHint').show();
        $('#statusGroup').show();

        const id = $(this).data('id');

        $.ajax({
            url: BASEURL + '/user/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#id_user').val(data.id_user);
                $('#username').val(data.username);
                $('#nama').val(data.nama_lengkap);
                $('#role').val(data.role);
                $('#status').val(data.status);
            }
        });
    });

});
