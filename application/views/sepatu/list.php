<?php if ($this->session->flashdata('hasil')) { ?>
<div class="alert alert-warning">
  <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('hasil');?>                  
</div>
<?php } ?>
<a href="<?php echo site_url('admin/sepatu/create'); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah sepatu</a>
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
              <td align='center'> <button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->id_sepatu."'>Hapus</button>"." ".anchor('admin/sepatu/edit/'.$m->id_sepatu,'Edit','class="btn btn-sm btn-primary"')."</td>
              </tr>";?>
                <div class="modal fade" id="hapus<?php echo $m->id_sepatu; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $m->id_sepatu; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus<?php echo $m->id_sepatu; ?>">Hapus Sepatu</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus <?php echo $m->brand." ".$m->model; ?>?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('admin/sepatu/delete/'.$m->id_sepatu,'Hapus','class="btn btn-danger"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              <?php
    }
    ?>
    </tbody>
</table>
