<?php

namespace Neuron\Application\Ncxtools\Data\Storage; 

use Zend\Db\Sql\Predicate\Expression;

class Oci8 extends Mysql {
    public function loadOgp($data) {
		
			$where = "";
		
			if(isset($data['data']['periode_create']) and $data['data']['periode_create'] != ''){
				/* $select->where(array(
					'PERIODE_CREATE' => $data['data']['periode_create']
				)); */
				;
				$periode = array();
				foreach($data['data']['periode_create'] as $row){
					array_push($periode,date("Ym",strtotime("01 ".$row)));
				}
				$periode = implode("','",$periode);
				$where .= " where PERIODE_CREATE_YM in('".$periode."')";
				//$select->where(new Expression($this->__('PERIODE_CREATE_YM')." in ('".$periode."')"));
			}else{
				$where .= " where TO_DATE (
									PERIODE_CREATE_YMD,
									'YYYYMMDD'
								) BETWEEN TO_DATE ('".date('Ymd',strtotime($data['data']['from']))."', 'YYYYMMDD')
								AND TO_DATE ('".date('Ymd',strtotime($data['data']['to']))."', 'YYYYMMDD')";
			}
			
			if(isset($data['data']['order_type']) and $data['data']['order_type'] != ''){
				/* $select->where(array(
					'ORDER_TYPE' => $data['data']['order_type']
				)); */
				
				$order_type = implode("','",$data['data']['order_type']);
				//$select->where(new Expression($this->__('ORDER_TYPE')." in ('".$ORDER_TYPE."')"));
				if($where != ""){
					$where .= " AND ORDER_TYPE in('".$order_type."')";
				}else{
					$where .= " where  ORDER_TYPE in('".$order_type."')";
				}
				
			}
			
			if(isset($data['data']['order_status']) and $data['data']['order_status'] != ''){
				/* $select->where(array(
					'ORDER_STATUS' => $data['data']['order_status']
				)); */
				
				$order_status = implode("','",$data['data']['order_status']);
				//$select->where(new Expression($this->__('ORDER_STATUS')." in ('".$order_status."')"));
				
				if($where != ""){
					$where .= " AND ORDER_STATUS in('".$order_status."')";
				}else{
					$where .= " where  ORDER_STATUS in('".$order_status."')";
				}
			}
			
			if(isset($data['data']['divisi']) and $data['data']['divisi'] != ''){
				/* $select->where(array(
					'DIVISI' => $data['data']['divisi']
				)); */
				
				$divisi = implode("','",$data['data']['divisi']);
				//$select->where(new Expression($this->__('DIVISI')." in ('".$divisi."')"));
				
				if($where != ""){
					$where .= " AND DIVISI in('".$divisi."')";
				}else{
					$where .= " where  DIVISI in('".$divisi."')";
				}
			}
			
			if(isset($data['data']['segmen']) and $data['data']['segmen'] != ''){
				/* $select->where(array(
					'SEGMEN' => $data['data']['segmen']
				)); */
				
				$segmen = implode("','",$data['data']['segmen']);
				//$select->where(new Expression($this->__('SEGMEN')." in ('".$segmen."')"));
				
				if($where != ""){
					$where .= " AND SEGMEN in('".$segmen."')";
				}else{
					$where .= " where  SEGMEN in('".$segmen."')";
				}
			}
			
			if(isset($data['data']['am']) and $data['data']['am'] != ''){
				/* $select->where(array(
					'AM' => $data['data']['am']
				)); */
				
				$am = implode("','",$data['data']['am']);
				//$select->where(new Expression($this->__('AM')." in ('".$am."')"));
				
				
				if($where != ""){
					$where .= " AND AM in('".$am."')";
				}else{
					$where .= " where  AM in('".$am."')";
				}
			}
			
			if(isset($data['data']['umur_order']) and $data['data']['umur_order'] != ''){
				/* $select->where(array(
					'UMUR_ORDER' => $data['data']['umur_order']
				)); */
				
				$umur_order = implode("','",$data['data']['umur_order']);
				//$select->where(new Expression($this->__('KATEGORI_UMUR_ORDER')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND UMUR_ORDER in('".$umur_order."')";
				}else{
					$where .= " where  UMUR_ORDER in('".$umur_order."')";
				}
			}
			
			if(isset($data['data']['umur_status_order']) and $data['data']['umur_status_order'] != ''){
				/* $select->where(array(
					'UMUR_ORDER_STATUS' => $data['data']['umur_status_order']
				)); */
				
				$umur_order = implode("','",$data['data']['umur_status_order']);
				//$select->where(new Expression($this->__('KATEGORI_UMUR_ORDERSTATUS')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND UMUR_ORDER_STATUS in('".$umur_order."')";
				}else{
					$where .= " where  UMUR_ORDER_STATUS in('".$umur_order."')";
				}
			}
			
			if(isset($data['data']['order_trans']) and $data['data']['order_trans'] != ''){
				/* $select->where(array(
					'UMUR_ORDER_STATUS' => $data['data']['umur_status_order']
				)); */
				
				$umur_order = implode("','",$data['data']['order_trans']);
				//$select->where(new Expression($this->__('ORDER_TRANS')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND ORDER_TRANS in('".$umur_order."')";
				}else{
					$where .= " where  ORDER_TRANS in('".$umur_order."')";
				}
			}
			
			if(isset($data['data']['vendor_name']) and $data['data']['vendor_name'] != ''){
				/* $select->where(array(
					'UMUR_ORDER_STATUS' => $data['data']['umur_status_order']
				)); */
				
				$umur_order = implode("','",$data['data']['vendor_name']);
				//$select->where(new Expression($this->__('ORDER_TRANS')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND VENDOR_NAME in('".$umur_order."')";
				}else{
					$where .= " where  VENDOR_NAME in('".$umur_order."')";
				}
			}
		
		
        $sql = "SELECT DWH_SALES.M_NCX_OGP.PROCESS AS PROCESS, DWH_SALES.M_NCX_OGP.ID_SUBPROCESS AS ID_SUBPROCESS, DWH_SALES
					.M_NCX_OGP.ORDER_SUBPROCESS AS ORDER_SUBPROCESS, sum(CASE WHEN DIVISI = 'DBS' AND UMUR_ORDER
					 = '0 - 7 Hari' THEN n_order ELSE 0 END) AS DBS_7, sum(CASE WHEN DIVISI = 'DBS' AND UMUR_ORDER
					 = '7 - 15 Hari' THEN n_order ELSE 0 END) AS DBS_15, sum(CASE WHEN DIVISI = 'DBS' AND UMUR_ORDER
					 = '> 15 Hari' THEN n_order ELSE 0 END) AS DBS_16, sum(CASE WHEN DIVISI = 'DBS' THEN n_order ELSE 0 END
					) AS DBS_TOTAL, sum(CASE WHEN DIVISI = 'DES' AND UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE
					 0 END) AS DES_7, sum(CASE WHEN DIVISI = 'DES' AND UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE
					 0 END) AS DES_15, sum(CASE WHEN DIVISI = 'DES' AND UMUR_ORDER = '> 15 Hari' THEN n_order ELSE
					 0 END) AS DES_16, sum(CASE WHEN DIVISI = 'DES' THEN n_order ELSE 0 END) AS DES_TOTAL, sum(CASE WHEN
					 DIVISI = 'DGS' AND UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END) AS DGS_7, sum(CASE WHEN
					 DIVISI = 'DGS' AND UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END) AS DGS_15, sum(CASE
					 WHEN DIVISI = 'DGS' AND UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END) AS DGS_16, sum(CASE
					 WHEN DIVISI = 'DGS' THEN n_order ELSE 0 END) AS DGS_TOTAL FROM DWH_SALES.M_NCX_OGP $where GROUP BY PROCESS
					, ID_SUBPROCESS, ORDER_SUBPROCESS ORDER BY ID_SUBPROCESS ASC";
		$sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
	
    public function loadAm2($data) {
		
			$where = "";
		
			if(isset($data['data']['periode_create']) and $data['data']['periode_create'] != ''){
				/* $select->where(array(
					'PERIODE_CREATE' => $data['data']['periode_create']
				)); */
				;
				$periode = array();
				foreach($data['data']['periode_create'] as $row){
					array_push($periode,date("Ym",strtotime("01 ".$row)));
				}
				$periode = implode("','",$periode);
				$where .= " where PERIODE_CREATE_YM in('".$periode."')";
				//$select->where(new Expression($this->__('PERIODE_CREATE_YM')." in ('".$periode."')"));
				
			}else{
				$where .= " where TO_DATE (
									PERIODE_CREATE_YMD,
									'YYYYMMDD'
								) BETWEEN TO_DATE ('".date('Ymd',strtotime($data['data']['from']))."', 'YYYYMMDD')
								AND TO_DATE ('".date('Ymd',strtotime($data['data']['to']))."', 'YYYYMMDD')";
			}
			
			if(isset($data['data']['order_type']) and $data['data']['order_type'] != ''){
				/* $select->where(array(
					'ORDER_TYPE' => $data['data']['order_type']
				)); */
				
				$order_type = implode("','",$data['data']['order_type']);
				//$select->where(new Expression($this->__('ORDER_TYPE')." in ('".$ORDER_TYPE."')"));
				if($where != ""){
					$where .= " AND ORDER_TYPE in('".$order_type."')";
				}else{
					$where .= " where  ORDER_TYPE in('".$order_type."')";
				}
				
			}
			
			if(isset($data['data']['order_status']) and $data['data']['order_status'] != ''){
				/* $select->where(array(
					'ORDER_STATUS' => $data['data']['order_status']
				)); */
				
				$order_status = implode("','",$data['data']['order_status']);
				//$select->where(new Expression($this->__('ORDER_STATUS')." in ('".$order_status."')"));
				
				if($where != ""){
					$where .= " AND ORDER_STATUS in('".$order_status."')";
				}else{
					$where .= " where  ORDER_STATUS in('".$order_status."')";
				}
			}
			
			if(isset($data['data']['divisi']) and $data['data']['divisi'] != ''){
				/* $select->where(array(
					'DIVISI' => $data['data']['divisi']
				)); */
				
				$divisi = implode("','",$data['data']['divisi']);
				//$select->where(new Expression($this->__('DIVISI')." in ('".$divisi."')"));
				
				if($where != ""){
					$where .= " AND DIVISI in('".$divisi."')";
				}else{
					$where .= " where  DIVISI in('".$divisi."')";
				}
			}
			
			if(isset($data['data']['segmen']) and $data['data']['segmen'] != ''){
				/* $select->where(array(
					'SEGMEN' => $data['data']['segmen']
				)); */
				
				$segmen = implode("','",$data['data']['segmen']);
				//$select->where(new Expression($this->__('SEGMEN')." in ('".$segmen."')"));
				
				if($where != ""){
					$where .= " AND SEGMEN in('".$segmen."')";
				}else{
					$where .= " where  SEGMEN in('".$segmen."')";
				}
			}
			
			if(isset($data['data']['am']) and $data['data']['am'] != ''){
				/* $select->where(array(
					'AM' => $data['data']['am']
				)); */
				
				$am = implode("','",$data['data']['am']);
				//$select->where(new Expression($this->__('AM')." in ('".$am."')"));
				
				
				if($where != ""){
					$where .= " AND AM in('".$am."')";
				}else{
					$where .= " where  AM in('".$am."')";
				}
			}
			
			if(isset($data['data']['umur_order']) and $data['data']['umur_order'] != ''){
				/* $select->where(array(
					'UMUR_ORDER' => $data['data']['umur_order']
				)); */
				
				$umur_order = implode("','",$data['data']['umur_order']);
				//$select->where(new Expression($this->__('KATEGORI_UMUR_ORDER')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND UMUR_ORDER in('".$umur_order."')";
				}else{
					$where .= " where  UMUR_ORDER in('".$umur_order."')";
				}
			}
			
			if(isset($data['data']['umur_status_order']) and $data['data']['umur_status_order'] != ''){
				/* $select->where(array(
					'UMUR_ORDER_STATUS' => $data['data']['umur_status_order']
				)); */
				
				$umur_order = implode("','",$data['data']['umur_status_order']);
				//$select->where(new Expression($this->__('KATEGORI_UMUR_ORDERSTATUS')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND UMUR_ORDERSTATUS in('".$umur_order."')";
				}else{
					$where .= " where  UMUR_ORDER_STATUS in('".$umur_order."')";
				}
			}
			
			if(isset($data['data']['order_trans']) and $data['data']['order_trans'] != ''){
				/* $select->where(array(
					'UMUR_ORDER_STATUS' => $data['data']['umur_status_order']
				)); */
				
				$umur_order = implode("','",$data['data']['order_trans']);
				//$select->where(new Expression($this->__('ORDER_TRANS')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND ORDER_TRANS in('".$umur_order."')";
				}else{
					$where .= " where  ORDER_TRANS in('".$umur_order."')";
				}
			}
			
			if(isset($data['data']['vendor_name']) and $data['data']['vendor_name'] != ''){
				/* $select->where(array(
					'UMUR_ORDER_STATUS' => $data['data']['umur_status_order']
				)); */
				
				$umur_order = implode("','",$data['data']['vendor_name']);
				//$select->where(new Expression($this->__('ORDER_TRANS')." in ('".$umur_order."')"));
				
				if($where != ""){
					$where .= " AND VENDOR_NAME in('".$umur_order."')";
				}else{
					$where .= " where  VENDOR_NAME in('".$umur_order."')";
				}
			}
		
		
        $sql = "SELECT DWH_SALES.M_NCX_OGP.AM AS PROCESS, DWH_SALES.M_NCX_OGP.PROCESS AS PROCESSX, DWH_SALES.M_NCX_OGP.ORDER_SUBPROCESS AS ORDER_SUBPROCESS, sum(CASE WHEN DIVISI = 'DBS' AND UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END) AS DBS_7, sum(CASE WHEN DIVISI = 'DBS' AND UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END) AS DBS_15, sum(CASE WHEN DIVISI = 'DBS' AND UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END) AS DBS_16, sum(CASE WHEN DIVISI = 'DBS' THEN n_order ELSE 0 END) AS DBS_TOTAL, sum(CASE WHEN DIVISI = 'DES' AND UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END) AS DES_7, sum(CASE WHEN DIVISI = 'DES' AND UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END) AS DES_15, sum(CASE WHEN DIVISI = 'DES' AND UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END) AS DES_16, sum(CASE WHEN DIVISI = 'DES' THEN n_order ELSE 0 END) AS DES_TOTAL, sum(CASE WHEN DIVISI = 'DGS' AND UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END) AS DGS_7, sum(CASE WHEN DIVISI = 'DGS' AND UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END) AS DGS_15, sum(CASE WHEN DIVISI = 'DGS' AND UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END) AS DGS_16, sum(CASE WHEN DIVISI = 'DGS' THEN n_order ELSE 0 END) AS DGS_TOTAL FROM DWH_SALES.M_NCX_OGP $where GROUP BY AM, PROCESS, ORDER_SUBPROCESS, ID_SUBPROCESS ORDER BY AM ASC, ID_SUBPROCESS ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
	
	public function loadquote2($data) {
		
			$where = "";
			if(isset($data['data']['status_quote']) and $data['data']['status_quote'] != ''){
				$status_quote = implode("','",$data['data']['status_quote']);
				//$select->where(new Expression($this->__('STATUS_QUOTE')." in ('".$status_quote."')"));
				
				if($where != ""){
					$where .= " AND STATUS_QUOTE in('".$status_quote."')";
				}else{
					$where .= " where  STATUS_QUOTE in('".$status_quote."')";
				}
			}
			
			if(isset($data['data']['umur_quote']) and $data['data']['umur_quote'] != ''){
				$umur_quote = implode("','",$data['data']['umur_quote']);
				//$select->where(new Expression($this->__('KATEGORI_UMUR_QUOTE')." in ('".$umur_quote."')"));
				
				if($where != ""){
					$where .= " AND KATEGORI_UMUR_QUOTE in('".$umur_quote."')";
				}else{
					$where .= " where  KATEGORI_UMUR_QUOTE in('".$umur_quote."')";
				}
			}
			
			if(isset($data['data']['umur_status_quote']) and $data['data']['umur_status_quote'] != ''){
				$umur_status_quote = implode("','",$data['data']['umur_status_quote']);
				//$select->where(new Expression($this->__('KATEGORI_UMUR_STATUS_QUOTE')." in ('".$umur_status_quote."')"));
				
				if($where != ""){
					$where .= " AND KATEGORI_UMUR_STATUS_QUOTE in('".$umur_status_quote."')";
				}else{
					$where .= " where  KATEGORI_UMUR_STATUS_QUOTE in('".$umur_status_quote."')";
				}
			}
			
			$sql = "SELECT DWH_SALES.M_NCX_QUOTE.STATUS_QUOTE AS STATUS_QUOTE, DWH_SALES.M_NCX_QUOTE.STATUS_ID AS STATUS_ID, sum(CASE WHEN DIVISI = 'DBS' THEN n_quote ELSE 0 END) AS DBS, sum(CASE WHEN DIVISI = 'DES' THEN n_quote ELSE 0 END) AS DCS, sum(CASE WHEN DIVISI = 'DGS' THEN n_quote ELSE 0 END) AS DGS FROM DWH_SALES.M_NCX_QUOTE $where GROUP BY STATUS_QUOTE, STATUS_ID ORDER BY STATUS_ID ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
	
	
	public function periode_create2($code = null, $guid = null, $param=array()) {
		$sql = "SELECT DWH_SALES.M_NCX_OGP.PERIODE_CREATE_YM as PERIODE_CREATE FROM DWH_SALES.M_NCX_OGP GROUP BY PERIODE_CREATE_YM ORDER BY PERIODE_CREATE_YM ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function order_type2($code = null, $guid = null, $param=array()) {
		$sql = "SELECT DWH_SALES.M_NCX_OGP.ORDER_TYPE FROM DWH_SALES.M_NCX_OGP GROUP BY ORDER_TYPE ORDER BY ORDER_TYPE ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function order_status2($code = null, $guid = null, $param=array()) {
		
		
		$sql = "SELECT DWH_SALES.M_NCX_OGP.ORDER_STATUS FROM DWH_SALES.M_NCX_OGP GROUP BY ORDER_STATUS ORDER BY ORDER_STATUS ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function divisi2($code = null, $guid = null, $param=array()) {
		
		$sql = "SELECT DWH_SALES.M_NCX_OGP.DIVISI  FROM DWH_SALES.M_NCX_OGP GROUP BY DIVISI ORDER BY DIVISI ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function segmen2($code = null, $guid = null, $param=array()) {
		
		$sql = "SELECT DWH_SALES.M_NCX_OGP.SEGMEN FROM DWH_SALES.M_NCX_OGP GROUP BY SEGMEN ORDER BY SEGMEN ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function am2($code = null, $guid = null, $param=array()) {
		
		
		$sql = "SELECT DWH_SALES.M_NCX_OGP.AM FROM DWH_SALES.M_NCX_OGP GROUP BY AM ORDER BY AM ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function minMax($code = null, $guid = null, $param=array()) {
		
		
		$sql = "SELECT
					max(PERIODE_CREATE_YMD) as MAX,
					min(PERIODE_CREATE_YMD) as MIN
				FROM
					DWH_SALES.M_NCX_OGP";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function order_trans($code = null, $guid = null, $param=array()) {
		
		
		$sql = "SELECT
					ORDER_TRANS
				FROM
					DWH_SALES.M_NCX_OGP
				GROUP BY ORDER_TRANS";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function vendorName($code = null, $guid = null, $param=array()) {
		
		
		$sql = "SELECT
					VENDOR_NAME
				FROM
					DWH_SALES.M_NCX_OGP
				GROUP BY VENDOR_NAME";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function updatedDate($code = null, $guid = null, $param=array()) {
		
		
		$sql = "select TO_CHAR(max(UPDATED_DATE), 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE from DWH_SALES.M_NCX_OGP order by UPDATED_DATE asc";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function status_quote2($code = null, $guid = null, $param=array()) {
		$sql = "SELECT DWH_SALES.m_ncx_quote.STATUS_QUOTE as STATUS_QUOTE FROM DWH_SALES.m_ncx_quote GROUP BY STATUS_QUOTE ORDER BY STATUS_QUOTE ASC";
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function detail($data=array()) {
		$where = "";
		$data['data'] = $data;
		if(isset($data['data']['periode_create']) and $data['data']['periode_create'] != ''){
			$periode = array();
			$periodex = explode("^_",$data['data']['periode_create']);
			
			foreach($periodex as $row){
				array_push($periode,date("Ym",strtotime("01 ".$row)));
			}
			$periode = implode("','",$periode);
			
			$where .= " WHERE PERIODE_CREATE_YM IN ('".$periode."')";
			
		}else{
			$where .= " WHERE PERIODE_CREATE_YMD >= '".date('Ymd',strtotime($data['data']['from']))."' AND PERIODE_CREATE_YMD < = '".date('Ymd',strtotime($data['data']['to']))."'";
		}
		
		if(isset($data['data']['order_type']) and $data['data']['order_type'] != ''){//ok //OK
			$order_type = str_replace('^_',"','",$data['data']['order_type']);
			if($where != ""){
				$where .= " AND ORDER_TYPE in('".$order_type."')";
			}else{
				$where .= " where ORDER_TYPE in('".$order_type."')";
			}
			
		}
		
		if(isset($data['data']['order_status']) and $data['data']['order_status'] != ''){//ok			
			$order_status = str_replace('^_',"','",$data['data']['order_status']);
			if($where != ""){
				$where .= " AND ORDER_STATUS in('".$order_status."')";
			}else{
				$where .= " where  ORDER_STATUS in('".$order_status."')";
			}
		}
		
		$div = "";
		$val = "";
		if($data['data']['f_'] == 3){
			$val = "0 - 7 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 4){
			$val = "7 - 15 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 5){
			$val = "> 15 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 6){
			$val = "";
			$div = 'DBS';
		}else if($data['data']['f_'] == 7){
			$val = "0 - 7 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 8){
			$val = "7 - 15 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 9){
			$val = "> 15 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 10){
			$val = "";
			$div = 'DES';
		}else if($data['data']['f_'] == 11){
			$val = "0 - 7 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 12){
			$val = "7 - 15 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 13){
			$val = "> 15 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 14){
			$val = "";
			$div = 'DGS';
		}
		
		
		if(isset($data['data']['f_']) and $data['data']['f_'] != '' and $val != ""){//umur order = systimestamp - created_date
			if($where != ""){
				$where .= " AND UMUR_ORDER = '".$val."'";
			}else{
				$where .= " where  UMUR_ORDER ='".$val."'";
			}

		}
		
		if(isset($data['data']['segmen']) and $data['data']['segmen'] != ''){
			$mile = str_replace('^_',"','",$data['data']['segmen']);
			if($where != ""){
				$where .= " AND SEGMEN IN ('".$mile."')";
			}else{
				$where .= " where  SEGMEN IN('".$mile."')";
			}
		}
		
		if($data['data']['f_'] >= 3){
			if($where != ""){
				$where .= " AND DIVISI = '".$div."'";
			}else{
				$where .= " where  DIVISI = '".$div."'";
			}
		}
		
		if(isset($data['data']['umur_status_order']) and $data['data']['umur_status_order'] != '' and $val != ""){//umur status order
			$umur_status_order = str_replace('^_',"','",$data['data']['umur_status_order']);
			if($where != ""){
				$where .= " AND UMUR_STATUS_ORDER IN ( '".$umur_status_order."')";
			}else{
				$where .= " where  UMUR_STATUS_ORDER IN ('".$umur_status_order."')";
			}

		}
		
		if(isset($data['data']['s_']) and $data['data']['s_'] != ''){//ok
			$mile = $data['data']['s_'];
			if($where != ""){
				$where .= " AND ORDER_SUBPROCESS = '".$mile."'";
			}else{
				$where .= " where  ORDER_SUBPROCESS ='".$mile."'";
			}
		}
		
		if(isset($data['data']['p_']) and $data['data']['p_'] != ''){
			
			if($data['data']['t_'] == 1){
				$mile = $data['data']['p_'];
				if($where != ""){
					$where .= " AND PROCESS = '".$mile."'";
				}else{
					$where .= " where  PROCESS ='".$mile."'";
				}
			}else if($data['data']['t_'] == 3){
				$mile = $data['data']['p_'];
				if($where != ""){
					$where .= " AND AM_NAME = '".$mile."'";
				}else{
					$where .= " where  AM_NAME = '".$mile."'";
				}
			}
		}
		
		if(isset($data['data']['order_trans']) and $data['data']['order_trans'] != ''){
			$mile = str_replace('^_',"','",$data['data']['order_trans']);
			if($where != ""){
				$where .= " AND ORDER_TRANS IN ('".$mile."')";
			}else{
				$where .= " where  ORDER_TRANS IN('".$mile."')";
			}
		}
		
		if(isset($data['data']['vendor_name']) and $data['data']['vendor_name'] != ''){//ok
			
			$umur_order = str_replace('^_',"','",$data['data']['vendor_name']);
			if($where != ""){
				$where .= " AND VENDOR_NAME in('".$umur_order."')";
			}else{
				$where .= " where  VENDOR_NAME in('".$umur_order."')";
			}
		}
		
		if(isset($data['data']['am']) and $data['data']['am'] != ''){//ok
			
			$umur_order = str_replace('^_',"','",$data['data']['am']);
			if($where != ""){
				$where .= " AND AM_NAME in('".$umur_order."')";
			}else{
				$where .= " where  AM_NAME in('".$umur_order."')";
			}
		}
		
		if($where != ""){
			$where .= " AND IS_USED = '1'";
		}else{
			$where .= " WHERE IS_USED = '1'";
		}
		
		$order = $data['data']['order'][0]['dir'];
		
		if(isset($data['data']['search']['value']) && $data['data']['search']['value'] != ''){
			$where .= " AND ORDER_ID = '".$data['data']['search']['value']."'";
		}
		
		$sql = "SELECT
					ORDER_ID
				FROM
					DWH_SALES.F_NCX_OGP_DETAIL $where group by ORDER_ID ORDER BY ORDER_ID $order";
		
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function total($data=array()) {
		$where = "";
		$data['data'] = $data;
		if(isset($data['data']['periode_create']) and $data['data']['periode_create'] != ''){
			$periode = array();
			$periodex = explode("^_",$data['data']['periode_create']);
			
			foreach($periodex as $row){
				array_push($periode,date("Ym",strtotime("01 ".$row)));
			}
			$periode = implode("','",$periode);
			
			$where .= " WHERE PERIODE_CREATE_YM IN ('".$periode."')";
			
		}else{
			$where .= " WHERE PERIODE_CREATE_YMD >= '".date('Ymd',strtotime($data['data']['from']))."' AND PERIODE_CREATE_YMD < = '".date('Ymd',strtotime($data['data']['to']))."'";
		}
		
		if(isset($data['data']['order_type']) and $data['data']['order_type'] != ''){//ok //OK
			$order_type = str_replace('^_',"','",$data['data']['order_type']);
			if($where != ""){
				$where .= " AND ORDER_TYPE in('".$order_type."')";
			}else{
				$where .= " where ORDER_TYPE in('".$order_type."')";
			}
			
		}
		
		if(isset($data['data']['order_status']) and $data['data']['order_status'] != ''){//ok			
			$order_status = str_replace('^_',"','",$data['data']['order_status']);
			if($where != ""){
				$where .= " AND ORDER_STATUS in('".$order_status."')";
			}else{
				$where .= " where  ORDER_STATUS in('".$order_status."')";
			}
		}
		
		$div = "";
		$val = "";
		if($data['data']['f_'] == 3){
			$val = "0 - 7 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 4){
			$val = "7 - 15 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 5){
			$val = "> 15 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 6){
			$val = "";
			$div = 'DBS';
		}else if($data['data']['f_'] == 7){
			$val = "0 - 7 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 8){
			$val = "7 - 15 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 9){
			$val = "> 15 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 10){
			$val = "";
			$div = 'DES';
		}else if($data['data']['f_'] == 11){
			$val = "0 - 7 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 12){
			$val = "7 - 15 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 13){
			$val = "> 15 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 14){
			$val = "";
			$div = 'DGS';
		}
		
		
		if(isset($data['data']['f_']) and $data['data']['f_'] != '' and $val != ""){//umur order = systimestamp - created_date
			if($where != ""){
				$where .= " AND UMUR_ORDER = '".$val."'";
			}else{
				$where .= " where  UMUR_ORDER ='".$val."'";
			}

		}
		
		if(isset($data['data']['segmen']) and $data['data']['segmen'] != ''){
			$mile = str_replace('^_',"','",$data['data']['segmen']);
			if($where != ""){
				$where .= " AND SEGMEN IN ('".$mile."')";
			}else{
				$where .= " where  SEGMEN IN('".$mile."')";
			}
		}
		
		if($data['data']['f_'] >= 3){
			if($where != ""){
				$where .= " AND DIVISI = '".$div."'";
			}else{
				$where .= " where  DIVISI = '".$div."'";
			}
		}
		
		if(isset($data['data']['umur_status_order']) and $data['data']['umur_status_order'] != '' and $val != ""){//umur status order
			$umur_status_order = str_replace('^_',"','",$data['data']['umur_status_order']);
			if($where != ""){
				$where .= " AND UMUR_STATUS_ORDER IN ( '".$umur_status_order."')";
			}else{
				$where .= " where  UMUR_STATUS_ORDER IN ('".$umur_status_order."')";
			}

		}
		
		if(isset($data['data']['s_']) and $data['data']['s_'] != ''){//ok
			$mile = $data['data']['s_'];
			if($where != ""){
				$where .= " AND ORDER_SUBPROCESS = '".$mile."'";
			}else{
				$where .= " where  ORDER_SUBPROCESS ='".$mile."'";
			}
		}
		
		if(isset($data['data']['p_']) and $data['data']['p_'] != ''){
			
			if($data['data']['t_'] == 1){
				$mile = $data['data']['p_'];
				if($where != ""){
					$where .= " AND PROCESS = '".$mile."'";
				}else{
					$where .= " where  PROCESS ='".$mile."'";
				}
			}else if($data['data']['t_'] == 3){
				$mile = $data['data']['p_'];
				if($where != ""){
					$where .= " AND AM_NAME = '".$mile."'";
				}else{
					$where .= " where  AM_NAME = '".$mile."'";
				}
			}
		}
		
		if(isset($data['data']['order_trans']) and $data['data']['order_trans'] != ''){
			$mile = str_replace('^_',"','",$data['data']['order_trans']);
			if($where != ""){
				$where .= " AND ORDER_TRANS IN ('".$mile."')";
			}else{
				$where .= " where  ORDER_TRANS IN('".$mile."')";
			}
		}
		
		if(isset($data['data']['vendor_name']) and $data['data']['vendor_name'] != ''){//ok
			
			$umur_order = str_replace('^_',"','",$data['data']['vendor_name']);
			if($where != ""){
				$where .= " AND VENDOR_NAME in('".$umur_order."')";
			}else{
				$where .= " where  VENDOR_NAME in('".$umur_order."')";
			}
		}
		
		if(isset($data['data']['am']) and $data['data']['am'] != ''){//ok
			
			$umur_order = str_replace('^_',"','",$data['data']['am']);
			if($where != ""){
				$where .= " AND AM_NAME in('".$umur_order."')";
			}else{
				$where .= " where  AM_NAME in('".$umur_order."')";
			}
		}
		
		if($where != ""){
			$where .= " AND IS_USED = '1'";
		}else{
			$where .= " WHERE IS_USED = '1'";
		}
		
		$order = $data['data']['order'][0]['dir'];
		
		if(isset($data['data']['search']['value']) && $data['data']['search']['value'] != ''){
			$where .= " AND ORDER_ID = '".$data['data']['search']['value']."'";
		}
		
		$sql = "select count(ORDER_ID) as total from (SELECT
					ORDER_ID
				FROM
					DWH_SALES.F_NCX_OGP_DETAIL $where group by ORDER_ID ORDER BY ORDER_ID $order)";
		//echo $sql;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function detailDownload($data=array(), $order_id = null, $type = null) {
		$where = "";
		$data['data'] = $data;
		if(isset($data['data']['periode_create']) and $data['data']['periode_create'] != ''){
			$periode = array();
			$periodex = explode("^_",$data['data']['periode_create']);
			
			foreach($periodex as $row){
				array_push($periode,date("Ym",strtotime("01 ".$row)));
			}
			$periode = implode("','",$periode);
			
			$where .= " WHERE PERIODE_CREATE_YM IN ('".$periode."')";
			
		}else{
			$where .= " WHERE PERIODE_CREATE_YMD >= '".date('Ymd',strtotime($data['data']['from']))."' AND PERIODE_CREATE_YMD < = '".date('Ymd',strtotime($data['data']['to']))."'";
		}
		
		if(isset($data['data']['order_type']) and $data['data']['order_type'] != ''){//ok //OK
			$order_type = str_replace('^_',"','",$data['data']['order_type']);
			if($where != ""){
				$where .= " AND ORDER_TYPE in('".$order_type."')";
			}else{
				$where .= " where ORDER_TYPE in('".$order_type."')";
			}
			
		}
		
		if(isset($data['data']['order_status']) and $data['data']['order_status'] != ''){//ok			
			$order_status = str_replace('^_',"','",$data['data']['order_status']);
			if($where != ""){
				$where .= " AND ORDER_STATUS in('".$order_status."')";
			}else{
				$where .= " where  ORDER_STATUS in('".$order_status."')";
			}
		}
		
		$div = "";
		$val = "";
		if($data['data']['f_'] == 3){
			$val = "0 - 7 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 4){
			$val = "7 - 15 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 5){
			$val = "> 15 Hari";
			$div = 'DBS';
		}else if($data['data']['f_'] == 6){
			$val = "";
			$div = 'DBS';
		}else if($data['data']['f_'] == 7){
			$val = "0 - 7 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 8){
			$val = "7 - 15 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 9){
			$val = "> 15 Hari";
			$div = 'DES';
		}else if($data['data']['f_'] == 10){
			$val = "";
			$div = 'DES';
		}else if($data['data']['f_'] == 11){
			$val = "0 - 7 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 12){
			$val = "7 - 15 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 13){
			$val = "> 15 Hari";
			$div = 'DGS';
		}else if($data['data']['f_'] == 14){
			$val = "";
			$div = 'DGS';
		}
		
		
		if(isset($data['data']['f_']) and $data['data']['f_'] != '' and $val != ""){//umur order = systimestamp - created_date
			if($where != ""){
				$where .= " AND UMUR_ORDER = '".$val."'";
			}else{
				$where .= " where  UMUR_ORDER ='".$val."'";
			}

		}
		
		if(isset($data['data']['segmen']) and $data['data']['segmen'] != ''){
			$mile = str_replace('^_',"','",$data['data']['segmen']);
			if($where != ""){
				$where .= " AND SEGMEN IN ('".$mile."')";
			}else{
				$where .= " where  SEGMEN IN('".$mile."')";
			}
		}
		
		if($data['data']['f_'] >= 3){
			if($where != ""){
				$where .= " AND DIVISI = '".$div."'";
			}else{
				$where .= " where  DIVISI = '".$div."'";
			}
		}
		
		if(isset($data['data']['umur_status_order']) and $data['data']['umur_status_order'] != '' and $val != ""){//umur status order
			$umur_status_order = str_replace('^_',"','",$data['data']['umur_status_order']);
			if($where != ""){
				$where .= " AND UMUR_STATUS_ORDER IN ( '".$umur_status_order."')";
			}else{
				$where .= " where  UMUR_STATUS_ORDER IN ('".$umur_status_order."')";
			}

		}
		
		if(isset($data['data']['s_']) and $data['data']['s_'] != ''){//ok
			$mile = $data['data']['s_'];
			if($where != ""){
				$where .= " AND ORDER_SUBPROCESS = '".$mile."'";
			}else{
				$where .= " where  ORDER_SUBPROCESS ='".$mile."'";
			}
		}
		
		if(isset($data['data']['p_']) and $data['data']['p_'] != ''){
			
			if($data['data']['t_'] == 1){
				$mile = $data['data']['p_'];
				if($where != ""){
					$where .= " AND PROCESS = '".$mile."'";
				}else{
					$where .= " where  PROCESS ='".$mile."'";
				}
			}else if($data['data']['t_'] == 3){
				$mile = $data['data']['p_'];
				if($where != ""){
					$where .= " AND AM_NAME = '".$mile."'";
				}else{
					$where .= " where  AM_NAME = '".$mile."'";
				}
			}
		}
		
		if(isset($data['data']['order_trans']) and $data['data']['order_trans'] != ''){
			$mile = str_replace('^_',"','",$data['data']['order_trans']);
			if($where != ""){
				$where .= " AND ORDER_TRANS IN ('".$mile."')";
			}else{
				$where .= " where  ORDER_TRANS IN('".$mile."')";
			}
		}
		
		if(isset($data['data']['vendor_name']) and $data['data']['vendor_name'] != ''){//ok
			
			$umur_order = str_replace('^_',"','",$data['data']['vendor_name']);
			if($where != ""){
				$where .= " AND VENDOR_NAME in('".$umur_order."')";
			}else{
				$where .= " where  VENDOR_NAME in('".$umur_order."')";
			}
		}
		
		if(isset($data['data']['am']) and $data['data']['am'] != ''){//ok
			
			$umur_order = str_replace('^_',"','",$data['data']['am']);
			if($where != ""){
				$where .= " AND AM_NAME in('".$umur_order."')";
			}else{
				$where .= " where  AM_NAME in('".$umur_order."')";
			}
		}
		
		if($where != ""){
			$where .= " AND IS_USED = '1'";
		}else{
			$where .= " WHERE IS_USED = '1'";
		}
		
		if($type == 'header'){
			$where .= " AND ORDER_ID = '".$order_id."' and ROWNUM = 1";
		}else if($type == 'detail'){
			$where .= " AND ORDER_ID = '".$order_id."'";
		}
		
		$sql = "SELECT
					ROWNUM,
					DWH_SALES.F_NCX_OGP_DETAIL.ORDER_ID,
					DWH_SALES.F_NCX_OGP_DETAIL.ORDER_CREATEDBY,
					DWH_SALES.F_NCX_OGP_DETAIL.ORDER_CREATEDBY_NAME,
					TO_CHAR(DWH_SALES.F_NCX_OGP_DETAIL.ORDER_CREATED_DATE, 'DD-MM-YYYY') as ORDER_CREATED_DATE,
					DWH_SALES.F_NCX_OGP_DETAIL.PRODUCTNAME,
					DWH_SALES.F_NCX_OGP_DETAIL.SERVICEADDRESS,
					DWH_SALES.F_NCX_OGP_DETAIL.PRODUCTTYPE,
					DWH_SALES.F_NCX_OGP_DETAIL.SPEED,
					DWH_SALES.F_NCX_OGP_DETAIL.CUSTACCNTNUM,
					DWH_SALES.F_NCX_OGP_DETAIL.CUSTACCNTNAME,
					DWH_SALES.F_NCX_OGP_DETAIL.CUST_REGION,
					DWH_SALES.F_NCX_OGP_DETAIL.WITEL_ALIAS,
					DWH_SALES.F_NCX_OGP_DETAIL.CUST_WITEL,
					DWH_SALES.F_NCX_OGP_DETAIL.CUST_SEGMEN,
					DWH_SALES.F_NCX_OGP_DETAIL.NIPNAS,
					DWH_SALES.F_NCX_OGP_DETAIL.BILLACCNTNUM,
					DWH_SALES.F_NCX_OGP_DETAIL.BILLACCNTNAME,
					DWH_SALES.F_NCX_OGP_DETAIL.ACCOUNTNAS,
					DWH_SALES.F_NCX_OGP_DETAIL.SERVICE_SEGMENT,
					DWH_SALES.F_NCX_OGP_DETAIL.SERVACCNTNAME,
					DWH_SALES.F_NCX_OGP_DETAIL.LI_MONTHLY_PRICE,
					DWH_SALES.F_NCX_OGP_DETAIL.LI_OTC_PRICE,
					DWH_SALES.F_NCX_OGP_DETAIL.LI_MANUAL_DISCOUNT,
					DWH_SALES.F_NCX_OGP_DETAIL.CURRENCY,
					DWH_SALES.F_NCX_OGP_DETAIL.HANDLINGTYPE,
					DWH_SALES.F_NCX_OGP_DETAIL.ORDER_STATUS,
					DWH_SALES.F_NCX_OGP_DETAIL.ORDER_SUBTYPE,
					DWH_SALES.F_NCX_OGP_DETAIL.LI_MILESTONE,
					DWH_SALES.F_NCX_OGP_DETAIL.LI_PRODUCTID,
					DWH_SALES.F_NCX_OGP_DETAIL.LI_PRODUCT_NAME,
					DWH_SALES.F_NCX_OGP_DETAIL.WONUM,
					DWH_SALES.F_NCX_OGP_DETAIL.WOCLASS,
					DWH_SALES.F_NCX_OGP_DETAIL.PARENT,
					DWH_SALES.F_NCX_OGP_DETAIL.WORKZONE,
					DWH_SALES.F_NCX_OGP_DETAIL.VENDOR_NAME,
					DWH_SALES.F_NCX_OGP_DETAIL.FULFLMNT_ITEM_CODE,
					DWH_SALES.F_NCX_OGP_DETAIL.BILLING_TYPE_CD,
					DWH_SALES.F_NCX_OGP_DETAIL.PRICE_TYPE_CD,
					DWH_SALES.F_NCX_OGP_DETAIL.STO_NAME
				FROM
					DWH_SALES.F_NCX_OGP_DETAIL $where ORDER BY ROWNUM, ORDER_ID, LI_PRODUCTID ";
		
		//echo $sql;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
        
	public function getHierarchy($data = array(), $config=array()) { //ok       
        try {
			$a = $data['VALUE'];
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN GET_CUSTOMER_HIERARCHY'.$config['server_prosedure'].'(:IN_CA, :OUT_STATUS, :OUT_MESS, :OUT_RESULT); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_CA",$a,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_RESULT", $cursor,-1,OCI_B_CURSOR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			oci_execute($cursor);
			
			if($pout_code == 0){
				return false;
			}
					
			// Use OCIFetchinto in the same way as you would with SELECT
			if ($stmt) {
				$i = 0;
				$res = array();
				while($temp = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)){
					array_push($res,$temp);
					$i++;
				}
				return $res;
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
        
	public function getDetailcabasa($data = array(), $config=array()) {//ok
		 try {
			 $a = $data['VALUE'];
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     
			//Request does not change
			$sql = 'BEGIN GET_DETAIL_CABASA'.$config['server_prosedure'].'(:IN_LOC, :OUT_STATUS, :OUT_MESS, :OUT_CUR_DET, :OUT_CUR_CONTACT, :OUT_CUR_ADDR); END;';
			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			$cursor = oci_new_cursor($conn);
			$cursor2 = oci_new_cursor($conn);
			$cursor3 = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_LOC",$a,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_CUR_DET", $cursor,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt,":OUT_CUR_CONTACT", $cursor2,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt,":OUT_CUR_ADDR", $cursor3,-1,OCI_B_CURSOR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			oci_execute($cursor);
			oci_execute($cursor2);
			oci_execute($cursor3);
			
			if($pout_code != 9){
				return false;
			}
			

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($stmt) {
				$i = 0;
				$res = array();
				$data = array();
				while($temp = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)){					
					array_push($res,$temp);
					$i++;
				}
				
				$temx1 = $res;
				
				while($temp = oci_fetch_array($cursor2, OCI_ASSOC+OCI_RETURN_NULLS)){
					array_push($res,$temp);
					$i++;
				}
				$temx2 = $res;
				
				while($temp = oci_fetch_array($cursor3, OCI_ASSOC+OCI_RETURN_NULLS)){
					array_push($res,$temp);
					$i++;
				}
				$temx3 = $res;
				
				$data = array(
					"DET" => $temx1,
					"CONTACT" => $temx2,
					"ADDR" => $temx3
				);
				
				return $data;
				
				
			}else{
				return false;
			}
		 } catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
        
	public function getDetailCustomer($data = array(), $config=array()) {//OK
		try 
		{
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN GET_DETAIL_CUSTOMER'.$config['server_prosedure'].'(:IN_CA, :OUT_STATUS, :OUT_MESS, :OUT_RESULT); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_CA",$data['IN_CA'],200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_RESULT", $cursor,-1,OCI_B_CURSOR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			oci_execute($cursor);

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($stmt) {
				$i = 0;
				$res = array();
				while($temp = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)){
					array_push($res,$temp);
					$i++;
				}
				return $res;
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
        
	public function getListCustomer($data = array(), $config=array()) {//ok
		try {
			$d = $data['FILTER'];//CA,BA,ACCOUNT_NAS,NIPNAS,NAME
			$a = $data['VALUE'];
			
			
			//echo $data['FILTER'];
			//echo $data['VALUE'];
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN LIST_CUSTOMER'.$config['server_prosedure'].'(:IN_FILTER_TYPE, :IN_VALUE, :OUT_STATUS, :OUT_MESS, :OUT_RESULT); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_FILTER_TYPE",$d,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_VALUE",$a,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_RESULT", $cursor,-1,OCI_B_CURSOR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			oci_execute($cursor);
			
			if($pout_code != 9){
				return false;
			}

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($stmt) {
				$i = 0;
				$res = array();
				while($temp = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)){
					array_push($res,$temp);
					$i++;
				}
				return $res;
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
        
	public function update($data = array(), $code_sess = null, $in_type = null, $in_file_name = null, $config=array()) {//ok
		try {
			$IN_LOC = $data['IN_LOC'];
			$IN_NAME = $data['IN_NAME'];
			$IN_CURRENCY = $data['IN_CURRENCY'];
			$IN_STATUS = $data['IN_STATUS'];
			$IN_BUSINESS_AREA = $data['IN_BUSINESS_AREA'];
			$IN_CUSTOMER_GROUP = $data['IN_CUSTOMER_GROUP'];
			$IN_ACCOUNT_NAS = $data['IN_ACCOUNT_NAS'];
			$IN_AFFILIATED_ID = $data['IN_AFFILIATED_ID'];
			$IN_BP_TYPE = $data['IN_BP_TYPE'];
			$IN_CLASSIFICATION = $data['IN_CLASSIFICATION'];
			$IN_PRICING_PROCEDURE = $data['IN_PRICING_PROCEDURE'];
			$IN_PPN = $data['IN_PPN'];
			$IN_REGION = $data['IN_REGION'];
			$IN_SEGMENT = $data['IN_SEGMENT'];
			$IN_SUB_SEGMENT = $data['IN_SUB_SEGMENT'];
			$IN_TAX_NUM = $data['IN_TAX_NUM'];
			$IN_VAT_CATEGORY = $data['IN_VAT_CATEGORY'];
			$IN_WITEL = $data['IN_WITEL'];
			$IN_NIPNAS = $data['IN_NIPNAS'];
			$IN_ACC_NUM = $data['IN_ACC_NUM'];
			$IN_USER = $code_sess;
			$IN_TYPE = $in_type;
			$IN_FILE_NAME = $in_file_name;
			$IN_REASON = $data['IN_REASON'];
			
			
			//echo $data['FILTER'];
			//echo $data['VALUE'];
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN UPDATE_CABASA'.$config['server_prosedure'].'(:IN_LOC, :IN_NAME, :IN_CURRENCY, :IN_STATUS, :IN_BUSINESS_AREA, :IN_CUSTOMER_GROUP, :IN_ACCOUNT_NAS, :IN_AFFILIATED_ID, :IN_BP_TYPE, :IN_CLASSIFICATION, :IN_PRICING_PROCEDURE, :IN_PPN, :IN_REGION, :IN_SEGMENT, :IN_SUB_SEGMENT, :IN_TAX_NUM, :IN_VAT_CATEGORY, :IN_WITEL, :IN_NIPNAS, :IN_ACC_NUM, :IN_USER, :IN_TYPE, :IN_FILE_NAME, :IN_CHANGE_REASON, :OUT_STATUS, :OUT_MESS); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			//$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_LOC",$IN_LOC,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_NAME",$IN_NAME,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CURRENCY",$IN_CURRENCY,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_STATUS",$IN_STATUS,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_BUSINESS_AREA",$IN_BUSINESS_AREA,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CUSTOMER_GROUP",$IN_CUSTOMER_GROUP,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_ACCOUNT_NAS",$IN_ACCOUNT_NAS,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_AFFILIATED_ID",$IN_AFFILIATED_ID,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_BP_TYPE",$IN_BP_TYPE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CLASSIFICATION",$IN_CLASSIFICATION,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_PRICING_PROCEDURE",$IN_PRICING_PROCEDURE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_PPN",$IN_PPN,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_REGION",$IN_REGION,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_SEGMENT",$IN_SEGMENT,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_SUB_SEGMENT",$IN_SUB_SEGMENT,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_TAX_NUM",$IN_TAX_NUM,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_VAT_CATEGORY",$IN_VAT_CATEGORY,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_WITEL",$IN_WITEL,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_NIPNAS",$IN_NIPNAS,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_ACC_NUM",$IN_ACC_NUM,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_USER",$IN_USER,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_TYPE",$IN_TYPE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_FILE_NAME",$IN_FILE_NAME,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CHANGE_REASON",$IN_REASON,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			//oci_execute($cursor);
			
			if($pout_code != 9){
				return false;
			}

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($pout_code == 9) {
				return "update success";
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
	
	public function update_log($param=array()) {
		try {
			$select = $this->select();
			$select->from($this->_tables['ncx_log']);
			$select->columns(array(
				'ID' => new Expression("max(ID)")
			));
			$id = $this->fetchRow($select);
			
			$param['ID'] = $id['ID'] + 1;
			$param['UPDATE_DATE'] = $this->now();
			
            $insert = $this->insert();
            $insert->into($this->_tables['ncx_log']);
			$insert->values($this->__($param));
			if ($id = $this->execute($insert)) {
				return $id;
			}
        } catch (\Exception $ex) {
            return false;
        }
	}
	
	public function tesQuery($param=array(), $config=array()) {
		$sql = "select * from ".$config['server_data']."s_org_ext".$config['server_update']." where loc = 'B0004849591'";
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function getListOrder($param=array(), $config=array()) {
		$where = "";
		if($param['sid'] != ''){
			$where = "and i.service_num = '".$param['sid']."'";
		}
		$sql = "select order_num, service_num, milestone_code, x.todo_cd, o.agree_id, /*X_BILL_START_DT*/
					ca.loc, ca.name ca,
					to_date(COMPLETED_DT + 7 / 24, 'dd-mm-yyyy') provisioning_dt, 
					to_date(x.x_bill_strt_dt + 7 / 24, 'dd-mm-yyyy') bill_dt, 
					to_date(x.x_baso_sign_dt + 7 / 24, 'dd-mm-yyyy') baso_dt, 
					to_date(x.x_integration_date + 7 / 24, 'dd-mm-yyyy') integration_dt,
					to_date(X_AGREE_START_DT + 7 / 24, 'dd-mm-yyyy') agree_start, 
					to_date(X_AGREE_END_DT + 7 / 24, 'dd-mm-yyyy') agree_end
				from ".$config['server_data']."s_order".$config['server_order']." o
				join ".$config['server_data']."s_order_item".$config['server_order']." i
					on i.order_id=o.row_id
				join ".$config['server_data']."s_org_ext".$config['server_order']." ca
					on ca.row_id = i.owner_account_id
				left join (select * from ".$config['server_data']."s_evt_act".$config['server_order']." a 
						where a.todo_cd = 'Get BASO'
						and a.last_upd = (select max(last_upd) from ".$config['server_data']."s_evt_act".$config['server_order']." where order_item_id=a.order_item_id and todo_cd = 'Get BASO')
						) x        
						on x.order_item_id = i.row_id
						and x.todo_cd = 'Get BASO'
				where o.order_num='".$param['order_id']."' 
				$where
				  and o.rev_num = (select max(rev_num) from ".$config['server_data']."s_order".$config['server_order']." x 
									where x.order_num = o.order_num
										and x.status_cd not in ('Abandoned','x'))
										and rownum = 1
				order by todo_cd
				";
		
		//echo $sql;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function orderBefore($param=array(), $config=array()) {
		$where = "";
		if(!empty($param['sid'])){
			$where = "and i.service_num = '".$param['data1']['sid']."'";
		}
		
		$sql = "select order_num, service_num, milestone_code, x.todo_cd, o.agree_id, /*X_BILL_START_DT*/
					ca.loc, ca.name ca,
					to_date(COMPLETED_DT + 7 / 24, 'dd-mm-yyyy') provisioning_dt, 
					to_date(x.x_bill_strt_dt + 7 / 24, 'dd-mm-yyyy') bill_dt, 
					to_date(x.x_baso_sign_dt + 7 / 24, 'dd-mm-yyyy') baso_dt, 
					to_date(x.x_integration_date + 7 / 24, 'dd-mm-yyyy') integration_dt,
					to_date(X_AGREE_START_DT + 7 / 24, 'dd-mm-yyyy') agree_start, 
					to_date(X_AGREE_END_DT + 7 / 24, 'dd-mm-yyyy') agree_end
				from ".$config['server_data']."s_order".$config['server_order']." o
				join ".$config['server_data']."s_order_item".$config['server_order']." i
					on i.order_id=o.row_id
				join ".$config['server_data']."s_org_ext".$config['server_order']." ca
					on ca.row_id = i.owner_account_id
				left join (select * from ".$config['server_data']."s_evt_act".$config['server_order']." a 
						where a.todo_cd = 'Get BASO'
						and a.last_upd = (select max(last_upd) from ".$config['server_data']."s_evt_act".$config['server_order']." where order_item_id=a.order_item_id and todo_cd = 'Get BASO')
						) x        
						on x.order_item_id = i.row_id
						and x.todo_cd = 'Get BASO'
				where o.order_num='".$param['data1']['order_id']."' 
				$where
				  and o.rev_num = (select max(rev_num) from ".$config['server_data']."s_order".$config['server_order']." x 
									where x.order_num = o.order_num
										and x.status_cd not in ('Abandoned','x'))
										and rownum = 1
				order by todo_cd
				";
		
		//echo $sql;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function dateAct($data=array(), $config=array()) {
		$set = "set last_upd = sysdate -7/24";
		if(!empty($data['data1']['bill_order'])){
			$set .= ", a.x_bill_strt_dt = to_date('".str_replace('-','/',$data['data1']['bill_order'])."','dd/mm/yyyy')-7/24";
		}
		
		if(!empty($data['data1']['baso_order'])){
			$set .= ", a.x_baso_sign_dt = to_date('".str_replace('-','/',$data['data1']['baso_order'])."','dd/mm/yyyy')-7/24";
		}
		
		if(!empty($data['data1']['integration_order'])){
			$set .= ", a.x_integration_date = to_date('".str_replace('-','/',$data['data1']['integration_order'])."','dd/mm/yyyy')-7/24";
		}
		
		/* $where = "";
		if($data['data1']['sid']){
			$where .= " and i.service_num = '".$data['data1']['sid']."'";
		} */
		
		$sql = "update ".$config['server_order']."s_evt_act".$config['server_update']." a
        $set
        WHERE
          1 = 1
        AND A .last_upd = (
          SELECT
            MAX (last_upd)
          FROM
            ".$config['server_order']."s_evt_act".$config['server_order']."
          WHERE
            order_item_id = A .order_item_id
          AND todo_cd = 'Get BASO'
        )
        AND todo_cd = 'Get BASO'
        AND evt_stat_cd IS NULL
        AND order_item_id IN (
          SELECT
            row_id
          FROM
            ".$config['server_order']."s_order_item".$config['server_order']." a2
          WHERE
            1 = 1
          AND a2.status_cd || '-' || a2.milestone_code = (
            CASE (
              SELECT
                AT .attrib_05
              FROM
                ".$config['server_order']."s_order_x".$config['server_order']." AT
              JOIN ".$config['server_order']."s_order".$config['server_order']." ot ON ot.row_id = AT .par_row_id
              WHERE
                AT .row_id = a2.order_id
            )
            WHEN 'Modify BA' THEN
              'Pending' || '-' || a2.milestone_code
            WHEN 'Modify Price' THEN
              'Pending' || '-' || a2.milestone_code
            WHEN 'Renewal Agreement' THEN
              'Pending' || '-' || a2.milestone_code
            ELSE
              'Pending BASO-BASO STARTED'
            END
          )
          AND service_num = '".$data['data1']['sid']."'
          AND order_id = (
            SELECT
              row_id
            FROM
              ".$config['server_order']."s_order".$config['server_order']." A
            WHERE
              A .order_num = '".$data['data1']['order_id']."'
            AND A .status_cd != 'Complete'
            AND A .rev_num = (
              SELECT
                MAX (rev_num)
              FROM
                ".$config['server_order']."s_order".$config['server_order']." x
              WHERE
                x.order_num = A .order_num
              AND x.active_flg = 'Y'
              AND x.status_cd NOT IN (
                'Abandoned',
                'x',
                'Cancelled',
                'Pending Cancel'
              )
            )
          )
        )";
		//echo $sql;exit;
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
			return ($result);
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function dateOrder($data=array(), $config=array()) {
		$set = "set last_upd = sysdate -7/24";
		$complete_dt ="";
		$agree_start ="";
		$agree_end ="";
		if(!empty($data['data1']['bill_order'])){
			$set .= ", x_bill_start_dt = to_date('".str_replace('-','/',$data['data1']['bill_order'])."','dd/mm/yyyy')-7/24";
		}
		
		if(!empty($data['data1']['provisioning_order'])){
			//$set .= ", COMPLETED_DT = to_date('".str_replace('-','/',$data['data1']['provisioning_order'])."','dd/mm/yyyy')-7/24";
			$complete_dt = ", COMPLETED_DT = CASE
			WHEN COMPLETED_DT IS NULL THEN
				NULL
			ELSE
				to_date ('".str_replace('-','/',$data['data1']['provisioning_order'])."', 'dd/mm/yyyy') - 7 / 24
			END";
		}
		
		if(!empty($data['data1']['agree_start_order'])){
			//$set .= ", COMPLETED_DT = to_date('".str_replace('-','/',$data['data1']['provisioning_order'])."','dd/mm/yyyy')-7/24";
			$agree_start = ", X_AGREE_START_DT = to_date ('".str_replace('-','/',$data['data1']['agree_start_order'])."', 'dd/mm/yyyy') - 7 / 24";
			
		}
		
		if(!empty($data['data1']['agree_end_order'])){
			//$set .= ", COMPLETED_DT = to_date('".str_replace('-','/',$data['data1']['provisioning_order'])."','dd/mm/yyyy')-7/24";
			$agree_end = ", X_AGREE_END_DT = to_date (
					'".str_replace('-','/',$data['data1']['agree_end_order'])." 23:59:59',
					'dd/mm/yyyy hh24:mi:ss'
				) - 7 / 24";
		}
		
		
		
		$where = "";
		
		$sql = "update ".$config['server_data']."s_order_item".$config['server_update']." a  
					$set
				$complete_dt 
				$agree_start
				$agree_end
				WHERE
					1 = 1
				AND a.status_cd || '-' || a.milestone_code = (
					CASE (
						SELECT
							AT .attrib_05
						FROM
							".$config['server_data']."s_order_x".$config['server_order']." AT
						JOIN ".$config['server_data']."s_order".$config['server_order']." ot ON ot.row_id = AT .par_row_id
						WHERE
							AT .row_id = a.order_id
					)
					WHEN 'Modify BA' THEN
						'Pending' || '-' || a.milestone_code
					WHEN 'Modify Price' THEN
						'Pending' || '-' || a.milestone_code
					WHEN 'Renewal Agreement' THEN
						'Pending' || '-' || a.milestone_code
					ELSE
						'Pending BASO-BASO STARTED'
					END
				)
				AND service_num = '".$data['data1']['sid']."'
				AND order_id = (
					SELECT
						row_id
					FROM
						".$config['server_data']."s_order".$config['server_order']." a
					WHERE
						order_num = '".$data['data1']['order_id']."'
					AND a.status_cd != 'Complete'
					AND a.rev_num = (
						SELECT
							max(rev_num)
						FROM
							".$config['server_data']."s_order".$config['server_order']." x
						WHERE
							x.order_num = a.order_num
						AND x.active_flg = 'Y'
						AND x.status_cd NOT IN (
							'Abandoned',
							'x',
							'Cancelled',
							'Pending Cancel'
						)
					)
				)";
		
		//echo $sql;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
			return ($result);
        } catch (\Exception $e) {
			echo "masuk false";
            return false;
			
			
        }
        return false; 
	}
	
	public function dateKontrakItem($data=array()) {
        return false;
	}
	
	public function dateKontrakAgree($data=array(), $config=array()) {
		$set = "set last_upd = sysdate -7/24";
		if(!empty($data['data1']['agree_start_order'])){
			$set .= ", x.EFF_START_DT = to_date('".str_replace('-','/',$data['data1']['agree_start_order'])."','dd/mm/yyyy')-7/24";
		}
		
		if(!empty($data['data1']['agree_end_order'])){
			$set .= ", x.EFF_END_DT = to_date('".str_replace('-','/',$data['data1']['agree_end_order'])."','dd/mm/yyyy')-7/24";
		}
		
		$sql = "update ".$config['server_data']."s_doc_agree".$config['server_update']." x
				$set
				WHERE
				row_id = (
					SELECT
						agree_id
					FROM
						".$config['server_data']."s_order".$config['server_order']." A
					WHERE
						order_num = '".$data['data1']['order_id']."'
					AND A .rev_num = (
						SELECT
							MAX (rev_num)
						FROM
							".$config['server_data']."s_order".$config['server_order']." x
						WHERE
							x.order_num = A .order_num
						AND x.active_flg = 'Y'
						AND x.status_cd NOT IN (
							'Abandoned',
							'x',
							'Cancelled',
							'Pending Cancel'
						)
					)
				)";
		
		//echo $sql;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
			return ($result);
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getListTermin($param=array(), $config=array()) {
		$where = "";
		if($param['order_id'] != ''){
			$where .= " and o.order_num = '".$param['order_id']."'";
		}
		
		
		if($param['no_asset'] != ''){
			$where .= " and a.asset_num = '".$param['no_asset']."'";
		}
		
		if(!empty($param['sequence'])){
			$where .= " and t.cx_sequence = '".$param['sequence']."'";
		}
		
		$sql = "select cx_sequence, to_date(cx_otc_eff_date + 7 / 24, 'dd-mm-yyyy') termin_billdate,
					i.milestone_code, ca.loc, ca.name ca
				from ".$config['server_data']."CX_SB_TERMIN".$config['server_termin']." t
				join ".$config['server_data']."s_Asset".$config['server_termin']." a
					on a.row_id = t.CX_PAR_ASSET_ID
				join ".$config['server_data']."s_order_item".$config['server_termin']." i
					on i.service_num = a.serial_num
					and i.par_order_item_id is null
				join ".$config['server_data']."s_order".$config['server_termin']." o
					on o.row_id = i.order_id
				join ".$config['server_data']."s_org_ext".$config['server_termin']." ca
					on ca.row_id = i.owner_account_id
				where (cx_int_status is null or upper(cx_int_status) = 'ERROR')
				--and a.asset_num = '1-213546634'--
				--and o.order_num = '1-212978652'--
				$where
				and o.rev_num = (select max(rev_num) from ".$config['server_data']."s_order".$config['server_termin']." x 
									where x.order_num = o.order_num
										and x.status_cd not in ('Abandoned','x'))
				order by cx_sequence";
		
		//echo $sql;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function updateTermin($param=array(), $key = null, $in_file_name = null, $in_type = null, $config=array()) {
		
		//print_r($param);die();

		$sql = "update ".$config['server_data']."CX_SB_TERMIN".$config['server_update']."
				set last_upd=sysdate -7/24, cx_otc_eff_date = to_date('".str_replace('-','/',$param['termin_date'])." 23:59:59','dd/mm/yyyy hh24:mi:ss') - 7 / 24 
				where CX_PAR_ASSET_ID=(select row_id from ".$config['server_data']."s_Asset".$config['server_termin']." where asset_num = '".$key."') 
				and CX_SEQUENCE='".$param['sequence']."'";
		
		//echo $sql;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            /* $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray(); */
			return ($result);
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}



	public function getListCA($data = null, $config=array()){
		try 
		{
			//print_r($data);die();
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN LIST_PARENT_ACCOUNT'.$config['server_prosedure'].'(:IN_NAME, :OUT_LIST_PARENT_ACC, :OUT_STATUS, :OUT_MESS); END;';            
			//$a = 'a';
			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_NAME",$data,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_LIST_PARENT_ACC", $cursor,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_status,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS",  $pout_mess,200,SQLT_CHR);
			

			// Execute the statement as in your first try

			oci_execute($stmt);

			// and now, execute the cursor
			oci_execute($cursor);
			//print_r($cursor);die();
			// Use OCIFetchinto in the same way as you would with SELECT
			if ($stmt) {
				$i = 0;
				$res = array();
				while($temp = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)){
					array_push($res,$temp);
					$i++;
				}
				return $res;
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;

	}


	public function saveMove($data = array(), $code_sess = null, $in_file_name = null, $in_type = null, $config=array()){
		try 
		{
			//print_r($data);die();
			$ba_source = str_replace(' ', '', $data['ba_source']);
			$ca_source =  str_replace(' ', '', $data['ca_source']);
			if(isset($data['status'])){
				$ca_target =  str_replace(' ', '', $data['ca_target']);
				$nipnas_target = str_replace(' ', '', $data['nipnas']);
				
			}else{
				$target = explode("~",$data['target']);
				$ca_target = str_replace(' ', '', $target[2]);
				$nipnas_target = str_replace(' ', '', $target[1]);
			}
			$type = $in_type;
			$file_name = $in_file_name;
			$user = $code_sess;
			
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN MOVE_BA_TO_OTHERS_CA'.$config['server_prosedure'].'(:IN_BA_SOURCE, :IN_CA_SOURCE, :IN_CA_TARGET, :IN_NIPNAS_TARGET, :IN_USER,:IN_TYPE, :IN_FILE_NAME, :OUT_STATUS, :OUT_MESSAGE ); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			oci_bind_by_name($stmt,":IN_BA_SOURCE",$ba_source,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CA_SOURCE",$ca_source,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CA_TARGET",$ca_target,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_NIPNAS_TARGET",$nipnas_target,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_USER",$user,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_TYPE",$type,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_FILE_NAME",$file_name,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESSAGE",  $pout_mess,200,SQLT_CHR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			//print($pout_code);die();

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($pout_code == 9) {
				return "update success";
			}else{
				return false;
			}

		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
	
	public function sendUpdate($data = array(), $code_sess = null, $in_type = null ,$in_file_name = null, $config=array()) {//ok
		try {
			$IN_LOC = $data['IN_LOC'];
			$IN_NAME = $data['IN_NAME'];
			$IN_CURRENCY = '';
			$IN_STATUS = '';
			$IN_BUSINESS_AREA = '';
			$IN_CUSTOMER_GROUP = '';
			$IN_ACCOUNT_NAS = $data['IN_ACCOUNT_NAS'];
			$IN_AFFILIATED_ID = '';
			$IN_BP_TYPE = '';
			$IN_CLASSIFICATION = '';
			$IN_PRICING_PROCEDURE = '';
			$IN_PPN = '';
			$IN_REGION = '';
			$IN_SEGMENT = '';
			$IN_SUB_SEGMENT = '';
			$IN_TAX_NUM = '';
			$IN_VAT_CATEGORY = '';
			$IN_WITEL = '';
			$IN_NIPNAS = $data['IN_NIPNAS'];
			$IN_ACC_NUM = '';
			$IN_USER = $data['IN_USER'];
			$IN_TYPE = $in_type;
			$IN_FILE_NAME = $in_file_name;
			$IN_REASON = "upload";
			
			
			//echo $data['FILTER'];
			//echo $data['VALUE'];
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN UPDATE_CABASA'.$config['server_prosedure'].'(:IN_LOC, :IN_NAME, :IN_CURRENCY, :IN_STATUS, :IN_BUSINESS_AREA, :IN_CUSTOMER_GROUP, :IN_ACCOUNT_NAS, :IN_AFFILIATED_ID, :IN_BP_TYPE, :IN_CLASSIFICATION, :IN_PRICING_PROCEDURE, :IN_PPN, :IN_REGION, :IN_SEGMENT, :IN_SUB_SEGMENT, :IN_TAX_NUM, :IN_VAT_CATEGORY, :IN_WITEL, :IN_NIPNAS, :IN_ACC_NUM, :IN_USER, :IN_TYPE, :IN_FILE_NAME, :IN_CHANGE_REASON, :OUT_STATUS, :OUT_MESS); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			//$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_LOC",$IN_LOC,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_NAME",$IN_NAME,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CURRENCY",$IN_CURRENCY,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_STATUS",$IN_STATUS,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_BUSINESS_AREA",$IN_BUSINESS_AREA,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CUSTOMER_GROUP",$IN_CUSTOMER_GROUP,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_ACCOUNT_NAS",$IN_ACCOUNT_NAS,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_AFFILIATED_ID",$IN_AFFILIATED_ID,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_BP_TYPE",$IN_BP_TYPE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CLASSIFICATION",$IN_CLASSIFICATION,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_PRICING_PROCEDURE",$IN_PRICING_PROCEDURE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_PPN",$IN_PPN,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_REGION",$IN_REGION,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_SEGMENT",$IN_SEGMENT,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_SUB_SEGMENT",$IN_SUB_SEGMENT,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_TAX_NUM",$IN_TAX_NUM,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_VAT_CATEGORY",$IN_VAT_CATEGORY,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_WITEL",$IN_WITEL,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_NIPNAS",$IN_NIPNAS,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_ACC_NUM",$IN_ACC_NUM,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_USER",$IN_USER,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_TYPE",$IN_TYPE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_FILE_NAME",$IN_FILE_NAME,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_CHANGE_REASON",$IN_REASON,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			//oci_execute($cursor);
			
			if($pout_code != 9){
				return false;
			}

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($pout_code == 9) {
				return "update success";
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
	
	public function insertLog($data = array(), $code = null, $in_file_name = null, $in_type = null, $mess = null, $sts=0, $dateBefore = null, $config=array()) {
		try {
			
			$select = $this->select()->columns(array('ID' => $this->expression('TLK_LOGS_ID_SEQ'.$config['server_table'].'.NEXTVAL')))->from('DUAL');
			$id = $this->fetchRow($select);
			
			$id_log = $id['ID'];
			
			$source = 'NCX_DEV';
			if($config['server_prosedure'] == '_PROD'){
				$source = 'NCX_PROD';
			}

			$param = array(
							'LOGS_ID' => $id_log,
							'USERS' => $code,
							'D_DATE' => $this->now(),
							'TYP' => $in_type,
							'LOC' => "ORDER_ID:".$data['data1']['order_id'].";SID:".$data['data1']['sid'],
							'VALUE' => "bill_order:".$data['data1']['bill_order'].";baso_order:".$data['data1']['baso_order'].";integration_order:".$data['data1']['integration_order'].";provisioning:".$data['data1']['provisioning_order'].";agree_start_order:".$data['data1']['agree_start_order'].";agree_end_order:".$data['data1']['agree_end_order'],
							'STATUS' => $sts,
							'MESSAGE' => $mess,
							'FILE_NAME' => $in_file_name,
							'PACK_PROC' => "UPDATE_TANGGAL_ORDER",
						);
			
			$param2 = array(
							'LOGS_ID' => $id_log,
							'LOGS_USER' => $code,
							'LOGS_TIMESTAMP' => $this->now(),
							'LOGS_REF_TABLE' => "s_evt_act,s_order_item,s_doc_agree",
							'LOGS_REF_COLUMN' => "ORDER_ID:".$data['data1']['order_id'].";SID:".$data['data1']['sid'],
							'LOGS_REF_COLUMNVALUE' => "bill:".$data['data1']['bill_order'].";baso:".$data['data1']['baso_order'].";integ:".$data['data1']['integration_order'].";prov:".$data['data1']['provisioning_order'].";start:".$data['data1']['agree_start_order'].";end:".$data['data1']['agree_end_order'],
							'LOGS_REF_TYPE' => "UPDATE",
							'LOGS_REF_LABEL' => "UPDATE_TANGGAL_ORDER",
							'LOGS_MSG' => "before=".$dateBefore."|After=bill:".$data['data1']['bill_order'].";baso:".$data['data1']['baso_order'].";integ:".$data['data1']['integration_order'].";prov:".$data['data1']['provisioning_order'].";start:".$data['data1']['agree_start_order'].";end:".$data['data1']['agree_end_order'],
						);
			
			
            $insert = $this->insert();
            $insert->into($this->_tables['LOG_INPUT']);
			$insert->values($this->__($param));
			
			
            $insert2 = $this->insert();
            $insert2->into($this->_tables['LOGS']);
			$insert2->values($this->__($param2));
			
			
			if ($id = $this->execute($insert)) {
				$this->execute($insert2);
				
				return $id;
			}
        } catch (\Exception $ex) {
            return false;
        }
	}
	
	public function insertLogTermin($data = array(), $code = null, $in_file_name = null, $in_type = null, $mess = null, $sts, $dataBefore = null, $config=array()) {
		try {
			$select = $this->select()->columns(array('ID' => $this->expression('TLK_LOGS_ID_SEQ'.$config['server_table'].'.NEXTVAL')))->from('DUAL');
			$id = $this->fetchRow($select);
			
			$id_log = $id['ID'];
			
			$source = 'NCX_DEV';
			if($config['server_prosedure'] == '_PROD'){
				$source = 'NCX_PROD';
			}

			$param = array(
							'LOGS_ID' => $id_log,
							'USERS' => $code,
							'D_DATE' => $this->now(),
							'TYP' => $in_type,
							'LOC' => "ORDER_ID:".$data['order_id'].";no_asset:".$data['no_asset'],
							'VALUE' => "ORDER_ID:".$data['order_id'].";no_asset:".$data['no_asset'].";sequence:".$data['sequence'].";termin_date:".$data['termin_date'],
							'STATUS' => $sts,
							'MESSAGE' => $mess,
							'FILE_NAME' => $in_file_name,
							'PACK_PROC' => "UPDATE_TANGGAL_TERMIN",
						);
			
			$param2 = array(
							'LOGS_ID' => $id_log,
							'LOGS_USER' => $code,
							'LOGS_TIMESTAMP' => $this->now(),
							'LOGS_REF_TABLE' => "CX_SB_TERMIN",
							'LOGS_REF_COLUMN' => "ORDER_ID:".$data['order_id'].";no_asset:".$data['no_asset'],
							'LOGS_REF_COLUMNVALUE' => "sequence:".$data['sequence'].";termin_date:".$data['termin_date'],
							'LOGS_REF_TYPE' => "UPDATE",
							'LOGS_REF_LABEL' => "UPDATE_TANGGAL_TERMIN",
							'LOGS_MSG' => "Before=".$dataBefore."|After=sequence:".$data['sequence'].";termin_date:".$data['termin_date'],
						);
			
			
            $insert = $this->insert();
            $insert->into($this->_tables['LOG_INPUT']);
			$insert->values($this->__($param));
			
			
            $insert2 = $this->insert();
            $insert2->into($this->_tables['LOGS']);
			$insert2->values($this->__($param2));
			
			
			if ($id = $this->execute($insert)) {
				$this->execute($insert2);
				
				return $id;
			}
        } catch (\Exception $ex) {
            return false;
        }
	}
	
	public function mergesave($data = array(), $code_sess = null, $in_type = null ,$in_file_name = null, $config=array()) {//ok
		try {
			$IN_LOC_BA_OLD = $data['IN_LOC_BA_OLD'];
			$IN_LOC_BA_NEW = $data['IN_LOC_BA_NEW'];
			$IN_NEW_ACCNAS = $data['IN_NEW_ACCNAS'];
			$IN_USER = $code_sess;
			$IN_TYPE = $in_type;
			$IN_FILE_NAME = $in_file_name;
			
			if($data['IN_NEW_ACCNAS'] == 'lain'){
				$IN_NEW_ACCNAS = $data['ACCNAS_LAIN'];
			}
			
			//echo $data['FILTER'];
			//echo $data['VALUE'];
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN MERGE_BA'.$config['server_prosedure'].'(:IN_LOC_BA_OLD, :IN_LOC_BA_NEW, :IN_NEW_ACCNAS, :IN_USER, :IN_TYPE, :IN_FILE_NAME, :OUT_STATUS, :OUT_MESS); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			//$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_LOC_BA_OLD",$IN_LOC_BA_OLD,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_LOC_BA_NEW",$IN_LOC_BA_NEW,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_NEW_ACCNAS",$IN_NEW_ACCNAS,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_USER",$IN_USER,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_TYPE",$IN_TYPE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_FILE_NAME",$IN_FILE_NAME,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			//oci_execute($cursor);
			
			if($pout_code != 9){
				return false;
			}

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($pout_code == 9) {
				return "Merge success";
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}



	public function getInboxLog($data, $config=array()) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		if(!empty($data['search']['value'])){
			$where .= " where (NAF_LOG_INPUT".$config['server_table'].".PACK_PROC like '%".$search."%' or NAF_LOG_INPUT".$config['server_table'].".VALUE like '%".$search."%' or NAF_LOG".$config['server_table'].".LOGS_MSG like '%".$search."%')";
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " ORDER BY NAF_LOG_INPUT".$config['server_table'].".LOGS_ID ".$data['order'][0]['dir']."";
		}else{
			$order = " ORDER BY NAF_LOG_INPUT".$config['server_table'].".LOGS_ID DESC";
		}
		
		
		
		$sql = "SELECT TO_CHAR(NAF_LOG_INPUT".$config['server_table'].".D_DATE, 'YYYY-mm-dd HH24:mi:ss') as LOGS_TIMESTAMP, NAF_LOG_INPUT".$config['server_table'].".LOGS_ID as ID, NAF_LOG".$config['server_table'].".LOGS_REF_LABEL as LABEL,  NAF_LOG".$config['server_table'].".LOGS_MSG as MESSAGE, NAF_LOG".$config['server_table'].".FLAG_STATUS as STATUS, NAF_LOG_INPUT".$config['server_table'].".STATUS as STATUS_EXT, NAF_LOG_INPUT".$config['server_table'].".D_DATE as DATE_LOG, NAF_LOG_INPUT".$config['server_table'].".FILE_NAME as FILE_NAME, NAF_LOG_INPUT".$config['server_table'].".VALUE as LOG_VALUE, NAF_LOG_INPUT".$config['server_table'].".PACK_PROC as PACK_PROC, NAF_LOG_INPUT".$config['server_table'].".LOC as LOC_INPUT, NAF_LOG_INPUT".$config['server_table'].".TYP as TYPE, NAF_LOG_INPUT".$config['server_table'].".USERS as USERS FROM NAF_LOG_INPUT".$config['server_table']." LEFT JOIN NAF_LOG".$config['server_table']." ON NAF_LOG".$config['server_table'].".LOGS_ID = NAF_LOG_INPUT".$config['server_table'].".LOGS_ID $where $order";
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM RNUM
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getInboxLogCount($data, $config=array()) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		if(!empty($data['search']['value'])){
			$where .= " where (NAF_LOG_INPUT".$config['server_table'].".PACK_PROC like '%".$search."%' or NAF_LOG_INPUT".$config['server_table'].".VALUE like '%".$search."%' or NAF_LOG".$config['server_table'].".LOGS_MSG like '%".$search."%')";
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " ORDER BY NAF_LOG_INPUT".$config['server_table'].".LOGS_ID ".$data['order'][0]['dir']."";
		}else{
			$order = " ORDER BY NAF_LOG_INPUT".$config['server_table'].".LOGS_ID DESC";
		}
		
		$sql = "SELECT count(NAF_LOG_INPUT".$config['server_table'].".LOGS_ID) as total FROM NAF_LOG_INPUT".$config['server_table']." LEFT JOIN NAF_LOG".$config['server_table']." ON NAF_LOG".$config['server_table'].".LOGS_ID = NAF_LOG_INPUT".$config['server_table'].".LOGS_ID $where $order";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			//print_r($rows);exit;
            //if (is_array($rows)) return array_change_key_case(reset($rows));
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function setComplete($id = null, $config=array()) {
		if(!empty($id)){
			$sql = "update NAF_LOG".$config['server_table']." set FLAG_STATUS = '1' where LOGS_ID = '".$id."'";
		}
		
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            /* $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray(); */
			return ($result);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getDataLog($id = null, $config=array()) {
		$sql = "SELECT TO_CHAR(NAF_LOG_INPUT".$config['server_table'].".D_DATE, 'YYYY-mm-dd HH24:mi:ss') as LOGS_TIMESTAMP, NAF_LOG_INPUT".$config['server_table'].".LOGS_ID as ID, NAF_LOG".$config['server_table'].".LOGS_REF_LABEL as LABEL,  NAF_LOG".$config['server_table'].".LOGS_MSG as MESSAGE, NAF_LOG".$config['server_table'].".FLAG_STATUS as STATUS, NAF_LOG_INPUT".$config['server_table'].".STATUS as STATUS_EXT, NAF_LOG_INPUT".$config['server_table'].".D_DATE as DATE_LOG, NAF_LOG_INPUT".$config['server_table'].".FILE_NAME as FILE_NAME, NAF_LOG_INPUT".$config['server_table'].".VALUE as LOG_VALUE, NAF_LOG_INPUT".$config['server_table'].".PACK_PROC as PACK_PROC, NAF_LOG_INPUT".$config['server_table'].".LOC as LOC_INPUT, NAF_LOG_INPUT".$config['server_table'].".TYP as TYPE, NAF_LOG_INPUT".$config['server_table'].".USERS as USERS FROM NAF_LOG_INPUT".$config['server_table']." LEFT JOIN NAF_LOG".$config['server_table']." ON NAF_LOG".$config['server_table'].".LOGS_ID = NAF_LOG_INPUT".$config['server_table'].".LOGS_ID where NAF_LOG".$config['server_table'].".LOGS_ID = '".$id."'";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getTotalRecon() {
		$sql = "SELECT
					COUNT (NCX_LAST_UPDATE) AS total,
					SUM(CASE WHEN STATUS = 'VALID' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN STATUS = 'NOT VALID' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_caba_ncx_tibs";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getReconDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (NCX_BA like '%".$search."%' or NCX_CA like '%".$search."%' or TIBS_BA like '%".$search."%' or TIBS_CA like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (NCX_BA like '%".$search."%' or NCX_CA like '%".$search."%' or TIBS_BA like '%".$search."%' or TIBS_CA like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					to_char(NCX_LAST_UPDATE, 'dd-mm-YYYY HH24:mi:ss') AS NCX_LAST_UPDATE, NCX_CA, NCX_BA, TIBS_CA, TIBS_BA, STATUS
				FROM
					dwh_sales.f_caba_ncx_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function totalRecon($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (NCX_BA like '%".$search."%' or NCX_CA like '%".$search."%' or TIBS_BA like '%".$search."%' or TIBS_CA like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (NCX_BA like '%".$search."%' or NCX_CA like '%".$search."%' or TIBS_BA like '%".$search."%' or TIBS_CA like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (NCX_LAST_UPDATE) AS total
				FROM
					dwh_sales.f_caba_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function getTotalBilling() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status_tibs = 'VALID' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status_tibs = 'NOT VALID' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_order_ncx_tibs";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getBillingDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS_TIBS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NCX like '%".$search."%' or STATUS_CD like '%".$search."%' or ROW_ID like '%".$search."%' or ATTRIB_05 like '%".$search."%' or STATUS_TIBS like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NCX like '%".$search."%' or STATUS_CD like '%".$search."%' or ROW_ID like '%".$search."%' or ATTRIB_05 like '%".$search."%' or STATUS_TIBS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					to_char(CREATED, 'dd-mm-YYYY HH24:mi:ss') AS CREATED, ORDER_NCX, STATUS_CD, ROW_ID, ATTRIB_05, STATUS_TIBS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalBilling($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS_TIBS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NCX like '%".$search."%' or STATUS_CD like '%".$search."%' or ROW_ID like '%".$search."%' or ATTRIB_05 like '%".$search."%' or STATUS_TIBS like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NCX like '%".$search."%' or STATUS_CD like '%".$search."%' or ROW_ID like '%".$search."%' or ATTRIB_05 like '%".$search."%' or STATUS_TIBS like '%".$search."%')";
			}
		}
		
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_order_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function cacustref() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_ca_ncx_tibs";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function getcacustreflast($table=null) {
		$sql = "SELECT
					max(to_char(UPDATED_DATE,'YYYYMMDD HH24:mi:ss')) as last_update
				FROM
					dwh_sales.".$table;
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function cacustrefDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}else{
				$where .= " where (CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					CA, NIPNAS, CUSTOMER_REF, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ca_ncx_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function cacustrefDetailDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, CA, NIPNAS, CUSTOMER_REF, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ca_ncx_tibs $where order by ROWNUM asc";
					
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalcacustref($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}else{
				$where .= " where (CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ca_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function getbaacnum() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_ba_ncx_tibs";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getbaacnumDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					BA, ACCOUNT_NUM, ACCOUNT_NAS, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ba_ncx_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getbaacnumDetailDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		
		$sql = "SELECT
					ROWNUM rnum, BA, ACCOUNT_NAS, ACCOUNT_NUM, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ba_ncx_tibs $where order by ROWNUM desc";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalgetbaacnum($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ba_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function gettibsncx() {
		$sql = "SELECT  COUNT (*) AS total,
				  SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID,
				  SUM(CASE WHEN (NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null) AND NCX_BUS_AREA=TIBS_BUS_AREA and status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID_NAME,
				  SUM(CASE WHEN (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)  
				  AND (NCX_NAME=TIBS_NAME OR NCX_NAME LIKE TIBS_NAME OR TIBS_NAME LIKE NCX_NAME)
				  and status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID_AREA,
				  SUM(
				  CASE WHEN (NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null)
				  AND (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)
				  AND status = 'NOT COMPLY' THEN 1 ELSE 0 END
				  ) AS NOT_VALID_ALL
				FROM
				dwh_sales.f_invoice_addr_ncx_tibs";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function gettibsncxDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if($data['TYPE'] == 'NAME'){
			if(!empty($where)){
				$where .= " and ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null) AND NCX_BUS_AREA=TIBS_BUS_AREA)";
			}else{
				$where .= " where ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null) AND NCX_BUS_AREA=TIBS_BUS_AREA)";
			}
		}else if($data['TYPE'] == 'AREA'){
			if(!empty($where)){
				$where .= " and ((NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)  
				  AND (NCX_NAME=TIBS_NAME OR NCX_NAME LIKE TIBS_NAME OR TIBS_NAME LIKE NCX_NAME))";
			}else{
				$where .= " where ((NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)  
				  AND (NCX_NAME=TIBS_NAME OR NCX_NAME LIKE TIBS_NAME OR TIBS_NAME LIKE NCX_NAME))";
			}
		}else if($data['TYPE'] == 'ALL'){
			if(!empty($where)){
				$where .= " and ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null)
				  AND (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null))";
			}else{
				$where .= " where ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null)
				  AND (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null))";
			}
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or NCX_NAME like '%".$search."%' or TIBS_NAME like '%".$search."%' or NCX_ADDRESS like '%".$search."%' or TIBS_ADDRESS like '%".$search."%' or NCX_BUS_AREA like '%".$search."%' or TIBS_BUS_AREA like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or NCX_NAME like '%".$search."%' or TIBS_NAME like '%".$search."%' or NCX_ADDRESS like '%".$search."%' or TIBS_ADDRESS like '%".$search."%' or NCX_BUS_AREA like '%".$search."%' or TIBS_BUS_AREA like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					BA, ACCOUNT_NUM, ACCOUNT_NAS, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE, NCX_NAME, TIBS_NAME, NCX_ADDRESS, TIBS_ADDRESS,NCX_BUS_AREA, TIBS_BUS_AREA
				FROM
					dwh_sales.f_invoice_addr_ncx_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function gettibsncxDetailDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		if(isset($data['TYPE'])){
			if($data['TYPE'] == 'NAME'){
				if(!empty($where)){
					$where .= " and ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null) AND NCX_BUS_AREA=TIBS_BUS_AREA)";
				}else{
					$where .= " where ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null) AND NCX_BUS_AREA=TIBS_BUS_AREA)";
				}
			}else if($data['TYPE'] == 'AREA'){
				if(!empty($where)){
					$where .= " and ((NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)  
					  AND (NCX_NAME=TIBS_NAME OR NCX_NAME LIKE TIBS_NAME OR TIBS_NAME LIKE NCX_NAME))";
				}else{
					$where .= " where ((NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)  
					  AND (NCX_NAME=TIBS_NAME OR NCX_NAME LIKE TIBS_NAME OR TIBS_NAME LIKE NCX_NAME))";
				}
			}else if($data['TYPE'] == 'ALL'){
				if(!empty($where)){
					$where .= " and ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null)
					  AND (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null))";
				}else{
					$where .= " where ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null)
					  AND (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null))";
				}
			}
		}
		
		$sql = "SELECT
					BA,ACCOUNT_NAS, ACCOUNT_NUM, NCX_NAME, TIBS_NAME, NCX_ADDRESS, TIBS_ADDRESS, NCX_BUS_AREA, TIBS_BUS_AREA, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_invoice_addr_ncx_tibs $where order by ROWNUM";
		//echo $sql;exit;
		
		$start = $data['START'] * 10000;
		$finish = ($start) + 10000;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalgettibsncx($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if($data['TYPE'] == 'NAME'){
			if(!empty($where)){
				$where .= " and ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null) AND NCX_BUS_AREA=TIBS_BUS_AREA)";
			}else{
				$where .= " where ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null) AND NCX_BUS_AREA=TIBS_BUS_AREA)";
			}
		}else if($data['TYPE'] == 'AREA'){
			if(!empty($where)){
				$where .= " and ((NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)  
				  AND (NCX_NAME=TIBS_NAME OR NCX_NAME LIKE TIBS_NAME OR TIBS_NAME LIKE NCX_NAME))";
			}else{
				$where .= " where ((NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null)  
				  AND (NCX_NAME=TIBS_NAME OR NCX_NAME LIKE TIBS_NAME OR TIBS_NAME LIKE NCX_NAME))";
			}
		}else if($data['TYPE'] == 'ALL'){
			if(!empty($where)){
				$where .= " and ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null)
				  AND (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null))";
			}else{
				$where .= " where ((NCX_NAME != TIBS_NAME or NCX_NAME is null or TIBS_NAME is null)
				  AND (NCX_BUS_AREA != TIBS_BUS_AREA or NCX_BUS_AREA is null or TIBS_BUS_AREA is null))";
			}
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or NCX_NAME like '%".$search."%' or TIBS_NAME like '%".$search."%' or NCX_ADDRESS like '%".$search."%' or TIBS_ADDRESS like '%".$search."%' or NCX_BUS_AREA like '%".$search."%' or TIBS_BUS_AREA like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or STATUS like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or NCX_NAME like '%".$search."%' or TIBS_NAME like '%".$search."%' or NCX_ADDRESS like '%".$search."%' or TIBS_ADDRESS like '%".$search."%' or NCX_BUS_AREA like '%".$search."%' or TIBS_BUS_AREA like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_invoice_addr_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function cabacustrefaacnum() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_rel_caba_ncx_tibs";
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function cabacustrefaacnumDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (CA_DIVISI like '%".$search."%' or CA_SEGMENT like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or BA like '%".$search."%' or CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}else{
				$where .= " where (CA_DIVISI like '%".$search."%' or CA_SEGMENT like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or BA like '%".$search."%' or CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
        $sql = "SELECT
					CA, CA_DIVISI, CA_SEGMENT, BA, NIPNAS, ACCOUNT_NAS, ACCOUNT_NUM, CUSTOMER_REF, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_rel_caba_ncx_tibs $where $order";
                    
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function cabacustrefaacnumDetailDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
        $sql = "SELECT
					ROWNUM rnum, CA, CA_DIVISI, CA_SEGMENT, BA, NIPNAS, ACCOUNT_NAS, CUSTOMER_REF, ACCOUNT_NUM, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_rel_caba_ncx_tibs $where ORDER BY ROWNUM";
                    
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalcabacustrefaacnum($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (CA_DIVISI like '%".$search."%' or CA_SEGMENT like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or BA like '%".$search."%' or CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}else{
				$where .= " where (CA_DIVISI like '%".$search."%' or CA_SEGMENT like '%".$search."%' or ACCOUNT_NUM like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or BA like '%".$search."%' or CUSTOMER_REF like '%".$search."%' or STATUS like '%".$search."%' or CA like '%".$search."%' or NIPNAS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_rel_caba_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function billcomncxtibs() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_billcom_order_ncx_tibs";
			// $sql = "SELECT *
			// 	FROM
			// 		dwh_sales.f_rel_caba_ncx_tibs";

		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function billcomncxtibsDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					ORDER_NUM, CUST_ORDER_NUM, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_billcom_order_ncx_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function billcomncxtibsDetailDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, ORDER_NUM, CUST_ORDER_NUM, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_billcom_order_ncx_tibs $where order by rownum";
		//echo $sql;exit;
		
		$start = 10;
		$finish = 20;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalbillcomncxtibs($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_billcom_order_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function tibsncxbillcom() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_all_order_tibs_vs_ncx";
			// $sql = "SELECT *
			// 	FROM
			// 		dwh_sales.f_rel_caba_ncx_tibs";

		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function tibsncxbillcomDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%' or MILESTONE like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%' or MILESTONE like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					ORDER_NUM, CUST_ORDER_NUM, STATUS, MILESTONE, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_all_order_tibs_vs_ncx $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function tibsncxbillcomDetailDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, ORDER_NUM, CUST_ORDER_NUM, MILESTONE, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_all_order_tibs_vs_ncx $where order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totaltibsncxbillcom($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%' or MILESTONE like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NUM like '%".$search."%' or STATUS like '%".$search."%' or CUST_ORDER_NUM like '%".$search."%' or MILESTONE like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_all_order_tibs_vs_ncx $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function ncxtibssid() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_sid_ncx_tibs";
			// $sql = "SELECT *
			// 	FROM
			// 		dwh_sales.f_rel_caba_ncx_tibs";

		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function ncxtibssidDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (SERVICE_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (SERVICE_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					PRODUCT_LABEL, SERVICE_NUM, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_sid_ncx_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function downloadncxtibssid($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		
		$sql = "SELECT
					ROWNUM rnum, SERVICE_NUM, PRODUCT_LABEL, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_sid_ncx_tibs $where order by rownum";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalncxtibssid($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (SERVICE_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (SERVICE_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_sid_ncx_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function doublesid() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_double_sid_tibs";
			// $sql = "SELECT *
			// 	FROM
			// 		dwh_sales.f_rel_caba_ncx_tibs";

		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function doublesidDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or PERIOD like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or PERIOD like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					PRODUCT_LABEL, ACCOUNT_NUM, PERIOD, BILL_MNY, TOTAL, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_double_sid_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function downloaddoublesid($data) {
		
		$sql = "SELECT
					rownum, ACCOUNT_NUM, PRODUCT_LABEL, PERIOD, TOTAL, BILL_MNY, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_double_sid_tibs  order by rownum";
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totaldoublesid($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or PERIOD like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or PERIOD like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_double_sid_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function doublenoparetDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					PRODUCT_LABEL, ACCOUNT_NUM, BILL_MNY, TOTAL, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_disc_no_parent_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totaldoublenoparet($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or PRODUCT_LABEL like '%".$search."%' or TOTAL like '%".$search."%' or BILL_MNY like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_disc_no_parent_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getMenu() {
		$sql = "SELECT
					*
				FROM
					NAF_REKON_MENU where parent is null and status = '0'";
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function getMenuDetail($id = null) {
		$sql = "SELECT
					*
				FROM
					NAF_REKON_MENU where status = '0' and parent = '$id'";
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function ncxtibsprice() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN c_price = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN c_price = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_order_ncx_tibs_attr";
			// $sql = "SELECT *
			// 	FROM
			// 		dwh_sales.f_rel_caba_ncx_tibs";

		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function ncxtibspriceDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_price='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_price_otc like '%".$search."%' or tibs_price_otc like '%".$search."%' or ncx_price_rec like '%".$search."%' or tibs_price_rec like '%".$search."%' or c_price like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_price_otc like '%".$search."%' or tibs_price_otc like '%".$search."%' or ncx_price_rec like '%".$search."%' or tibs_price_rec like '%".$search."%' or c_price like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					order_num, ncx_price_otc, tibs_price_otc, ncx_price_rec, tibs_price_rec, c_price, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function downloadncxtibsprice($data) {
		$where = "";
		
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_price='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					rownum, order_num, ncx_price_otc, tibs_price_otc, ncx_price_rec, tibs_price_rec, c_price, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where order by rownum";
		//echo $sql;exit;
		

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalncxtibsprice($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_price='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_price_otc like '%".$search."%' or tibs_price_otc like '%".$search."%' or ncx_price_rec like '%".$search."%' or tibs_price_rec like '%".$search."%' or c_price like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_price_otc like '%".$search."%' or tibs_price_otc like '%".$search."%' or ncx_price_rec like '%".$search."%' or tibs_price_rec like '%".$search."%' or c_price like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function ncxtibsbilldate() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN C_BILLDATE = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN C_BILLDATE = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_order_ncx_tibs_attr";
			// $sql = "SELECT *
			// 	FROM
			// 		dwh_sales.f_rel_caba_ncx_tibs";

		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function ncxtibsbilldateDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE C_BILLDATE='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_billdate like '%".$search."%' or tibs_billdate like '%".$search."%' or C_BILLDATE like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_billdate like '%".$search."%' or tibs_billdate like '%".$search."%' or C_BILLDATE like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					order_num, ncx_billdate, tibs_billdate, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE, C_BILLDATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function downloadncxtibsbilldate($data) {
		$where = "";
		
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE C_BILLDATE='".$data['STATUS']."'";
		}
		$sql = "SELECT
					rownum, order_num, ncx_billdate, tibs_billdate, C_BILLDATE, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where order by rownum";


        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalncxtibsbilldate($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE C_BILLDATE='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_billdate like '%".$search."%' or tibs_billdate like '%".$search."%' or C_BILLDATE like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_billdate like '%".$search."%' or tibs_billdate like '%".$search."%' or C_BILLDATE like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function ncxtibsppn() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN C_PPN = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN C_PPN = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_order_ncx_tibs_attr";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function ncxtibsppnDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE C_PPN='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_ppn like '%".$search."%' or tibs_ppn like '%".$search."%' or c_ppn like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_ppn like '%".$search."%' or tibs_ppn like '%".$search."%' or c_ppn like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					order_num,ncx_ppn, tibs_ppn, c_ppn, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function downloadtibsncxppn($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE C_PPN='".$data['STATUS']."'";
		}
		
		
		$sql = "SELECT
					rownum, order_num,ncx_ppn, tibs_ppn, c_ppn, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where order by rownum";
		

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalncxtibsppn($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE C_PPN='".$data['STATUS']."'";
		}

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_ppn like '%".$search."%' or tibs_ppn like '%".$search."%' or c_ppn like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_ppn like '%".$search."%' or tibs_ppn like '%".$search."%' or c_ppn like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function ncxtibstop() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN C_TERM_PAYMENT = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  	SUM(CASE WHEN C_TERM_PAYMENT = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_order_ncx_tibs_attr";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();

            //print_r($rows);die();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function ncxtibstopDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_term_payment like '%".$search."%' or tibs_term_payment like '%".$search."%' or c_term_payment like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_term_payment like '%".$search."%' or tibs_term_payment like '%".$search."%' or c_term_payment like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					order_num,ncx_term_payment, tibs_term_payment, c_term_payment, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function downloadtibsncxtop($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		}
		
		
		$sql = "SELECT
					rownum, order_num,ncx_term_payment, tibs_term_payment, c_term_payment, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where order by rownum";
		//echo $sql;exit;
		

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalncxtibstop($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		}

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or ncx_term_payment like '%".$search."%' or tibs_term_payment like '%".$search."%' or c_term_payment like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or ncx_term_payment like '%".$search."%' or tibs_term_payment like '%".$search."%' or c_term_payment like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_order_ncx_tibs_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function saveMergeCa($data = array(), $code_sess = null, $in_type = null ,$in_file_name = null, $config=array()) {//ok
		try {
			$IN_LOC_CA_OLD = $data['in_loc_ca_old'];
			$IN_LOC_CA_NEW = $data['in_loc_ca_new'];
			$IN_NIPNAS_NEW = $data['in_nipnas_new'];
			$IN_USER = $code_sess;
			$IN_TYPE = $in_type;
			$IN_FILE_NAME = $in_file_name;
			
			//echo $data['FILTER'];
			//echo $data['VALUE'];
			$conn = $this->getAdapter()->getDriver()->getConnection()->getResource();     

			//Request does not change
			$sql = 'BEGIN MERGE_CA'.$config['server_prosedure'].'(:IN_LOC_CA_OLD, :IN_LOC_CA_NEW, :IN_NIPNAS_NEW, :IN_USER, :IN_TYPE, :IN_FILE_NAME, :OUT_STATUS, :OUT_MESS); END;';            

			//Statement does not change
			$stmt = oci_parse($conn,$sql);  
			
			//$cursor = oci_new_cursor($conn);
			
			oci_bind_by_name($stmt,":IN_LOC_CA_OLD",$IN_LOC_CA_OLD,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_LOC_CA_NEW",$IN_LOC_CA_NEW,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_NIPNAS_NEW",$IN_NIPNAS_NEW,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_USER",$IN_USER,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_TYPE",$IN_TYPE,200,SQLT_CHR);
			oci_bind_by_name($stmt,":IN_FILE_NAME",$IN_FILE_NAME,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_STATUS", $pout_code,200,SQLT_CHR);
			oci_bind_by_name($stmt,":OUT_MESS", $pout_mess,200,SQLT_CHR);
			

			// Execute the statement as in your first try
			oci_execute($stmt);

			// and now, execute the cursor
			//oci_execute($cursor);
			
			if($pout_code != 9){
				return false;
			}

			// Use OCIFetchinto in the same way as you would with SELECT
			if ($pout_code == 9) {
				return "Merge success";
			}else{
				return false;
			}
		} catch (\Exception $e) {
                return false;
				
        }

        return false;
	}
	
	public function doublemoDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		} */
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_type like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or period like '%".$search."%')";
			}else{
				$where .= " where (order_type like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or period like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					order_type,account_num, period, cust_order_num, bill_mny, total, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_double_mo_otc_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloaddoublemo($data) {
		
		$sql = "SELECT
					rownum, account_num, cust_order_num, order_type, period, total, bill_mny, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_double_mo_otc_tibs order by rownum";
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totaldoublemo($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_type like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or period like '%".$search."%')";
			}else{
				$where .= " where (order_type like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or period like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_double_mo_otc_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function doublemrcDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		} */
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (cid like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or prod_period like '%".$search."%' or bill_period like '%".$search."%')";
			}else{
				$where .= " where (cid like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or prod_period like '%".$search."%' or bill_period like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					cid,account_num, prod_period, bill_period, cust_order_num, bill_mny, total, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_double_mrc_disc_tibs $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	
	public function downloaddoublemrc($data) {
		$sql = "SELECT
					rownum,account_num, cust_order_num, cid, bill_period, prod_period, total, bill_mny, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_double_mrc_disc_tibs order by rownum";
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totaldoublemrc($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (cid like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or prod_period like '%".$search."%' or bill_period like '%".$search."%')";
			}else{
				$where .= " where (cid like '%".$search."%' or account_num like '%".$search."%' or cust_order_num like '%".$search."%' or bill_mny like '%".$search."%' or total like '%".$search."%' or prod_period like '%".$search."%' or bill_period like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_double_mrc_disc_tibs $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function businessareaDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		} */
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or OU_NUM like '%".$search."%' or BUSINESS_AREA like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or OU_NUM like '%".$search."%' or BUSINESS_AREA like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					BA, OU_NUM, BUSINESS_AREA, accnt_type_cd, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_ba_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloadbusinessarea($data = null) {
		$where = "";
		
		
		$sql = "SELECT
					rownum, BA, OU_NUM, BUSINESS_AREA, accnt_type_cd, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_ba_attr order by rownum";
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalbusinessarea($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or OU_NUM like '%".$search."%' or BUSINESS_AREA like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or OU_NUM like '%".$search."%' or BUSINESS_AREA like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ncx_ba_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function tanggalcontractDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		} */
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (agreenum like '%".$search."%' or agree_start_date like '%".$search."%' or agree_end_date like '%".$search."%')";
			}else{
				$where .= " where (agreenum like '%".$search."%' or agree_start_date like '%".$search."%' or agree_end_date like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					AGREENUM, to_char(AGREE_START_DATE, 'dd-mm-YYYY') as AGREE_START_DATE, to_char(AGREE_END_DATE, 'dd-mm-YYYY') as AGREE_END_DATE, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_tc_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloadtanggalcontract($data) {
		
		$sql = "SELECT
					rownum, AGREENUM, to_char(AGREE_START_DATE, 'dd-mm-YYYY') as AGREE_START_DATE, to_char(AGREE_END_DATE, 'dd-mm-YYYY') as AGREE_END_DATE, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_tc_attr order by rownum";
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totaltanggalcontract($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (agreenum like '%".$search."%' or agree_start_date like '%".$search."%' or agree_end_date like '%".$search."%')";
			}else{
				$where .= " where (agreenum like '%".$search."%' or agree_start_date like '%".$search."%' or agree_end_date like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ncx_tc_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function cpaddressDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		} */
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (row_id like '%".$search."%' or ba like '%".$search."%' or ou_num like '%".$search."%' or pr_addr_per_id like '%".$search."%' or pr_con_id like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}else{
				$where .= " where (row_id like '%".$search."%' or ba like '%".$search."%' or ou_num like '%".$search."%' or pr_addr_per_id like '%".$search."%' or pr_con_id like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					ba, row_id, ou_num, pr_addr_id, accnt_type_cd, pr_con_id, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_cpa_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloadcpaddress($data) {
		
		$sql = "SELECT
					rownum, ba, row_id, pr_addr_id, pr_con_id, accnt_type_cd, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_cpa_attr order by rownum";
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalcpaddress($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (row_id like '%".$search."%' or ba like '%".$search."%' or ou_num like '%".$search."%' or pr_addr_per_id like '%".$search."%' or pr_con_id like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}else{
				$where .= " where (row_id like '%".$search."%' or ba like '%".$search."%' or ou_num like '%".$search."%' or pr_addr_per_id like '%".$search."%' or pr_con_id like '%".$search."%' or accnt_type_cd like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ncx_cpa_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function latlongDetail($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment ='".$data['STATUS']."'";
		} */
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (row_id like '%".$search."%' or latitude like '%".$search."%' or longitude like '%".$search."%')";
			}else{
				$where .= " where (row_id like '%".$search."%' or latitude like '%".$search."%' or longitude like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					row_id, latitude, longitude, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_latlong_attr $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		//echo $sql_limit;exit;
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloadlatlong($data) {
		$sql = "SELECT
					rownum, row_id, latitude, longitude, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ncx_latlong_attr order by rownum";
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totallatlong($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (row_id like '%".$search."%' or latitude like '%".$search."%' or longitude like '%".$search."%')";
			}else{
				$where .= " where (row_id like '%".$search."%' or latitude like '%".$search."%' or longitude like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ncx_latlong_attr $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function misssingbilling($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or SID like '%".$search."%' or PROD_PERIOD like '%".$search."%' or DESCRIPTION like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or SID like '%".$search."%' or PROD_PERIOD like '%".$search."%' or DESCRIPTION like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		$sql = "SELECT
					ACCOUNT_NUM, SID, PROD_PERIOD, to_char(START_DAT, 'dd-mm-YYYY HH24:mi:ss') AS START_DAT, to_char(END_DAT, 'dd-mm-YYYY HH24:mi:ss') AS END_DAT, DESCRIPTION, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.F_MISSING_BILLING_TIBS $where $order";
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloadmisssingbilling($data) {
		$sql = "SELECT
					ROWNUM, ACCOUNT_NUM, SID, PROD_PERIOD, to_char(START_DAT, 'dd-mm-YYYY HH24:mi:ss') AS START_DAT, to_char(END_DAT, 'dd-mm-YYYY HH24:mi:ss') AS END_DAT, DESCRIPTION, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.F_MISSING_BILLING_TIBS order by rownum";
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totalmisssingbilling($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or SID like '%".$search."%' or PROD_PERIOD like '%".$search."%' or DESCRIPTION like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or SID like '%".$search."%' or PROD_PERIOD like '%".$search."%' or DESCRIPTION like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.F_MISSING_BILLING_TIBS $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function doubleAo($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (upper(ORDER_TYPE) like '%".$search."%'or upper(CUSTOMER_REF) like '%".$search."%'or upper(ACCOUNT_NUM) like '%".$search."%'or upper(PRODUCT_GROUP) like '%".$search."%'or upper(CUST_ORDER_NUM) like '%".$search."%'or upper(CID) like '%".$search."%'or upper(PRODUCT_NAME) like '%".$search."%'or upper(BILL_MNY) like '%".$search."%'or upper(PERIOD) like '%".$search."%'or upper(PROD_PERIOD) like '%".$search."%'or upper(PRODUCT_SEQ) like '%".$search."%')";
			}else{
				$where .= " where (upper(ORDER_TYPE) like '%".$search."%'or upper(CUSTOMER_REF) like '%".$search."%'or upper(ACCOUNT_NUM) like '%".$search."%'or upper(PRODUCT_GROUP) like '%".$search."%'or upper(CUST_ORDER_NUM) like '%".$search."%'or upper(CID) like '%".$search."%'or upper(PRODUCT_NAME) like '%".$search."%'or upper(BILL_MNY) like '%".$search."%'or upper(PERIOD) like '%".$search."%'or upper(PROD_PERIOD) like '%".$search."%'or upper(PRODUCT_SEQ) like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
	
		$sql = "SELECT
					ORDER_TYPE, CUSTOMER_REF, ACCOUNT_NUM, CUST_ORDER_NUM, CID, PRODUCT_NAME, BILL_MNY, PERIOD, PROD_PERIOD, PRODUCT_SEQ, PRODUCT_GROUP, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.F_DOUBLE_AO_OTC_TIBS $where $order";
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloaddoubleAo($data) {
		$sql = "SELECT
					rownum, ORDER_TYPE, CUSTOMER_REF, ACCOUNT_NUM, CUST_ORDER_NUM, CID, PRODUCT_NAME, BILL_MNY, PERIOD, PROD_PERIOD, PRODUCT_SEQ, PRODUCT_GROUP, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.F_DOUBLE_AO_OTC_TIBS order by rownum";
		
        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}


	public function totaldoubleAo($data) {
		$search = strtoupper($data['search']['value']);
		$where = "";
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE c_term_payment='".$data['STATUS']."'";
		} */

		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (upper(ORDER_TYPE) like '%".$search."%'or upper(CUSTOMER_REF) like '%".$search."%'or upper(ACCOUNT_NUM) like '%".$search."%'or upper(PRODUCT_GROUP) like '%".$search."%'or upper(CUST_ORDER_NUM) like '%".$search."%'or upper(CID) like '%".$search."%'or upper(PRODUCT_NAME) like '%".$search."%'or upper(BILL_MNY) like '%".$search."%'or upper(PERIOD) like '%".$search."%'or upper(PROD_PERIOD) like '%".$search."%'or upper(PRODUCT_SEQ) like '%".$search."%')";
			}else{
				$where .= " where (upper(ORDER_TYPE) like '%".$search."%'or upper(CUSTOMER_REF) like '%".$search."%'or upper(ACCOUNT_NUM) like '%".$search."%'or upper(PRODUCT_GROUP) like '%".$search."%'or upper(CUST_ORDER_NUM) like '%".$search."%'or upper(CID) like '%".$search."%'or upper(PRODUCT_NAME) like '%".$search."%'or upper(BILL_MNY) like '%".$search."%'or upper(PERIOD) like '%".$search."%'or upper(PROD_PERIOD) like '%".$search."%'or upper(PRODUCT_SEQ) like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.F_DOUBLE_AO_OTC_TIBS $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function sidncxnoss() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_order_sid_ncx_oss";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function sidncxnossDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NUM like '%".$search."%' or SERVICE_NUM like '%".$search."%'  or OU_NUM like '%".$search."%'  or NIPNAS like '%".$search."%'  or SID_NOSS like '%".$search."%'  or CUST_ID_NOSS like '%".$search."%'  or SID_TENOSS like '%".$search."%'  or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NUM like '%".$search."%' or SERVICE_NUM like '%".$search."%'  or OU_NUM like '%".$search."%'  or NIPNAS like '%".$search."%'  or SID_NOSS like '%".$search."%'  or CUST_ID_NOSS like '%".$search."%'  or SID_TENOSS like '%".$search."%'  or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					ORDER_NUM, SERVICE_NUM, OU_NUM, NIPNAS, SID_NOSS, CUST_ID_NOSS, SID_TENOSS, CUST_ID_TENOSS, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_sid_ncx_oss $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function sidncxnossDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, ORDER_NUM, SERVICE_NUM, OU_NUM, NIPNAS, SID_NOSS, CUST_ID_NOSS, SID_TENOSS, CUST_ID_TENOSS, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_order_sid_ncx_oss $where order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalsidncxnoss($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ORDER_NUM like '%".$search."%' or SERVICE_NUM like '%".$search."%'  or OU_NUM like '%".$search."%'  or NIPNAS like '%".$search."%'  or SID_NOSS like '%".$search."%'  or CUST_ID_NOSS like '%".$search."%'  or SID_TENOSS like '%".$search."%'  or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (ORDER_NUM like '%".$search."%' or SERVICE_NUM like '%".$search."%'  or OU_NUM like '%".$search."%'  or NIPNAS like '%".$search."%'  or SID_NOSS like '%".$search."%'  or CUST_ID_NOSS like '%".$search."%'  or SID_TENOSS like '%".$search."%'  or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_order_sid_ncx_oss $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function bancxtrems() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_ba_ncx_trems";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function bancxtremsDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or STATUS like '%".$search."%' or BPEXT like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or STATUS like '%".$search."%' or BPEXT like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					BA, ACCOUNT_NAS, BPEXT, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ba_ncx_trems $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function bancxtremsDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, BA, ACCOUNT_NAS, BPEXT, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ba_ncx_trems $where order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalbancxtrems($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (BA like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or STATUS like '%".$search."%' or BPEXT like '%".$search."%')";
			}else{
				$where .= " where (BA like '%".$search."%' or ACCOUNT_NAS like '%".$search."%' or STATUS like '%".$search."%' or BPEXT like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ba_ncx_trems $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function falloutnoss($data) {
		$search = strtoupper($data['search']['value']);
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		} */
		
		$where = "";
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (CREATIONDATE like '%".$search."%' or TICKETID like '%".$search."%' or SCORDERNO like '%".$search."%' or SERVICE_NUM like '%".$search."%' or SCCD_STATUS like '%".$search."%' or WFM_STATUS like '%".$search."%' or TROUBLE_STATUS_DATE like '%".$search."%' or TROUBLE_HEADLINE like '%".$search."%' or TK_CLASSIFICATION like '%".$search."%')";
			}else{
				$where .= " where (CREATIONDATE like '%".$search."%' or TICKETID like '%".$search."%' or SCORDERNO like '%".$search."%' or SERVICE_NUM like '%".$search."%' or SCCD_STATUS like '%".$search."%' or WFM_STATUS like '%".$search."%' or TROUBLE_STATUS_DATE like '%".$search."%' or TROUBLE_HEADLINE like '%".$search."%' or TK_CLASSIFICATION like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					to_char(CREATIONDATE, 'dd-mm-YYYY HH24:mi:ss') AS CREATIONDATE, TICKETID, SCORDERNO, SERVICE_NUM, SCCD_STATUS, WFM_STATUS, to_char(TROUBLE_STATUS_DATE, 'dd-mm-YYYY HH24:mi:ss') AS TROUBLE_STATUS_DATE, TROUBLE_HEADLINE, TK_CLASSIFICATION, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_fallout_noss $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function falloutnossDownload($data) {
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		 */
		$sql = "SELECT
					ROWNUM rnum, to_char(CREATIONDATE, 'dd-mm-YYYY HH24:mi:ss') AS CREATIONDATE, TICKETID, SCORDERNO, SERVICE_NUM, SCCD_STATUS, WFM_STATUS, to_char(TROUBLE_STATUS_DATE, 'dd-mm-YYYY HH24:mi:ss') AS TROUBLE_STATUS_DATE, TROUBLE_HEADLINE, TK_CLASSIFICATION, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_fallout_noss order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalfalloutnoss($data) {
		$search = strtoupper($data['search']['value']);
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		} */
		
		$where = "";
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (CREATIONDATE like '%".$search."%' or TICKETID like '%".$search."%' or SCORDERNO like '%".$search."%' or SERVICE_NUM like '%".$search."%' or SCCD_STATUS like '%".$search."%' or WFM_STATUS like '%".$search."%' or TROUBLE_STATUS_DATE like '%".$search."%' or TROUBLE_HEADLINE like '%".$search."%' or TK_CLASSIFICATION like '%".$search."%')";
			}else{
				$where .= " where (CREATIONDATE like '%".$search."%' or TICKETID like '%".$search."%' or SCORDERNO like '%".$search."%' or SERVICE_NUM like '%".$search."%' or SCCD_STATUS like '%".$search."%' or WFM_STATUS like '%".$search."%' or TROUBLE_STATUS_DATE like '%".$search."%' or TROUBLE_HEADLINE like '%".$search."%' or TK_CLASSIFICATION like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_fallout_noss $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function revcode() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_rev_code_tibs_trems";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function revcodeDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (rev_code_tibs like '%".$search."%' or id_rev_trems like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (rev_code_tibs like '%".$search."%' or id_rev_trems like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					rev_code_tibs, id_rev_trems, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_rev_code_tibs_trems $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function revcodeDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, rev_code_tibs, id_rev_trems, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_rev_code_tibs_trems $where order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalrevcode($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (rev_code_tibs like '%".$search."%' or id_rev_trems like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (rev_code_tibs like '%".$search."%' or id_rev_trems like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_rev_code_tibs_trems $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function batibstrems() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_ba_tibs_trems";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function batibstremsDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or BPEXT like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or BPEXT like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					ACCOUNT_NUM, BPEXT, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ba_tibs_trems $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function batibstremsDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, ACCOUNT_NUM, BPEXT, STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_ba_tibs_trems $where order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalbatibstrems($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ACCOUNT_NUM like '%".$search."%' or BPEXT like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (ACCOUNT_NUM like '%".$search."%' or BPEXT like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_ba_tibs_trems $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function serviceaddrncx($data) {
		$search = strtoupper($data['search']['value']);
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		} */
		
		$where = "";
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (SERVACCNTNUM like '%".$search."%' or SERVACCNTNAME like '%".$search."%' or SERVACCNTTYPE like '%".$search."%' or ADDR_NAME like '%".$search."%')";
			}else{
				$where .= " where(SERVACCNTNUM like '%".$search."%' or SERVACCNTNAME like '%".$search."%' or SERVACCNTTYPE like '%".$search."%' or ADDR_NAME like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					SERVACCNTNUM, SERVACCNTNAME, SERVACCNTTYPE, ADDR_NAME, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_service_addr_ncx $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function serviceaddrncxDownload($data) {
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		 */
		$sql = "SELECT
					ROWNUM rnum, SERVACCNTNUM, SERVACCNTNAME, SERVACCNTTYPE, ADDR_NAME, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_service_addr_ncx order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalserviceaddrncx($data) {
		$search = strtoupper($data['search']['value']);
		/* if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		} */
		
		$where = "";
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (SERVACCNTNUM like '%".$search."%' or SERVACCNTNAME like '%".$search."%' or SERVACCNTTYPE like '%".$search."%' or ADDR_NAME like '%".$search."%')";
			}else{
				$where .= " where(SERVACCNTNUM like '%".$search."%' or SERVACCNTNAME like '%".$search."%' or SERVACCNTTYPE like '%".$search."%' or ADDR_NAME like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_service_addr_ncx $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function sidncxnossasset() {
		$sql = "SELECT
					COUNT (*) AS total,
					SUM(CASE WHEN status = 'COMPLY' THEN 1 ELSE 0 END) AS VALID,
				  SUM(CASE WHEN status = 'NOT COMPLY' THEN 1 ELSE 0 END) AS NOT_VALID
				FROM
					dwh_sales.f_asset_sid_ncx_oss";
		//echo $sql;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function sidncxnossassetDetail($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ASSET_NUM like '%".$search."%' or SERIAL_NUM like '%".$search."%' or OU_NUM like '%".$search."%' or NIPNAS like '%".$search."%' or SID_NOSS like '%".$search."%' or CUST_ID_NOSS like '%".$search."%' or SID_TENOSS like '%".$search."%' or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (ASSET_NUM like '%".$search."%' or SERIAL_NUM like '%".$search."%' or OU_NUM like '%".$search."%' or NIPNAS like '%".$search."%' or SID_NOSS like '%".$search."%' or CUST_ID_NOSS like '%".$search."%' or SID_TENOSS like '%".$search."%' or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					ASSET_NUM, SERIAL_NUM, OU_NUM, NIPNAS, SID_NOSS, CUST_ID_NOSS, SID_TENOSS,  CUST_ID_TENOSS,  STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_asset_sid_ncx_oss $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

	public function sidncxnossassetDownload($data) {
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		$sql = "SELECT
					ROWNUM rnum, ASSET_NUM, SERIAL_NUM, OU_NUM, NIPNAS, SID_NOSS, CUST_ID_NOSS, SID_TENOSS,  CUST_ID_TENOSS,  STATUS, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.f_asset_sid_ncx_oss $where order by ROWNUM";
		//echo $sql;exit;
		
		$start = 0;
		$finish = 10;
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								ROWNUM rnum, C.*
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function totalsidncxnossasset($data) {
		$search = strtoupper($data['search']['value']);
		if($data['STATUS'] == 'all'){
			$where = "";
		}else{
			$where = "WHERE STATUS='".$data['STATUS']."'";
		}
		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (ASSET_NUM like '%".$search."%' or SERIAL_NUM like '%".$search."%' or OU_NUM like '%".$search."%' or NIPNAS like '%".$search."%' or SID_NOSS like '%".$search."%' or CUST_ID_NOSS like '%".$search."%' or SID_TENOSS like '%".$search."%' or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}else{
				$where .= " where (ASSET_NUM like '%".$search."%' or SERIAL_NUM like '%".$search."%' or OU_NUM like '%".$search."%' or NIPNAS like '%".$search."%' or SID_NOSS like '%".$search."%' or CUST_ID_NOSS like '%".$search."%' or SID_TENOSS like '%".$search."%' or CUST_ID_TENOSS like '%".$search."%' or STATUS like '%".$search."%')";
			}
		}
	
		$sql = "SELECT
					COUNT (*) AS total
				FROM
					dwh_sales.f_asset_sid_ncx_oss $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function downloadRekon($data = array()) {
        try {
			$status = $data['IN_STATUS'];
			if($status == 'all'){
				$status = null;
			}
			
			$temp = array(
					'rekon_table'	=> $data['IN_TABLE'], // table name
					'rekon_date'	=> $data['IN_DATE'], // today dmY
					'rekon_status'	=> $status, //comply, not comply, all
					'create_date'	=> $this->now(),
					'status_download'	=> 0,
					'rekon_name'	=> $data['name']
				);
			
            $select = $this->select();
			$select->from($this->_tables['queue']);
			$select->where(array(
							'rekon_table'	=> $data['IN_TABLE'], // table name
							'rekon_date'	=> $data['IN_DATE'], // today dmY
							'rekon_status'	=> $status, //comply, not comply, all
						));

			$row = $this->fetchRow($select);
			
			if(empty($row)){
				$select = $this->select()->columns(array('ID' => $this->expression('SEQ_NAF_QUEUE.NEXTVAL')))->from('DUAL');
				//echo str_replace('"','',$select->getSqlString());exit;
				$id = $this->fetchRow($select);
				
				$insert = $this->insert();
				$insert->into($this->_tables['queue']);
				$insert->values(array(
					'id_rekon'		=> $id['ID'], // table name
					'rekon_table'	=> $data['IN_TABLE'], // table name
					'rekon_date'	=> $data['IN_DATE'], // today dmY
					'rekon_status'	=> $status, //comply, not comply, all
					'create_date'	=> $this->now(),
					'status_download'	=> 0,
					'rekon_name'	=> $data['name']
				));
				if ($this->execute($insert)) {
					$temp['id'] = $id['ID'];
					return $temp;
				}
			}else{
				$temp['id'] = $row['id_rekon'];
				return $temp;
			}
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function checkDownload($data = array()) {
        try {
            $select = $this->select();
			$select->from($this->_tables['queue']);
			$select->where(array(
							'id_rekon'	=> $data['id'], // table name
							'status_download'	=> 2, // table name
						));
			//echo str_replace('"','',$select->getSqlString());exit;
			return $this->fetchRow($select);
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function listDownload($data = array()) {
        try {
            $select = $this->select();
			$select->from($this->_tables['queue']);
			$select->where(array(
							'rekon_date'	=> date('dmY'), // table name
						));
			//echo str_replace('"','',$select->getSqlString());exit;
			$data = $this->fetchAll($select);
			$dataAll = array();
			if(!empty($data) and $data != ''){
				foreach($data as $row) {
					array_push($dataAll, $row);
				}
			}
			return $dataAll;
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function orderDateAgreement($data = array()) {
        $search = strtoupper($data['search']['value']);
			$where = "";

		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or order_created like '%".$search."%' or order_due like '%".$search."%' or contract_eff like '%".$search."%' or contract_start like '%".$search."%' or contract_end like '%".$search."%' or renewal_end like '%".$search."%' or upper(header_status) like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or order_created like '%".$search."%' or order_due like '%".$search."%' or contract_eff like '%".$search."%' or contract_start like '%".$search."%' or contract_end like '%".$search."%' or renewal_end like '%".$search."%' or upper(header_status) like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
		
		
		$sql = "SELECT
					order_num, order_created, order_due, contract_eff, contract_start, contract_end, renewal_end,  header_status, to_char(UPDATED_DATE, 'dd-mm-YYYY HH24:mi:ss') AS UPDATED_DATE
				FROM
					dwh_sales.F_ORDERDT_AGREEMENT $where $order";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql_limit, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}
	
	public function orderDateAgreementTotal($data = array()) {
        $search = strtoupper($data['search']['value']);
			$where = "";

		
		if(!empty($data['search']['value'])){
			if(!empty($where)){
				$where .= " and (order_num like '%".$search."%' or order_created like '%".$search."%' or order_due like '%".$search."%' or contract_eff like '%".$search."%' or contract_start like '%".$search."%' or contract_end like '%".$search."%' or renewal_end like '%".$search."%' or upper(header_status) like '%".$search."%')";
			}else{
				$where .= " where (order_num like '%".$search."%' or order_created like '%".$search."%' or order_due like '%".$search."%' or contract_eff like '%".$search."%' or contract_start like '%".$search."%' or contract_end like '%".$search."%' or renewal_end like '%".$search."%' or upper(header_status) like '%".$search."%')";
			}
		}
		
		if(!empty($data['order'][0]['column'])){
			$order = " order by ".$data['columns'][ $data['order'][0]['column']]['data']." ".$data['order'][0]['dir']."";
		}else{
			$order = "";
		}
	
		$sql = "SELECT
					COUNT (order_num) AS total
				FROM
					dwh_sales.F_ORDERDT_AGREEMENT $where";
		//echo $sql;exit;
		
		$start = $data['start'];
		$finish = $data['start'] + $data['length'];
		
		$sql_limit = "SELECT
						D .*
					FROM
						(
							SELECT
								C.*, ROWNUM rnum
							FROM
								(".$sql.") C
							WHERE
								ROWNUM <= $finish -- finish
						) D
					WHERE
						rnum > $start -- start";
		
		//echo $sql_limit;exit;

        try {
            $adapter = $this->_db;
            $result = $this->_db->query($sql, $adapter::QUERY_MODE_EXECUTE);
            $resultset = new \Zend\Db\ResultSet\ResultSet();
            $rows = $resultset->initialize($result)->toArray();
			return ($rows);
			
        } catch (\Exception $e) {
            return false;
        }
        return false;
	}

}
