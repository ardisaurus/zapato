<?php if ($this->session->flashdata('hasil')) { ?>
<div class="alert alert-warning">
  <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('hasil');?>                  
</div>
<?php } ?>
<a href="<?php echo site_url('administrasi/create'); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah Administrasi</a>
<br/><br/>
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">Id Pengguna</th><th class='text-center'>Nama</th><th class='text-center'>Level</th><th class='text-center'>No. Telepon</th><th class='text-center'>Alamat</th><th width="150px"></th></tr>
    </thead>
    <tbody>
    <?php
    if (isset($administrasi)) {
      foreach ($administrasi as $m){
        echo "<tr>
              <td>$m->user_id</td>
              <td>$m->nama</td>
              <td>$m->level</td>
              <td>$m->telepon</td>
              <td>$m->alamat</td>";
        if ($m->level=="outlet") {
          echo 
              "<td align='center'> <button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus".$m->user_id."'>Hapus</button>
              </td></tr>";
        }else{
          echo 
              "<td align='center'>"
              ."</td></tr>";
        }?>
                  <div class="modal fade" id="hapus<?php echo $m->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $m->user_id; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus<?php echo $m->user_id; ?>">Hapus Akun</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus <?php echo $m->user_id; ?>?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('administrasi/delete/'.$m->user_id,'Hapus','class="btn btn-danger"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
<?php
      }
    }else{
      ?>
      <tr><td colspan="6" class="text-center text-danger danger">No data</td></tr>
      <?php
    }    
    ?>
    </tbody>
</table>
