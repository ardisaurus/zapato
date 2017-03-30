<hr></hr>
<?php echo $gudang[0]->alamat; ?>
<br/><br/>
<a href='<?php echo site_url('outlet/gudang'); ?>' class="btn btn-default">Kembali</a>
<br/><br/>
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">No.</th><th class='text-center'>Brand & Model Sepatu</th><th class='text-center'>Ukuran</th><th class='text-center'>Harga</th><th class='text-center'>Stok</th><th width="150px"></th></tr>
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
              <td>Rp. $m->harga</td>
              <td>$m->stok</td>
              <td align='center'><button class='btn btn-sm btn-success' data-toggle='modal' data-target='#edit".$m->id_stok_gudang."'><i class='glyphicon glyphicon-send'></i> Tambah Pesanan</button>"."</td>
              </tr>";
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
                                <h4 class="modal-title" id="labeledit<?php echo $m->id_stok_gudang; ?>">Pesan Sepatu <?php echo $m->brand." - ".$m->model; ?></h4>
                            </div>
                            <div class="modal-body">
                        <form class="form-horizontal" role="form"  action="<?php echo site_url('outlet/transaksi/create');?>" method="post">
                              <input type="hidden" name="id_stok_gudang" class="form-control" id="id_stok_gudang" value="<?php echo $m->id_stok_gudang; ?>">
                              <input type="hidden" name="id_gudang" class="form-control" id="id_gudang" value="<?php echo $m->id_gudang; ?>">
                              <input type="hidden" name="id_sepatu" class="form-control" id="id_sepatu" value="<?php echo $m->id_sepatu; ?>" required>
                              <input type="hidden" name="ukuran" class="form-control" id="ukuran" value="<?php echo $m->ukuran; ?>" required>
                              <input type="hidden" name="stok" class="form-control" id="stok" value="<?php echo $m->stok; ?>" required>
                          <div class="form-group">
                          <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-8">
                              <input type="text" name="jml" class="form-control" id="jml" placeholder="Masukan Jumlah Sepatu" data-ng-model="jumlah" required>
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