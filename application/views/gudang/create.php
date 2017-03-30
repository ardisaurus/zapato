    <?php if (validation_errors()) {?>
        <div class="alert alert-danger">
            <?php echo validation_errors();?>
        </div>
    <?php } ?>
    <?php echo form_open('admin/gudang/create', 'class="form-horizontal"');?>
    <table>
        <tr><td></td><td><?php echo form_hidden('id_gudang');?></td></tr>
        <div class="form-group">
            <label for="nama" class="col-sm-1 control-label">Nama</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="nama" name='nama'>
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
            <?php echo anchor('admin/gudang','Kembali', 'class="btn btn-default"');?></td></tr>
    </table>
    <?php
    echo form_close();
    ?>