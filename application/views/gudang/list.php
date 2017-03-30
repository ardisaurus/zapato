<?php if ($this->session->flashdata('hasil')) { ?>
<div class="alert alert-warning">
  <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('hasil');?>                  
</div>
<?php } ?>
<a href="<?php echo site_url('admin/gudang/create'); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah gudang</a>
<br/><br/>
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">ID</th><th class='text-center'>Nama</th><th class='text-center'>Alamat</th><th width="150px"></th></tr>
    </thead>
    <tbody>
    <?php
    foreach ($gudang as $m){
        echo "<tr>
              <td class='text-center'>$m->id_gudang</td>
              <td>$m->nama</td>
              <td>$m->alamat</td>
              <td align='center'> ".anchor('admin/gudang/stok/'.$m->id_gudang,'<i class="glyphicon glyphicon-eye-open"></i>','class="btn btn-sm btn-info"')." ".anchor('admin/gudang/edit/'.$m->id_gudang,'<i class="glyphicon glyphicon-cog"></i>','class="btn btn-sm btn-primary"')." "."<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->id_gudang."'><i class='glyphicon glyphicon-trash'></i></button>"."</td>
              </tr>";?>
                <div class="modal fade" id="hapus<?php echo $m->id_gudang; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $m->id_gudang; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus<?php echo $m->id_gudang; ?>">Hapus gudang</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus <?php echo $m->nama; ?>?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('admin/gudang/delete/'.$m->id_gudang,'Hapus','class="btn btn-danger"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              <?php
    }
    ?>
    </tbody>
</table>