<?php 
	class Transaksi_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function get_pajak_jual(){
			$this->db->trans_begin();
			
			$data['create_date'] = date("Y-m-d H:i:s");

			$id = $this->db->insert('dk_account', $data);

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id;
			}
		}
		
		public function user($search){
			$where = "";
			if(!empty($search)){
				$where = " and (upper(nama_customer) like '%".strtoupper($search)."%' or id_customer like '%".$search."%')";
				$limit = " limit 0,10";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select * from dk_customer where perusahaan='$perusahaan' and cabang='$cabang' $where order by nama_customer $limit";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function search_produk($search){
			$where = "";
			if(!empty($search)){
				$where = " and (upper(nama_produk) like '%".strtoupper($search)."%' or id_produk like '%".$search."%')";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select * from dk_produk where status = '1' and perusahaan='$perusahaan' and (cabang='$cabang' || all_cabang='Y') $where order by nama_produk limit 0,10";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function account_list($pembiayaan=false){
			$where ="";
			if($pembiayaan){
				$where =" and (account_num like '2%' || account_num like '5%' || account_num like '6%' || account_num like '7%' || account_num like '8%')";
			}
			
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select account_num, account_name from dk_account where status = '0' and perusahaan = '$perusahaan' $where";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_list(){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$admin = cek_admin();
			$query 	= "select * from dk_transaksi where perusahaan='$perusahaan' $admin order by tanggal_transaksi desc";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function detail_transaksi($id = null){
			$query 	= "select * from dk_transaksi_detail where id_ref = '$id' order by tanggal_transaksi desc";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function bank_list($id = null){
			$where = "";
			if(!empty($id)){
				$where = " and account_num = '$id'";
			}
			$query 	= "select * from dk_account where LENGTH(account_name) > 6 and (SUBSTR(account_name,1,4) = 'Bank' or SUBSTR(account_name,1,4) = 'bank') and SUBSTR(account_num,1,3) = '1-1' $where";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save($id = null){
			$this->db->trans_begin();
			$data1 = array(
						'discount'			=> str_replace(',','',$this->input->post('discount')),
						'nama_pelanggan'	=> $this->input->post('nama_pelanggan'),
						'email'				=> $this->input->post('email_pelanggan'),
						'no_ref'			=> $this->input->post('no_referensi'),
						'alamat_tagih'		=> $this->input->post('alamat_penagihan'),
						'nomor_transaksi'	=> $this->input->post('nomor_transaksi'),
						'metode_pembayaran' => $this->input->post('metode_pembayaran'),
						'user'				=> $this->session->userdata('pn_id'),
						'cabang'			=> $this->session->userdata('pn_wilayah'),
						'perusahaan'		=> $this->session->userdata('perusahaan'),
						'akun_tujuan'		=> $this->input->post('tujuan'),
						'pesan'				=> $this->input->post('pesan'),
						'top'				=> $this->input->post('top'),
						'tanggal_invoice'	=> $this->input->post('tanggal_invoice'),
						'tanggal_transaksi'	=> date('Y-m-d H:i:s'),
						'status'			=> 0,
					);
			$this->db->insert('dk_transaksi',$data1);
			$id_ref = $this->db->insert_id();
			
			$transaksi = $this->input->post('transaksi');
			$sub = 0;
			$ppn = 0;
			$item = 0;
			foreach($transaksi as $row){
				$nm_produk = explode(' - ',$row['nama_produk']);
				$data = array(
					'nama_produk'		=> $nm_produk[1],
					'id_produk'			=> $row['id_produk'],
					'deskripsi'			=> $row['deskripsi'],
					'kuantitas'			=> $row['kuantitas'],
					'satuan'			=> $row['satuan'],
					'harga_satuan'		=> $row['harga_satuan_dec'],
					'pajak'				=> $row['pajak'],
					'jumlah'			=> $row['jumlah_dec'],
					'id_ref'			=> $id_ref,
					'user'				=> $this->session->userdata('pn_id'),
					'cabang'			=> $this->session->userdata('pn_wilayah'),
					'perusahaan'		=> $this->session->userdata('perusahaan'),
					'tanggal_transaksi'	=> date('Y-m-d H:i:s'),
					'status'			=> 0,
				);
				$sub += $row['jumlah_dec'];
				$ppn += $row['pajak'];
				$item++;
				$this->db->insert('dk_transaksi_detail',$data);
			}
			
			$data2 = array(
						'jumlah_bayar' => ($jumlah_bayar = $sub-(str_replace(',','',$this->input->post('discount')))),
						'jumlah_item' => $item,
						'jumlah_pajak' => $ppn,
						'sub_total' => $sub,
					);
			$this->db->where('id',$id_ref);
			$this->db->update('dk_transaksi',$data2);
			
			
			
			
			$invoice = $this->input->post('tanggal_invoice');
			
			$ak_cred = '4-1110';//revenue - penjualan
			$ak_deb = '1-1111';//kas
			
			if($this->input->post('tujuan') != ''){
				$ak_deb = $this->input->post('tujuan');
			}
			
			if(isset($invoice) && $invoice != ''){
				$ak_cred = '4-1110';//revenue - penjualan
				$ak_deb = '1-1320';//piutang usaha - penjualan
			}
			
			$debit = array(
							'no_akun_debit'		=> $ak_deb,
							'nama_akun_debit'	=> account_name($ak_deb),
							'no_akun_credit'	=> $ak_cred,
							'nama_akun_credit'	=> account_name($ak_cred),
							'tanggal'			=> date('Y-m-d H:i:s'),
							'no_bukti'			=> $this->input->post('nomor_transaksi'),
							'keterangan'		=> 'Penjualan',
							'type'				=> 'Debit',
							'jumlah_debit'		=> $jumlah_bayar,
							'jumlah_credit'		=> $jumlah_bayar,
							'user'				=> $this->session->userdata('pn_id'),
							'cabang'			=> $this->session->userdata('pn_wilayah'),
							'perusahaan'		=> $this->session->userdata('perusahaan'),
							'create_date'		=> date("Y-m-d H:i:s"),
							'status'			=> 0,
							'no_ref'			=> $id_ref,
						);
			$this->db->insert('dk_jurnal',$debit);
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $id_ref;
			}
		}
		
		public function save_id_lampiran($name=null,$id=null){
			$this->db->trans_begin();
			$this->db->where('id',$id);
			$this->db->update('dk_transaksi',array('lampiran'=>$name));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id;
			}
		}
		
		public function save_jurnal($name=null,$id=null){
			$this->db->trans_begin();
			
			$transaksi = $this->input->post('transaksi');
			foreach($transaksi as $row){
				$debit = array(
								'no_akun_debit'			=> $row['akun_debet'],
								'nama_akun_debit'		=> account_name($row['akun_debet']),
								'no_akun_credit'		=> $row['akun_kredit'],
								'nama_akun_credit'		=> account_name($row['akun_kredit']),
								'tanggal'				=> date("Y-m-d H:i:s",strtotime($row['tanggal'])),
								'no_bukti'				=> $row['no_bukti'],
								'create_date'			=> date("Y-m-d H:i:s"),
								'keterangan'			=> $row['deskripsi'],
								'jumlah_debit'			=> str_replace(',','',$row['debet']),
								'jumlah_credit'			=> str_replace(',','',$row['kredit']),
								'user'					=> $this->session->userdata('pn_id'),
								'cabang'				=> $this->session->userdata('pn_wilayah'),
								'perusahaan'			=> $this->session->userdata('perusahaan'),
								'create_date'			=> date("Y-m-d H:i:s"),
								'status'				=> 0,
							);
				$this->db->insert('dk_jurnal',$debit);
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return true;
			}
		}
	}