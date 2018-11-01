<?php $this->load->view('header');?>
    <style>
  .GaugeMeter{
    Position:        Relative;
    Text-Align:      Center;
    Overflow:        Hidden;
    Cursor:          Default;
  }

  .GaugeMeter SPAN,
  .GaugeMeter B{
    Margin:          0 23%;
    Width:           54%;
    Position:        Absolute;
    Text-align:      Center;
    Display:         Inline-Block;
    Color:           RGBa(0,0,0,.8);
    Font-Weight:     100;
    Font-Family:     "Open Sans", Arial;
    Overflow:        Hidden;
    White-Space:     NoWrap;
    Text-Overflow:   Ellipsis;
  }

  .GaugeMeter {
      margin: auto;
      width: 50%;
      padding: 10px;
  }
  .GaugeMeter[data-style="Semi"] B{
    Margin:          0 10%;
    Width:           80%;
  }

  .GaugeMeter S,
  .GaugeMeter U{
    Text-Decoration: None;
    Font-Size:       .5em;
    Opacity:         .5;
  }

  .GaugeMeter B{
    Color:           Black;
    Font-Weight:     300;
    Font-Size:       .5em;
    Opacity:         .8;
  }
  
  .box-footer{
	 background-color:#209dc6;
	  color:white
  }
  
  .box-footer a{
	 // background-color:#e24341;
	  color:white
  }
  .box-body{
	  min-height: 80px;
  }
  
  .val-square{
	  border:1px solid #67c89c;
	  border-radius:5px;
	  width:100%;
	  //padding:10px 0px 10px 0px 
	  height:100%;
  }
  
  .val-square-header{
		width:100%;
		height:35px;
		border-bottom:1px solid #67c89c;
		text-align:center;
		padding: 7px;
		color: #fff;
		font-size: 15px;
		background: #67c89c;
	  
  }
  
  .val-square-body{
		width:100%;
		height:25px;
		text-align:center;
		min-height: 100px;
		font-size: 25px;
		font-weight: 700;
		padding-top: 20px;
	}
	.box-body .box-header{
	  text-align:center;
	}
	
	.square-green{
		background-color:#c0efd8;
	}
	
	.square-merah  {
		background-color:#ff8989;
		border-color:#f33a3a;
	}
	
	.square-merah   .val-square-header{
		background-color:#f33a3a;
	}
	
	.square-lightbrown {
		background-color:antiquewhite;
		border-color:#efb467;
	}
	
	.square-lightbrown  .val-square-header{
		background-color:#efb467;
	}
	
	.square-lightgray  {
		background-color:#e4e0e0;
		border-color:#8d8d8d;
	}
	
	.square-lightgray   .val-square-header{
		background-color:#8d8d8d;
	}
	
	.square-violete {
		background-color:#c39cf5;
		border-color:#8040d2;
	}
	
	.square-violete .val-square-header{
		background-color:#8040d2;
	}
	
	.square-lightblue {
		background-color:#77def5;
		border-color:#4fbdcf;
	}
	
	.square-lightblue .val-square-header{
		background-color:#4fbdcf;
	}
	
	.square-brown  {
		background-color:#edf3b2;
		border-color:#c3c12e;
	}
	
	.square-brown  .val-square-header{
		background-color:#c3c12e;
	}
  
  .glyphicon-refresh-animate {
		-animation: spin .7s infinite linear;
		-ms-animation: spin .7s infinite linear;
		-webkit-animation: spinw .7s infinite linear;
		-moz-animation: spinm .7s infinite linear;
	}

	@keyframes spin {
		from { transform: scale(1) rotate(0deg);}
		to { transform: scale(1) rotate(360deg);}
	}
	  
	@-webkit-keyframes spinw {
		from { -webkit-transform: rotate(0deg);}
		to { -webkit-transform: rotate(360deg);}
	}

	@-moz-keyframes spinm {
		from { -moz-transform: rotate(0deg);}
		to { -moz-transform: rotate(360deg);}
	}
</style>
  
 <!--  <div class="row">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  </div> -->
<section class="content">
  <div class="row">
		<div class="col-md-12">
			<h4 class="page-header">
				Overview
			</h4>
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<div class="input-group">
							<div class="input-group-addon" id="spinner">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control" id="date_daily_product" value="<?php echo date('Y-m-d')?>">
						</div>
					</div>
				</div>
			</div>
			<br>
		</div>
		
		<div class="col-md-12">
			<div class="box box-danger">
				<div class="box-header with-border" style="margin-bottom: 10px;">
					<i class="fa fa-bar-chart"></i><h3 class="box-title"> Jumlah Transaksi</h3>
				</div>
				<div class="box-body no-padding">
					<div class="row">
						<div class="col-lg-3 col-xs-6">
						  <!-- small box -->
						  <div class="small-box bg-aqua">
							<div class="inner">
							  <h3>150</h3>

							  <p>New Orders</p>
							</div>
							<div class="icon">
							  <i class="ion ion-bag"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						  </div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-xs-6">
						  <!-- small box -->
						  <div class="small-box bg-green">
							<div class="inner">
							  <h3>53<sup style="font-size: 20px">%</sup></h3>

							  <p>Bounce Rate</p>
							</div>
							<div class="icon">
							  <i class="ion ion-stats-bars"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						  </div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-xs-6">
						  <!-- small box -->
						  <div class="small-box bg-yellow">
							<div class="inner">
							  <h3>44</h3>

							  <p>User Registrations</p>
							</div>
							<div class="icon">
							  <i class="ion ion-person-add"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						  </div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-xs-6">
						  <!-- small box -->
						  <div class="small-box bg-red">
							<div class="inner">
							  <h3>65</h3>

							  <p>Unique Visitors</p>
							</div>
							<div class="icon">
							  <i class="ion ion-pie-graph"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						  </div>
						</div>
						<!-- ./col -->
					  </div>
				</div>
			</div>
		</div>
        <div class="col-md-8">
          <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-random"></i><h3 class="box-title">Kondisi Hidrologi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<div class="col-md-12">
					<div id="container" style="height:400px"></div>
				</div>
				<div class="col-md-6">
					<div class="box box-danger" style="border-top-color:#5abede !important;">
						<div class="box-header with-border">
						  <h3 class="box-title">Month To Date</h3>
						</div>
						<div class="box-body no-padding">
							<div class="col-md-12">
								<div id="monthly_transaksi"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-danger" style="border-top-color:#5abede !important;">
						<div class="box-header with-border">
						  <h3 class="box-title">Year To Date</h3>
						</div>
						<div class="box-body no-padding">
							<div class="col-md-12">
								<div id="yearly_transaksi"></div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="<?php echo base_url()?>/dashasahan/tools/debit-harian?d=1" class="uppercase">Detail Debit Harian <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
		<div class="col-md-4">
          <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-random"></i><h3 class="box-title">Transaksi Terhutang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<div id="terhutang"></div>
            </div>
            <!-- /.box-footer -->
          </div>
          <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-random"></i><h3 class="box-title">Piutang Usaha</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<div id="piutang"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="<?php echo base_url()?>/dashasahan/tools/water-level-toba?d=1" class="uppercase">Detail Water Level Toba <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
		<div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-hourglass-3"></i><h3 class="box-title">Daftar Akun Terpantau</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<div class="col-md-12">
					<table class="table table-strips table-hover" id="example">
						<thead>
							<tr>
								<th>Akun</th>
								<th>Bulan Ini</th>
								<th>Tahun Ini</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Kas (1-1111)</td>
								<td>Rp. 0</td>
								<td>Rp. 0</td>
							</tr>
							<tr>
								<td>Petty Cash (1-1112)</td>
								<td>Rp. 0</td>
								<td>Rp. 0</td>
							</tr>
							<tr>
								<td>Bank MANDIRI (1-1124)</td>
								<td>Rp. 0</td>
								<td>Rp. 0</td>
							</tr>
							<tr>
								<td>Bank CIMBNIAGA (1-1125)</td>
								<td>Rp. 0</td>
								<td>Rp. 0</td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
		<div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-gears"></i><h3 class="box-title">Biaya Operasional</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
		<div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-gears"></i><h3 class="box-title">Laba Rugi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
		<div class="col-md-4">
              <!-- USERS LIST -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-recycle"></i><h3 class="box-title">Pemeliharaan Sungai</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<div class="col-md-6">
					<div class="box box-danger" style="border-top-color:#5abede !important;">
						<div class="box-header with-border">
						  <h3 class="box-title">Volume</h3>
						</div>
						<div class="box-body no-padding">
							<div class="col-md-12" style="min-height:150px">
								<div class="val-square square-violete">
									<div class="val-square-body square-violete" id="volume_pelastik"></div>
									<div class="val-square-header"><label>Pelastik</label></div>
								</div>
							</div>
							<div class="col-md-12" style="min-height:150px">
								<div class="val-square square-lightblue">
									<div class="val-square-body square-lightblue" id="volume_eceng"></div>
									<div class="val-square-header"><label>Eceng Gondok</label></div>
								</div>
							</div>
							<div class="col-md-12" style="min-height:150px">
								<div class="val-square square-brown">
									<div class="val-square-body square-brown" id="volume_lain"></div>
									<div class="val-square-header"><label>Lain - Lain</label></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-danger" style="border-top-color:#5abede !important;">
						<div class="box-header with-border">
						  <h3 class="box-title">Pencapaian</h3>
						</div>
						<div class="box-body no-padding">
							<div class="col-md-12" style="min-height:150px">
								<div class="val-square square-green">
									<div class="val-square-body square-green" id="pencapaian_plastik"></div>
									<div class="val-square-header"><label>Pelastik</label></div>
								</div>
							</div>
							<div class="col-md-12" style="min-height:150px">
								<div class="val-square square-lightbrown">
									<div class="val-square-body square-lightbrown" id="pencapaian_eceng"></div>
									<div class="val-square-header"><label>Eceng Gondok</label></div>
								</div>
							</div>
							<div class="col-md-12" style="min-height:150px">
								<div class="val-square square-merah">
									<div class="val-square-body square-merah" id="pencapaian_lain"></div>
									<div class="val-square-header"><label>Lain - Lain</label></div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="<?php echo base_url()?>/dashasahan/tools/volume-sampah?d=1" class="uppercase">Detail Kinerja Pemeliharaan Sungai <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
  </div>
</section>
<?php $this->load->view('footer');?>

<?php
$cab1 = 0;
$cab2 = 0;

$month1 = 0;
$month2 = 0;
$total = $cab1+$cab2;

$total2 = $month1+$month2;
$target = $total2+3220000;
$total_ach = (($total2/$target)*100);

$total3 = ($total+3110000) * 12;
$target_year = $target*12;
$total_year_ach = (($total3/$target_year)*100);

?>
<script>
	$(document).ready(function(){
		
		//sungai -----------------------------------
		document.getElementById('volume_eceng').innerHTML = (0);
		document.getElementById('volume_pelastik').innerHTML = (0);
		document.getElementById('volume_lain').innerHTML = (0);
		document.getElementById('pencapaian_eceng').innerHTML = (0);
		document.getElementById('pencapaian_plastik').innerHTML = (0);
		document.getElementById('pencapaian_lain').innerHTML = (0);
		
		//$("#example").dataTable();
		
		Highcharts.chart('container', {

			title: {
				text: 'Avaibility Target '
			},

			subtitle: {
				text: ''
			},
			chart: {
				type: 'column'
			},

			xAxis: {
				categories: [
								'Jan',
								'Feb',
								'Mar',
								'Apr',
								'May',
								'Jun',
								'Jul',
								'Aug',
								'Sep',
								'Oct',
								'Nov',
								'Dec'
							],
			},
			yAxis: {
				title: {
					text: 'Percentage (%)'
				},
				labels: {
					formatter: function () {
						return this.value;
					}
				}
			},
			tooltip: {
				crosshairs: true,
				shared: true
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'bottom'
			},

			series: [{
				name: 'Cabang 1',
				data: [81934, 52503, 57367, 69918, 97031, 111111, 132113, 154175]
			},{
				name: 'Cabang 2',
				data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
			}]

			});
			
			
		Highcharts.chart('terhutang', {

			title: {
				text: 'Avaibility Target '
			},

			subtitle: {
				text: ''
			},
			chart: {
				type: 'column'
			},

			xAxis: {
				categories: [
								'<?php echo date("m/d",strtotime("-7 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-6 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-5 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-4 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-3 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-2 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-1 days",strtotime(date('Y-m-d'))))?>',
							],
			},
			yAxis: {
				title: {
					text: 'Percentage (%)'
				},
				labels: {
					formatter: function () {
						return this.value;
					}
				}
			},
			tooltip: {
				crosshairs: true,
				shared: true
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'bottom'
			},

			series: [{
				name: 'Cabang 1',
				data: [8193400, 5250300, 5736700, 6991800, 9703100, 11111100, 13211300]
			},{
				name: 'Cabang 2',
				data: [4393400, 5250300, 5717700, 6965800, 9703100, 11993100, 13713300]
			}]

			});
		
		console.log('');
			
		Highcharts.chart('piutang', {

			title: {
				text: 'Avaibility Target '
			},

			subtitle: {
				text: ''
			},
			chart: {
				type: 'column'
			},

			xAxis: {
				categories: [
								'<?php echo date("m/d",strtotime("-7 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-6 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-5 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-4 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-3 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-2 days",strtotime(date('Y-m-d'))))?>',
								'<?php echo date("m/d",strtotime("-1 days",strtotime(date('Y-m-d'))))?>',
							],
			},
			yAxis: {
				title: {
					text: 'Percentage (%)'
				},
				labels: {
					formatter: function () {
						return this.value;
					}
				}
			},
			tooltip: {
				crosshairs: true,
				shared: true
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'bottom'
			},

			series: [{
				name: 'Cabang 1',
				data: [61934, 32503, 77367, 49918, 37031, 211111, 432113]
			},{
				name: 'Cabang 2',
				data: [43934, 22503, 47177, 49658, 97031, 119931, 137133]
			}]

			});
			
			Highcharts.chart('monthly_transaksi', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'Monthly'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				series: [{
					name: 'Brands',
					colorByPoint: true,
					data: [{
						name: 'Chrome',
						y: 61.41,
						sliced: true,
						selected: true
					}, {
						name: 'Internet Explorer',
						y: 11.84
					}, {
						name: 'Firefox',
						y: 10.85
					}, {
						name: 'Edge',
						y: 4.67
					}]
				}]
			});
			
			Highcharts.chart('yearly_transaksi', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'Yearly'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				series: [{
					name: 'Brands',
					colorByPoint: true,
					data: [{
						name: 'Chrome',
						y: 61.41
					}, {
						name: 'Internet Explorer',
						y: 11.84
					}, {
						name: 'Firefox',
						y: 10.85
					}, {
						name: 'Edge',
						y: 4.67
					}]
				}]
			});
	});
</script>