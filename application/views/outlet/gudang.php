<?php if ($this->session->flashdata('peringatan')) { ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('peringatan');?>                  
        </div>
    <?php } ?>
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
              <td align='center'> ".anchor('outlet/gudang/stok/'.$m->id_gudang,'<i class="glyphicon glyphicon-eye-open"></i> Lihat Stok','class="btn btn-sm btn-info"')."</td>
              </tr>";
    }
    ?>
    </tbody>
</table>