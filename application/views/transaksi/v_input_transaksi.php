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
            <div class="box-header" style="padding:0px">
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<form enctype="multipart/form-data" id="submit">
					<div class="col-md-12">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<input type="text" id="nama_pelanggan"  onkeyup="return cari_pelanggan()" class="form-control" placeholder="[Auto]">
								<input type="hidden" id="id_pelanggan">
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email_pelanggan" class="form-control">
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group" >
								<label>No Referensi</label>
								<input type="text" id="no_referensi" class="form-control moneydec">
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Alamat Penagihan</label>
								<textarea id="alamat_penagihan" class="form-control" ></textarea>
							</div>
						</div>
						<hr>
					</div>
					
					<div class="col-md-12">
						<div class="col-sm-6 col-md-3">
							<div class="form-group" >
								<label>Tanggal Transaksi</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="tanggal_transaksi" class="form-control" readonly value="<?php echo date('d/m/Y')?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Nomor Transaksi</label>
								<input type="text" id="nomor_transaksi" class="form-control" placeholder="[Auto]">
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group" >
								<label>Tanggal Invoice</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="tanggal_invoice" class="form-control date" value="">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Term Of Payment (Hari)</label>
								<select id="top" class="form-control">
									<option value="0">NET 1</option>
									<option value="10">NET 10</option>
									<option value="15">NET 15</option>
									<option value="30">NET 30</option>
									<option value="45">NET 45</option>
									<option value="60">NET 30</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-sm-6 col-md-3">
							<div class="form-group" >
								<label>Metode Pembayaran</label>
								<select id="metode_pembayaran" onchange="return tujuan()" class="form-control">
									<option value="cash">Cash</option>
									<option value="debit">Debit</option>
									<option value="credit">Credit</option>
									<option value="transfer">Transfer</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group" id="tujuan">
								<label>Tujuan</label>
								<select id="tujuan_transfer" class="form-control" disabled>
									<option value="">Pilih Salah Satu</option>
									<?php 
										if($bank_list > 0){
											foreach($bank_list as $row){
												echo '<option value="'.$row->account_num.'">'.$row->account_name.'</option>';
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Nomor Faktur Pajak</label>
								<input type="text" id="nomor_faktur" class="form-control" placeholder="[Auto]">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-hover table-strips">
							<thead>
								<tr>
									<th width="28%">Nama Produk</th>
									<th width="15%">Deskripsi</th>
									<th width="12%">Kuantitas</th>
									<th width="7%">Satuan</th>
									<th width="10%">Harga Satuan</th>
									<th width="10%">Pajak</th>
									<th width="22%">Jumlah</th>
								</tr>
							</thead>
							<tbody id="produk">
								<tr id="produk_1">
									<td>
										<div class="input-group">
											<div class="input-group-addon" onclick="return delete_produk(1)">
												<i class="fa fa-trash"></i>
											</div>
											<input type="text" id="nama_produk_1" onkeyup="return cari_produk(1)" class="form-control">
											<input type="hidden" id="id_produk_1" class="form-control">
											<input type="hidden" id="counter" class="form-control" value="2">
										</div>
									</td>
									<td><textarea style="height: 33px;" id="deskripsi_1" class="form-control"></textarea></td>
									<td>
										<div class="input-group">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return min_item(1)">-</button>
											</div>
											<input type="text" id="kuantitas_1" onkeyup="return hitung_item(1)" class="form-control">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return add_item(1)">+</button>
											</div>
										</div>
									</td>
									<td><input type="text" id="satuan_1" class="form-control" readonly></td>
									<td>
										<input type="text" id="harga_satuan_1" class="form-control" readonly>
										<input type="hidden" id="harga_satuan_dec_1" class="form-control" readonly>
									</td>
									<td>
										<select id="pajak_1" class="form-control" onchange="return ppn(1)">
											<option value="0">Non PPN </option>
											<option value="10">PPN </option>
											<option value="15">PPN & Service</option>
										</select>
									<td>
										<input type="text" id="jumlah_1" class="form-control" readonly>
										<input type="hidden" id="jumlah_dec_1" value="0" class="form-control" readonly>
									</td>
								</tr>
								<tr id="produk_2">
									<td>
										<div class="input-group">
											<div class="input-group-addon" onclick="return delete_produk(2)">
												<i class="fa fa-trash"></i>
											</div>
											<input type="text" id="nama_produk_2" onkeyup="return cari_produk(2)" class="form-control">
											<input type="hidden" id="id_produk_2" class="form-control">
										</div>
									</td>
									<td><textarea style="height: 33px;" id="deskripsi_2" class="form-control"></textarea></td>
									<td>
										<div class="input-group">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return min_item(2)">-</button>
											</div>
											<input type="text" id="kuantitas_2" onkeyup="return hitung_item(1)" class="form-control">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return add_item(2)">+</button>
											</div>
										</div>
									</td>
									<td><input type="text" id="satuan_2" class="form-control" readonly></td>
									<td>
										<input type="text" id="harga_satuan_2" class="form-control" readonly>
										<input type="hidden" id="harga_satuan_dec_2" class="form-control" readonly>
									</td>
									<td>
										<select id="pajak_2" class="form-control" onchange="return ppn(2)">
											<option value="0">Non PPN </option>
											<option value="10">PPN </option>
											<option value="15">PPN & Service</option>
										</select>
									</td>
									<td>
										<input type="text" id="jumlah_2" onchange="return hitung_all()" class="form-control" readonly>
										<input type="hidden" id="jumlah_dec_2" value="0" class="form-control" readonly>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="7">
										<button type="button" class="btn btn-success" onclick="return add_product()"><i class="fa fa-plus"></i> Tambah Produk</button>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="col-md-12">
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<span>Pesan</span>
								<div class="input-group">
									<textarea id="pesan" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<span>Lampiran</span>
								<div class="input-group">
									<input type="file" name="file"  id="image_file" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							
						</div>
						<div class="col-md-4 col-sm-12" style="padding-right: 10px;">
							<div class="form-group  pull-right">
								<span>Subtotal</span>
								<div class="input-group">
									<input type="text" id="subtotal" readonly class="form-control">
								</div>
							</div>
							<div class="form-group pull-right">
								<span>Potongan</span>
								<div class="input-group">
									<input type="text" id="discount" onkeyup="return hitung_all()" class="form-control money" >
								</div>
							</div>
							<div class="form-group pull-right">
								<span>Total</span>
								<div class="input-group">
									<input type="text" id="total" readonly class="form-control">
								</div>
							</div>
						</div>
						<input type="hidden" id="invoice_status" value="0">
					</div>
					<div class="col-md-12">
						<hr>
						
					</div>
					<div class="col-md-12" id="btn_save">
						
						<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
						<span class="btn btn-danger pull-right" onclick="return simpan_invoice()"><i class="fa fa-save"></i> Simpan & Cetak Invoice</span>
						
					</div>
					<div class="col-md-12">
						<br>
						<br>
					</div>
				</form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<script>
	function curency(x=''){
		if(x == ''){
			x = 0;
		}
		return x.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
	}
	
	function decimal(x=''){
		if(x == ''){
			x = 0;
		}
		return x.toString().replace(/[^0-9.-]+/g,"");
	}
	
	$('.date').datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
	});
	
	function simpan_invoice(){
		if($('#id_pelanggan').val() == ''){
			alert('Silahkan pilih customer');
			return false;
		}
		$('#invoice_status').val('1');
		$('#submit').submit();
	}
	$('#submit').submit(function(e){
		var counter = $('#counter').val();
		var transaksi = new Array();
		if($('#metode_pembayaran').val() != "cash" && $('#tujuan_transfer').val() == ""){
			alert("Silahkan pilih tujuan pembayaran !");
			return false;
		}
		
		if($('#invoice_status').val() == 1){
			document.getElementById('btn_save').innerHTML = '<span class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</span><span class="btn btn-danger pull-right"><i class="fa fa-spinner"></i> Simpan & Cetak Invoice</span>';
		}else{
			document.getElementById('btn_save').innerHTML = '<span class="btn btn-success pull-right"><i class="fa fa-spinner"></i> Simpan</span><span class="btn btn-danger pull-right"><i class="fa fa-save"></i> Simpan & Cetak Invoice</span>';
		}
		
		for(i=1;i<=counter;i++){
			var temp = {
				nama_produk	:$('#nama_produk_'+i).val(),
				id_produk	:$('#id_produk_'+i).val(),
				deskripsi	:$('#deskripsi_'+i).val(),
				kuantitas	:$('#kuantitas_'+i).val(),
				satuan		:$('#satuan_'+i).val(),
				harga_satuan_dec:$('#harga_satuan_dec_'+i).val(),
				pajak		:$('#pajak_'+i).val(),
				jumlah_dec	:$('#jumlah_dec_'+i).val(),
			}
			if($('#jumlah_dec_'+i).val() != 0 && $('#id_produk_'+i).val() != ''){
				transaksi.push(temp);
			}
		}
		if(transaksi.length > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/transaksi/save',
				type: "POST",
				data: {
					discount			: $('#discount').val(),
					id_pelanggan		: $('#id_pelanggan').val(),
					nama_pelanggan		: $('#nama_pelanggan').val(),
					email_pelanggan		: $('#email_pelanggan').val(),
					no_referensi		: $('#no_referensi').val(),
					alamat_penagihan	: $('#alamat_penagihan').val(),
					tanggal_transaksi	: $('#tanggal_transaksi').val(),
					nomor_transaksi		: $('#nomor_transaksi').val(),
					metode_pembayaran	: $('#metode_pembayaran').val(),
					tujuan				: $('#tujuan_transfer').val(),
					top					: $('#top').val(),
					tanggal_invoice		: $('#tanggal_invoice').val(),
					pesan				: $('#pesan').val(),
					lampiran			: $('#lampiran').val(),
					nomor_faktur		: $('#nomor_faktur').val(),
					transaksi 			: transaksi
				},
				success: function(datax) {
					var datax = JSON.parse(datax);
					if(datax.code == 0 && $('#image_file').val() != ''){
						var formData = new FormData();
						formData.append('file', $('input[type=file]')[0].files[0]);
						$.ajax({
							url:'<?php echo base_url()?>index.php/transaksi/save_bukti?id='+(datax.data),
							type:"post",
							data:  formData,
							processData:false,
							contentType:false,
							cache:false,
							async:false,
							success: function(data){
							  alert('Transaksi berhasil');
							  if($('#invoice_status').val() == 1){
								  $('#invoice_status').val(0);
								  location.replace('<?php echo base_url()?>index.php/transaksi/invoice?inv='+datax.guid);
							  }else{
								  location.replace('<?php echo base_url()?>index.php/transaksi/input');
							  }
							  
							}
						});
					}else if(datax.code == 1){
						alert('Simpan gagal !');
					}else{
						alert('Transaksi berhasil !');
						if($('#invoice_status').val() == 1){
							$('#invoice_status').val(0);
							location.replace('<?php echo base_url()?>index.php/transaksi/invoice?inv='+datax.guid);
						}else{
						  location.replace('<?php echo base_url()?>index.php/transaksi/input');
						}
					}
					document.getElementById('btn_save').innerHTML = '<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button><span class="btn btn-danger pull-right" onclick="return simpan_invoice()"><i class="fa fa-save"></i> Simpan & Cetak Invoice</span>';
				}
			});
		}else{
			document.getElementById('btn_save').innerHTML = '<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button><span class="btn btn-danger pull-right" onclick="return simpan_invoice()"><i class="fa fa-save"></i> Simpan & Cetak Invoice</span>';
			alert('Tidak ada transaksi !');
			$('#invoice_status').val(0);
		}
		return false;
	});
	
	function add_product(){
		var num = $('#counter').val();
		num++;
		$('#produk').append('<tr id="produk_'+num+'">'+
								'<td>'+
									'<div class="input-group">'+
										'<div class="input-group-addon" onclick="return delete_produk('+num+')">'+
											'<i class="fa fa-trash"></i>'+
										'</div>'+
										'<input type="text" id="nama_produk_'+num+'" onkeyup="return cari_produk('+num+')" class="form-control">'+
										'<input type="hidden" id="id_produk_'+num+'" class="form-control">'+
									'</div>'+
								'</td>'+
								'<td><textarea style="height: 33px;" id="deskripsi_'+num+'" class="form-control"></textarea></td>'+
								'<td>'+
									'<div class="input-group">'+
										'<div class="input-group-addon" style="padding: 5px;">'+
											'<button type="button" onclick="return min_item('+num+')">-</button>'+
										'</div>'+
										'<input type="text" id="kuantitas_'+num+'" onkeyup="return hitung_item(1)" class="form-control">'+
										'<div class="input-group-addon" style="padding: 5px;">'+
											'<button type="button" onclick="return add_item('+num+')">+</button>'+
										'</div>'+
									'</div>'+
								'</td>'+
								'<td><input type="text" id="satuan_'+num+'" class="form-control" readonly></td>'+
								'<td>'+
									'<input type="text" id="harga_satuan_'+num+'" class="form-control" readonly>'+
									'<input type="hidden" id="harga_satuan_dec_'+num+'" class="form-control" readonly>'+
								'</td>'+
								'<td>'+
									'<select id="pajak_'+num+'" class="form-control" onchange="return ppn('+num+')">'+
										'<option value="0">Non PPN </option>'+
										'<option value="10">PPN </option>'+
										'<option value="15">PPN & Service</option>'+
									'</select>'+
								'</td>'+
								'<td>'+
									'<input type="text" id="jumlah_'+num+'" class="form-control" readonly>'+
									'<input type="hidden" id="jumlah_dec_'+num+'" value="0" class="form-control" readonly>'+
								'</td>'+
							'</tr>');
		$('#counter').val(num);
	}
	
	function tujuan(){
		if($('#metode_pembayaran').val() == 'cash'){
			$('#tujuan_transfer').val('');
			$('#tujuan_transfer').attr('disabled','disabled');
		}else{
			$('#tujuan_transfer').removeAttr('disabled');
		}
		ppn(x);
		hitung_all();
	}
	
	function min_item(x){
		var jum = $('#kuantitas_'+x).val();
		var harga = $('#harga_satuan_dec_'+x).val();
		var qty = jum;
		if(jum > 1){
			qty = (jum*1)-1;
			$('#kuantitas_'+x).val(qty);
		}
		var total = qty * harga;
		$('#jumlah_'+x).val(curency(total));
		$('#jumlah_dec_'+x).val(total);
		ppn(x);
		hitung_all();
	}
	
	function add_item(x){
		var jum = $('#kuantitas_'+x).val();
		var harga = $('#harga_satuan_dec_'+x).val();
		var qty = (jum*1)+1;
		$('#kuantitas_'+x).val(qty);
		var total = qty * harga;
		
		$('#jumlah_'+x).val(curency(total));
		$('#jumlah_dec_'+x).val(total);	
		ppn(x);
		hitung_all();
	}
	
	function hitung_item(x){
		var jum = $('#kuantitas_'+x).val();
		var harga = $('#harga_satuan_dec_'+x).val();
		var qty = jum;
		$('#kuantitas_'+x).val(qty);
		var total = qty * harga;
		$('#jumlah_'+x).val(curency(total));
		$('#jumlah_dec_'+x).val(total);
		ppn(x);
		hitung_all();
		
	}
	
	function delete_produk(x){
		document.getElementById('produk_'+x+'').style.display = "none";
		$('#id_produk_'+x).val('');
		$('#kuantitas_'+x).val('');
		//var jumlah = harga;
		$('#jumlah_'+x).val('');
		$('#jumlah_dec_'+x).val(0);
		$('#satuan_'+x).val('');
		$('#harga_satuan_'+x).val('');
		$('#harga_satuan_dec_'+x).val('');
		ppn(x);
		hitung_all();
		hitung_all();
	}
	
	function cari_pelanggan(x){
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_user',
			type: "POST",
			data: {pn_name:$('#nama_pelanggan').val()},
			success: function(datax) {
				var datax = JSON.parse(datax);
					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var pn_id = item.id_customer;
						var pn_name = item.nama_customer;
						var alamat = item.alamat;
						if(alamat != null){
							alamat = (item.alamat).substring(0,20);
						}
						
						var temp_name = pn_id+' - '+pn_name+' - '+alamat;
						list_name.push(temp_name);
					});
					$("#nama_pelanggan").autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Tidak ditemukan, klik untuk menambah user'){
								$('#id_pelanggan').val('');
								$('#alamat_penagihan').val('');
								$('#email_pelanggan').val('');
								$('#modal-user').modal();
							}else{
								var str = (ui.item.label).split(' -');
								var index = str[0];
								var user_id = datax.user_list[index]['id_customer'];
								var user_name = datax.user_list[index]['nama_customer'];
								var alamat = datax.user_list[index]['alamat'];
								var no_hp = datax.user_list[index]['nomor_telfon'];
								var email = datax.user_list[index]['email'];
								$('#id_pelanggan').val(user_id);
								$('#alamat_penagihan').val(alamat);
								$('#email_pelanggan').val(email);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									$('#id_pelanggan').val('');
									$('#alamat_penagihan').val('');
									$('#email_pelanggan').val('');
									var noResult = { value:"",label:"Tidak ditemukan, klik untuk menambah user" };
									ui.content.push(noResult);
							}
						}
					});
			}
		});
	}
	
	function cari_produk(x){
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_produk',
			type: "POST",
			data: {pn_name:$('#nama_produk_'+x).val()},
			success: function(datax) {
				var datax = JSON.parse(datax);

					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var nama_produk = item.nama_produk;
						var id_produk = item.id_produk;
						list_name.push(id_produk+' - '+nama_produk);
					});
					
					$("#nama_produk_"+x).autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Produk tidak ditemukan'){
								$('#id_produk_'+x).val('');
								$('#kuantitas_'+x).val('');
								//var jumlah = harga;
								$('#jumlah_'+x).val('');
								$('#jumlah_dec_'+x).val(0);
								$('#satuan_'+x).val('');
								$('#harga_satuan_'+x).val('');
								$('#harga_satuan_dec_'+x).val('');
								ppn(x);
								hitung_all();
							}else{
								var str = (ui.item.label).split(' - ');
								var index = str[0];
								var id_produk = datax.user_list[index]['id_produk'];
								var nama_produk = datax.user_list[index]['nama_produk'];
								var satuan = datax.user_list[index]['satuan'];
								var harga = datax.user_list[index]['harga'];
								var harga_dec = datax.user_list[index]['harga_dec'];
								$('#id_produk_'+x).val(id_produk);
								$('#kuantitas_'+x).val(1);
								var jumlah = harga_dec;
								$('#jumlah_'+x).val(jumlah);
								$('#jumlah_dec_'+x).val(harga);
								$('#nama_produk_'+x).val(str[1]);
								$('#satuan_'+x).val(satuan);
								$('#harga_satuan_'+x).val(harga_dec);
								$('#harga_satuan_dec_'+x).val(harga);
								ppn(x);
								hitung_all();
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									var noResult = { value:"",label:"Produk tidak ditemukan" };
									ui.content.push(noResult);
							}
						}
					});
					
					if(datax.code != '0'){
						$('#id_produk_'+x).val('');
						$('#kuantitas_'+x).val('');
						$('#harga_satuan_dec_'+x).val('');
						//var jumlah = harga;
						$('#jumlah_'+x).val('');
						$('#jumlah_dec_'+x).val(0);
						$('#satuan_'+x).val('');
						$('#harga_satuan_'+x).val('');
						ppn(x);
						hitung_all();
					}
			}
		});
	}
	
	function ppn(x){
		var jum = $('#harga_satuan_dec_'+x).val();
		var qty = $('#kuantitas_'+x).val();
		var ppn = $('#pajak_'+x).val();
		var tot_ppn = Math.round((ppn/100) * (jum*qty));
		var jumlah_dec = decimal(((jum*qty) + tot_ppn));
		var jumlah_cur = curency(((jum*qty) + tot_ppn));
		$('#jumlah_'+x).val(jumlah_cur);
		$('#jumlah_dec_'+x).val(jumlah_dec);
		hitung_all();
	}
	
	
	function hitung_all(){
		var counter = $('#counter').val();
		var subtotal = 0;
		
		for(i=1;i<=counter;i++){
			subtotal = (subtotal*1) + ($('#jumlah_dec_'+i).val()) *1;
		}
		$('#subtotal').val(curency(subtotal));
		
		var total = subtotal-decimal($('#discount').val());
		$('#total').val(curency(total))
		
	}
</script>
