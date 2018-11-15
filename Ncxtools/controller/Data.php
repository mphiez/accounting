<?php

namespace Neuron\Application\Ncxtools\Controller;

require './vendor/PHPExcel/PHPExcel.php';
require './vendor/PHPExcel/PHPExcel/IOFactory.php';
use Neuron\Generic\Result;
use Neuron\Application\Ncxtools\Data as DataModel;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;

class Data extends Controller {

    public function indexAction($message = '') {

        return $this->getREST()->getResponse(new Result(0, 0, 'Data API'));
    }

    public function processAction() {
        try {
            //$this->isLoggedIn(true);
            $post = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb($module = __NAMESPACE__, 'secondary'), $this->getConfig()));
			$sid = null; //user_id
			$table = null; //tabel
			$oldvalue = null; //value lama
			$newvalue = null; //value baru
			$function = null; //fungsi update / insert
			
            $result = $cData->logActivity($sid, $table, $oldvalue, $newvalue, $function);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function getDataAction() {
        try {
            //$this->isLoggedIn(true);
            $post = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->loadData();

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function loadRekapAction() {
        try {
            //$this->isLoggedIn(true);
            $post = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->loadRekap();

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function uploadExcelAction() {
		$result = new result();
        try {
			$data = array();
			if(!empty($_FILES["excel_file"]))  
			{
				$file_array = explode(".", $_FILES["excel_file"]["name"]);
				if($file_array[1] == "xls" || $file_array[1] == "xlsx")  
				{
				   $output = '';  
				   $output .= '';
				   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
				   foreach($object->getWorksheetIterator() as $worksheet)  
				   {  
						$highestRow = $worksheet->getHighestRow();  
						for($row=2; $row<=$highestRow; $row++)  
						{
							$tabel = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
							$action = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							$value = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
							$id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							$date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
							$temp = array(
								'tabel' => $tabel,
								'action' => $action,
								'value' => $value,
								'id' => $id,
								'date' => $date,
							);
							
							array_push($data,$temp);
						}
				   }
				}
			}
			
			$result->data = $data;

			return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function loadOgpAction() {
        try {
            //$this->isLoggedIn(true);
            $post = $this->getRequest()->getPost();
			
			//print_r($this->getDb( __NAMESPACE__, 'third'));

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->loadOgp($post);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function loadAmAction() {
        try {
            //$this->isLoggedIn(true);
            $post = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->loadAm($post);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function loadquoteAction() {
        try {
            //$this->isLoggedIn(true);
            $post = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->loadquote($post);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function filterAction() {
        try {
            //$this->isLoggedIn(true);
            $post = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->filter();

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function loadRestAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->filter();

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function getHierarchyAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->getHierarchy($data, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function getDetailcabasaAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();

			$config = $this->getServerConfig();
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->getDetailcabasa($data, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function getDetailCustomerAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();

			$config = $this->getServerConfig();
			
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->getDetailCustomer($data, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function getListCustomerAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();

			$config = $this->getServerConfig();
			
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->getListCustomer($data, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function detailAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->detail($data);
			
			$total = $cData->total($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function updateAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();


			$config = $this->getServerConfig();
			
			
			$session = $this->getSession();
			$code_sess = $session->get('code');
			
			$in_type = "SINGLE";
			$in_file_name = "";
			
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->update($data['data1'],$code_sess,$in_type,$in_file_name, $config);
			
			/* $data_log = $data['data1'];
			$data_log['OLD_LOC'] = $data['data1']['IN_LOC'];
			$data_log['OLD_NAME'] = $data['data2']['IN_NAME'];//yg dirubah
			$data_log['OLD_CURRENCY'] = $data['data1']['IN_CURRENCY'];
			$data_log['OLD_STATUS'] = $data['data1']['IN_STATUS'];
			$data_log['OLD_BUSINESS_AREA'] = $data['data1']['IN_BUSINESS_AREA'];
			$data_log['OLD_CUSTOMER_GROUP'] = $data['data1']['IN_CUSTOMER_GROUP'];
			$data_log['OLD_ACCOUNT_NAS'] = $data['data2']['IN_ACCOUNT_NAS'];//yg dirubah
			$data_log['OLD_AFFILIATED_ID'] = $data['data1']['IN_AFFILIATED_ID'];
			$data_log['OLD_BP_TYPE'] = $data['data1']['IN_BP_TYPE'];
			$data_log['OLD_CLASSIFICATION'] = $data['data1']['IN_CLASSIFICATION'];
			$data_log['OLD_PRICING_PROCEDURE'] = $data['data1']['IN_PRICING_PROCEDURE'];
			$data_log['OLD_PPN'] = $data['data1']['IN_PPN'];
			$data_log['OLD_REGION'] = $data['data1']['IN_REGION'];
			$data_log['OLD_SEGMENT'] = $data['data1']['IN_SEGMENT'];
			$data_log['OLD_SUB_SEGMENT'] = $data['data1']['IN_SUB_SEGMENT'];
			$data_log['OLD_TAX_NUM'] = $data['data1']['IN_TAX_NUM'];
			$data_log['OLD_VAT_CATEGORY'] = $data['data1']['IN_VAT_CATEGORY'];
			$data_log['OLD_WITEL'] = $data['data1']['IN_WITEL'];
			$data_log['OLD_NIPNAS'] = $data['data2']['IN_NIPNAS'];//yg dirubah
			$data_log['OLD_ACC_NUM'] = $data['data1']['IN_ACC_NUM'];
            $data_log['OLD_REASON'] = $data['data2']['IN_REASON'];
			$data_log['UPDATE_API'] = "update";
			$data_log['UPDATE_BY'] = $code_sess;
			$data_log['UPDATE_TYPE'] = "CABASA";
			$data_log['UPDATE_STATUS'] = $result->code;

            //print_r($data_log);die();
			
			$cData->update_log($data_log); */

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function tesQueryAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->tesQuery($data, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function getListOrderAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->getListOrder($data, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function updateTanggalAction() {
		try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();
			
			$code = $this->getREST()->getCode();

			$data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();
			
			$session = $this->getSession();
			$code_sess = $session->get('code');
			
			$in_file_name = "";
			$in_type = "SINGLE";
			
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->sendOrder($data, $code_sess,$in_file_name,$in_type, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
	}
		
    public function getListTerminAction() {
        try {
            $guid = $this->getREST()->getGuid();
			
            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
			
            $result = $cData->getListTermin($data, $config);

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
		
    public function updateTerminAction() {
        try {
            $guid = $this->getREST()->getGuid();
			
            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();

            $in_file_name = "";
            $in_type = "SINGLE TERMIN";
			
			$session = $this->getSession();
			$code_sess = $session->get('code');

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->updateTermin($data['data'], $data['asset_key'], $in_file_name, $in_type, $code_sess, $data['order_id'], $config);
			
            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getListCAAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

           // $data = $this->getRequest()->getPost();

            $data = $_GET['search'];
            //print_r($a['search']);die();

           // print_r($code_sess);exit;


            //print_r($data);die();
			
			$config = $this->getServerConfig();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->getListCA($data, $config);

          //  print_r($result);die();

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function saveMoveBACAAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

			
			$config = $this->getServerConfig();

            //print_r($data);die();

            $session = $this->getSession();
            $code_sess = $session->get('code');
            //print_r($data);die();
            $in_file_name = "";
            $in_type = "SINGLE MOVE";

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->saveMove($data, $code_sess, $in_file_name, $in_type, $config);


            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
	}

     public function uploadUpdateAction() {
        $result = new result();
        try {
			$data = array();
			$datax = array('data','nama_file');
			if(!empty($_FILES["excel_file"]))  
			{
				$file_array = explode(".", $_FILES["excel_file"]["name"]);
				$nama_file = "";
				foreach($file_array as $rows){
					if(!empty($nama_file)){
						$nama_file .= ".".$rows;
					}else{
						$nama_file .= $rows;
					}
				}
				
				$nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
				
				if($file_array[(count($file_array)-1)] == "xls" || $file_array[(count($file_array)-1)] == "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
				{
				   $output = '';  
				   $output .= '';
				   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
				   foreach($object->getWorksheetIterator() as $worksheet)  
				   { 
						$highestRow = $worksheet->getHighestRow();  
						for($row=2; $row<=$highestRow; $row++)  
						{
							$loc = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
							$name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							$nipnas = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
							$acnas = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							$status = "Valid";
							if($loc == ''){
								$status = "not valid";
							}
							$temp = array(
								'loc' => $loc,
								'name' => $name == "" ? "" : $name,
								'nipnas' => $nipnas == "" ? "" : $nipnas,
								'acnas' => $acnas == "" ? "" : $acnas,
								'status' => $status == "" ? "" : $status
							);
							
							array_push($data,$temp);
						}
						$datax = array(
							'data' => $data,
							'nama_file' => $nama_file
						);
				   }
				}else{
					$result->code = 9;
					$result->info = 'Invalid File';
				}
			}
			
			$result->data = $datax;

			return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

     public function sendUpdateAction() {
        $result = new result();
        try {
			$config = $this->getServerConfig();
			$data = array();
			$datax = array('data','nama_file');
			
			$session = $this->getSession();
			$code_sess = $session->get('code');
			if(!empty($_FILES["excel_file"]))  
			{
				$file_array = explode(".", $_FILES["excel_file"]["name"]);
				$nama_file = "";
				foreach($file_array as $rows){
					if(!empty($nama_file)){
						$nama_file .= ".".$rows;
					}else{
						$nama_file .= $rows;
					}
				}
				
				$nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
				
				if($file_array[(count($file_array)-1)] == "xls" ||  $file_array[(count($file_array)-1)]== "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
				{
				   $output = '';  
				   $output .= '';
				   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
				   foreach($object->getWorksheetIterator() as $worksheet)  
				   {
						$total = 0;
						$error = 0;
						$highestRow = $worksheet->getHighestRow();  
						for($row=2; $row<=$highestRow; $row++)  
						{
							$loc = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
							$name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							$nipnas = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
							$acnas = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							$status = "Valid";
							if($loc == ''){
								$status = "not valid";
							}
							$temp = array(
								'IN_LOC' => $loc,
								'IN_NAME' => $name,
								'IN_NIPNAS' => $nipnas,
								'IN_ACCOUNT_NAS' => $acnas,
								'IN_USER' => $code_sess
							);
							
							$total++;
							if($status == 'Valid'){
								$in_type = "BULK";
								$in_file_name = $nama_filex;
								$cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
								$result = $cData->sendUpdate($temp, $code_sess, $in_type, $in_file_name, $config);
								if($result->code == 0){
									
								}else{
									$error++;
								}
							}else{
								$error++;
							}
							
						}
						$datax = array(
							'data' => $data,
							'nama_file' => $nama_file
						);
						$result->data = "Jumlah : ".$total.", Error : ".$error;
				   }
				   
				   $result->info = "Jumlah : ".$total.", Error : ".$error;
				}else{
					$result->code = 9;
					$result->info = 'Invalid File';
				}
			}

			return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function uploadOrderAction() {
        $result = new result();
        try {
			$data = array();
			$datax = array('data','nama_file');
			if(!empty($_FILES["excel_file"]))  
			{
				$file_array = explode(".", $_FILES["excel_file"]["name"]);
				$nama_file = "";
				foreach($file_array as $rows){
					if(!empty($nama_file)){
						$nama_file .= ".".$rows;
					}else{
						$nama_file .= $rows;
					}
				}
				
				$nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
				
				if($file_array[(count($file_array)-1)] == "xls" || $file_array[(count($file_array)-1)] == "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
				{
				   $output = '';  
				   $output .= '';
				   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
				   foreach($object->getWorksheetIterator() as $worksheet)  
				   { 
						$highestRow = $worksheet->getHighestRow();  
						for($row=2; $row<=$highestRow; $row++)  
						{
							$order_id 			= $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
							$sid 				= $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
							$provisioning_order = explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue()));
							$bill_order 		= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue()));
							$baso_order 		= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(4, $row)->getFormattedValue()));
							$integration_order 	= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(5, $row)->getFormattedValue()));
							$agree_start_order 	= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(6, $row)->getFormattedValue()));
							$agree_end_order 	= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue()));
							
							
							$status = "Valid";
							if($order_id == ''){
								$status = "Not valid";
							}
							
							if(isset($provisioning_order[1]) && $provisioning_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($bill_order[1]) && $bill_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($baso_order[1]) && $baso_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($integration_order[1]) && $integration_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($agree_start_order[1]) && $agree_start_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($agree_end_order[1]) && $agree_end_order[1] > 12){
								$status = "Not valid Date";
							}
							
							$temp = array(
								'agree_end_order' 	=> $agree_end_order[0] == "" || empty($agree_end_order[1]) ? "" : date("d-m-Y",strtotime($agree_end_order[2]."-".$agree_end_order[1]."-".$agree_end_order[0])),
								'agree_start_order' => $agree_start_order[0] == "" || empty($agree_start_order[1])  ? "" : date("d-m-Y",strtotime($agree_start_order[2]."-".$agree_start_order[1]."-".$agree_start_order[0])),
								'baso_order' 		=> $baso_order[0] == "" || empty($baso_order[1])  ? "" : date("d-m-Y",strtotime($baso_order[2]."-".$baso_order[1]."-".$baso_order[0])),
								'bill_order' 		=> $bill_order[0] == "" || empty($bill_order[1])  ? "" : date("d-m-Y",strtotime($bill_order[2]."-".$bill_order[1]."-".$bill_order[0])),
								'integration_order' => $integration_order[0] == "" || empty($integration_order[1])  ? "" : date("d-m-Y",strtotime($integration_order[2]."-".$integration_order[1]."-".$integration_order[0])),
								'provisioning_order' => $provisioning_order[0] == "" || empty($provisioning_order[1])  ? "" : date("d-m-Y",strtotime($provisioning_order[2]."-".$provisioning_order[1]."-".$provisioning_order[0])),
								'order_id' 			=> $order_id,
								'sid' 				=> $sid,
								'status' 			=> $status
							);
							
							array_push($data,$temp);
						}
						$datax = array(
							'data' => $data,
							'nama_file' => $nama_file
						);
				   }
				}else{
					$result->code = 9;
					$result->info = 'Invalid File';
				}
			}
			
			$result->data = $datax;

			return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

     public function sendOrderAction() {
        $result = new result();
        try {
			$config = $this->getServerConfig();
			$data = array();
			$datax = array('data','nama_file');
			if(!empty($_FILES["excel_file"]))  
			{
				$file_array = explode(".", $_FILES["excel_file"]["name"]);
				$nama_file = "";
				foreach($file_array as $rows){
					if(!empty($nama_file)){
						$nama_file .= ".".$rows;
					}else{
						$nama_file .= $rows;
					}
				}
				
				$nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
				
				if($file_array[(count($file_array)-1)] == "xls" ||  $file_array[(count($file_array)-1)]== "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
				{
				   $output = '';  
				   $output .= '';
				   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
				   foreach($object->getWorksheetIterator() as $worksheet)  
				   { 
						$highestRow = $worksheet->getHighestRow();  
						for($row=2; $row<=$highestRow; $row++)  
						{
							$order_id 			= $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
							$sid 				= $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
							$provisioning_order = explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue()));
							$bill_order 		= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue()));
							$baso_order 		= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(4, $row)->getFormattedValue()));
							$integration_order 	= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(5, $row)->getFormattedValue()));
							$agree_start_order 	= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(6, $row)->getFormattedValue()));
							$agree_end_order 	= explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue()));
							
							
							$status = "Valid";
							if($order_id == ''){
								$status = "not valid";
							}
							
							if(isset($provisioning_order[1]) && $provisioning_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($bill_order[1]) && $bill_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($baso_order[1]) && $baso_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($integration_order[1]) && $integration_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($agree_start_order[1]) && $agree_start_order[1] > 12){
								$status = "Not valid Date";
							}
							
							if(isset($agree_end_order[1]) && $agree_end_order[1] > 12){
								$status = "Not valid Date";
							}
						
							$temp = array(
								'agree_end_order' 	=> $agree_end_order[0] == "" || empty($agree_end_order[1]) ? "" : date("d-m-Y",strtotime($agree_end_order[2]."-".$agree_end_order[1]."-".$agree_end_order[0])),
								'agree_start_order' => $agree_start_order[0] == "" || empty($agree_start_order[1])  ? "" : date("d-m-Y",strtotime($agree_start_order[2]."-".$agree_start_order[1]."-".$agree_start_order[0])),
								'baso_order' 		=> $baso_order[0] == "" || empty($baso_order[1])  ? "" : date("d-m-Y",strtotime($baso_order[2]."-".$baso_order[1]."-".$baso_order[0])),
								'bill_order' 		=> $bill_order[0] == "" || empty($bill_order[1])  ? "" : date("d-m-Y",strtotime($bill_order[2]."-".$bill_order[1]."-".$bill_order[0])),
								'integration_order' => $integration_order[0] == "" || empty($integration_order[1])  ? "" : date("d-m-Y",strtotime($integration_order[2]."-".$integration_order[1]."-".$integration_order[0])),
								'provisioning_order' => $provisioning_order[0] == "" || empty($provisioning_order[1])  ? "" : date("d-m-Y",strtotime($provisioning_order[2]."-".$provisioning_order[1]."-".$provisioning_order[0])),
								'order_id' 			=> $order_id,
								'sid' 				=> $sid,
								'status' 			=> $status
							);
							
							$session = $this->getSession();
							$code_sess = $session->get('code');
							
							$in_file_name = $nama_file;
							$in_type = "BULK";
							
							if($status == 'Valid'){
								$cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
								$result = $cData->sendOrder($temp,$code_sess,$in_file_name,$in_type, $config);
							}
							
						}
						$datax = array(
							'data' => $data,
							'nama_file' => $nama_file
						);
				   }
				}else{
					$result->code = 9;
					$result->info = 'Invalid File';
				}
			}
			
			$result->data = $datax;

			return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function mergesaveAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();

            $session = $this->getSession();
            $code_sess = $session->get('code');
            //print_r($data);die();
			
			$session = $this->getSession();
			$code_sess = $session->get('code');
			
			$in_file_name = "";
			$in_type = "SINGLE";

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->sendMerge($data, $code_sess, $in_type, $in_file_name, $config);


            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function uploadMergeAction() {
        $result = new result();
        try {
			$data = array();
			$datax = array('data','nama_file');
			if(!empty($_FILES["excel_file"]))  
			{
				$file_array = explode(".", $_FILES["excel_file"]["name"]);
				$nama_file = "";
				foreach($file_array as $rows){
					if(!empty($nama_file)){
						$nama_file .= ".".$rows;
					}else{
						$nama_file .= $rows;
					}
				}
				
				$nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
				
				if($file_array[(count($file_array)-1)] == "xls" || $file_array[(count($file_array)-1)] == "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
				{
				   $output = '';  
				   $output .= '';
				   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
				   foreach($object->getWorksheetIterator() as $worksheet)  
				   { 
						$highestRow = $worksheet->getHighestRow();  
						for($row=2; $row<=$highestRow; $row++)  
						{
							$ba_old 			= $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
							$ba_new				= $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
							$acnas_new 			= $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
							
							
							$status = "Valid";
							if($ba_old == '' || $ba_new == "" || $acnas_new == ""){
								$status = "not valid";
							}
						
							$temp = array(
								'ba_old' 			=> $ba_old,
								'ba_new' 			=> $ba_new,
								'acnas_new' 		=> $acnas_new,
								'status' 			=> $status
							);
							
							array_push($data,$temp);
						}
						$datax = array(
							'data' => $data,
							'nama_file' => $nama_file
						);
				   }
				}else{
					$result->code = 9;
					$result->info = 'Invalid File';
				}
			}
			
			$result->data = $datax;

			return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

     public function sendMergeAction() {
        $result = new result();
        try {
			$config = $this->getServerConfig();
			$data = array();
			$datax = array('data','nama_file');
			if(!empty($_FILES["excel_file"]))  
			{
				$file_array = explode(".", $_FILES["excel_file"]["name"]);
				$nama_file = "";
				foreach($file_array as $rows){
					if(!empty($nama_file)){
						$nama_file .= ".".$rows;
					}else{
						$nama_file .= $rows;
					}
				}
				
				$nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
				
				if($file_array[(count($file_array)-1)] == "xls" ||  $file_array[(count($file_array)-1)]== "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
				{
				   $output = '';  
				   $output .= '';
				   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
				   foreach($object->getWorksheetIterator() as $worksheet)  
				   { 
						$highestRow = $worksheet->getHighestRow();  
						for($row=2; $row<=$highestRow; $row++)  
						{
							$ba_old 			= $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
							$ba_new				= $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
							$acnas_new 			= $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
							
							
							$status = "Valid";
							if($ba_old == '' || $ba_new == "" || $acnas_new == ""){
								$status = "not valid";
							}
						
							$temp = array(
								'IN_LOC_BA_OLD' 	=> $ba_old,
								'IN_LOC_BA_NEW' 	=> $ba_new,
								'IN_NEW_ACCNAS' 	=> $acnas_new,
								'ACCNAS_LAIN' 		=> "",
								'status' 			=> $status
							);
							
							$session = $this->getSession();
							$code_sess = $session->get('code');
							
							$in_file_name = $nama_file;
							$in_type = "BULK";
							
							if($status == 'Valid'){
								$cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
								$result = $cData->sendMerge($temp,$code_sess,$in_file_name,$in_type, $config);
							}
							
						}
						$result->code = 0;
						$result->info = 'Merge Success';
				   }
				}else{
					$result->code = 9;
					$result->info = 'Invalid File';
				}
			}
			
			//$result->data = $datax;

			return $this->getREST()->getResponse($result);
			} catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function uploadMoveAction() {
        $result = new result();
        try {
            $data = array();
            $datax = array('data','nama_file');
            if(!empty($_FILES["excel_file"]))  
            {
                $file_array = explode(".", $_FILES["excel_file"]["name"]);
                $nama_file = "";
                foreach($file_array as $rows){
                    if(!empty($nama_file)){
                        $nama_file .= ".".$rows;
                    }else{
                        $nama_file .= $rows;
                    }
                }
                
                $nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
                
                if($file_array[(count($file_array)-1)] == "xls" || $file_array[(count($file_array)-1)] == "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
                {
                   $output = '';  
                   $output .= '';
                   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
                   foreach($object->getWorksheetIterator() as $worksheet)  
                   { 
                        $highestRow = $worksheet->getHighestRow();  
                        for($row=2; $row<=$highestRow; $row++)  
                        {

                            $ba_source = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $ca_source = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $ca_target = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $nipnas = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $status = "Valid";

                            if($ba_source == '' || $ca_source == '' || $ca_target == '' || $nipnas == ''){
                                $status = "not valid";
                            }
                            $temp = array(
                                'ba_source' => $ba_source,
                                'ca_source' => $ca_source,
                                'ca_target' => $ca_target,
                                'nipnas' => $nipnas,
                                'status' => $status
                            );
                            
                            array_push($data,$temp);
                        }
                        $datax = array(
                            'data' => $data,
                            'nama_file' => $nama_file
                        );
                   }
                }else{
                    $result->code = 9;
                    $result->info = 'Invalid File';
                }
            }
            
            $result->data = $datax;

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }



    public function sendMoveAction() {
        $result = new result();
        try {
			$config = $this->getServerConfig();
            $data = array();
            $datax = array('data','nama_file','result');
            if(!empty($_FILES["excel_file"]))  
            {
                $file_array = explode(".", $_FILES["excel_file"]["name"]);
                $nama_file = "";
                foreach($file_array as $rows){
                    if(!empty($nama_file)){
                        $nama_file .= ".".$rows;
                    }else{
                        $nama_file .= $rows;
                    }
                }
                
                $nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
                
                if($file_array[(count($file_array)-1)] == "xls" ||  $file_array[(count($file_array)-1)]== "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
                {
                   $output = '';  
                   $output .= '';
                   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
                   foreach($object->getWorksheetIterator() as $worksheet)  
                   { 
                        $highestRow = $worksheet->getHighestRow();  
						$temp_res = array();
                        for($row=2; $row<=$highestRow; $row++)  
                        {
                            
                            $ba_source = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $ca_source = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $ca_target = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $nipnas = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $status = "Valid";

                            if($ba_source == '' || $ca_source == '' || $ca_target == '' || $nipnas == ''){
                                $status = "not valid";
                            }
                            $temp = array(
                                'ba_source' => $ba_source,
                                'ca_source' => $ca_source,
                                'ca_target' => $ca_target,
                                'nipnas' => $nipnas,
                                'status' => $status
                            );
                            
                            $session = $this->getSession();
                            $code_sess = $session->get('code');

                            
                            $in_file_name = $nama_file;
                            $in_type = "BULK MOVE";

                            
                            if($status == 'Valid'){
                                $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
                                $result = $cData->saveMove($temp, $code_sess, $in_file_name, $in_type, $config);
                            }
							
							if($result->code == 0){
								$temp_var = array(
									'ba' => $ba_source,
									'status' => 'success'
								);
							}else{
								$temp_var = array(
									'ba' => $ba_source,
									'status' => 'failed'
								);
							}
							
							array_push($temp_res,$temp_var);
                            
                        }
                        $datax = array(
                            'data' => $data,
                            'nama_file' => $nama_file,
                            'result' => $temp_res
                        );
                   }
                }else{
                    $result->code = 9;
                    $result->info = 'Invalid File';
                }
            }
            
            $result->data = $datax;

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }



    public function uploadTerminAction() {
        $result = new result();
        try {
            $data = array();
            $datax = array('data','nama_file');
            if(!empty($_FILES["excel_file"]))  
            {
                $file_array = explode(".", $_FILES["excel_file"]["name"]);
                $nama_file = "";
                foreach($file_array as $rows){
                    if(!empty($nama_file)){
                        $nama_file .= ".".$rows;
                    }else{
                        $nama_file .= $rows;
                    }
                }
                
                $nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
                
                if($file_array[(count($file_array)-1)] == "xls" || $file_array[(count($file_array)-1)] == "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
                {
                   $output = '';  
                   $output .= '';
                   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
                   foreach($object->getWorksheetIterator() as $worksheet)  
                   { 
                        $highestRow = $worksheet->getHighestRow();  
                        for($row=2; $row<=$highestRow; $row++)  
                        {

                            $sequence = $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
                            //$termin = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $termin = explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue()));
                            $order_id = $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
                            $no_asset = $worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue();
                            $status = "Valid";

                            if($sequence == '' || $termin == '' || $order_id == '' || $no_asset == ''){
                                $status = "not valid";
                            }
							
							if(isset($termin[1]) && $termin[1] > 12){
								$status = "Not valid Date";
							}
							
                            $temp = array(
                                'sequence' => $sequence,
                                'termin' => $termin[0] == "" || empty($termin[1])  ? "" : date("d-m-Y",strtotime($termin[2]."-".$termin[1]."-".$termin[0])),
                                'order_id' => $order_id,
                                'no_asset' => $no_asset,
                                'status' => $status
                            );
                            
                            array_push($data,$temp);
                        }
                        $datax = array(
                            'data' => $data,
                            'nama_file' => $nama_file
                        );
                   }
                }else{
                    $result->code = 9;
                    $result->info = 'Invalid File';
                }
            }
            
            $result->data = $datax;

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function sendTerminAction() {
        $result = new result();
        try {
			$config = $this->getServerConfig();
            $data = array();
            $datax = array('data','nama_file');
            if(!empty($_FILES["excel_file"]))  
            {
                $file_array = explode(".", $_FILES["excel_file"]["name"]);
                $nama_file = "";
                foreach($file_array as $rows){
                    if(!empty($nama_file)){
                        $nama_file .= ".".$rows;
                    }else{
                        $nama_file .= $rows;
                    }
                }
                
                $nama_filex = $nama_file.".".$file_array[(count($file_array)-1)];
                
                if($file_array[(count($file_array)-1)] == "xls" ||  $file_array[(count($file_array)-1)]== "xlsx" || $file_array[(count($file_array)-1)] == "csv")  
                {
                   $output = '';  
                   $output .= '';
                   $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
                   foreach($object->getWorksheetIterator() as $worksheet)  
                   { 
                        $highestRow = $worksheet->getHighestRow();  
                        for($row=2; $row<=$highestRow; $row++)  
                        {
                            
                            $sequence = $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
                            //$termin = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $termin = explode("/",str_replace("-","/",$worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue()));
                            $order_id = $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
                            $no_asset = $worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue();
                            $status = "Valid";

                            if($sequence == '' || $termin == '' || $order_id == '' || $no_asset == ''){
                                $status = "not valid";
                            }
							
							if(isset($termin[1]) && $termin[1] > 12){
								$status = "Not valid Date";
							}
							
                            $temp = array(
                                'sequence' => $sequence,
                                'termin_date' => $termin[0] == "" || empty($termin[1])  ? "" : date("d-m-Y",strtotime($termin[2]."-".$termin[1]."-".$termin[0])),
                                'order_id' => $order_id,
                                'no_asset' => $no_asset,
                                'status' => $status
                            );
                            
                            $session = $this->getSession();
                            $code_sess = $session->get('code');
                            
                            $in_file_name = $nama_file;
                            $in_type = "BULK TERMIN";

                            
                            if($status == 'Valid'){
                                $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
                                $result = $cData->sendTermin($temp, $code_sess,$in_file_name, $in_type, $config);
                            }
                            
                        }
                        $datax = array(
                            'data' => $data,
                            'nama_file' => $nama_file
                        );
                   }
                }else{
                    $result->code = 9;
                    $result->info = 'Invalid File';
                }
            }
            
            $result->data = $datax;

            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function downloadAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			
			
			$data['t_'] =  $_GET['t_'];
			$data['f_'] =  $_GET['f_'];
			$data['p_'] =  $_GET['p_'];
			$data['s_'] =  $_GET['s_'];
			$data['from'] =  $_GET['from'];
			$data['to'] =  $_GET['to'];
			$data['periode_create'] =  $_GET['periode_create'];
			$data['order_type'] =  $_GET['order_type'];
			$data['order_status'] =  $_GET['order_status'];
			$data['divisi'] =  $_GET['divisi'];
			$data['segmen'] =  $_GET['segmen'];
			$data['am'] =  $_GET['am'];
			$data['order_trans'] =  $_GET['order_trans'];
			$data['umur_order'] =  $_GET['umur_order'];
			$data['umur_status_order'] =  $_GET['umur_status_order'];
			$data['vendor_name'] =  $_GET['vendor_name'];
			
			
			if($data['periode_create'] != ''){
				$periode = $data['periode_create'];
				
			}else{
				$periode = $data['from']." s/d ".$data['to'];
			}
			
			if($data['t_'] == 1){
				$tabel = "OGP Dashboard";
			}else if($data['t_'] == 3){
				$tabel = "OGP Dashboard AM";
			}
				
			if($data['f_'] == 3){
				$val = "0 - 7 Hari";
				$div = 'DBS';
			}else if($data['f_'] == 4){
				$val = "7 - 15 Hari";
				$div = 'DBS';
			}else if($data['f_'] == 5){
				$val = "> 15 Hari";
				$div = 'DBS';
			}else if($data['f_'] == 6){
				$val = "";
				$div = 'DBS';
			}else if($data['f_'] == 7){
				$val = "0 - 7 Hari";
				$div = 'DES';
			}else if($data['f_'] == 8){
				$val = "7 - 15 Hari";
				$div = 'DES';
			}else if($data['f_'] == 9){
				$val = "> 15 Hari";
				$div = 'DES';
			}else if($data['f_'] == 10){
				$val = "";
				$div = 'DES';
			}else if($data['f_'] == 11){
				$val = "0 - 7 Hari";
				$div = 'DGS';
			}else if($data['f_'] == 12){
				$val = "7 - 15 Hari";
				$div = 'DGS';
			}else if($data['f_'] == 13){
				$val = "> 15 Hari";
				$div = 'DGS';
			}else if($data['f_'] == 14){
				$val = "";
				$div = 'DGS';
			}else{
				$val = "";
				$div = '';
			}

			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->detailDownload($data);
			
			
			$sheet->setCellValue('A1', "Detail Order");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Periode ");
			$sheet->setCellValue('B2', ": ".$periode);
			
			$sheet->setCellValue('A3', "Divisi ");
			$sheet->setCellValue('B3', ": ".$div);
			
			$sheet->setCellValue('A4', "Umur Order ");
			$sheet->setCellValue('B4', ": ".$val);
			
			if($data['t_'] == 1){
				$sheet->setCellValue('A5', "Process ");
			}else{
				$sheet->setCellValue('A5', "AM Name ");
			}
			
			$sheet->setCellValue('B5', ": ".$data['p_']);
			
			$sheet->setCellValue('A6', "Sub-Process ");
			$sheet->setCellValue('B6', ": ".$data['s_']);
			
			$sheet->setCellValue('A7', "Order Type ");
			$sheet->setCellValue('B7', ": ".$_GET['order_type']);
			
			$sheet->setCellValue('A8', "Order Status ");
			$sheet->setCellValue('B8', ": ".$data['order_status']);

			
			//-----------------
			
			$sheet->setCellValue('D2', "Segment ");
			$sheet->setCellValue('E2', ": ".$data['segmen']);
			
			$sheet->setCellValue('D3', "AM ");
			$sheet->setCellValue('E3', ": ".$data['am']);
			
			$sheet->setCellValue('D4', "Order Trans ");
			$sheet->setCellValue('E4', ": ".$data['order_trans']);
			
			$sheet->setCellValue('D5', "Umur Order ");
			$sheet->setCellValue('E5', ": ".$data['umur_order']);
			
			$sheet->setCellValue('D6', "Umur Status Order ");
			$sheet->setCellValue('E6', ": ".$data['umur_status_order']);
			
			$sheet->setCellValue('D7', "Vendor Name ");
			$sheet->setCellValue('E7', ": ".$data['vendor_name']);
			
			$sheet->setCellValue('A10', "No ");
			$sheet->setCellValue('B10', "Order ID ");
			$sheet->setCellValue('C10', "Created By ");
			$sheet->setCellValue('D10', "Created By Name ");
			$sheet->setCellValue('E10', "Order Created Date ");
			$sheet->setCellValue('F10', "Product Name ");
			$sheet->setCellValue('G10', "Service Address ");
			$sheet->setCellValue('H10', "Product Type ");
			$sheet->setCellValue('I10', "Speed ");
			$sheet->setCellValue('J10', "Cust ACCNUM ");
			$sheet->setCellValue('K10', "Cust ACC Name ");
			$sheet->setCellValue('L10', "Cust Region ");
			$sheet->setCellValue('M10', "Witel Alias ");
			$sheet->setCellValue('N10', "Cust Witel ");
			$sheet->setCellValue('O10', "Cust Segment ");
			$sheet->setCellValue('P10', "Nipnas ");
			$sheet->setCellValue('Q10', "Bill ACCNUM ");
			$sheet->setCellValue('R10', "Bill ACC Name ");
			$sheet->setCellValue('S10', "ACOUNTNAS ");
			$sheet->setCellValue('T10', "Service Segment ");
			$sheet->setCellValue('U10', "SERVACCNAME ");
			$sheet->setCellValue('V10', "LI Monthly Price ");
			$sheet->setCellValue('W10', "LI OTC Price ");
			$sheet->setCellValue('X10', "LI Manual Discount ");
			$sheet->setCellValue('Y10', "Currency ");
			$sheet->setCellValue('Z10', "Handling Type ");
			$sheet->setCellValue('AA10', "Order Status ");
			$sheet->setCellValue('AB10', "Order Sub Type");
			$sheet->setCellValue('AC10', "Li Milestone ");
			$sheet->setCellValue('AD10', "Li Product ID ");
			$sheet->setCellValue('AE10', "LI Product Name ");
			$sheet->setCellValue('AF10', "WO Num ");
			$sheet->setCellValue('AG10', "WOCLASS ");
			$sheet->setCellValue('AH10', "PARENT ");
			$sheet->setCellValue('AI10', "WORKZONE ");
			$sheet->setCellValue('AJ10', "STO_NAME ");
			$sheet->setCellValue('AK10', "Vendor Name ");
			$sheet->setCellValue('AL10', "Fullfilment Item Code ");
			$sheet->setCellValue('AM10', "Billing Type CD ");
			$sheet->setCellValue('AN10', "Price Type CD ");
			$first_row = 10;
			$last_col = 40;
			$row_num = 11;
			$last_order = "";
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					if($value !== $last_order){
							$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					}
					
					if($col_num == 0 && $last_order == $row['ORDER_ID']){
							$sheet->setCellValueByColumnAndRow($col_num, $row_num, null);						
					}
					
					if($col_num == 0 && $last_order != $row['ORDER_ID']){
							$sheet->setCellValueByColumnAndRow($col_num, $row_num, $num);	
							$num++;
					}
					
					$col_num++;
				}
				
				$row_num++;
				$last_order = $row['ORDER_ID'];
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A10:AN10')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			$sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			$objPHPExcel->getActiveSheet()->getStyle("A2:A8")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AN10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


    public function getInboxAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->getInboxLog($data, $config);
			
			$total = $cData->getInboxLogCount($data, $config);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


    public function completeAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();
			
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->setComplete($data['ID'], $config);
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function rollbackAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();
			
			$session = $this->getSession();
			$code_sess = $session->get('code');
			
			$in_type = "SINGLE";
			$in_file_name = "ROLLBACK";
			
            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->rollback($data['ID'], $code_sess, $in_type, $in_file_name, $config);
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getTotalReconAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->getTotalRecon();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getReconDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->getReconDetail($data);
			
			$total = $cData->totalRecon($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getTotalBillingAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->getTotalBilling();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getBillingDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->getBillingDetail($data);
			
			$total = $cData->totalBilling($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getcacustrefAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->cacustref();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getcacustreflastAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->getcacustreflast($data['tabel']);
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getcacustrefDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            //print_r($data);die();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->cacustrefDetail($data);
			
			$total = $cData->totalcacustref($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadCacustrefAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->cacustrefDetailDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "CA - Customer_ref  ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Customer Account");
			$sheet->setCellValue('C4', "Nipnas");
			$sheet->setCellValue('D4', "Customer Ref");
			$sheet->setCellValue('E4', "Status");
			$sheet->setCellValue('F4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getbaacnumAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->getbaacnum();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function getbaacnumDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->getbaacnumDetail($data);
			
			$total = $cData->totalgetbaacnum($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadbaacnumAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->getbaacnumDetailDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "BA - Account_num");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Billing Account");
			$sheet->setCellValue('C4', "ACCOUNT_NAS");
			$sheet->setCellValue('D4', "ACCOUNT_NUM");
			$sheet->setCellValue('E4', "Status");
			$sheet->setCellValue('F4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function gettibsncxAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->gettibsncx();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function gettibsncxDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->gettibsncxDetail($data);
			
			$total = $cData->totalgettibsncx($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadtibsncxAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$data['START'] = $_GET['page'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->gettibsncxDetailDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "TIBS vs NCX (Nama, Alamat, Business Area)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->mergeCells('A4:A5');
			$sheet->setCellValue('B4', "Billing Account");
			$sheet->mergeCells('B4:B5');
			$sheet->setCellValue('C4', "ACCOUNT_NAS");
			$sheet->mergeCells('C4:C5');
			$sheet->setCellValue('D4', "ACCOUNT_NUM");
			$sheet->mergeCells('D4:D5');
			$sheet->setCellValue('E4', "Name");
			$sheet->mergeCells('E4:F4');
			$sheet->setCellValue('E5', "NCX");
			$sheet->setCellValue('F5', "TIBS");
			$sheet->setCellValue('G4', "Address");
			$sheet->mergeCells('G4:H4');
			$sheet->setCellValue('G5', "NCX");
			$sheet->setCellValue('H5', "TIBS");
			$sheet->setCellValue('I4', "Bus Area");
			$sheet->mergeCells('I4:J4');
			$sheet->setCellValue('I5', "NCX");
			$sheet->setCellValue('J5', "TIBS");
			$sheet->setCellValue('K4', "Status");
			$sheet->mergeCells('K4:K5');
			$sheet->setCellValue('L4', "Update Date");
			$sheet->mergeCells('L4:L5');
			
			
			$first_row = 4;
			$last_col = 12;
			$row_num = 6;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:L5')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel_page_'.(($_GET['page'])+1).'.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


    public function getCabacustrefaacnumAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->cabacustrefaacnum();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function getCabacustrefaacnumDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->cabacustrefaacnumDetail($data);
            
            $total = $cData->totalcabacustrefaacnum($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadcabacustrefacnumAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->cabacustrefaacnumDetailDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "CA BA - Customer_ref & Account_num ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Customer Account");
			$sheet->setCellValue('C4', "CA Divisi");
			$sheet->setCellValue('D4', "CA Segment");
			$sheet->setCellValue('E4', "Billing Account");
			$sheet->setCellValue('F4', "NIPNAS");
			$sheet->setCellValue('G4', "Account Nas");
			$sheet->setCellValue('H4', "Customer Ref");
			$sheet->setCellValue('I4', "Account Number");
			$sheet->setCellValue('J4', "Status");
			$sheet->setCellValue('K4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 11;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:K4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function billcomncxtibsAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->billcomncxtibs();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

     public function billcomncxtibsDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->billcomncxtibsDetail($data);
            
            $total = $cData->totalbillcomncxtibs($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadbillcomncxtibsAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->billcomncxtibsDetailDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Order Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "NCX (Billcom) vs TIBS ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Order Number");
			$sheet->setCellValue('C4', "Customer Order Number");
			$sheet->setCellValue('D4', "Status");
			$sheet->setCellValue('E4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 5;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:E4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function tibsncxbillcomAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->tibsncxbillcom();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function tibsncxbillcomDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->tibsncxbillcomDetail($data);
            
            $total = $cData->totaltibsncxbillcom($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadtibsncxbillcomAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->tibsncxbillcomDetailDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Order Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "TIBS (All Order) vs NCX (Billcom) ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Order Num");
			$sheet->setCellValue('C4', "Customer Order Number");
			$sheet->setCellValue('D4', "Milestone");
			$sheet->setCellValue('E4', "Status");
			$sheet->setCellValue('F4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function ncxtibssidAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->ncxtibssid();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function ncxtibssidDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->ncxtibssidDetail($data);
            
            $total = $cData->totalncxtibssid($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadncxtibssidAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadncxtibssid($data);
			
			
			$sheet->setCellValue('A1', "Rekon Order Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "NCX vs TIBS (SID)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Service Num");
			$sheet->setCellValue('C4', "Product Label");
			$sheet->setCellValue('D4', "Status");
			$sheet->setCellValue('E4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 5;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:E4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function doublesidAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->ncxtibssid();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function doublesidDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->doublesidDetail($data);
            
            $total = $cData->totaldoublesid($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloaddoublesidAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloaddoublesid();
			
			
			$sheet->setCellValue('A1', "Rekon Atribut NCX");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Double SID ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Account Number");
			$sheet->setCellValue('C4', "Product Label");
			$sheet->setCellValue('D4', "Periode");
			$sheet->setCellValue('E4', "Total");
			$sheet->setCellValue('F4', "Jumlah Billing");
			$sheet->setCellValue('G4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 7;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:G4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

     public function doublenoparetDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->doublenoparetDetail($data);
            
            $total = $cData->totaldoublenoparet($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
    
    public function ncxtibspriceAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->ncxtibsprice();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function ncxtibspriceDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->ncxtibspriceDetail($data);
            
            $total = $cData->totalncxtibsprice($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadncxtibspriceAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadncxtibsprice($data);
			
			
			$sheet->setCellValue('A1', "Rekon Order Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "NCX vs TIBS (Price)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Order Number");
			$sheet->setCellValue('C4', "NCX Price OTC");
			$sheet->setCellValue('D4', "TIBS Price OTC");
			$sheet->setCellValue('E4', "NCX Price REC");
			$sheet->setCellValue('F4', "TIBS Price REC");
			$sheet->setCellValue('G4', "Status");
			$sheet->setCellValue('H4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 8;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:H4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
    
    public function ncxtibsbilldateAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->ncxtibsbilldate();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function ncxtibsbilldateDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->ncxtibsbilldateDetail($data);
            
            $total = $cData->totalncxtibsbilldate($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadncxtibsbilldateAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadncxtibsbilldate($data);
			
			
			$sheet->setCellValue('A1', "Rekon Order Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "NCX VS TIBS (Bill Date)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Order Number");
			$sheet->setCellValue('C4', "NCX Billdate");
			$sheet->setCellValue('D4', "TIBS Billdate");
			$sheet->setCellValue('E4', "Status");
			$sheet->setCellValue('F4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

     public function ncxtibsppnAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->ncxtibsppn();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


     public function ncxtibsppnDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->ncxtibsppnDetail($data);
            
            $total = $cData->totalncxtibsppn($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadtibsncxppnAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadtibsncxppn($data);
			
			
			$sheet->setCellValue('A1', "Rekon Order Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "NCX VS TIBS (PPN)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "NCX Order Number");
			$sheet->setCellValue('C4', "TIBS Order Number");
			$sheet->setCellValue('D4', "NCX PPN");
			$sheet->setCellValue('E4', "TIBS PPN");
			$sheet->setCellValue('F4', "Status");
			$sheet->setCellValue('G4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 7;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:G4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }


    public function ncxtibstopAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            //print_r("ok");die();
            $result = $cData->ncxtibstop();
            
            return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function ncxtibstopDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->ncxtibstopDetail($data);
            
            $total = $cData->totalncxtibstop($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

	public function downloadtibsncxtopAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadtibsncxtop($data);
			
			
			$sheet->setCellValue('A1', "Rekon Order Detail");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "NCX VS TIBS (Term Of Payment)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Order Number");
			$sheet->setCellValue('C4', "NCX TOP");
			$sheet->setCellValue('D4', "TIBS TOP");
			$sheet->setCellValue('E4', "Status");
			$sheet->setCellValue('F4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function saveMergeCaAction() {
        try {
            //$this->isLoggedIn(true);
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();
			
			$config = $this->getServerConfig();

            $session = $this->getSession();
            $code_sess = $session->get('code');
            //print_r($data);die();
			
			$session = $this->getSession();
			$code_sess = $session->get('code');
			
			$in_file_name = "";
			$in_type = "SINGLE";

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->saveMergeCa($data, $code_sess, $in_type, $in_file_name, $config);


            return $this->getREST()->getResponse($result);
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function doublemoDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->doublemoDetail($data);
            
            $total = $cData->totaldoublemo($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloaddoublemoAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloaddoublemo();
			
			
			$sheet->setCellValue('A1', "Rekon Atribut NCX");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Double MO OTC ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Account Number");
			$sheet->setCellValue('C4', "Customer Order Number");
			$sheet->setCellValue('D4', "Order Type");
			$sheet->setCellValue('E4', "Periode");
			$sheet->setCellValue('F4', "Total");
			$sheet->setCellValue('G4', "Jumlah Billing");
			$sheet->setCellValue('H4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 8;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:H4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function doublemrcDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->doublemrcDetail($data);
            
            $total = $cData->totaldoublemrc($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloaddoublemrcAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloaddoublemrc();
			
			
			$sheet->setCellValue('A1', "Rekon Atribut NCX");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Double MRC & Discount");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Account Number");
			$sheet->setCellValue('C4', "Customer Order Number");
			$sheet->setCellValue('D4', "CID");
			$sheet->setCellValue('E4', "Periode");
			$sheet->setCellValue('F4', "Prod Periode");
			$sheet->setCellValue('G4', "Total");
			$sheet->setCellValue('H4', "Jumlah Billing");
			$sheet->setCellValue('I4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 9;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:I4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function businessareaDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->businessareaDetail($data);
            
            $total = $cData->totalbusinessarea($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadbusinessareaAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadbusinessarea();
			
			
			$sheet->setCellValue('A1', "Rekon Atribut NCX");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Business Area (Level BA)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Billing Account");
			$sheet->setCellValue('C4', "OU Number");
			$sheet->setCellValue('D4', "Business Area");
			$sheet->setCellValue('E4', "Account Type CD");
			$sheet->setCellValue('F4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function tanggalcontractDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->tanggalcontractDetail($data);
            
            $total = $cData->totaltanggalcontract($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadtanggalcontractAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadtanggalcontract();
			
			
			$sheet->setCellValue('A1', "Rekon Atribut NCX");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Tanggal Contract (Level Agreement) ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Agree Number");
			$sheet->setCellValue('C4', "Agree Start Date");
			$sheet->setCellValue('D4', "Agree End Date");
			$sheet->setCellValue('E4', "Updated Date");
			
			
			$first_row = 4;
			$last_col = 5;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:E4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function cpaddressDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->cpaddressDetail($data);
            
            $total = $cData->totalcpaddress($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadcpaddressAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadcpaddress();
			
			
			$sheet->setCellValue('A1', "Rekon Atribut NCX");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Contact Person dan Address (Level SA)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Acount (LOC)");
			$sheet->setCellValue('C4', "Row ID");
			$sheet->setCellValue('D4', "PR_ADDR_ID");
			$sheet->setCellValue('E4', "PR_CON_ID");
			$sheet->setCellValue('F4', "Account Type CD");
			$sheet->setCellValue('G4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 7;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:G4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function latlongDetailAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->latlongDetail($data);
            
            $total = $cData->totallatlong($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadlatlongAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadlatlong();
			
			
			$sheet->setCellValue('A1', "Rekon Atribut NCX");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Latlong (Level Address SA)");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Row ID");
			$sheet->setCellValue('C4', "Latitude");
			$sheet->setCellValue('D4', "Longitude");
			$sheet->setCellValue('E4', "Update Date");
			
			
			$first_row = 4;
			$last_col = 5;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:E4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function misssingbillingAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->misssingbilling($data);
            
            $total = $cData->totalmisssingbilling($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadmisssingbillingAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloadmisssingbilling();
			
			
			$sheet->setCellValue('A1', "Validasi TIBS");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Double MO OTC ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Account Number");
			$sheet->setCellValue('C4', "SID");
			$sheet->setCellValue('D4', "PROD Period");
			$sheet->setCellValue('E4', "Start Date");
			$sheet->setCellValue('F4', "End Date");
			$sheet->setCellValue('G4', "Description");
			$sheet->setCellValue('H4', "Updated Date");
			
			
			$first_row = 4;
			$last_col = 8;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:H4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function doubleAoAction() {
        $result = new result();
        try {
            $guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();


            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            
            $result = $cData->doubleAo($data);
            
            $total = $cData->totaldoubleAo($data);

                        
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
            $response->setContent(json_encode(array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $total->data ),
                "recordsFiltered" => intval( $total->data ),
                "data"            => $result->data
            )));    
            return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloaddoubleAoAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->downloaddoubleAo();
	
			
			$sheet->setCellValue('A1', "Validasi TIBS");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Double MO OTC ");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Order Type");
			$sheet->setCellValue('C4', "Customer Ref");
			$sheet->setCellValue('D4', "Account Number");
			$sheet->setCellValue('E4', "Customer Order Number");
			$sheet->setCellValue('F4', "CID");
			$sheet->setCellValue('G4', "Product Name");
			$sheet->setCellValue('H4', "Bill Money");
			$sheet->setCellValue('I4', "Periode");
			$sheet->setCellValue('J4', "Prod Period");
			$sheet->setCellValue('K4', "Product Sequence");
			$sheet->setCellValue('L4', "Product Group");
			$sheet->setCellValue('M4', "Updated Date");
			
			$first_row = 4;
			$last_col = 13;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:M4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function sidncxnossAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->sidncxnoss();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function sidncxnossDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->sidncxnossDetail($data);
			
			$total = $cData->totalsidncxnoss($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadsidncxnossAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->sidncxnossDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "SID NCX NOSS");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "ORDER_NUM");
			$sheet->setCellValue('C4', "SERVICE_NUM");
			$sheet->setCellValue('D4', "OU_NUM");
			$sheet->setCellValue('E4', "NIPNAS");
			$sheet->setCellValue('F4', "CUST_ID_NOSS");
			$sheet->setCellValue('G4', "SID NOSS");
			$sheet->setCellValue('H4', "SID_TENOSS");
			$sheet->setCellValue('I4', "CUST_ID_TENOSS");
			$sheet->setCellValue('J4', "STATUS");
			$sheet->setCellValue('K4', "UPDATED DATE");
			
			
			$first_row = 4;
			$last_col = 11;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:K4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function bancxtremsAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->bancxtrems();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function bancxtremsDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->bancxtremsDetail($data);
			
			$total = $cData->totalbancxtrems($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadbancxtremsAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->bancxtremsDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "BA NCX - BP L2 TREMS");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "BA");
			$sheet->setCellValue('C4', "ACCOUNT NAS");
			$sheet->setCellValue('D4', "BPEXT");
			$sheet->setCellValue('E4', "STATUS");
			$sheet->setCellValue('F4', "UPDATED DATE");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function falloutnossAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->falloutnoss($data);
			
			$total = $cData->totalfalloutnoss($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadfalloutnossAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->falloutnossDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master");
			$sheet->mergeCells('A1:B1');
			
			
			
			$sheet->setCellValue('A2', "Fallout Noss");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Creation");
			$sheet->setCellValue('C4', "Ticket ID");
			$sheet->setCellValue('D4', "SCORDERNO");
			$sheet->setCellValue('E4', "Service Num");
			$sheet->setCellValue('F4', "SCCD Status");
			$sheet->setCellValue('G4', "WFM Status");
			$sheet->setCellValue('H4', "Trouble Status Date");
			$sheet->setCellValue('I4', "Trouble Headline");
			$sheet->setCellValue('J4', "TK Classification");
			$sheet->setCellValue('K4', "Updated Date");
			
			
			$first_row = 4;
			$last_col = 11;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:K4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function revcodeAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->revcode();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function revcodeDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->revcodeDetail($data);
			
			$total = $cData->totalrevcode($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadrevcodeAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->revcodeDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "Rev Code TIBS - ID Rev TREMS");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "REV Code TIBS");
			$sheet->setCellValue('C4', "ID REV Terms");
			$sheet->setCellValue('D4', "STATUS");
			$sheet->setCellValue('E4', "UPDATED DATE");
			
			
			$first_row = 4;
			$last_col = 5;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:E4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function batibstremsAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->batibstrems();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function batibstremsDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->batibstremsDetail($data);
			
			$total = $cData->totalbatibstrems($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadbatibstremsAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->batibstremsDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "AccNum TIBS - BP L2 TREMS");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "ACCOUNT_NUM");
			$sheet->setCellValue('C4', "BPEXT");
			$sheet->setCellValue('D4', "STATUS");
			$sheet->setCellValue('E4', "UPDATED DATE");
			
			
			$first_row = 4;
			$last_col = 5;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:E4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function serviceaddrncxAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->serviceaddrncx($data);
			
			$total = $cData->totalserviceaddrncx($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadserviceaddrncxAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->serviceaddrncxDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master");
			$sheet->mergeCells('A1:B1');
			
			
			
			$sheet->setCellValue('A2', "Service Address NCX");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "Service Account Number");
			$sheet->setCellValue('C4', "Service Account Name");
			$sheet->setCellValue('D4', "Service Account Type");
			$sheet->setCellValue('E4', "Address Name");
			$sheet->setCellValue('F4', "Updated Date");
			
			
			$first_row = 4;
			$last_col = 6;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:F4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

	public function sidncxnossassetAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
            $result = $cData->sidncxnossasset();
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }

    public function sidncxnossassetDetailAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->sidncxnossassetDetail($data);
			
			$total = $cData->totalsidncxnossasset($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadsidncxnossassetAction() {
        $result = new result();
        try {
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
				->setCreator("Temporaris")
				->setLastModifiedBy("Temporaris")
				->setTitle("Template Relevé des heures intérimaires")
				->setSubject("Template excel")
				->setDescription("Template excel permettant la création d'un ou plusieurs relevés d'heures")
				->setKeywords("Template excel");
			$objPHPExcel->setActiveSheetIndex(0);

			$sheet = $objPHPExcel->getActiveSheet();
			
			$guid = $this->getREST()->getGuid();

			$code = $this->getREST()->getCode();

			$data = $this->getREST()->getParameters();
			$data['STATUS'] = $_GET['status'];
			$cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			$result = $cData->sidncxnossassetDownload($data);
			
			
			$sheet->setCellValue('A1', "Rekon Master");
			$sheet->mergeCells('A1:B1');
			
			$sheet->setCellValue('A2', "SID NCX NOSS");
			
			$sheet->setCellValue('A4', "No");
			$sheet->setCellValue('B4', "ASSET_NUM");
			$sheet->setCellValue('C4', "SERIAL_NUM");
			$sheet->setCellValue('D4', "OU_NUM");
			$sheet->setCellValue('E4', "NIPNAS");
			$sheet->setCellValue('F4', "SID_NOSS");
			$sheet->setCellValue('G4', "CUST_ID_NOSS");
			$sheet->setCellValue('H4', "SID_TENOSS");
			$sheet->setCellValue('I4', "CUST_ID_TENOSS");
			$sheet->setCellValue('J4', "STATUS");
			$sheet->setCellValue('K4', "UPDATED DATE");
			
			
			$first_row = 4;
			$last_col = 11;
			$row_num = 5;
			$num = 1;
			foreach($result->data as $row)
			{
				$col_num = 0;
				foreach($row as $field => $value)
				{
					$sheet->setCellValueByColumnAndRow($col_num, $row_num, $value);
					$col_num++;
				}
				
				$row_num++;
			}
			
			$tableStyleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			$sheet->getStyle('A4:K4')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			);
			
			/* $sheet->getStyle('A1:E1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'b2b4b7')
					)
				)
			); */
			
			$sheet->getStyleByColumnAndRow(0, $first_row, ($last_col-1), ($row_num-1))->applyFromArray($tableStyleArray);
			
			//$sheet->getStyleByColumnAndRow(0, 2, 1, 8)->applyFromArray($tableStyleArray);
			//$sheet->getStyleByColumnAndRow(3, 2, 4, 8)->applyFromArray($tableStyleArray);
			
			/* $objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("D2:A7")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A10:AJ10")->getFont()->setBold( true );
			$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true ); */
			
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="excel.xls"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function downloadRekonAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->downloadRekon($data);
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function checkDownloadAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->checkDownload($data);
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function listDownloadAction() {
		$result = new result();
        try {
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            $result = $cData->listDownload($data);
			
			return $this->getREST()->getResponse($result);


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
	
	public function orderDateAgreementAction() {
		$result = new result();
        try {
			
			$guid = $this->getREST()->getGuid();

            $code = $this->getREST()->getCode();

            $data = $this->getRequest()->getPost();

            $cData = new DataModel(DataModel\Storage::factory($this->getDb( __NAMESPACE__, 'third'), $this->getConfig()));
			
			$result = $cData->orderDateAgreement($data);
			
			$total = $cData->orderDateAgreementTotal($data);

						
			$response = $this->getResponse();
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setContent(json_encode(array(
				"draw"            => intval( $data['draw'] ),
				"recordsTotal"    => intval( $total->data ),
				"recordsFiltered" => intval( $total->data ),
				"data"            => $result->data
			)));	
			return $response;


        } catch (\Exception $ex) {
            $result = new Result();
            $result->code = 500;
            $result->info = $ex->getMessage();
            return $this->getREST()->getResponse($result);
        }
    }
    
}
