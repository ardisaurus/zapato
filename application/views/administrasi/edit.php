<?php if (validation_errors()) {?>
    <div class="alert alert-danger">
        <?php echo validation_errors();?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('hasil')) { ?>
    <div class="alert alert-warning">
        <?php echo $this->session->flashdata('hasil');?>                  
    </div>
<?php } ?>
<?php if ($this->session->flashdata('peringatan')) { ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('peringatan');?>                  
    </div>
<?php } ?>
<?php echo form_open('administrasi/edit', 'class="form-horizontal"');?>

    <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">ID</label>
        <div class="col-sm-9">
                <input type="text" class="form-control required" id="user_id" name='user_id' value="<?php echo $administrasi[0]->user_id; ?>">
            </div>
    </div>
    <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Nama</label>
        <div class="col-sm-9">
            <input type="text" class="form-control required" id="nama" name='nama' value="<?php echo $administrasi[0]->nama; ?>">
        </div>
    </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-9">
                <?php echo anchor("administrasi/edit_password/".$this->session->userdata('user_id'),'Ubah Password', 'class="btn btn-warning"');?>
            </div>
        </div>
        <div class="form-group">
            <label for="telepon" class="col-sm-2 control-label">Telepon</label>
            <div class="col-sm-9">
              <input type="text" class="form-control required" id="telepon" name='telepon' value="<?php echo $administrasi[0]->telepon; ?>">
            </div>
        </div>
         <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-9">
            <textarea class="form-control required" id="alamat" name='alamat'><?php echo $administrasi[0]->alamat; ?></textarea>
            </div>
        </div> 
            <?php echo form_submit('submit','Simpan', 'class="btn btn-primary btn-block"');?>

            <?php echo anchor( $administrasi[0]->level.'/welcome/','Kembali', 'class="btn btn-default btn-block"');?>  
<?php
echo form_close();
?>
                <br/>
                <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#hapus">
                  <i class="glyphicon glyphicon-remove"></i> Hapus Akun
                </button>

                <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="labelhapus" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus">Hapus Akun</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin untuk menghapus akun ini?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('administrasi/delete_me/'.$administrasi[0]->user_id,'Hapus Akun','class="btn btn-danger"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->