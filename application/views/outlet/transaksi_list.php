<?php if ($this->session->flashdata('hasil')) { ?>
<div class="alert alert-warning">
  <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('hasil');?>                  
</div>
<?php } ?>
<?php if ($this->session->flashdata('peringatan')) { ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('peringatan');?>                  
</div>
<?php } ?>
<a href="<?php echo site_url('outlet/transaksi/create'); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah transaksi</a>
<br/><br/>
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">ID</th><th class='text-center'>Gudang</th><th class='text-center'>Sepatu</th><th class='text-center'>Ukuran</th><th class='text-center'>Jumlah</th><th class='text-center'>Harga</th><th class='text-center'>Status</th><th width="150px"></th></tr>
    </thead>
    <tbody>
    <?php
    foreach ($transaksi as $m){
        echo "<tr>
              <td class='text-center'>$m->id_transaksi</td>
              <td>$m->nama</td>
              <td>$m->brand - $m->model</td>
              <td class='text-center'>$m->ukuran</td>
              <td class='text-center'>$m->jml</td>
              <td class='text-center'>Rp. $m->harga_total</td>
              <td class='text-center'>$m->status</td>";
        if ($m->status=="Menunggu Konfirmasi") {
          echo "<td align='center'> "."<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#edit".$m->id_transaksi."'><i class='glyphicon glyphicon-edit'></i></button>"." "."<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->id_transaksi."'><i class='glyphicon glyphicon-trash'></i></button>"."</td>
              </tr>";
        }elseif($m->status=="Terkirim"){
          echo "<td align='center'> "."<button class='btn btn-sm btn-success' data-toggle='modal' data-target='#diterima".$m->id_transaksi."'><i class='glyphicon glyphicon-download'></i> Diterima</button>"."</td></tr>";?>
                <div class="modal fade" id="diterima<?php echo $m->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="labelditerima<?php echo $m->id_transaksi; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelditerima<?php echo $m->id_transaksi; ?>">Terima Pesanan</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin telah menerima pesanan ini?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('outlet/transaksi/diterima/'.$m->id_transaksi,'Diterima','class="btn btn-success"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
          <?php          
        }elseif($m->status=="Diterima"){
          echo "<td align='center'> "."<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->id_transaksi."'><i class='glyphicon glyphicon-trash'></i> Hapus</button>"."</td>
            </tr>";
        ?>
                <div class="modal fade" id="hapus<?php echo $m->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $m->id_transaksi; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus<?php echo $m->id_transaksi; ?>">Hapus transaksi</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus transaksi?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('outlet/transaksi/delete/'.$m->id_transaksi,'Hapus','class="btn btn-danger"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              <?php         
        }elseif($m->status=="Ditolak"){
          echo "<td align='center'> "."<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->id_transaksi."'><i class='glyphicon glyphicon-trash'></i> Hapus</button>"."</td>
            </tr>";
        }
        ?>
                <div class="modal fade" id="hapus<?php echo $m->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $m->id_transaksi; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus<?php echo $m->id_transaksi; ?>">Hapus transaksi</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus transaksi?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('outlet/transaksi/delete/'.$m->id_transaksi,'Hapus','class="btn btn-danger"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              <?php
    }
    ?>
    </tbody>
</table>
<?php
    foreach ($transaksi as $m){
?>
<!-- Modal tambah stok -->
                <div class="modal fade" id="edit<?php echo $m->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="labeledit<?php echo $m->id_transaksi; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeledit<?php echo $m->id_transaksi; ?>">Pesan Sepatu <?php echo $m->brand." - ".$m->model; ?></h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="<?php echo site_url('outlet/transaksi/edit');?>" method="post">
                              <input type="hidden" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $m->id_transaksi; ?>">
                              <input type="hidden" name="id_gudang" class="form-control" id="id_gudang" value="<?php echo $m->id_gudang; ?>">
                              <input type="hidden" name="id_sepatu" class="form-control" id="id_sepatu" value="<?php echo $m->id_sepatu; ?>" required>
                              <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?php echo $m->user_id; ?>" required>
                              <input type="hidden" name="ukuran" class="form-control" id="ukuran" value="<?php echo $m->ukuran; ?>" required>
                              <input type="hidden" name="status" class="form-control" id="status" value="<?php echo $m->status; ?>" required>
                          <div class="form-group">
                          <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-8">
                              <input type="text" name="jml" class="form-control" id="jml" value="<?php echo $m->jml; ?>" placeholder="Masukan Jumlah Sepatu" data-ng-model="jumlah" required>
                            </div>                        
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name='submit' value='submit'>Pesan</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>                          
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->  
<?php 
    }
 ?>