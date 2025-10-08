<!-- Modal Approve Transaksi -->
<div class="modal fade" id="modalapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open('keuangan-gereja/approve', ['class' => 'formapprove']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">
            
            <div class="modal-body">
                <!-- Detail Transaksi -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-info-circle"></i> Detail Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>Kode Transaksi</strong></td>
                                        <td>: <?= esc($data['kode_transaksi']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal</strong></td>
                                        <td>: <?= date('d F Y', strtotime($data['tanggal_transaksi'])) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis</strong></td>
                                        <td>: 
                                            <span class="badge <?= $data['jenis_transaksi'] == 'Pemasukan' ? 'bg-success' : 'bg-danger' ?>">
                                                <?= esc($data['jenis_transaksi']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kategori</strong></td>
                                        <td>: 
                                            <span class="badge" style="background-color: <?= $data['warna'] ?>; color: white;">
                                                <?= esc($data['nama_kategori']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>Jumlah</strong></td>
                                        <td>: <strong class="<?= $data['jenis_transaksi'] == 'Pemasukan' ? 'text-success' : 'text-danger' ?>">
                                            Rp <?= number_format($data['jumlah'], 0, ',', '.') ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Metode</strong></td>
                                        <td>: <?= esc($data['metode_pembayaran']) ?></td>
                                    </tr>
                                    <?php if ($data['no_referensi']): ?>
                                    <tr>
                                        <td><strong>No. Referensi</strong></td>
                                        <td>: <?= esc($data['no_referensi']) ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($data['sumber_dana']): ?>
                                    <tr>
                                        <td><strong>Sumber Dana</strong></td>
                                        <td>: <?= esc($data['sumber_dana']) ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($data['penerima']): ?>
                                    <tr>
                                        <td><strong>Penerima</strong></td>
                                        <td>: <?= esc($data['penerima']) ?></td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>Keterangan:</strong>
                                <p class="mt-2"><?= nl2br(esc($data['keterangan'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Approval -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-check-circle"></i> Persetujuan Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Status Persetujuan <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" id="statusApproval" required>
                                <option value="">Pilih Status</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="kasGroup" style="display: none;">
                            <label>Pilih Kas <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_kas">
                                <option value="">Pilih Kas</option>
                                <?php foreach ($kas_list as $kas): ?>
                                    <option value="<?= $kas['id_kas'] ?>">
                                        <?= esc($kas['nama_kas']) ?> 
                                        (Saldo: Rp <?= number_format($kas['saldo_akhir'], 0, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Pilih kas yang akan terpengaruh oleh transaksi ini</small>
                        </div>

                        <div class="form-group mb-3">
                            <label>Catatan Persetujuan</label>
                            <textarea class="form-control" name="catatan" rows="3" placeholder="Berikan catatan untuk keputusan ini (opsional)"></textarea>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Perhatian:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Jika <strong>Disetujui</strong>, saldo kas akan otomatis terupdate</li>
                                <li>Jika <strong>Ditolak</strong>, transaksi tidak akan mempengaruhi kas</li>
                                <li>Keputusan ini tidak dapat diubah setelah disimpan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary btnApprove">
                    <i class="fas fa-check"></i> Proses Persetujuan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Show/hide kas selection based on status
        $('#statusApproval').change(function() {
            const status = $(this).val();
            if (status === 'Disetujui') {
                $('#kasGroup').show();
                $('select[name="id_kas"]').attr('required', true);
            } else {
                $('#kasGroup').hide();
                $('select[name="id_kas"]').attr('required', false);
            }
        });

        // Form submit
        $('.formapprove').submit(function(e) {
            e.preventDefault();
            let form = this;
            
            // Validation
            const status = $('#statusApproval').val();
            const id_kas = $('select[name="id_kas"]').val();
            
            if (!status) {
                toastr.error('Silahkan pilih status persetujuan');
                return;
            }
            
            if (status === 'Disetujui' && !id_kas) {
                toastr.error('Silahkan pilih kas untuk transaksi yang disetujui');
                return;
            }
            
            // Confirmation
            const statusText = status === 'Disetujui' ? 'menyetujui' : 'menolak';
            const statusClass = status === 'Disetujui' ? 'success' : 'error';
            
            Swal.fire({
                title: `Konfirmasi ${status}`,
                html: `Yakin ${statusText} transaksi <strong><?= esc($data['kode_transaksi']) ?></strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: status === 'Disetujui' ? '#28a745' : '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: `Ya, ${status}!`,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: $(form).attr('action'),
                        data: $(form).serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            $('.btnApprove').attr('disable', 'disabled');
                            $('.btnApprove').html('<i class="fa fa-spin fa-spinner"></i> Memproses...');
                        },
                        complete: function() {
                            $('.btnApprove').removeAttr('disable');
                            $('.btnApprove').html('<i class="fas fa-check"></i> Proses Persetujuan');
                        },
                        success: function(response) {
                            if (response.sukses) {
                                toastr.success(response.sukses);
                                $('#modalapprove').modal('hide');
                                listkeuangan();
                            } else if (response.error) {
                                toastr.error(response.error);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
            
            return false;
        });

        // Reset form when modal closed
        $('#modalapprove').on('hidden.bs.modal', function() {
            $('.formapprove')[0].reset();
            $('#kasGroup').hide();
            $('select[name="id_kas"]').attr('required', false);
        });
    });
</script>
