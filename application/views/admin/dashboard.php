<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">    
    <title>Zapato | <?php echo $title; ?></title>
    <!-- Bootstrap core CSS -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <style type='text/css'>
		body {
  		padding-top: 30px;
		}
		.starter-template {
  		padding: 10px 0px;
  		text-align: left;
		}

	    .putih{
	      color: #FFFFFF;
	    }
	</style>
  <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
  </head>
  <body>  
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-screenshot"></i> Zapato Footwear</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo site_url('admin/transaksi');?>"><i class="glyphicon glyphicon-list-alt"></i> Transaksi</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/sepatu');?>"><i class="glyphicon glyphicon-tag"></i> Sepatu</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/gudang');?>"><i class="glyphicon glyphicon-home"></i> Gudang</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('administrasi');?>"><i class="glyphicon glyphicon-edit"></i> Administrasi</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"><i class="glyphicon glyphicon-user"></i> <?php echo $this->session->userdata('user_id'); ?> <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo site_url('administrasi/edit/'.$this->session->userdata('user_id'));?>">Pengaturan</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('administrasi/logout');?>">Keluar</a></li>
                      </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
      </div>
    </div>
    <div class="container">
      <div class="starter-template">
  <h2><?php echo $title; ?></h2>
  <!-- =============================================== -->

  <?php $this->load->view($page) ?>

  <!-- =============================================== -->
  </div>
    </div><!-- /.container --></div>

    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/transition.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/dropdown.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/collapse.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/modal.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/bootstrap-hover-dropdown.min.js'); ?>"></script>
  </body>
</html>