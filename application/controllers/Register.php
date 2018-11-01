<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('menu');
		$this->load->model('register_model');
		$this->load->model('master_model');
		$this->load->library('MyPHPMailer');
	}
	
	public function index(){
		$data['judul']				= "User Register";
		$data['csrf']				= $csrf = generate();
		$this->session->set_userdata(array('reg_csrf' => $csrf));
		$this->load->view('register/create',$data);
	}
	
	public function save(){
		$post = $this->input->post();
		$data = json_decode($post['data']);
		$gen = md5(generate()."n".generate());
		if($data->csrf == $this->session->userdata('reg_csrf')){
				if($name = $this->register_model->check_user($data)){
					$return = array(
								'data' => "Username Is Used",
								'code' => 4
							);
				}else if($name = $this->register_model->check_email($data)){
					$return = array(
								'data' => "Email Is Used",
								'code' => 5
							);
				}else{
				
					/* $fromEmail = "budianatekom@gmail.com"; //ganti dg alamat email kamu di sini
					//$isiEmail = "Isi email tulis disini"; //ini isi emailnya
					$nm_cust="";
					$no_inv="";
					$number_terbilang="";
					$jatuh_tempo="";
					$ups = "";
					$saldo_akhir="";
					$isiEmail = "<html>
								<body style=\"font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">
								

								<p>Verification</p>
								<br/>
								<p>Terima Kasih telah bergabung dengan SMS Merdeka. Klik link berikut untuk memverifikasi email anda. <a href='".base_url()."index.php/register/verify?reg_code=$gen'>Verification Here</a></p>
								</body>
								<p>&nbsp;</p>
								<p>Komp. Buah Batu Regency A2 No.9-10 Kel. Kujangsari / Cijawaru Kec. Bandung Kidul, Jawa Barat | Indonesia</p>
								<p>©2018 <a href='neuronworks.co.id'>Neuronworks</a> All rights reserved.</p>
								
								<hr>
								<body style=\"font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#666666;\">
								<p>This document is automatic generated by system</p>
								<p>No signature required</p>
								</body>
								<hr>

							</html>";
					$mail = new PHPMailer();
					$mail->IsHTML(true);    //ini agar email bisa mengirim dalam format HTML
					$mail->IsSMTP();   //kita akan menggunakan SMTP
					$mail->SMTPAuth   = true; //Autentikasi SMTP: enabled
					$mail->SMTPSecure = "ssl";  //jenis keamanan SMTP
					$mail->Host       = "smtp.gmail.com"; //setting GMail sebagai SMTP server
					$mail->Port       = 465; // SMTP port to connect to GMail
					$mail->Username   = $fromEmail;
					$mail->Password   = "sauydumvmmc@123"; //ganti dg password GMail kamu
					$mail->SetFrom('budianatekom@gmail.com', 'Neuron SMS');  //Siapa yg mengirim email
					$mail->Subject    = "Verification "; //ini subjek emailnya
					$mail->Body       = $isiEmail;
					$toEmail = $data->email; // siapa yg menerima email ini
					$mail->AddAddress($toEmail);
				   
					if(!$mail->Send()) {
						$return = array(
							'data' => "Eror: ".$mail->ErrorInfo,
							'code' => 3
						);
					} else { */
						
						$id = $this->register_model->save($data, $gen);
						if($id){
							$return = array(
								'data' => "success",
								'code' => 0
							);
						}else{
							$return = array(
								'data' => "failed",
								'code' => 1
							);
						}
					/* } */
				}
		}else{
			$return = array(
				'data' => "forbiden",
				'code' => 2
			);
		}
		
		
		echo json_encode($return);
	}
	
	public function verify(){
		$post = $this->input->get();
		$id = $this->register_model->verify($post);
		if($id){
			$return = array(
				'data' => "success",
				'code' => 0
			);
			redirect('main');
		}else{
			$return = array(
				'data' => "failed",
				'code' => 1
			);
		}
		
		
		echo json_encode($return);
	}
	
	public function search_user(){
		$name = $this->input->post('pn_name');
		$datax = $this->transaksi_model->user($name);
		$list = array();
		$temp = array();
		if($datax > 0){
			foreach($datax as $row){
				$list[$row->id_customer] = $row;
			}
			
			$return = array(
				'data' => $datax,
				'user_list' => $list,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'user_list' => $list,
				'code' => 1
			);
		}
		echo json_encode($return);
	}
	
	public function search_produk(){
		$name = $this->input->post('pn_name');
		$datax = $this->transaksi_model->search_produk($name);
		$list = array();
		$temp = array();
		if($datax > 0){
			foreach($datax as $row){
				$row->harga_dec = number_format($row->harga);
				$list[$row->id_produk] = $row;
			}
			
			$return = array(
				'data' => $datax,
				'user_list' => $list,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'user_list' => $list,
				'code' => 1
			);
		}
		echo json_encode($return);
	}
	
	public function number(){
		echo to_number($this->input->post('total'));
	}
	
	public function decimal(){
		
		echo to_decimal($this->input->post('total'));
	}
	
	public function save_bukti(){
		//print_r($_FILES['file']);exit;
		$id = $this->input->get('id');
        $nmfile="";
		$ekstensi_file	= '.jpg';
		$this->load->library('upload');
		$nmfile = $id.$ekstensi_file; //nama file + fungsi time
		$config['upload_path'] = './gambar_barang/'; //Folder untuk menyimpan hasil upload
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; //maksimum besar file 3M
		$config['max_width']  = '5000'; //lebar maksimum 5000 px
		$config['max_height']  = '5000'; //tinggi maksimu 5000 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya

		$this->upload->initialize($config);
		//print_r($_FILES['file']['name']);exit;
		if($_FILES['file']['name'])
		{
			if (!$this->upload->do_upload('file'))
			{
				echo $this->upload->display_errors();
			}else{
				$gbr = $this->upload->data();
				$this->transaksi_model->save_id_lampiran($nmfile,$id);
			}
		}

    }
	
	public function jurnal(){
		$data['judul']				= "Buat Jurnal";
		$data['account_list'] 			= $this->transaksi_model->account_list();
		$this->load->view('transaksi/v_input_jurnal',$data);
	}
	
	public function list_transaksi(){
		$data['judul']				= "List Transaksi";
		$this->load->view('transaksi/v_list_transaksi',$data);
	}
	
	public function load_list(){
		$datax = $this->transaksi_model->load_list();
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->jumlah_bayar = number_format($row->jumlah_bayar);
				$row->jumlah_item = number_format($row->jumlah_item);
				$row->jumlah_pajak = number_format($row->jumlah_pajak);
				$row->sub_total = number_format($row->sub_total);
				$row->discount = number_format($row->discount);
				array_push($temp, $row);
			}
			$return = array(
				'data' => $temp,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => array(),
				'code' => 1
			);
		}
		echo json_encode($return);
	}
	
	public function detail_transaksi(){
		$id = $this->input->post('id');
		$datax = $this->transaksi_model->detail_transaksi($id);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->harga_satuan = number_format($row->harga_satuan);
				$row->jumlah = number_format($row->jumlah);
				$row->pajak = number_format($row->pajak);
				array_push($temp, $row);
			}
			$return = array(
				'data' => $temp,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => array(),
				'code' => 1
			);
		}
		echo json_encode($return);
	}
	
	public function save_jurnal(){
		$post = $this->input->post();
		$datax = $this->transaksi_model->save_jurnal($post);
		if($datax){
			$return = array(
				'data' => $datax,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1
			);
		}
		echo json_encode($return);
	}
}