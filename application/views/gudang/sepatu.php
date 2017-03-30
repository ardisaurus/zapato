<?php if ($this->session->flashdata('peringatan')) { ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('peringatan');?>                  
</div>
<?php } ?>
<a href='<?php echo site_url('admin/gudang/stok/'.$this->session->userdata('id_gudang')); ?>' class="btn btn-default">Kembali</a>
<br/><br/>
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">ID</th><th class='text-center'>Brand</th><th class='text-center'>Model</th><th class='text-center'>Kategori</th><th class='text-center'>Harga</th><th width="150px"></th></tr>
    </thead>
    <tbody>
    <?php
    foreach ($sepatu as $m){
        echo "<tr>
              <td class='text-center'>$m->id_sepatu</td>
              <td>$m->brand</td>
              <td>$m->model</td>
              <td>$m->kategori</td>
              <td> Rp. $m->harga</td>
              <td align='center'><button class='btn btn-sm btn-success' data-toggle='modal' data-target='#tambah".$m->id_sepatu."'><i class='glyphicon glyphicon-plus'></i> Tambah</button>"."</td>
              </tr>";?>
              <?php
    }
    ?>
    </tbody>
</table>
<?php 
    foreach ($sepatu as $m){
 ?>
<!-- Modal tambah stok -->
                <div class="modal fade" id="tambah<?php echo $m->id_sepatu; ?>" tabindex="-1" role="dialog" aria-labelledby="labeltambah<?php echo $m->id_sepatu; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeltambah<?php echo $m->id_sepatu; ?>">Tambah Stok <?php echo $m->brand." - ".$m->model; ?></h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="<?php echo site_url('admin/gudang/add_stok');?>" method="post">
                        <div class="form-group">
                          <label for="ukuran" class="col-sm-3 control-label">Ukuran</label>
                            <div class="col-sm-8">
                              <input type="hidden" name="id_stok_gudang" class="form-control" id="id_stok_gudang">
                              <input type="hidden" name="id_sepatu" class="form-control" id="id_sepatu" value="<?php echo $m->id_sepatu; ?>" required>
                              <input type="text" name="ukuran" class="form-control" id="ukuran" placeholder="Masukan Ukuran Sepatu" required>
                            </div>                        
                          </div>
                          <div class="form-group">
                          <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-8">
                              <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Masukan Jumlah Sepatu" required>
                            </div>                        
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" name='submit' value='submit'>Tambah</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->  
<?php } ?>