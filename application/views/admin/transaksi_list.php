<?php if ($this->session->flashdata('hasil')) { ?>
<div class="alert alert-warning">
  <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('hasil');?>                  
</div>
<?php } ?>
<?php if ($this->session->flashdata('peringatan')) { ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('peringatan');?>                  
</div>
<?php } ?>
<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class="text-center">ID</th><th class='text-center'>Outlet</th><th class='text-center'>Gudang</th><th class='text-center'>Sepatu</th><th class='text-center'>Ukuran</th><th class='text-center'>Jumlah</th><th class='text-center'>Harga</th><th class='text-center'>Status</th><th width="150px"></th></tr>
    </thead>
    <tbody>
    <?php
    foreach ($transaksi as $m){
        echo "<tr>
              <td class='text-center'>$m->id_transaksi</td>              
              <td>$m->user_id</td>
              <td>$m->nama</td>
              <td>$m->brand - $m->model</td>
              <td class='text-center'>$m->ukuran</td>
              <td class='text-center'>$m->jml</td>
              <td class='text-center'>Rp. $m->harga_total</td>
              <td class='text-center'>$m->status</td>";
        if ($m->status=="Menunggu Konfirmasi") {
          echo "<td align='center'> "."<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#konfirmasi".$m->id_transaksi."'><i class='glyphicon glyphicon-check'></i></button>"." "."<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#tolak".$m->id_transaksi."'><i class='glyphicon glyphicon-remove'></i></button>"."</td>
              </tr>";?>
              <div class="modal fade" id="konfirmasi<?php echo $m->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="labelkonfirmasi<?php echo $m->id_transaksi; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelkonfirmasi<?php echo $m->id_transaksi; ?>">Konfirmasi Pesanan</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin ingin mengkonfirmasi pesanan ini?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('admin/transaksi/dikonfirmasi/'.$m->id_transaksi,'Dikonfirmasi','class="btn btn-primary"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade" id="tolak<?php echo $m->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="labeltolak<?php echo $m->id_transaksi; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeltolak<?php echo $m->id_transaksi; ?>">Tolak Pesanan</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin ingin menolak pesanan ini?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('admin/transaksi/ditolak/'.$m->id_transaksi,'Ditolak','class="btn btn-danger"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
        <?php      
        }elseif($m->status=="Dikonfirmasi"){
          echo "<td align='center'> "."<button class='btn btn-sm btn-success' data-toggle='modal' data-target='#dikirim".$m->id_transaksi."'><i class='glyphicon glyphicon-send'></i> Terkirim</button>"."</td></tr>";?>
                <div class="modal fade" id="dikirim<?php echo $m->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="labeldikirim<?php echo $m->id_transaksi; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labeldikirim<?php echo $m->id_transaksi; ?>">Kirim Pesanan</h4>
                            </div>
                            <div class="modal-body">
                              <p align="center">Anda yakin telah mengirim pesanan ini?</p>                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <?php echo anchor('admin/transaksi/dikirim/'.$m->id_transaksi,'Dikirim','class="btn btn-success"') ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
          <?php          
        } 
    }
    ?>
    </tbody>
</table>