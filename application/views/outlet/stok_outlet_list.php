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
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">ID</th><th class='text-center'>Sepatu</th><th class='text-center'>Ukuran</th><th class='text-center'>Stok</th><th class='text-center'>Harga</th><th width="150px"></th></tr>
    </thead>
    <tbody>
    <?php
    foreach ($stok_outlet as $m){
        echo "<tr>
              <td class='text-center'>$m->id_stok_outlet</td>
              <td>$m->brand - $m->model</td>
              <td class='text-center'>$m->ukuran</td>
              <td class='text-center'>$m->stok</td>
              <td class='text-center'>Rp. $m->harga</td>
              <td align='center'> <button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->id_stok_outlet."'>Hapus</button>"." "."<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#edit".$m->id_stok_outlet."'>Edit</button>"."</td>
              </tr>";?>
                <div class="modal fade" id="hapus<?php echo $m->id_stok_outlet; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $m->id_stok_outlet; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus<?php echo $m->id_stok_outlet; ?>">Hapus Sepatu</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus <?php echo $m->brand." ".$m->model; ?>?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('outlet/stok_outlet/delete/'.$m->id_stok_outlet,'Hapus','class="btn btn-danger"') ?>
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
    foreach ($stok_outlet as $m){
?>
<div class="modal fade" id="edit<?php echo $m->id_stok_outlet; ?>" tabindex="-1" role="dialog" aria-labelledby="labeledit<?php echo $m->id_stok_outlet; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeledit<?php echo $m->id_stok_outlet; ?>">Edit Stok Outlet</h4>
                            </div>
                            <div class="modal-body">
                            <form class="form-horizontal" role="form"  action="<?php echo site_url('outlet/stok_outlet/edit/'.$m->id_stok_outlet);?>" method="post">
                              <div class="form-group">
                              <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                                <div class="col-sm-8">
                                  <input type="text" name="stok" class="form-control" id="stok" value="<?php echo $m->stok; ?>" placeholder="Masukan Jumlah Sepatu" data-ng-model="jumlah" required>
                                </div>                        
                              </div>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='submit' value='submit'>Edit</button>                       
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
<?php } ?>