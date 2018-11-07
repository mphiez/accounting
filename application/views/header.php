<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AMS Neuron - Acountan Managment System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url()?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>font-awesome-4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="<?=base_url()?>font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="shortcut icon" href="<?=base_url()?>/assets/icon.ico" type="image/x-icon" /> 
  <link rel="stylesheet" href="<?=base_url()?>dist/ionicons.min.css">
  <!-- data tables -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?=base_url()?>plugins/datatables/jquery.dataTables.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/iCheck/flat/blue.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/chosen/chosen.css">
  <link rel="stylesheet" href="<?=base_url()?>plugins/chosen/chosen.min.css">
  <link rel="stylesheet" href="<?=base_url()?>plugins/jQueryUI/jquery-ui.css">
  <link rel="stylesheet" href="<?=base_url()?>plugins/chart/exporting.js">
  
  <script src="<?php echo base_url()?>plugins/libs/Chart.js/2.7.3/Chart.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
	.dataTables_wrapper .dataTables_paginate .paginate_button {
		padding: 0px;
	}
	.new-item{
		height:50px; 
		width:120px; 
		border:1px solid lightgray;
		border-radius:3px;
		padding:10px 5px 5px 5px;
		margin:5px 5px 15px 5px;
	}
	
	.add-item{
		background-color:red;
	}
	
	.label{
		font-size: 12px;
		color:black;
	}
	
	/* .main-header .content-danger, .card .header-danger, .skin-blue .main-header .navbar, .skin-blue .main-header .logo {
		background: linear-gradient(60deg,#ef5350,#d32f2f) !important;
	}
	
	.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side, .skin-blue .sidebar-menu > li:hover > a, .skin-blue .sidebar-menu > li.active > a, .skin-blue .sidebar-menu > li.menu-open > a, .treeview-menu, .skin-blue .sidebar-menu > li > .treeview-menu, .skin-blue .sidebar-menu .treeview-menu > li > a  {
		background-color: #fff;
	}
	
	.treeview span, .treeview .fa, .skin-blue .sidebar-menu .treeview-menu > li > a, skin-blue .sidebar a {
		color: #1877ae !important;
		white-space: normal;
	}
	.treeview a:hover {
		background-color:#e9e9e9 !important;
	}
	
	.treeview a:hover, skin-blue .sidebar a {
		background-color:#e9e9e9 !important;
	}
	
	.treeview-menu a:hover, treeview > li > a:hover, skin-blue .sidebar a:hover{
		color:black !important;
	} 
	
	.header-menu{
		text-align: center;
		margin: 0px 10px 5px 10px !important;
		border: 1px solid red;
		color: white !important;
		border-radius: 4px;
		background-color: #e44543 !important;
		padding: 7px !important;
	} */
	
	.input-group-addon{
		cursor:pointer;
	}
	.fa-trash:hover{
		color:red;
	}
  </style>
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php $val = check_akun();
		if($val && $val['status_akun'] == 1){
			$ts1 = (date("Y-m-d",strtotime($val['verify_date'])));
			$ts2 = (date("Y-m-d"));
			$dStart = new DateTime($ts1);
			$dEnd  = new DateTime($ts2);
			$dDiff = $dStart->diff($dEnd);
			if($val['status_akun'] == '1'){
			?>
			<section class="content-header" style="padding:5px;background-color:yellow">
				<div class="row">
					<div class="col-xs-12">
						<?php if((date("Y-m-d",strtotime("+1 month", strtotime($val['verify_date'])))) > date("Y-m-d")){?>
						<p class="btn btn-danger btn-sm"><i class="fa fa-hourglass-3"></i>  Trial Mode : <span> <?php echo (30-$dDiff->days);?> days left</span></p>
						<?php }else{
						?>
						<p class="btn btn-danger btn-sm"><i class="fa fa-hourglass-3"></i>  Your trial mode is expired, please upgrade your account</span></p>
						<?php
						}?>
						<a href="<?php echo base_url()?>index.php/upgrade?uc=dsfdsgDFD454vvcvd54" class="btn btn-success btn-sm"><i class="fa fa-rocket"></i><span> Upgrade Your Account Here</span></a>
						<a href="<?php echo base_url()?>index.php/upgrade?uc=dsfdsgDFD454vvcvd54" class="btn btn-info btn-sm pull-right"><span style="border:1px solid lightgray;border-radius:6px;padding:0px 4px;background-color:white;color: #8f8787;"><b>?</b></span><span> More info</span></a>
					</div>
				</div>
			</section>
			<?php
			}
		}
	?>
	
<div class="wrapper">
	
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()?>" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DMS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
			<a class="dropdown-toggle" href="#" data-toggle="dropdown">
				<i class="fa fa-bell-o"></i>
				<span class="label label-warning">10</span>
			</a>
            <ul class="dropdown-menu">
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
            </ul>
		  </li>
          <li class="dropdown user user-menu">
			<a class="dropdown-toggle" href="#" data-toggle="dropdown">
				<i class="fa fa-envelope"></i>
				<span class="label label-warning">10</span>
			</a>
            <ul class="dropdown-menu">
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
            </ul>
		  </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url()?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->userdata('pn_name')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?=$this->session->userdata('pn_name')?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url()?>index.php/login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('pn_name')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header header-menu">MAIN NAVIGATION</li>
		<?php 
		$active = $this->uri->segment(1);
		$sub_ac		= $this->uri->segment(2);
		$pn_jabatan = $this->session->userdata('pn_jabatan');
		$pn_akses = $this->session->userdata('pn_akses');
		
		if($pn_akses == '1'){
			echo tampil_menu($pn_jabatan,$active,$sub_ac);
		}
		?>
		 <!-- menu here --> 
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="body-inside">
	
    <!-- Content Header (Page header) -->