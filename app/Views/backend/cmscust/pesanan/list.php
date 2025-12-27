<?= csrf_field(); ?>

<div class="table-responsive mt-3">
    <table id="listpesanan" class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light">
            <tr>
                <th width="5%">No</th>
                <th>No. Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Total</th>
                <th>Status Pembayaran</th>
                <th>Status Pesanan</th>
                <th>Tanggal</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            if ($list):
                foreach ($list as $data):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= esc($data['no_pesanan']) ?></strong></td>
                        <td>
                            <?= esc($data['nama_pemesan']) ?><br>
                            <small class="text-muted"><?= esc($data['no_hp']) ?></small>
                        </td>
                        <td><strong>Rp <?= number_format($data['grand_total'], 0, ',', '.') ?></strong></td>
                        <td>
                            <?php
                            $badge_bayar = 'secondary';
                            if ($data['status_pembayaran'] == 'Lunas')
                                $badge_bayar = 'success';
                            elseif ($data['status_pembayaran'] == 'Pending')
                                $badge_bayar = 'warning';
                            ?>
                            <span class="badge bg-<?= $badge_bayar ?>"><?= esc($data['status_pembayaran']) ?></span>
                        </td>
                        <td>
                            <?php
                            $badge_status = 'info';
                            if ($data['status_pesanan'] == 'Selesai')
                                $badge_status = 'success';
                            elseif ($data['status_pesanan'] == 'Dibatalkan')
                                $badge_status = 'danger';
                            elseif ($data['status_pesanan'] == 'Dikirim')
                                $badge_status = 'primary';
                            ?>
                            <span class="badge bg-<?= $badge_status ?>"><?= esc($data['status_pesanan']) ?></span>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($data['tgl_pesan'])) ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="detail('<?= $data['id_pesanan'] ?>')">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <?php if ($akses == '1' || $akses == '2'): ?>
                                <button type="button" class="btn btn-warning btn-sm"
                                    onclick="updatestatus('<?= $data['id_pesanan'] ?>')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#listpesanan').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[0, "desc"]]
        });
    });

    function detail(id) {
        $.ajax({
            type: 'post',
            url: '<?= site_url('pesanan/detail') ?>',
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_pesanan: id
            },
            dataType: 'json',
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldetail').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function updatestatus(id) {
        Swal.fire({
            title: 'Update Status Pesanan',
            html: `
                <select id="status_pesanan" class="form-select mb-2">
                    <option value="Pending">Pending</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Dikirim">Dikirim</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
                <input type="text" id="resi" class="form-control" placeholder="No. Resi (opsional)">
            `,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                return {
                    status: document.getElementById('status_pesanan').value,
                    resi: document.getElementById('resi').value
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?= site_url('pesanan/updatestatus') ?>',
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        id_pesanan: id,
                        status_pesanan: result.value.status,
                        resi_pengiriman: result.value.resi
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listpesanan();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>