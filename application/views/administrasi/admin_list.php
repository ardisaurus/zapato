<table class="table table-hover table-hover table-bordered table-striped table-condensed">
    <thead>
    <tr><th class='text-center'>Nama Admin</th><th class='text-center'>No. Telepon</th><th class='text-center'>Alamat</th></tr>
    </thead>
    <tbody>
    <?php
    if (isset($administrasi)) {
      foreach ($administrasi as $m){
        if ($m->level=="admin") {
          echo "<tr>
          <td>$m->nama</td>
          <td>$m->telepon</td>
          <td>$m->alamat</td></tr>";
        }
      }
    }else{
      ?>
      <tr><td colspan="6" class="text-center text-danger danger">No data</td></tr>
      <?php
    }    
    ?>
    </tbody>
</table>
