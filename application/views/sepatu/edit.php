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
<?php echo form_open('admin/sepatu/edit', 'class="form-horizontal"');?>
<?php echo form_hidden('id_sepatu',$sepatu[0]->id_sepatu);?>
<table>
    <tr><td></td><td><?php echo form_hidden('',$sepatu[0]->id_sepatu);?></td></tr>
    <div class="form-group">
        <label for="brand" class="col-sm-1 control-label">Brand</label>
    	<div class="col-sm-5">
        	<input type="text" class="form-control required" id="brand" name='brand' value="<?php echo $sepatu[0]->brand; ?>">
        </div>
    </div>
    <div class="form-group">
            <label for="model" class="col-sm-1 control-label">Model</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="model" name='model' value="<?php echo $sepatu[0]->model; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="harga" class="col-sm-1 control-label">Kategori</label>
            <div class="col-sm-5">
              <select name="kategori" class="form-control">
                    <option value="Man - Sepatu Derbies" <?php echo  set_select('kategori', 'Man - Sepatu Derbies', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Sepatu Derbies" ? TRUE : FALSE )); ?> >Man - Sepatu Derbies</option>
                    <option value="Man - Sneaker & Skate" <?php echo  set_select('kategori', 'Man - Sneaker & Skate', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Sneaker & Skate" ? TRUE : FALSE )); ?>>Man - Sneaker & Skate</option>
                    <option value="Man - Sepatu Olahraga" <?php echo  set_select('kategori', 'Man - Sepatu Olahraga', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Sepatu Olahraga" ? TRUE : FALSE )); ?>>Man - Sepatu Olahraga</option>
                    <option value="Man - Sendal & Flip-Flop" <?php echo  set_select('kategori', 'Man - Sendal & Flip-Flop', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Sendal & Flip-Flop" ? TRUE : FALSE )); ?>>Man - Sendal & Flip-Flop</option>
                    <option value="Man - Sepatu Formal" <?php echo  set_select('kategori', 'Man - Sepatu Formal', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Sepatu Formal" ? TRUE : FALSE )); ?>>Man - Sepatu Formal</option>
                    <option value="Man - Slip On & Espardiles" <?php echo  set_select('kategori', 'Man - Slip On & Espardiles'), ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Slip On & Espardiles" ? TRUE : FALSE ); ?>>Man - Slip On & Espardiles</option>
                    <option value="Man - Loafers" <?php echo  set_select('kategori', 'Man - Loafers', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Loafers" ? TRUE : FALSE )); ?>>Man - Loafers</option>
                    <option value="Man - Boots" <?php echo  set_select('kategori', 'Man - Boots', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Man - Boots" ? TRUE : FALSE )); ?>>Man - Boots</option> 
                    <option value="Woman - Wedges" <?php echo  set_select('kategori', 'Woman - Wedges', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Wedges" ? TRUE : FALSE )); ?>>Woman - Wedges</option>
                    <option value="Woman - Flats & Balerina" <?php echo  set_select('kategori', 'Woman - Flats & Balerina', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Flats & Balerina" ? TRUE : FALSE )); ?>>Woman - Flats & Balerina</option>
                    <option value="Woman - Slip On" <?php echo  set_select('kategori', 'Woman - Slip On', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Slip On" ? TRUE : FALSE )); ?>>Woman - Slip On</option>
                    <option value="Woman - Sandal" <?php echo  set_select('kategori', 'Woman - Sandal', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Sandal" ? TRUE : FALSE )); ?>>Woman - Sandal</option>
                    <option value="Woman - Heels" <?php echo  set_select('kategori', 'Woman - Heels', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Heels" ? TRUE : FALSE )); ?>>Woman - Heels</option>
                    <option value="Woman - Sneaker" <?php echo  set_select('kategori', 'Woman - Sneaker', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Sneaker" ? TRUE : FALSE )); ?>>Woman - Sneaker</option>
                    <option value="Woman - Boots" <?php echo  set_select('kategori', 'Woman - Boots', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Boots" ? TRUE : FALSE )); ?>>Woman - Boots</option>
                    <option value="Woman - Sepatu Olahraga" <?php echo  set_select('kategori', 'Woman - Sepatu Olahraga', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Sepatu Olahraga" ? TRUE : FALSE )); ?>>Woman - Sepatu Olahraga</option>
                    <option value="Woman - Loafers" <?php echo  set_select('kategori', 'Woman - Loafers', ( !empty($sepatu[0]->kategori) && $sepatu[0]->kategori == "Woman - Loafers" ? TRUE : FALSE )); ?>>Woman - Loafers</option>                   
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="harga" class="col-sm-1 control-label">Harga</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="harga" name='harga' value="<?php echo $sepatu[0]->harga; ?>">
            </div>
        </div>   
    <tr><td colspan="2">
            <?php echo form_submit('submit','Simpan', 'class="btn btn-primary"');?>
            <?php echo anchor('admin/sepatu','Kembali', 'class="btn btn-default"');?></td></tr>
</table>
<?php
echo form_close();
?>