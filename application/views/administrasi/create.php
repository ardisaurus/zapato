    <?php if (validation_errors()) {?>
                    <div class="alert alert-danger">
                    <?php echo validation_errors();?>
                  </div>
                <?php } ?>
    <?php if ($this->session->flashdata('peringatan')) { ?>
    <div class="alert alert-danger">
      <i class="glyphicon glyphicon-remove"></i> <?php echo $this->session->flashdata('peringatan');?>                  
    </div>
    <?php } ?>
    <?php echo form_open('administrasi/create', 'class="form-horizontal"');?>
    <table>
        <div class="form-group">
            <label for="user_id" class="col-sm-1 control-label">ID</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="user_id" name='user_id'>
            </div>
        </div>
        <div class="form-group">
            <label for="nama" class="col-sm-1 control-label">Nama</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="nama" name='nama'>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-1 control-label">Password</label>
            <div class="col-sm-5">
              <input type="password" class="form-control required" id="password" name='password'>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-1 control-label"></label>
            <div class="col-sm-5">
              <input type="password" class="form-control required" id="passwordconf" name='passwordconf'>
            </div>
        </div>
        <div class="form-group">
            <label for="level" class="col-sm-1 control-label">Level</label>
            <div class="col-sm-5">
                <select name="level" class="form-control">
                    <option value="admin" >Admin</option>
                    <option value="outlet" >Outlet</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="telepon" class="col-sm-1 control-label">Telepon</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="telepon" name='telepon'>
            </div>
        </div>
        <div class="form-group">
            <label for="telepon" class="col-sm-1 control-label">Alamat</label>
            <div class="col-sm-5">
             <textarea class="form-control" rows="3" id="alamat" name='alamat'></textarea>
            </div>
        </div>   
        <tr><td colspan="2">
            <?php echo form_submit('submit','Simpan', 'class="btn btn-primary"');?>
            <?php echo anchor('administrasi','Kembali', 'class="btn btn-default"');?></td></tr>
    </table>
    <?php
    echo form_close();
    ?>