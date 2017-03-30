<hr></hr>
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
<?php echo $gudang[0]->alamat; ?>
<br/><br/>
<a href='<?php echo site_url('admin/gudang/add_stok/'.$id_gud.''); ?>' class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah stok gudang</a>
<a href='<?php echo site_url('admin/gudang'); ?>' class="btn btn-default">Kembali</a>
<br/><br/>
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">No.</th><th class='text-center'>Brand & Model Sepatu</th><th class='text-center'>Ukuran</th><th class='text-center'>Stok</th><th width="150px"></th></tr>
    </thead>
    <tbody>
    <?php
    $no=0;
    foreach ($stok_gudang as $m){
    	$no++;
        echo "<tr>
              <td class='text-center'>$no</td>
              <td>$m->brand - $m->model</td>
              <td>$m->ukuran</td>
              <td>$m->stok</td>
              <td align='center'><button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#edit".$m->id_stok_gudang."'><i class='glyphicon glyphicon-cog'></i></button>"." "."<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->id_stok_gudang."'><i class='glyphicon glyphicon-trash'></i></button>"."</td>
              </tr>";?>
                <div class="modal fade" id="hapus<?php echo $m->id_stok_gudang; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $m->id_stok_gudang; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus<?php echo $m->id_stok_gudang; ?>">Hapus stok gudang</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus <?php echo $m->nama; ?>?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('admin/gudang/delete_stok/'.$m->id_stok_gudang,'Hapus','class="btn btn-danger"') ?>
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
    foreach ($stok_gudang as $m){
?>

<!-- Modal tambah stok -->
                <div class="modal fade" id="edit<?php echo $m->id_stok_gudang; ?>" tabindex="-1" role="dialog" aria-labelledby="labeledit<?php echo $m->id_stok_gudang; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeledit<?php echo $m->id_stok_gudang; ?>">Ubah Stok <?php echo $m->brand." - ".$m->model; ?></h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="<?php echo site_url('admin/gudang/edit_stok');?>" method="post">
                              <input type="hidden" name="id_stok_gudang" class="form-control" id="id_stok_gudang" value="<?php echo $m->id_stok_gudang; ?>">
                              <input type="hidden" name="id_gudang" class="form-control" id="id_gudang" value="<?php echo $m->id_gudang; ?>">
                              <input type="hidden" name="id_sepatu" class="form-control" id="id_sepatu" value="<?php echo $m->id_sepatu; ?>" required>
                              <input type="hidden" name="ukuran" class="form-control" id="ukuran" placeholder="Masukan Ukuran Sepatu" value="<?php echo $m->ukuran; ?>" required>
                          <div class="form-group">
                          <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-8">
                              <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Masukan Jumlah Sepatu" value="<?php echo $m->stok; ?>" required>
                            </div>                        
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='submit' value='submit'>Ubah</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->  
<?php 
    }
 ?>