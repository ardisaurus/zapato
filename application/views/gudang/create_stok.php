    <?php if (validation_errors()) {?>
        <div class="alert alert-danger">
            <?php echo validation_errors();?>
        </div>
    <?php } ?>
    <?php echo form_open('admin/gudang/create_stok', 'class="form-horizontal"');?>
    <table>
        <tr><td></td><td><?php echo form_hidden('id_stok_gudang');?></td></tr>
        <div class="form-group">
            <label for="id_gudang" class="col-sm-1 control-label">Id Gudang</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="id_gudang" name='id_gudang' value="<?php echo $this->uri->segment(4); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="id_sepatu" class="col-sm-1 control-label">Id sepatu</label>
            <div class="col-sm-5">
             <input type="text" class="form-control required" id="id_sepatu" name='id_sepatu' value="<?php echo $this->uri->segment(5); ?>">
            </div>
        </div>
         <div class="form-group">
            <label for="ukuran" class="col-sm-1 control-label">Ukuran</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="ukuran" name='ukuran'>
            </div>
        </div>
        <div class="form-group">
            <label for="jumlah" class="col-sm-1 control-label">jumlah</label>
            <div class="col-sm-5">
             <input type="text" class="form-control required" id="jumlah" name='jumlah'>
            </div>
        </div>   
        <tr><td colspan="2">
            <?php echo form_submit('submit','Simpan', 'class="btn btn-primary"');?>
            <?php echo anchor('admin/gudang','Kembali', 'class="btn btn-default"');?></td></tr>
    </table>
    <?php
    echo form_close();
    ?>