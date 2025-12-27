<div class="row">
    <div class="col-sm-12">
        <div class="float-right">
            <button type="button" class="btn btn-success btn-sm" onclick="tambah()">
                <i class="fas fa-plus-circle"></i> Tambah Jadwal
            </button>
        </div>
    </div>
</div>

<div class="table-responsive mt-3">
    <table id="listjadwal" class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light">
            <tr>
                <th width="5%"><input type="checkbox" id="checkall"></th>
                <th width="5%">No</th>
                <th>Judul Jadwal</th>
                <th>Jenis Pelayanan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Tempat</th>
                <th>Status</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            if ($list):
                foreach ($list as $data):
                    ?>
                    <tr>
                        <td><input type="checkbox" class="checkboxes" name="id[]" value="<?= $data['id_jadwal'] ?>"></td>
                        <td><?= $no++ ?></td>
                        <td><strong><?= esc($data['judul_jadwal']) ?></strong></td>
                        <td><span class="badge badge-primary"><?= esc($data['jenis_pelayanan']) ?></span></td>
                        <td><?= date_indo($data['tanggal']) ?></td>
                        <td><?= date('H:i', strtotime($data['waktu_mulai'])) ?></td>
                        <td><?= esc($data['tempat']) ?></td>
                        <td>
                            <?php if ($data['status'] == 1): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="lihat('<?= $data['id_jadwal'] ?>')"><i
                                    class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $data['id_jadwal'] ?>')"><i
                                    class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $data['id_jadwal'] ?>')"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="row mt-3">
    <div class="col-sm-12 col-md-5">
        <button type="button" class="btn btn-danger btn-sm" onclick="hapusall()">
            <i class="far fa-trash-alt"></i> Hapus yang Dipilih
        </button>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#listjadwal').DataTable({ "language": { "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json" } });
        $('#checkall').click(function () { $('.checkboxes').prop('checked', $(this).prop('checked')); });
    });

    function tambah() {
        $.ajax({
            type: 'get', url: '<?= base_url('jadwal-pelayanan/formtambah') ?>', dataType: 'json',
            success: function (response) { $('.viewmodal').html(response.data).show(); $('#modaltambah').modal('show'); }
        });
    }

    function lihat(id) {
        $.ajax({
            type: 'post', url: '<?= base_url('jadwal-pelayanan/formlihat') ?>',
            data: { csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(), id: id }, dataType: 'json',
            success: function (response) { if (response.sukses) { $('.viewmodal').html(response.sukses).show(); $('#modallihat').modal('show'); } }
        });
    }

    function edit(id) {
        $.ajax({
            type: 'post', url: '<?= base_url('jadwal-pelayanan/formedit') ?>',
            data: { csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(), id: id }, dataType: 'json',
            success: function (response) { if (response.sukses) { $('.viewmodal').html(response.sukses).show(); $('#modaledit').modal('show'); } }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Jadwal?', text: 'Data akan dihapus permanen!', icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post', url: '<?= base_url('jadwal-pelayanan/hapus') ?>',
                    data: { csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(), id: id }, dataType: 'json',
                    success: function (response) { if (response.sukses) { Swal.fire({ icon: 'success', title: 'Berhasil!', text: response.sukses }); listjadwal(); } }
                });
            }
        });
    }

    function hapusall() {
        let id = []; $('.checkboxes:checked').each(function () { id.push($(this).val()); });
        if (id.length === 0) { Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Pilih data yang akan dihapus' }); return false; }
        Swal.fire({
            title: 'Hapus ' + id.length + ' Jadwal?', text: 'Data akan dihapus permanen!', icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post', url: '<?= base_url('jadwal-pelayanan/hapusall') ?>',
                    data: { csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(), id: id }, dataType: 'json',
                    success: function (response) { if (response.sukses) { Swal.fire({ icon: 'success', title: 'Berhasil!', text: response.sukses }); listjadwal(); } }
                });
            }
        });
    }
</script>