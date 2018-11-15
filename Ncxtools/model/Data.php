<?php

namespace Neuron\Application\Ncxtools;

use Neuron\Generic\Result;

class Data {

    protected $_storage;
    protected $_plaza = null;
	protected $_config = array();

    public function __construct(Data\Storage\Skeleton $storage, $config = array()) {

        $this->_storage = $storage;
		$this->_config = $config;
    }

    public function userActivity() {
        $result = new Result();
        try {
            if ($data = $this->_storage->userActivity()) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function logActivity($sid, $table, $oldvalue=array(), $newvalue=array(), $function) {
        $result = new Result();
        try {
            if ($data = $this->_storage->exeActivity($sid, $table, $oldvalue, $newvalue, $function)) {
				$this->_storage->saveActivity($sid, $table, $oldvalue, $newvalue, $function);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function loadData($code = null, $guid = null, $param=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->loadData($code, $guid, $param)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function loadRekap($code = null, $guid = null, $param=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->loadRekap($code, $guid, $param)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function loadOgp($data) {
        $result = new Result();
        try {
            if ($data = $this->_storage->loadOgp($data)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function loadAm($data) {
        $result = new Result();
        try {
            if ($data = $this->_storage->loadAm2($data)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function loadquote($data) {
        $result = new Result();
        try {
            if ($data = $this->_storage->loadquote2($data)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function filter($code = null, $guid = null, $param=array()) {
        $result = new Result();
		$datatemp = array();
        try {
            if ($data = $this->_storage->periode_create2($code, $guid, $param)) {
				//$datax = $data;
				$datax = array();
				foreach($data as $row){
					$row['PERIODE_CREATE'] = date('M Y',strtotime($row['PERIODE_CREATE']."01"));
					array_push($datax,$row['PERIODE_CREATE']);
				}
                $datatemp['periode_create'] = $datax;
            } else {
                 $datatemp['periode_create'] = array();
            }
			
            if ($data = $this->_storage->order_type2($code, $guid, $param)) {
                $datatemp['order_type'] = $data;
            } else {
                 $datatemp['order_type'] = array();
            }
			
            if ($data = $this->_storage->order_status2($code, $guid, $param)) {
                $datatemp['order_status'] = $data;
            } else {
                 $datatemp['order_status'] = array();
            }
			
            if ($data = $this->_storage->divisi2($code, $guid, $param)) {
                $datatemp['divisi'] = $data;
            } else {
                 $datatemp['divisi'] = array();
            }
			
            if ($data = $this->_storage->segmen2($code, $guid, $param)) {
                $datatemp['segmen'] = $data;
            } else {
                 $datatemp['segmen'] = array();
            }
			
            if ($data = $this->_storage->am2($code, $guid, $param)) {
                $datatemp['am'] = $data;
            } else {
                 $datatemp['am'] = array();
            }
			
            if ($data = $this->_storage->status_quote2($code, $guid, $param)) {
                $datatemp['status_quote'] = $data;
            } else {
                 $datatemp['status_quote'] = array();
            }
			
            if ($data = $this->_storage->order_trans($code, $guid, $param)) {
                $datatemp['order_trans'] = $data;
            } else {
                 $datatemp['order_trans'] = array();
            }
			
            if ($data = $this->_storage->vendorName($code, $guid, $param)) {
                $datatemp['vendor_name'] = $data;
            } else {
                 $datatemp['vendor_name'] = array();
            }
			
            if ($data = $this->_storage->updatedDate($code, $guid, $param)) {
				foreach($data as $rows){
					$update_time = $rows['UPDATED_DATE'];
				}
                $datatemp['updated_date'] = array('UPDATED_DATE' => $update_time);
            } else {
                 $datatemp['updated_date'] = array();
            }
			
            if ($data = $this->_storage->minMax($code, $guid, $param)) {
                $datax = array();
				foreach($data as $row){
					$row['MAX1'] = date('Y-m-d',strtotime($row['MAX']));
					$row['MAX2'] = date('d-m-Y',strtotime($row['MAX']));
					$row['MIN1'] = date('Y-m-d',strtotime($row['MIN']));
					$row['MIN2'] = date('d-m-Y',strtotime($row['MIN']));
					$temp = array(
						'MAX' => $row['MAX1'],
						'MIN' => $row['MIN1'],
						'MAX2' => $row['MAX2'],
						'MIN2' => $row['MIN2'],
					);
					array_push($datax,$temp);
				}
                $datatemp['minmax'] = $datax;
            } else {
                 $datatemp['minmax'] = array();
            }
			
			$result->data = $datatemp;
			
			
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function getHierarchy($data = array(), $config = array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->getHierarchy($data, $config)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function getDetailcabasa($data = array(), $config=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->getDetailcabasa($data, $config)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function getDetailCustomer($data = array(), $config=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->getDetailCustomer($data, $config)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function getListCustomer($data = array(), $config=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->getListCustomer($data, $config)) {
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
    
	
	public function detail($data = array()) {
		$dataTemp = $data;
        $result = new Result();
		$no = $data['start']+1;;
        try {
			$temp = array();
            if ($data = $this->_storage->detail($data)) {
				foreach($data as $row){
					
					$tempdetail = array();
					if($datadetail = $this->_storage->detailDownload($dataTemp, $row['ORDER_ID'], 'detail')){
						foreach($datadetail as $rowdet){
							$rowdet['ORDER_ID'] = $rowdet['ORDER_ID'] == "" ? " - " : $rowdet['ORDER_ID'];
							$rowdet['ORDER_CREATEDBY'] = $rowdet['ORDER_CREATEDBY'] == "" ? " - " : $rowdet['ORDER_CREATEDBY'];
							$rowdet['ORDER_CREATEDBY_NAME'] = $rowdet['ORDER_CREATEDBY_NAME'] == "" ? " - " : $rowdet['ORDER_CREATEDBY_NAME'];
							$rowdet['ORDER_CREATED_DATE'] = $rowdet['ORDER_CREATED_DATE'] == "" ? " - " : $rowdet['ORDER_CREATED_DATE'];
							$rowdet['PRODUCTNAME'] = $rowdet['PRODUCTNAME'] == "" ? " - " : $rowdet['PRODUCTNAME'];
							$rowdet['SERVICEADDRESS'] = $rowdet['SERVICEADDRESS'] == "" ? " - " : $rowdet['SERVICEADDRESS'];
							$rowdet['PRODUCTTYPE'] = $rowdet['PRODUCTTYPE'] == "" ? " - " : $rowdet['PRODUCTTYPE'];
							$rowdet['SPEED'] = $rowdet['SPEED'] == "" ? " - " : $rowdet['SPEED'];
							$rowdet['CUSTACCNTNUM'] = $rowdet['CUSTACCNTNUM'] == "" ? " - " : $rowdet['CUSTACCNTNUM'];
							$rowdet['CUSTACCNTNAME'] = $rowdet['CUSTACCNTNAME'] == "" ? " - " : $rowdet['CUSTACCNTNAME'];
							$rowdet['CUST_REGION'] = $rowdet['CUST_REGION'] == "" ? " - " : $rowdet['CUST_REGION'];
							$rowdet['WITEL_ALIAS'] = $rowdet['WITEL_ALIAS'] == "" ? " - " : $rowdet['WITEL_ALIAS'];
							$rowdet['CUST_WITEL'] = $rowdet['CUST_WITEL'] == "" ? " - " : $rowdet['CUST_WITEL'];
							$rowdet['CUST_SEGMEN'] = $rowdet['CUST_SEGMEN'] == "" ? " - " : $rowdet['CUST_SEGMEN'];
							$rowdet['NIPNAS'] = $rowdet['NIPNAS'] == "" ? " - " : $rowdet['NIPNAS'];
							$rowdet['BILLACCNTNUM'] = $rowdet['BILLACCNTNUM'] == "" ? " - " : $rowdet['BILLACCNTNUM'];
							$rowdet['BILLACCNTNAME'] = $rowdet['BILLACCNTNAME'] == "" ? " - " : $rowdet['BILLACCNTNAME'];
							$rowdet['ACCOUNTNAS'] = $rowdet['ACCOUNTNAS'] == "" ? " - " : $rowdet['ACCOUNTNAS'];
							$rowdet['SERVICE_SEGMENT'] = $rowdet['SERVICE_SEGMENT'] == "" ? " - " : $rowdet['SERVICE_SEGMENT'];
							$rowdet['SERVACCNTNAME'] = $rowdet['SERVACCNTNAME'] == "" ? " - " : $rowdet['SERVACCNTNAME'];
							$rowdet['LI_MONTHLY_PRICE'] = $rowdet['LI_MONTHLY_PRICE'] == "" ? " - " : $rowdet['LI_MONTHLY_PRICE'];
							$rowdet['LI_OTC_PRICE'] = $rowdet['LI_OTC_PRICE'] == "" ? " - " : $rowdet['LI_OTC_PRICE'];
							$rowdet['LI_MANUAL_DISCOUNT'] = $rowdet['LI_MANUAL_DISCOUNT'] == "" ? " - " : $rowdet['LI_MANUAL_DISCOUNT'];
							$rowdet['CURRENCY'] = $rowdet['CURRENCY'] == "" ? " - " : $rowdet['CURRENCY'];
							$rowdet['HANDLINGTYPE'] = $rowdet['HANDLINGTYPE'] == "" ? " - " : $rowdet['HANDLINGTYPE'];
							$rowdet['ORDER_STATUS'] = $rowdet['ORDER_STATUS'] == "" ? " - " : $rowdet['ORDER_STATUS'];
							$rowdet['ORDER_SUBTYPE'] = $rowdet['ORDER_SUBTYPE'] == "" ? " - " : $rowdet['ORDER_SUBTYPE'];
							$rowdet['LI_MILESTONE'] = $rowdet['LI_MILESTONE'] == "" ? " - " : $rowdet['LI_MILESTONE'];
							$rowdet['VENDOR_NAME'] = $rowdet['VENDOR_NAME'] == "" ? " - " : $rowdet['VENDOR_NAME'];
							$rowdet['FULFLMNT_ITEM_CODE'] = $rowdet['FULFLMNT_ITEM_CODE'] == "" ? " - " : $rowdet['FULFLMNT_ITEM_CODE'];
							$rowdet['BILLING_TYPE_CD'] = $rowdet['BILLING_TYPE_CD'] == "" ? " - " : $rowdet['BILLING_TYPE_CD'];
							$rowdet['PRICE_TYPE_CD'] = $rowdet['PRICE_TYPE_CD'] == "" ? " - " : $rowdet['PRICE_TYPE_CD'];
							array_push($tempdetail, $rowdet);
						}
					}
					
					$row['no'] = $no++;
					
					$row['detail'] = $tempdetail;
					array_push($temp, $row);
					
				}
                $result->data = $temp;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function total($data = array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->total($data)) {
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
				$result->data = 0;
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function detailDownload($data = array()) {
        $result = new Result();
        try {
			$temp = array();
            if ($data = $this->_storage->detailDownload($data)) {
				foreach($data as $row){
					$row['ORDER_ID'] = $row['ORDER_ID'] == "" ? " - " : $row['ORDER_ID'];
					$row['ORDER_CREATEDBY'] = $row['ORDER_CREATEDBY'] == "" ? " - " : $row['ORDER_CREATEDBY'];
					$row['ORDER_CREATEDBY_NAME'] = $row['ORDER_CREATEDBY_NAME'] == "" ? " - " : $row['ORDER_CREATEDBY_NAME'];
					$row['ORDER_CREATED_DATE'] = $row['ORDER_CREATED_DATE'] == "" ? " - " : $row['ORDER_CREATED_DATE'];
					$row['PRODUCTNAME'] = $row['PRODUCTNAME'] == "" ? " - " : $row['PRODUCTNAME'];
					$row['SERVICEADDRESS'] = $row['SERVICEADDRESS'] == "" ? " - " : $row['SERVICEADDRESS'];
					$row['PRODUCTTYPE'] = $row['PRODUCTTYPE'] == "" ? " - " : $row['PRODUCTTYPE'];
					$row['SPEED'] = $row['SPEED'] == "" ? " - " : $row['SPEED'];
					$row['CUSTACCNTNUM'] = $row['CUSTACCNTNUM'] == "" ? " - " : $row['CUSTACCNTNUM'];
					$row['CUSTACCNTNAME'] = $row['CUSTACCNTNAME'] == "" ? " - " : $row['CUSTACCNTNAME'];
					$row['CUST_REGION'] = $row['CUST_REGION'] == "" ? " - " : $row['CUST_REGION'];
					$row['WITEL_ALIAS'] = $row['WITEL_ALIAS'] == "" ? " - " : $row['WITEL_ALIAS'];
					$row['CUST_WITEL'] = $row['CUST_WITEL'] == "" ? " - " : $row['CUST_WITEL'];
					$row['CUST_SEGMEN'] = $row['CUST_SEGMEN'] == "" ? " - " : $row['CUST_SEGMEN'];
					$row['NIPNAS'] = $row['NIPNAS'] == "" ? " - " : $row['NIPNAS'];
					$row['BILLACCNTNUM'] = $row['BILLACCNTNUM'] == "" ? " - " : $row['BILLACCNTNUM'];
					$row['BILLACCNTNAME'] = $row['BILLACCNTNAME'] == "" ? " - " : $row['BILLACCNTNAME'];
					$row['ACCOUNTNAS'] = $row['ACCOUNTNAS'] == "" ? " - " : $row['ACCOUNTNAS'];
					$row['SERVICE_SEGMENT'] = $row['SERVICE_SEGMENT'] == "" ? " - " : $row['SERVICE_SEGMENT'];
					$row['SERVACCNTNAME'] = $row['SERVACCNTNAME'] == "" ? " - " : $row['SERVACCNTNAME'];
					$row['LI_MONTHLY_PRICE'] = $row['LI_MONTHLY_PRICE'] == "" ? " - " : $row['LI_MONTHLY_PRICE'];
					$row['LI_OTC_PRICE'] = $row['LI_OTC_PRICE'] == "" ? " - " : $row['LI_OTC_PRICE'];
					$row['LI_MANUAL_DISCOUNT'] = $row['LI_MANUAL_DISCOUNT'] == "" ? " - " : $row['LI_MANUAL_DISCOUNT'];
					$row['CURRENCY'] = $row['CURRENCY'] == "" ? " - " : $row['CURRENCY'];
					$row['HANDLINGTYPE'] = $row['HANDLINGTYPE'] == "" ? " - " : $row['HANDLINGTYPE'];
					$row['ORDER_STATUS'] = $row['ORDER_STATUS'] == "" ? " - " : $row['ORDER_STATUS'];
					$row['ORDER_SUBTYPE'] = $row['ORDER_SUBTYPE'] == "" ? " - " : $row['ORDER_SUBTYPE'];
					$row['LI_MILESTONE'] = $row['LI_MILESTONE'] == "" ? " - " : $row['LI_MILESTONE'];
					array_push($temp,$row);
				}
                $result->data = $temp;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function update($data = array(), $code_sess = null,$in_type = null ,$in_file_name = null, $config=array()) {
		//print_r($data);exit;
        $result = new Result();
        try {
            if ($data = $this->_storage->update($data, $code_sess, $in_type,$in_file_name, $config)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function update_log($data = array()) {
		//print_r($data);die();
        $result = new Result();
        try {
            if ($data = $this->_storage->update_log($data)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function tesQuery($data = array(), $config = array()) {
		//print_r($data);exit;
        $result = new Result();
        try {
            if ($data = $this->_storage->tesQuery($data, $config)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function getListOrder($data = array(), $config=array()) {
		//print_r($data);exit;
        $result = new Result();
        try {
            if ($data = $this->_storage->getListOrder($data, $config)) {
				
				$data[0]['INTEGRATION_DT'] = empty($data[0]['INTEGRATION_DT']) ? '' : date("d-m-Y",strtotime($data[0]['INTEGRATION_DT']));
				$data[0]['PROVISIONING_DT'] = empty($data[0]['PROVISIONING_DT']) ? '' : date("d-m-Y",strtotime($data[0]['PROVISIONING_DT']));
				$data[0]['BILL_DT'] = empty($data[0]['BILL_DT']) ? '' : date("d-m-Y",strtotime($data[0]['BILL_DT']));
				$data[0]['BASO_DT'] = empty($data[0]['BASO_DT']) ? '' : date("d-m-Y",strtotime($data[0]['BASO_DT']));
				$data[0]['AGREE_END'] = empty($data[0]['AGREE_END']) ? '' : date("d-m-Y",strtotime($data[0]['AGREE_END']));
				$data[0]['AGREE_START'] = empty($data[0]['AGREE_START']) ? '' : date("d-m-Y",strtotime($data[0]['AGREE_START']));
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }


    public function getListCA($data = null, $config=array()) {
        $result = new Result();
        //print_r($data);die();
        try {
            if ($data = $this->_storage->getListCA($data, $config)) {
              //  print_r($data);die();
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	


    public function saveMove($data = array(), $code_sess = null, $in_file_name = null, $in_type = null, $config=array()) {
        $result = new Result();
        //print_r($data);die();
        try {
            if ($data = $this->_storage->saveMove($data, $code_sess, $in_file_name, $in_type, $config)) {
              //  print_r($data);die();
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function getListTermin($data = array(), $config=array()) {
        $result = new Result();
        //print_r($data);die();
        try {
            if ($data = $this->_storage->getListTermin($data, $config)) {
				$temp = array();
               foreach($data as $row){
					$row['TERMIN_BILLDATE'] = $row['TERMIN_BILLDATE'] == "" ? "" : date("d-m-Y",strtotime($row['TERMIN_BILLDATE']));
					array_push($temp,$row);
				}
                $result->data = $temp;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function updateTermin($data = array(), $key = null, $in_file_name = null, $in_type = null, $code_sess= null, $order_id = null, $config=array()) {
		//print_r($data);exit;
        $result = new Result();
        try {
			if($data){
				foreach($data as $row){
					if($row['termin_date'] != ''){
						$temp  = array(
							'sequence' => $row['sequence'],
							'termin_date' => $row['termin_date'],
							'no_asset' => $key,
							'order_id' => $order_id,
						);
						
						$dataBefore = "";
						if($Before = $this->_storage->getListTermin($temp, $config)){
							foreach($Before as $row){
								$TERMIN_BILLDATE = $row['TERMIN_BILLDATE'] == "" ? "" : date("d-m-Y",strtotime($row['TERMIN_BILLDATE']));
								$dataBefore = "order ID:".$temp['order_id'].";asset id:".$temp['no_asset'].";sequence:".$row['CX_SEQUENCE'].";termin date:".$TERMIN_BILLDATE;
							}
						}
						
						
						$data = $this->_storage->updateTermin($temp, $key, $in_file_name, $in_type, $config);
						if($data){
							$mess = "Success";
							$sts = 0;
							$this->_storage->insertLogTermin($temp, $code_sess, $in_file_name, $in_type, $mess, $sts, $dataBefore, $config);
						}else{
							$mess = "Failed";
							$sts = 1;
							$this->_storage->insertLogTermin($temp, $code_sess, $in_file_name, $in_type, $mess, $sts, $dataBefore, $config);
						}
					}
				}
			}
			return $result;
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function sendUpdate($data = array(), $code_sess = null,$in_type = null ,$in_file_name = null, $config=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->sendUpdate($data, $code_sess, $in_type, $in_file_name, $config)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function sendOrder($data = array(), $code = null, $in_file_name = null, $in_type = null, $config=array()) {
        $result = new Result();
        try {
			/* if ($data = $this->_storage->sendUpdateOrder($data, $code_sess, $in_type, $in_file_name)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            } */
			//update date act
			$hasil1 = 0;
			$temp = $data;
			if($in_type == "BULK"){
				$temp = $data;
				$data = array();//hapus dulu
				$data['data1'] = $temp;
			}
			
			
			
			$val['order_id'] 	= $data['data1']['order_id'];
			$val['sid'] 		= $data['data1']['sid'];
			$dateBefore = "";
			if($before = $this->_storage->orderBefore($data, $config)){
				foreach($before as $row){
					$dateBefore .= "ORDER_NUM:".$row['ORDER_NUM'].";SERVICE_NUM:".$row['SERVICE_NUM'].";MILESTONE_CODE:".$row['MILESTONE_CODE'].";TODO_CD:".$row['TODO_CD'].";AGREE_ID:".$row['AGREE_ID'].";LOC:".$row['LOC'].";CA:".$row['CA'].";PROVISIONING_DT:".$row['PROVISIONING_DT'].";BILL_DT:".$row['BILL_DT'].";BASO_DT:".$row['BASO_DT'].";INTEGRATION_DT:".$row['INTEGRATION_DT'].";AGREE_START:".$row['AGREE_START'].";AGREE_END:".$row['AGREE_END'];
				}
			}
			
			if(!empty($data['data1']['bill_order']) || !empty($data['data1']['baso_order']) || !empty($data['data1']['integration_order'])){
				$res1 = $this->_storage->dateAct($data, $config);
				$hasil1 = 1;
			}
			
			//update date order item
			$hasil2 = 0;
			if(!empty($data['data1']['bill_order']) || !empty($data['data1']['provisioning_order'])){
				$res2 = $this->_storage->dateOrder($data, $config);
				$hasil2 = 1;
			}
			
			//update kontrak
			$hasil3 = 0;
			$hasil4 = 0;
			if(!empty($data['data1']['agree_start_order']) || !empty($data['data1']['agree_end_order'])){
				//$res3 = $this->_storage->dateKontrakItem($data);
				$hasil3 = 1;
				
				
				$res4 = $this->_storage->dateKontrakAgree($data, $config);
				$hasil4 = 1;
			}
			$mess = "";
			if($hasil1 == 1){
				if($res1){
					$mess .= " s_evt_act:success";
				}else{
					$mess .= " s_evt_act:failed";
				}
			}
			
			if($hasil2 == 1){
				if($res2){
					$mess .= ", s_order_item:success";
				}else{
					$mess .= ", s_order_item:failed";
				}
			}
			
			
			/* if($hasil3 == 1){
				if($res3){
					$mess .= ", s_order_item(kontrak):success";
				}else{
					$mess .= ", s_order_item(kontrak):failed";
				}
			} */
			
			
			if($hasil4 == 1){
				if($res4){
					$mess .= ", s_doc_agree:success";
				}else{
					$mess .= ", s_doc_agree:failed";
				}
			}
			
			
			
			if($mess != ""){
				$this->_storage->insertLog($data, $code, $in_file_name, $in_type, $mess, 0, $dateBefore, $config);
				$result->info = "Update Success";
				$result->code = 0;
			}else{
				$this->_storage->insertLog($data, $code, $in_file_name, $in_type, $mess, 1, $dateBefore, $config);
				$result->info = "Update Failed";
				$result->code = 1;
			}
			

        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function sendMerge($data = array(), $code_sess = null,$in_type = null ,$in_file_name = null, $config=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->mergesave($data, $code_sess, $in_type, $in_file_name, $config)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }

    public function sendTermin($data = array(), $code_sess = null, $in_file_name = null, $in_type = null, $config=array()) {
        $result = new Result();
        //print_r($data);die();
		$temp = $data;
		$dataBefore = "";
		if($Before = $this->_storage->getListTermin($data, $config)){
			foreach($Before as $row){
				$TERMIN_BILLDATE = $row['TERMIN_BILLDATE'] == "" ? "" : date("d-m-Y",strtotime($row['TERMIN_BILLDATE']));
				$dataBefore = "order ID:".$data['order_id'].";asset id:".$data['no_asset'].";sequence:".$row['CX_SEQUENCE'].";termin date:".$TERMIN_BILLDATE;
			}
		}
		
		
        try {
            if ($data = $this->_storage->updateTermin($data, $data['no_asset'], $in_file_name, $in_type, $config)) {
				$mess = "Success";
				$sts = 0;
				
            	$this->_storage->insertLogTermin($temp, $code_sess, $in_file_name, $in_type, $mess, $sts, $dataBefore, $config);
				$result->info = $data;
				
            } else {
				$mess = "Failed";
				$sts = 1;
				$this->_storage->insertLogTermin($temp, $code_sess, $in_file_name, $in_type, $mess, $sts, $dataBefore, $config);
                $result->code = 1;
                $result->info = 'no_data_found';
				
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }

    public function getInboxLog($data, $config=array()) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getInboxLog($data, $config)) {
				$dataTemp = array();
                foreach($data as $key)
                {
                  $temp = $this->explodeMessage($key);
				  
				  $temp['ID']	= $key['ID'];
				  $temp['RNUM']	= $key['RNUM'];
				  
				  array_push($dataTemp, $temp);
                }
                $result->data = $dataTemp;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }

    public function getInboxLogCount($data, $config=array()) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getInboxLogCount($data, $config)) {
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function explodeMessage($key = array()) {
        $result = new Result();
        try {
            if (!empty($key)) {
                if($key['PACK_PROC'] == 'UPDATE_CABASA'){
					$LOG_CLOB 	= $key['LOG_VALUE'];
					$LOC_INPUT 	= $key['LOC_INPUT'];
					//$MESSAGE 	= $key['MESSAGE'];
					$mess 	= $key['MESSAGE'];
					$MESSAGE = "";
					if($mess){
						$MESSAGE = $mess->load();
					}
					
					/* 
					BEFORE (S_ORG_EXT) name :TELKOMSEL|
					x_pti1__nipnas:6846372|
					x_pti1_accnt_nas:1234|
					loc:B0004840599|
					x_pti1__nipnas:6846372|
					loc:B0004842255|
					x_pti1__nipnas:6846372|loc:B0004809123|x_pti1__nipnas:6846372|loc:B0004808747|x_pti1__nipnas:6846372|loc:B0004829497|x_pti1__nipnas:6846372|loc:B0004835777|x_pti1__nipnas:6846372|loc:B0004842921|x_pti1__nipnas:6846372|loc:B0004843083|x_pti1__nipnas:6846372|loc:B0004802205|x_pti1__nipnas:6846372|loc:B0004837681|x_pti1__nipnas:6846372|loc:B0004842032|x_pti1__nipnas:6846372|loc:B0004829144|x_pti1__nipnas:6846372|loc:B0004841847|x_pti1__nipnas:6846372|loc:B0004841970|x_pti1__nipnas:6846372|loc:B0004842394|x_pti1__nipnas:6846372|loc:B0004850830|x_pti1__nipnas:6846372|loc:B0004837013|x_pti1__nipnas:6846372|loc:B0004853712|x_pti1__nipnas:6846372|loc:B0004830595|x_pti1__nipnas:6846372|loc:B0004860972|x_pti1__nipnas:6846372. AFTER (S_ORG_EXT) name :TELKOMSEL_testing_lagi|x_pti1__nipnas:6846372|x_pti1_accnt_nas:|loc:B0004840599|x_pti1__nipnas:6846372|loc:B0004842255|x_pti1__nipnas:6846372|loc:B0004809123|x_pti1__nipnas:6846372|loc:B0004808747|x_pti1__nipnas:6846372|loc:B0004829497|x_pti1__nipnas:6846372|loc:B0004835777|x_pti1__nipnas:6846372|loc:B0004842921|x_pti1__nipnas:6846372|loc:B0004843083|x_pti1__nipnas:6846372|loc:B0004802205|x_pti1__nipnas:6846372|loc:B0004837681|x_pti1__nipnas:6846372|loc:B0004842032|x_pti1__nipnas:6846372|loc:B0004829144|x_pti1__nipnas:6846372|loc:B0004841847|x_pti1__nipnas:6846372|loc:B0004841970|x_pti1__nipnas:6846372|loc:B0004842394|x_pti1__nipnas:6846372|loc:B0004850830|x_pti1__nipnas:6846372|loc:B0004837013|x_pti1__nipnas:6846372|loc:B0004853712|x_pti1__nipnas:6846372|loc:B0004830595|x_pti1__nipnas:6846372|loc:B0004860972|x_pti1__nipnas:6846372
					
					
					BEFORE (S_ORG_EXT) name :INFOMEDIA NUSANTARA|
					x_pti1__nipnas:|
					x_pti1_accnt_nas:. AFTER (S_ORG_EXT) name :INFOMEDIA NUSANTARA|
					x_pti1__nipnas:1234|
					x_pti1_accnt_nas:
					 */
					 
					$MESSAGE = explode('. AFTER (S_ORG_EXT)',$MESSAGE);
					if(count($MESSAGE) > 1){
						$before = explode('|',str_replace('BEFORE (S_ORG_EXT) ','',$MESSAGE[0]));
					}else{
						$before = explode('|',str_replace('BEFORE (S_ORG_EXT) ','',$MESSAGE[0]));
					}
					
					if(count($before) > 1){
						$dataBefore = array(
								'NAME' 		=> str_replace('name :','Name : ',$before[0]),//name
								'NIPNAS' 	=> str_replace('x_pti1__nipnas:','nipnas : ',$before[1]),//nipnas
								'ACCNAS' 	=> str_replace('x_pti1_accnt_nas:','ACCNAS : ',$before[2]),//accnas
								'LOC' 		=> $LOC_INPUT,//loc
							);
					}else{
						$dataBefore = array(
								'NAME' 		=> "",
								'NIPNAS' 	=> "",
								'ACCNAS' 	=> "",
								'LOC' 		=> "",
							);
					}
					
					$LOG_VALUE = "";
					if($LOG_CLOB){
						$LOG_VALUE = $LOG_CLOB->load();
					}
					
					$after = explode('|',$LOG_VALUE);
					
					$dataAfter = array(
									'NAME' 		=> str_replace('in_name:','Name : ',$after[1]),//name
									'NIPNAS' 	=> str_replace('in_nipnas:','NIPNAS : ',$after[3]),//nipnas
									'ACCNAS' 	=> str_replace('in_account_nas:','ACCNAS : ',$after[2]),//accnas
									'LOC' 		=> $LOC_INPUT,//loc
									'USER' 				=> "Update By : ".($key['USERS'] == "" ? "" : $key['USERS']),//loc
									'TYPE' 				=> "Type : ".($key['TYPE'] == "" ? "" : $key['TYPE']),//loc
									'FILE_NAME' 		=> "File Name : ".($key['FILE_NAME'] == "" ? "" : $key['FILE_NAME']),//loc
								);
					
					$temp = array(
								'PROCEDURE'			=> 'UPDATE_CABASA',
								'BEFORE'			=> $dataBefore,
								'AFTER'				=> $dataAfter,
								'STATUS'			=> $key['STATUS'],
								'STATUS_EXT'		=> $key['STATUS_EXT'],
								'LOGS_TIMESTAMP'	=> $key['LOGS_TIMESTAMP'],
							);
							
					$key['detail'] = $temp;
				  
						
					  
				  }else if($key['PACK_PROC'] == 'MOVE_BA_TO_OTHERS_CA'){
					  
					//$MESSAGE 	= $key['MESSAGE'];
					
					$mess 	= $key['MESSAGE'];

					$MESSAGE = "";
					if($mess){
						$MESSAGE = $mess->load();
					}
					//par_ou_id :1-62I-403|master_ou_id:1-62I-403|x_pti1__nipnas:684637|(S_ASSET)|(S_DOC_AGREE)(S_ORDER)(S_ORDER_ITEM). AFTER (S_ORG_EXT) par_ou_id:1-62I-3706|master_ou_id:1-62I-3706|x_pti1__nipnas:3001064661|(S_ASSET)|(S_DOC_AGREE)(S_ORDER)(S_ORDER_ITEM)
					
					$before = explode('|',str_replace('BEFORE (S_ORG_EXT) ','',$MESSAGE));
					$nipnas_source = "";
					if(count($before) > 2){
						$nipnas_source = $before[2];
					}
					  
					$LOG_CLOB 	= $key['LOG_VALUE'];

					
					$LOG_VALUE = "";
					if($LOG_CLOB){
						$LOG_VALUE = $LOG_CLOB->load();
					}
					
					$after = explode('|',$LOG_VALUE);
					
					$dataBefore = array(
									'LOC' 		=> "",
									'CA' 		=> "",
								);
								
					$dataAfter = array(
									'LOC' 		=> "",
									'NIPNAS' 	=> "",
									'CA' 		=> "",
									'USER' 				=> "",
									'TYPE' 				=> "",
									'FILE_NAME' 		=> "",
								);

					
					if(count($after) > 1){
						
						$dataBefore = array(
										'LOC' 		=> str_replace('in_ba_source:','LOC : ',$after[0]),//loc
										'CA' 		=> str_replace('in_ca_source:','CA : ',$after[1]),//ca
										'NIPNAS' 	=> str_replace('x_pti1__nipnas:','Nipnas : ',$nipnas_source),//ca
									);
									
						$dataAfter = array(
										'LOC' 		=> str_replace('in_ba_source:','LOC : ',$after[0]),//loc
										'NIPNAS' 	=> str_replace('in_nipnas_target:','Nipnas Target : ',$after[3]),//nipnas
										'CA' 		=> str_replace('in_ca_target:','CA Target : ',$after[2]),//ca
										'USER' 				=> "Update By : ".($key['USERS'] == "" ? "" : $key['USERS']),//loc
										'TYPE' 				=> "Type : ".($key['TYPE'] == "" ? "" : $key['TYPE']),//loc
										'FILE_NAME' 		=> "File Name : ".($key['FILE_NAME'] == "" ? "" : $key['FILE_NAME']),//loc
									);
					}
					
					$temp = array(
								'PROCEDURE'			=> 'MOVE_BA_TO_OTHERS_CA',
								'BEFORE'			=> $dataBefore,
								'AFTER'				=> $dataAfter,
								'STATUS'			=> $key['STATUS'],
								'STATUS_EXT'		=> $key['STATUS_EXT'],
								'LOGS_TIMESTAMP'	=> $key['LOGS_TIMESTAMP'],
							);
					  
				  }else if($key['PACK_PROC'] == 'MERGE_BA'){
						
						/* //C0004700966
						//B0004802205 -> awal -> nipnas : 6846372 -> accnas : 033590 -> hilang
						//B0004837681 -> merge -> nipnas : 6846372 -> accnas : 4837681 -> acnas dipilih : 4837681 -> ada
						//accnas : 4837681 -> nipnas : 6846372
						
						before :
						
						CA : C0004700966
						Nipnas : 6846372
						par_ou_id : X1-62I-403
						
						loc merge :B0004802205
						accnas : 033590
						
						loc merge target : B0004837681
						accnas : 4837681
						
						
						after :
						
						CA : C0004700966
						par_ou_id : X1-62I-403
						LOC : B0004837681
						accnas : 4837681
						
						
						
						
						
						
						
						//BEFORE (S_ORG_EXT) OLD loc:B0004802205|
						x_pti1_accnt_nas:033590|
						par_ou_id:1-62I-403|
						cust_stat_cd:Active|
						NEW Loc:B0004837681|
						x_pti1_accnt_nas:4837681(S_ASSET)(S_ORDER_ITEM)(S_ORDER)|
						Bill Profile:. AFTER (S_ORG_EXT) x_pti1_accnt_nas:X033590|
						//x_pti1_accnt_nas:4837681|
						par_ou_id:X1-62I-403|
						cust_stat_cd:Inactive(S_ASSET)|
						row_id:1-6SX-2566|bill_accnt_id:1-4MS-3423|row_id:1-6SX-2567|bill_accnt_id:1-4MS-3423|row_id:1-6SX-2568|bill_accnt_id:1-4MS-3423|row_id:1-6SX-2569|bill_accnt_id:1-4MS-3423|row_id:1-6SX-3875|bill_accnt_id:1-4MS-3423|row_id:1-6T0-4373|bill_accnt_id:1-4MS-3423(S_ORDER_ITEM)|row_id:1-6KY-1215|bill_accnt_id:1-4MS-3423|row_id:1-6KY-3847|bill_accnt_id:1-4MS-3423|row_id:1-6L5-4334|bill_accnt_id:1-4MS-3423|row_id:1-6L6-2914|bill_accnt_id:1-4MS-3423|row_id:1-6L5-4349|bill_accnt_id:1-4MS-3423|row_id:1-6KY-1234|bill_accnt_id:1-4MS-3423(S_ORDER)|row_id:1-6DI-2258|bill_accnt_id:1-4MS-3423|row_id:1-6DI-2259|bill_accnt_id:1-4MS-3423|Bill Profile:|row_id:1-6DI-2258|bill_profile_id:1-4OD-3423|row_id:1-6DI-2259|bill_profile_id:1-4OD-3423
						 */
						$mess 	= $key['MESSAGE'];
						
						$MESSAGE = "";
						if($mess){
							$MESSAGE = $mess->load();
						}
					  
						$after = explode('|',$MESSAGE);
						
						$dataBefore = array(
										'PAR_OU_ID' 	=> "",
										'LOC_MERGE' 	=> "",
										'ACCNAS_MERGE' 	=> "",
										'LOC_TARGET' 	=> "",
										'ACCNAS_TARGET' => "",
									);
						$dataAfter = array(
										'LOC' 		=> "",
										'ACCNAS' 	=> "",
										'USER' 		=> "",
										'TYPE' 		=> "",
										'FILE_NAME' => "",
									);
									
						if(count($after) > 1){
						
							$dataBefore = array(
											'PAR_OU_ID' 	=> str_replace('par_ou_id:','PAR_OU_ID : ',$after[2]),
											'LOC_MERGE' 	=> str_replace('BEFORE (S_ORG_EXT) OLD loc:','LOC : ',$after[0]),
											'ACCNAS_MERGE' 	=> str_replace('x_pti1_accnt_nas:','ACCNAS : ',$after[1]),
											'LOC_TARGET' 	=> str_replace('NEW Loc:','LOC Target : ',$after[4]),
											'ACCNAS_TARGET' => str_replace('(S_ASSET)(S_ORDER_ITEM)(S_ORDER)','',(str_replace('x_pti1_accnt_nas:','ACCNAS Target : ',$after[5]))),
										);
										
							$dataAfter = array(
											'LOC' 		=> str_replace('NEW Loc:','LOC Target : ',$after[4]),
											'ACCNAS' 	=> str_replace('x_pti1_accnt_nas:','LOC : ',$after[7]),
											'USER' 		=> "Update By : ".($key['USERS'] == "" ? "" : $key['USERS']),//loc
											'TYPE' 		=> "Type : ".($key['TYPE'] == "" ? "" : $key['TYPE']),//loc
											'FILE_NAME' => "File Name : ".($key['FILE_NAME'] == "" ? "" : $key['FILE_NAME']),//loc
										);
						}
						
						$temp = array(
									'PROCEDURE'			=> 'MERGE_BA',
									'BEFORE'			=> $dataBefore,
									'AFTER'				=> $dataAfter,
									'STATUS'			=> $key['STATUS'],
									'STATUS_EXT'		=> $key['STATUS_EXT'],
									'LOGS_TIMESTAMP'	=> $key['LOGS_TIMESTAMP'],
								);
					  
				  }else if($key['PACK_PROC'] == 'UPDATE_TANGGAL_TERMIN'){
					  
						$mess 	= $key['MESSAGE'];

						$MESSAGE = "";
						/* echo $key['ID'];
						print_r($mess); */
						if($mess){
							$MESSAGE = $mess->load();
						}
						$message = explode('|',$MESSAGE);
						
						
					
						$dataBefore = array(
										'ORDER_ID' 			=> "",
										'ASSET_ID' 			=> "",
										'SEQUENCE' 			=> "",
										'TERMIN_DATE' 		=> "",
											);
						$dataAfter = array(
										'ORDER_ID' 			=> "",
										'ASSET_ID' 			=> "",
										'SEQUENCE' 			=> "",
										'TERMIN_DATE' 		=> "",
										'USER' 				=> "",
										'TYPE' 				=> "",
										'FILE_NAME' 		=> "",
									);
									
						if(count($message) == 2){
							$before = explode(';',str_replace('Before=','',$message[0]));
							$after = explode(';',str_replace('After=','',$message[1]));
							if(count($before) > 2){
								$dataBefore = array(
												'ORDER_ID' 			=> str_replace('order ID:','Order ID : ',$before[0]) == '' ? '' : $before[0],//ca
												'ASSET_ID' 			=> str_replace('asset id:','Asset ID : ',$before[1]) == '' ? '' : $before[1],//ca
												'SEQUENCE' 			=> str_replace('sequence:','Sequence : ',$before[2]) == '' ? '' : $before[2],//ca
												'TERMIN_DATE' 		=> str_replace('termin date:','Termin Date : ',$before[3]) == '' ? '' : $before[3],//ca
											);
							}
							if(count($after) > 1 && count($before) > 2){
								$dataAfter = array(
												'ORDER_ID' 			=> str_replace('order ID:','Order ID : ',$before[0] == '' ? '' : $before[0]),//ca
												'ASSET_ID' 			=> str_replace('asset id:','Asset ID : ',$before[1] == '' ? '' : $before[1]),//ca
												'SEQUENCE' 			=> str_replace('sequence:','Sequence : ',$after[0] == '' ? '' : $after[0]),//ca
												'TERMIN_DATE' 		=> str_replace('termin_date:','Termin Date : ',$after[1] == '' ? '' : $after[1]),//ca
												'USER' 				=> "Update By : ".($key['USERS'] == "" ? "" : $key['USERS']),//loc
												'TYPE' 				=> "Type : ".($key['TYPE'] == "" ? "" : $key['TYPE']),//loc
												'FILE_NAME' 		=> "File Name : ".($key['FILE_NAME'] == "" ? "" : $key['FILE_NAME']),//loc
											);
							}
						}
						
						$temp = array(
									'PROCEDURE'			=> 'UPDATE_TANGGAL_TERMIN',
									'BEFORE'			=> $dataBefore,
									'AFTER'				=> $dataAfter,
									'STATUS'			=> $key['STATUS'],
									'STATUS_EXT'		=> $key['STATUS_EXT'],
									'LOGS_TIMESTAMP'	=> $key['LOGS_TIMESTAMP'],
								);
					  
				  }else if($key['PACK_PROC'] == 'UPDATE_TANGGAL_ORDER'){
					$mess 	= $key['MESSAGE'];
					
					$MESSAGE = "";
					if($mess){
						$MESSAGE = $mess->load();
					}
					$message = explode('|',$MESSAGE);
					
					$dataBefore = array(
									'ORDER_ID' 			=> "",
									'SERVICE_ID' 		=> "",
									'PROVISIONING_DT' 	=> "",
									'BILL_DT' 			=> "",
									'BASO_DT' 			=> "",
									'INTEGRATION_DT' 	=> "",
									'AGREE_START' 		=> "",
									'AGREE_END' 		=> "",
								);
								
					$dataAfter = array(
									'PROVISIONING_DT' 	=> "",
									'BILL_DT' 			=> "",
									'BASO_DT' 			=> "",
									'INTEGRATION_DT' 	=> "",
									'AGREE_START' 		=> "",
									'AGREE_END' 		=> "",
									'USER' 				=> "",
									'TYPE' 				=> "",
									'FILE_NAME' 		=> "",
								);
								
					if(count($message) == 2){
						$before = explode(';',str_replace('before=','',$message[0]));
						$after = explode(';',str_replace('After=','',$message[1]));
						if(count($before) > 2){
							$dataBefore = array(
											'ORDER_ID' 			=> str_replace(':',' : ',$before[0]),//loc
											'SERVICE_ID' 		=> str_replace(':',' : ',($before[1] == ''? '':$before[1])),//ca
											'PROVISIONING_DT' 	=> str_replace(':',' : ',$before[7]),//loc
											'BILL_DT' 			=> str_replace(':',' : ',$before[8]),//loc
											'BASO_DT' 			=> str_replace(':',' : ',$before[9]),//loc
											'INTEGRATION_DT' 	=> str_replace(':',' : ',$before[10]),//loc
											'AGREE_START' 		=> str_replace(':',' : ',$before[11]),//loc
											'AGREE_END' 		=> str_replace(':',' : ',$before[12]),//loc
										);
						}
						if(count($after) > 2){
							$dataAfter = array(
											'PROVISIONING_DT' 	=> str_replace('prov:','PROVISIONING_DT : ',$after[3]),//loc
											'BILL_DT' 			=> str_replace('bill:','BILL_DT : ',$after[0]),//loc
											'BASO_DT' 			=> str_replace('baso:','BASO_DT : ',$after[1]),//loc
											'INTEGRATION_DT' 	=> str_replace('integ:','INTEGRATION_DT : ',$after[2]),//loc
											'AGREE_START' 		=> str_replace('start:','AGREE_START : ',$after[4]),//loc
											'AGREE_END' 		=> str_replace('end:','AGREE_END : ',$after[5]),//loc
											'USER' 				=> "Update By : ".($key['USERS'] == "" ? "" : $key['USERS']),//loc
											'TYPE' 				=> "Type : ".($key['TYPE'] == "" ? "" : $key['TYPE']),//loc
											'FILE_NAME' 		=> "File Name : ".($key['FILE_NAME'] == "" ? "" : $key['FILE_NAME']),//loc
										);
						}
					}
					
					$temp = array(
								'PROCEDURE'			=> 'UPDATE_TANGGAL_ORDER',
								'BEFORE'			=> $dataBefore,
								'AFTER'				=> $dataAfter,
								'STATUS'			=> $key['STATUS'],
								'STATUS_EXT'		=> $key['STATUS_EXT'],
								'LOGS_TIMESTAMP'	=> $key['LOGS_TIMESTAMP'],
							);
					  
				  }else{
						$temp = array(
								'PROCEDURE'			=> "",
								'BEFORE'			=> "",
								'AFTER'				=> "",
								'STATUS'			=> "",
								'STATUS_EXT'		=> "",
								'LOGS_TIMESTAMP'	=> "",
							);
				  }
            } else {
                $temp = array(
						'PROCEDURE'			=> "",
						'BEFORE'			=> "",
						'AFTER'				=> "",
						'STATUS'			=> "",
						'STATUS_EXT'		=> "",
						'LOGS_TIMESTAMP'	=> "",
					);
            }
        } catch (\Exception $ex) {
            $temp = array(
						'PROCEDURE'			=> "",
						'BEFORE'			=> "",
						'AFTER'				=> "",
						'STATUS'			=> "",
						'STATUS_EXT'		=> "",
						'LOGS_TIMESTAMP'	=> "",
					);
        }
        return $temp;
    }
	
	public function setComplete($data = null, $config=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->setComplete($data, $config)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function rollback($data = null, $code_sess = null, $in_type = null, $in_file_name = null, $config=array()) {
        $result = new Result();
        try {
            if ($datax = $this->_storage->getDataLog($data, $config)) {
				foreach($datax as $key){
					$data = array();
					$temp = $this->explodeMessage($key);
					$update = "";
					if($temp['PROCEDURE'] == 'MOVE_BA_TO_OTHERS_CA'){
						
						$data = array(
										'ba_source'	=> str_replace('LOC : ','',$temp['AFTER']['LOC']),
										'ca_source'	=> str_replace('CA Target : ','',$temp['AFTER']['CA']),
										'target'	=> "xxxx"."~".str_replace('Nipnas : ','',$temp['BEFORE']['NIPNAS'])."~".str_replace('CA : ','',$temp['BEFORE']['CA']),
									); 
						
						
						$update = $this->saveMove($data, $code_sess, $in_file_name, $in_type, $config);
						
					}else if($temp['PROCEDURE'] == 'UPDATE_CABASA'){

						$data = array(
									'IN_LOC' 			=> $temp['BEFORE']['LOC'],
									'IN_NAME' 			=> str_replace('Name : ','',$temp['BEFORE']['NAME']),
									'IN_NIPNAS' 		=> str_replace('nipnas : ','',$temp['BEFORE']['NIPNAS']),
									'IN_ACCOUNT_NAS' 	=> str_replace('ACCNAS : ','',$temp['BEFORE']['ACCNAS']),
									'IN_USER' 			=> $code_sess
									);
						
						
						$update = $this->sendUpdate($data, $code_sess, $in_type ,$in_file_name, $config);
						
					}else if($temp['PROCEDURE'] == 'MERGE_BA'){
						
						$update = $this->sendMerge($data, $code_sess, $in_type ,$in_file_name, $config);
						
					}else if($temp['PROCEDURE'] == 'UPDATE_TANGGAL_ORDER'){

						$val = array(
										'agree_end_order'	=> str_replace('AGREE_END : ','',$temp['BEFORE']['AGREE_END']),
										'agree_start_order'	=> str_replace('AGREE_START : ','',$temp['BEFORE']['AGREE_START']),
										'baso_order'		=> str_replace('BASO_DT : ','',$temp['BEFORE']['BASO_DT']),
										'bill_order'		=> str_replace('BILL_DT : ','',$temp['BEFORE']['BILL_DT']),
										'integration_order'	=> str_replace('INTEGRATION_DT : ','',$temp['BEFORE']['INTEGRATION_DT']),
										'provisioning_order'=> str_replace('PROVISIONING_DT : ','',$temp['BEFORE']['PROVISIONING_DT']),
										'order_id'			=> str_replace('ORDER_NUM : ','',$temp['BEFORE']['ORDER_ID']),
										'sid'				=> str_replace('SERVICE_NUM : ','',$temp['BEFORE']['SERVICE_ID']),
										'status'			=> "",
									);
						$data['data1'] = $val;
						
						$update = $this->sendOrder($data, $code_sess, $in_file_name, $in_type, $config);
						
					}else if($temp['PROCEDURE'] == 'UPDATE_TANGGAL_TERMIN'){
						
						$data = array(
										'sequence'		=> str_replace('sequence:','',$temp['BEFORE']['SEQUENCE']),
										'termin_date'	=> str_replace('termin date:','',$temp['BEFORE']['TERMIN_DATE']),
										'order_id'		=> str_replace('order ID:','',$temp['BEFORE']['ORDER_ID']),
										'no_asset'		=> str_replace('asset id:','',$temp['BEFORE']['ASSET_ID']),
										'status'		=> "",
									);
						
						$update = $this->sendTermin($data, $code_sess, $in_file_name, $in_type, $config);
						
					}
				}
				if($update){
					$result->data = $update;
				}else{
					$result->code = 10;
					$result->info = "update_failed";
				}
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function getTotalRecon() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getTotalRecon()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function getReconDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getReconDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalRecon($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalRecon($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function getTotalBilling() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getTotalBilling()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function getBillingDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getBillingDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalBilling($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalBilling($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function cacustref() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->cacustref()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function getcacustreflast($table=null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getcacustreflast($table)) {
				$data[0]['LAST_UPDATE'] = date('d-m-Y H:i:s', strtotime($data[0]['LAST_UPDATE']));
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function cacustrefDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->cacustrefDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function cacustrefDetailDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->cacustrefDetailDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalcacustref($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalcacustref($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function getbaacnum() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getbaacnum()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function getbaacnumDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getbaacnumDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function getbaacnumDetailDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->getbaacnumDetailDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalgetbaacnum($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalgetbaacnum($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function gettibsncx() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->gettibsncx()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT_NAME'] = number_format(($data[0]['NOT_VALID_NAME'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT_AREA'] = number_format(($data[0]['NOT_VALID_AREA'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT_ALL'] = number_format(($data[0]['NOT_VALID_ALL'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$data[0]['NOT_VALID_NAME'] = number_format($data[0]['NOT_VALID_NAME']);
				$data[0]['NOT_VALID_AREA'] = number_format($data[0]['NOT_VALID_AREA']);
				$data[0]['NOT_VALID_ALL'] = number_format($data[0]['NOT_VALID_ALL']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function gettibsncxDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->gettibsncxDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function gettibsncxDetailDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->gettibsncxDetailDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalgettibsncx($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalgettibsncx($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }


    public function cabacustrefaacnum() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->cabacustrefaacnum()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function cabacustrefaacnumDetail($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->cabacustrefaacnumDetail($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function cabacustrefaacnumDetailDownload($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->cabacustrefaacnumDetailDownload($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function totalcabacustrefaacnum($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalcabacustrefaacnum($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function billcomncxtibs() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->billcomncxtibs()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function billcomncxtibsDetail($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->billcomncxtibsDetail($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function billcomncxtibsDetailDownload($data) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->billcomncxtibsDetailDownload($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function totalbillcomncxtibs($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalbillcomncxtibs($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function tibsncxbillcom() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->tibsncxbillcom()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function tibsncxbillcomDetail($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->tibsncxbillcomDetail($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
    public function tibsncxbillcomDetailDownload($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->tibsncxbillcomDetailDownload($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function totaltibsncxbillcom($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totaltibsncxbillcom($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function ncxtibssid() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->ncxtibssid()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function ncxtibssidDetail($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->ncxtibssidDetail($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function downloadncxtibssid($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->downloadncxtibssid($data)) {
                $result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function totalncxtibssid($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalncxtibssid($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function doublesid() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->doublesid()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function doublesidDetail($data = null) {
        
        $result = new Result();
        
        try {
			$temp = array();
            if ($data = $this->_storage->doublesidDetail($data)) {
				foreach($data as $row){
					
					$row['BILL_MNY']	= number_format($row['BILL_MNY']);
					array_push($temp, $row);
				}
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
    public function downloaddoublesid($data = null) {
        
        $result = new Result();
        
        try {
			$temp = array();
            if ($data = $this->_storage->downloaddoublesid($data)) {
				foreach($data as $row){
					
					$row['BILL_MNY']	= number_format($row['BILL_MNY']);
					array_push($temp, $row);
				}
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function totaldoublesid($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totaldoublesid($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function doublenoparetDetail($data = null) {
        
        $result = new Result();
        
        try {
			$temp = array();
            if ($data = $this->_storage->doublenoparetDetail($data)) {
				foreach($data as $row){
					
					$row['BILL_MNY']	= number_format($row['BILL_MNY']);
					array_push($temp, $row);
				}
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function totaldoublenoparet($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totaldoublenoparet($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
    public function getMenu() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->getMenu()) {
				$temp = array();
				foreach($data as $row){
					if($detail = $this->_storage->getMenuDetail($row['ID'])){
						$det = $detail;
						$index = array();
						foreach($detail as $val){
							array_push($index,$val['LINK']);
						}
					}else{
						$det = array();
						$index = array();
					}
					$row['index']	= $index;
					$row['detail'] = $det;
					array_push($temp, $row);
				}
				
                $result->data = $temp;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function ncxtibsprice() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->ncxtibsprice()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function ncxtibspriceDetail($data = null) {
        
        $result = new Result();
        
        try {
			$temp = array();
            if ($data = $this->_storage->ncxtibspriceDetail($data)) {
				foreach($data as $row){
					
					$row['NCX_PRICE_OTC']	= number_format($row['NCX_PRICE_OTC']);
					$row['TIBS_PRICE_OTC']	= number_format($row['TIBS_PRICE_OTC']);
					$row['NCX_PRICE_REC']	= number_format($row['NCX_PRICE_REC']);
					$row['TIBS_PRICE_REC']	= number_format($row['TIBS_PRICE_REC']);
					array_push($temp, $row);
				}
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function downloadncxtibsprice($data = null) {
        
        $result = new Result();
        
        try {
			$temp = array();
            if ($data = $this->_storage->downloadncxtibsprice($data)) {
				foreach($data as $row){
					
					$row['NCX_PRICE_OTC']	= number_format($row['NCX_PRICE_OTC']);
					$row['TIBS_PRICE_OTC']	= number_format($row['TIBS_PRICE_OTC']);
					$row['NCX_PRICE_REC']	= number_format($row['NCX_PRICE_REC']);
					$row['TIBS_PRICE_REC']	= number_format($row['TIBS_PRICE_REC']);
					array_push($temp, $row);
				}
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function totalncxtibsprice($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalncxtibsprice($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function ncxtibsbilldate() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->ncxtibsbilldate()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function ncxtibsbilldateDetail($data = null) {
        
        $result = new Result();
        
        try {
			$temp = array();
            if ($data = $this->_storage->ncxtibsbilldateDetail($data)) {
				foreach($data as $row){
					
					array_push($temp, $row);
				}
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function downloadncxtibsbilldate($data = null) {
        
        $result = new Result();
        
        try {
			$temp = array();
            if ($data = $this->_storage->downloadncxtibsbilldate($data)) {
				foreach($data as $row){
					
					array_push($temp, $row);
				}
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function totalncxtibsbilldate($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalncxtibsbilldate($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function ncxtibsppn() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->ncxtibsppn()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function ncxtibsppnDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->ncxtibsppnDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
                    // $row['TIBS_PPN']  = number_format($row['TIBS_PPN']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function downloadtibsncxppn($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloadtibsncxppn($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
                    // $row['TIBS_PPN']  = number_format($row['TIBS_PPN']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totalncxtibsppn($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalncxtibsppn($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


     public function ncxtibstop() {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->ncxtibstop()) {

               // print_r($data);die();

                $data[0]['TOTAL_PERCENT']   = ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
                $data[0]['VALID_PERCENT']   = number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
                $data[0]['TOTAL']   = number_format($data[0]['TOTAL']);
                $data[0]['VALID']   = number_format($data[0]['VALID']);
                $data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
                $result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }


    public function ncxtibstopDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->ncxtibstopDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
                    // $row['TIBS_PPN']  = number_format($row['TIBS_PPN']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function downloadtibsncxtop($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloadtibsncxtop($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
                    // $row['TIBS_PPN']  = number_format($row['TIBS_PPN']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totalncxtibstop($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalncxtibstop($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

	public function saveMergeCa($data = array(), $code_sess = null,$in_type = null ,$in_file_name = null, $config=array()) {
        $result = new Result();
        try {
            if ($data = $this->_storage->saveMergeCa($data, $code_sess, $in_type, $in_file_name, $config)) {
                $result->info = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        return $result;
    }
	
	public function doublemoDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->doublemoDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function downloaddoublemo($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloaddoublemo($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totaldoublemo($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totaldoublemo($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function doublemrcDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->doublemrcDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function downloaddoublemrc($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloaddoublemrc($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totaldoublemrc($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totaldoublemrc($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function businessareaDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->businessareaDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function downloadbusinessarea($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloadbusinessarea($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

    public function totalbusinessarea($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalbusinessarea($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function cpaddressDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->cpaddressDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

	public function downloadcpaddress($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloadcpaddress($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totalcpaddress($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalcpaddress($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function tanggalcontractDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->tanggalcontractDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }

	public function downloadtanggalcontract($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloadtanggalcontract($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totaltanggalcontract($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totaltanggalcontract($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function latlongDetail($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->latlongDetail($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function downloadlatlong($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloadlatlong($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totallatlong($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totallatlong($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function misssingbilling($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->misssingbilling($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function downloadmisssingbilling($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloadmisssingbilling($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					//$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totalmisssingbilling($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totalmisssingbilling($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function doubleAo($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->doubleAo($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function downloaddoubleAo($data = null) {
        
        $result = new Result();
        
        try {
            $temp = array();
            if ($data = $this->_storage->downloaddoubleAo($data)) {
                foreach($data as $row){
                    
                    // $row['NCX_PPN']   = number_format($row['NCX_PPN']);
					$row['BILL_MNY']  = number_format($row['BILL_MNY']);
                    array_push($temp, $row);
                }
                $result->data = $temp;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }



    public function totaldoubleAo($data = null) {
        
        $result = new Result();
        
        try {
            if ($data = $this->_storage->totaldoubleAo($data)) {
                //print_r($data);
                $result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
        
        return $result;
    }
	
	public function sidncxnoss() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->sidncxnoss()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function sidncxnossDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->sidncxnossDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function sidncxnossDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->sidncxnossDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalsidncxnoss($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalsidncxnoss($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function bancxtrems() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->bancxtrems()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function bancxtremsDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->bancxtremsDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function bancxtremsDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->bancxtremsDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalbancxtrems($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalbancxtrems($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function falloutnoss($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->falloutnoss($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalfalloutnoss($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalfalloutnoss($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function falloutnossDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->falloutnossDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function revcode() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->revcode()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function revcodeDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->revcodeDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function revcodeDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->revcodeDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalrevcode($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalrevcode($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function batibstrems() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->batibstrems()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function batibstremsDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->batibstremsDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function batibstremsDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->batibstremsDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalbatibstrems($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalbatibstrems($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function serviceaddrncx($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->serviceaddrncx($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalserviceaddrncx($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalserviceaddrncx($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function serviceaddrncxDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->serviceaddrncxDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	
	
	public function sidncxnossasset() {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->sidncxnossasset()) {
				$data[0]['TOTAL_PERCENT'] 	= ($data[0]['TOTAL'] / $data[0]['TOTAL'])* 100;
				$data[0]['VALID_PERCENT'] 	= number_format(($data[0]['VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['NOT_VALID_PERCENT'] = number_format(($data[0]['NOT_VALID'] / $data[0]['TOTAL'])* 100,2);
				$data[0]['TOTAL'] 	= number_format($data[0]['TOTAL']);
				$data[0]['VALID'] 	= number_format($data[0]['VALID']);
				$data[0]['NOT_VALID'] = number_format($data[0]['NOT_VALID']);
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function sidncxnossassetDetail($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->sidncxnossassetDetail($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function sidncxnossassetDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->sidncxnossassetDownload($data)) {
				$result->data = $data;
            } else {
				$result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function totalsidncxnossasset($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->totalsidncxnossasset($data)) {
				//print_r($data);
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function downloadRekon($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->downloadRekon($data)) {
				if($data['rekon_status'] == null) {
					$data['rekon_status'] = "";
				}else{ 
					$data['rekon_status'] = $data['rekon_status'];
				};
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function checkDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->checkDownload($data)) {
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function listDownload($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->listDownload($data)) {
				$result->data = $data;
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function orderDateAgreement($data = null) {
        $result = new Result();
		
        try {
            if ($data = $this->_storage->orderDateAgreement($data)) {
				$result->data = $data;
            } else {
                $result->data = array();
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
			$result->data = array();
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }
	
	public function orderDateAgreementTotal($data = null) {
		
        $result = new Result();
		
        try {
            if ($data = $this->_storage->orderDateAgreementTotal($data)) {
				$result->data = $data[0]['TOTAL'];
            } else {
                $result->code = 1;
                $result->info = 'no_data_found';
            }
        } catch (\Exception $ex) {
            $result->code = 500;
            $result->info = $ex->getMessage();
        }
		
        return $result;
    }

}
