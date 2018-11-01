<?php $this->load->view('header');?>
    <section class="content-header">
      <h1>
       <?=$judul?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<div class="box-body">
			  <a href="<?=base_url()?>index.php/master/create_paket" class="btn btn-warning btn-sm" >Tambah Paket <i class="fa fa-plus"></i>
			  </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover " id="example1">
				<thead>
					<tr>
					  <th width="5%">ID Produk</th>
					  <th>Nama Produk</th>
					  <th>Deskripsi</th>
					  <th>Satuan</th>
					  <th>Harga</th>
					  <th>Status</th>
					  <th>Semua Cabang</th>
					  <th>Action</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
              </table>
            </div>
        </div>
        </div>
    </div>
	</section>
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
	load();
  function load(){	
	$("#example1").dataTable({
		"processing": true,
		"ajax": {
			"url": "<?php echo base_url()?>index.php/master/get_paket",
			"type": "POST",
			data: {},
		},
		"destroy": true,
		"oLanguage": {
			"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
		},
		"aoColumns": [
			{ "data": "id_produk"},
			{ "data": "nama_produk"},
			{ "data": "deskripsi"},
			{ "data": "satuan"},
			{ "data": "harga"},
			{ "data": "status_paket"},
			{ "data": "all_cabang"},
			{
				render: function (data, type, row, meta) {
					return '<a href="<?php echo base_url()?>index.php/master/edit_paket/'+row.id_produk+'" class="btn btn-warning btn-sm" onclick="return edit(&#39;'+row.id+'&#39;)"><i class="fa fa-pencil"></i> Update</a>';
				}
			}
		],
		"order": [[ 0, "asc" ]],
	});
}

function edit(x){
	
}
</script>