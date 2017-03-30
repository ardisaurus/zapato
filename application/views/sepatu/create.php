    <?php if (validation_errors()) {?>
        <div class="alert alert-danger">
            <?php echo validation_errors();?>
        </div>
    <?php } ?>
    <?php echo form_open_multipart('admin/sepatu/create', 'class="form-horizontal"');?>
    <table>
        <tr><td></td><td><?php echo form_hidden('id_sepatu');?></td></tr>
        <div class="form-group">
            <label for="brand" class="col-sm-1 control-label">Brand</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="brand" name='brand'>
            </div>
        </div>
        <div class="form-group">
            <label for="model" class="col-sm-1 control-label">Model</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="model" name='model'>
            </div>
        </div>
        <div class="form-group">
            <label for="harga" class="col-sm-1 control-label">Kategori</label>
            <div class="col-sm-5">
                <select name="kategori" class="form-control">
                    <option value="Man - Sepatu Derbies" >Man - Sepatu Derbies</option>
                    <option value="Man - Sneaker & Skate" >Man - Sneaker & Skate</option>
                    <option value="Man - Sepatu Olahraga" >Man - Sepatu Olahraga</option>
                    <option value="Man - Sendal & Flip-Flop" >Man - Sendal & Flip-Flop</option>
                    <option value="Man - Sepatu Formal" >Man - Sepatu Formal</option>
                    <option value="Man - Slip On & Espardiles" >Man - Slip On & Espardiles</option>
                    <option value="Man - Loafers" >Man - Loafers</option>
                    <option value="Man - Boots" >Man - Boots</option> 
                    <option value="Woman - Wedges" >Woman - Wedges</option>
                    <option value="Woman - Flats & Balerina" >Woman - Flats & Balerina</option>
                    <option value="Woman - Slip On" >Woman - Slip On</option>
                    <option value="Woman - Sandal" >Woman - Sandal</option>
                    <option value="Woman - Heels" >Woman - Heels</option>
                    <option value="Woman - Sneaker" >Woman - Sneaker</option>
                    <option value="Woman - Boots" >Woman - Boots</option>
                    <option value="Woman - Sepatu Olahraga" >Woman - Sepatu Olahraga</option>
                    <option value="Woman - Loafers" >Woman - Loafers</option>                   
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="harga" class="col-sm-1 control-label">Harga</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" id="harga" name='harga'>
            </div>
        </div>
        <tr><td colspan="2">
            <?php echo form_submit('submit','Simpan', 'class="btn btn-primary"');?>
            <?php echo anchor('admin/sepatu','Kembali', 'class="btn btn-default"');?></td></tr>
    </table>
    <?php
    echo form_close();
    ?>