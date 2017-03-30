    <?php if (validation_errors()) {?>
        <div class="alert alert-danger">
            <?php echo validation_errors();?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('peringatan')) { ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('peringatan');?>                  
    </div>
    <?php } ?>
<div class="row col-sm-8">    
    <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-lock"></i> Password
            </div>
            <div class="panel-body">
                <?php echo form_open('administrasi/edit_password', 'class="form-horizontal"');?>
                <table>    
                        <div class="form-group">
                            <label for="telepon" class="col-sm-3 control-label">Password Lama</label>
                            <div class="col-sm-5">
                              <input type="password" class="form-control required" id="password_lama" name='password_lama' placeholder="Masukan password lama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-sm-3 control-label">Password Baru</label>
                            <div class="col-sm-5">
                              <input type="password" class="form-control required" id="password" name='password' placeholder="Masukan password baru">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-sm-3 control-label"> </label>
                            <div class="col-sm-5">
                              <input type="password" class="form-control required" id="passwordconf" name='passwordconf' placeholder="Masukan kembali password baru">
                            </div>
                        </div>  
                    <tr><td colspan="2">
                            <?php echo form_submit('submit','Simpan', 'class="btn btn-primary"');?>
                            <?php echo anchor( "administrasi/edit/".$this->session->userdata('user_id'),'Kembali', 'class="btn btn-default"');?></td></tr>
                </table>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
</div>