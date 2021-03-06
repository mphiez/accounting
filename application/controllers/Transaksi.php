<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('transaksi_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
	}
	
	public function index(){
		$data['judul']				= "Buat Penjualan";
		$this->load->view('order/penjualan/v_input_penjualan',$data);
	}
	
	public function input(){
		$data['judul']				= "Buat Penjualan";
		$data['bank_list'] 			= $this->transaksi_model->bank_list();
		$this->load->view('transaksi/v_input_transaksi',$data);
	}
	
	function invoice(){
		$id = $this->input->get('inv');
		$data['data_invoice']				= $this->transaksi_model->dataInvoice($id);
		$html							= $this->load->view('transaksi/v_invoice',$data,true);
		$pdfFilePath					= "laba rugi.pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				10, // margin_left
				20, // margin Left  -
				20, // margin right -
				0, // margin top - 
				10, // margin bottom
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		
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
	
	public function save(){
		$post = $this->input->post();
		$datax = $this->transaksi_model->save($post);
		if($datax){
			$return = array(
				'data' => $datax,
				'code' => 0,
				'guid' => md5($datax)
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
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