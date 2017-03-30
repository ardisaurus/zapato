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
<?php echo form_open('admin/gudang/edit', 'class="form-horizontal"');?>
<?php echo form_hidden('id_gudang',$gudang[0]->id_gudang);?>
<table>
    <tr><td></td><td><?php echo form_hidden('',$gudang[0]->id_gudang);?></td></tr>
    <div class="form-group">
        <label for="nama" class="col-sm-1 control-label">Nama</label>
    	<div class="col-sm-5">
        	<input type="text" class="form-control required" id="nama" name='nama' value="<?php echo $gudang[0]->nama; ?>">
        </div>
    </div>
    <div class="form-group">
            <label for="alamat" class="col-sm-1 control-label">Alamat</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="alamat" name='alamat' value="<?php echo $gudang[0]->alamat; ?>">
            </div>
        </div>  
    <tr><td colspan="2">
            <?php echo form_submit('submit','Simpan', 'class="btn btn-primary"');?>
            <?php echo anchor('admin/gudang','Kembali', 'class="btn btn-default"');?></td></tr>
</table>
<?php
echo form_close();
?>