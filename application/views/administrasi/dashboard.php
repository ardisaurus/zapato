<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">    
    <title>Zapato | <?php echo $title; ?></title>
    <!-- Bootstrap core CSS -->
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

      <!-- JavaScript Includes -->
  <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
  </head>
  <body>  
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-screenshot"></i> Zapato Footwear</a>
        </div>
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
    <!-- Angular.js Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
  </body>
</html>