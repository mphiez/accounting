<?php

namespace Neuron\Application\Ncxtools\Data\Storage;

use Zend\Db\Sql\Predicate\Expression;

class Mysql extends \Neuron\Db\Storage implements Skeleton {

    public function userActivity() {
        try {
            $select = $this->select();
            $select->from($this->_tables['users']);
			// echo ('$select => '.str_replace('"','',$select->getSqlString()));
            return $this->fetchAll($select);
        } catch (\Exception $ex) {
            return false;
        }
    }
	
    public function loadData($code = null, $guid = null, $param=array()) {
        try {
            $select = $this->select();
            $select->from($this->_tables['users']);
            $data = $this->fetchAll($select);
			$dataAll = array();
			if(!empty($data) and $data != ''){
				foreach($data as $row) {
					array_push($dataAll, $row);
				}
			}
			return $dataAll;
        } catch (\Exception $ex) {
            return false;
        }
    }
	
    public function loadRekap($code = null, $guid = null, $param=array()) {
        try {
            $select = $this->select();
            $select->from($this->_tables['rekap']);
			
			// echo ('$select => '.str_replace('"','',$select->getSqlString()));
			
            $data = $this->fetchAll($select);
			$dataAll = array();
			if(!empty($data) and $data != ''){
				foreach($data as $row) {
					array_push($dataAll, $row);
				}
			}
			return $dataAll;
        } catch (\Exception $ex) {
            return false;
        }
    }
        
	public function loadOgp($data) {
		try {
			$select = $this->select();
            $select->from($this->_tables['ncx_ogp']);
			$select->columns(array(
					'PROCESS' => $this->_('PROCESS'),
					'ID_SUBPROCESS' => $this->_('ID_SUBPROCESS'),
					'ORDER_SUBPROCESS' => $this->_('ORDER_SUBPROCESS'),
					'DBS_7' => new Expression("sum(CASE WHEN DIVISI = 'DBS' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'DBS_15' => new Expression("sum(CASE WHEN DIVISI = 'DBS' AND KATEGORI_UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END)"),
					'DBS_16' => new Expression("sum(CASE WHEN DIVISI = 'DBS' AND KATEGORI_UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END)"),
					'DBS_TOTAL' => new Expression("sum(CASE WHEN DIVISI = 'DBS' THEN n_order ELSE 0 END)"),
					'DES_7' => new Expression("sum(CASE WHEN DIVISI = 'DES' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'DES_15' => new Expression("sum(CASE WHEN DIVISI = 'DES' AND KATEGORI_UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END)"),
					'DES_16' => new Expression("sum(CASE WHEN DIVISI = 'DES' AND KATEGORI_UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END)"),
					'DES_TOTAL' => new Expression("sum(CASE WHEN DIVISI = 'DES' THEN n_order ELSE 0 END)"),
					'DGS_7' => new Expression("sum(CASE WHEN DIVISI = 'DGS' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'DGS_15' => new Expression("sum(CASE WHEN DIVISI = 'DGS' AND KATEGORI_UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END)"),
					'DGS_16' => new Expression("sum(CASE WHEN DIVISI = 'DGS' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'DGS_TOTAL' => new Expression("sum(CASE WHEN DIVISI = 'DGS' THEN n_order ELSE 0 END)"),
			));
			
			if(isset($data['data']['periode_create']) and $data['data']['periode_create'] != ''){
				$select->where(array(
					'PERIODE_CREATE' => $data['data']['periode_create']
				));
			}
			
			if(isset($data['data']['order_type']) and $data['data']['order_type'] != ''){
				$select->where(array(
					'ORDER_TYPE' => $data['data']['order_type']
				));
			}
			
			if(isset($data['data']['order_status']) and $data['data']['order_status'] != ''){
				$select->where(array(
					'ORDER_STATUS' => $data['data']['order_status']
				));
			}
			
			if(isset($data['data']['divisi']) and $data['data']['divisi'] != ''){
				$select->where(array(
					'DICISI' => $data['data']['divisi']
				));
			}
			
			if(isset($data['data']['segmen']) and $data['data']['segmen'] != ''){
				$select->where(array(
					'SEGMEN' => $data['data']['segmen']
				));
			}
			
			if(isset($data['data']['am']) and $data['data']['am'] != ''){
				$select->where(array(
					'AM' => $data['data']['am']
				));
			}
			
			if(isset($data['data']['umur_order']) and $data['data']['umur_order'] != ''){
				$select->where(array(
					'UMUR_ORDER' => $data['data']['umur_order']
				));
			}
			
			if(isset($data['data']['umur_status_order']) and $data['data']['umur_status_order'] != ''){
				$select->where(array(
					'UMUR_ORDER_STATUS' => $data['data']['umur_status_order']
				));
			}
			
			$select->group(array(
				$this->__('PROCESS'),
				$this->__('ID_SUBPROCESS'),
				$this->__('ORDER_SUBPROCESS'),
			));
			
			$select->order($this->__('ID_SUBPROCESS'));
			
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
        
	public function loadAm($data) {
		try {
			$select = $this->select();
            $select->from($this->_tables['ncx_ogp']);
			$select->columns(array(
					'process' => $this->_('am'),
					'ID_SUBPROCESS' => $this->_('process'),
					'ORDER_SUBPROCESS' => $this->_('ORDER_SUBPROCESS'),
					'dbs_7' => new Expression("sum(CASE WHEN DIVISI = 'DBS' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'dbs_15' => new Expression("sum(CASE WHEN DIVISI = 'DBS' AND KATEGORI_UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END)"),
					'dbs_16' => new Expression("sum(CASE WHEN DIVISI = 'DBS' AND KATEGORI_UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END)"),
					'dbs_total' => new Expression("sum(CASE WHEN DIVISI = 'DBS' THEN n_order ELSE 0 END)"),
					'des_7' => new Expression("sum(CASE WHEN DIVISI = 'DES' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'des_15' => new Expression("sum(CASE WHEN DIVISI = 'DES' AND KATEGORI_UMUR_ORDER = '7 - 15 Hari' THEN n_order ELSE 0 END)"),
					'des_16' => new Expression("sum(CASE WHEN DIVISI = 'DES' AND KATEGORI_UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END)"),
					'des_total' => new Expression("sum(CASE WHEN DIVISI = 'DES' THEN n_order ELSE 0 END)"),
					'dgs_7' => new Expression("sum(CASE WHEN DIVISI = 'DGS' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'dgs_15' => new Expression("sum(CASE WHEN DIVISI = 'DGS' AND KATEGORI_UMUR_ORDER = '> 15 Hari' THEN n_order ELSE 0 END)"),
					'dgs_16' => new Expression("sum(CASE WHEN DIVISI = 'DGS' AND KATEGORI_UMUR_ORDER = '0 - 7 Hari' THEN n_order ELSE 0 END)"),
					'dgs_total' => new Expression("sum(CASE WHEN DIVISI = 'DGS' THEN n_order ELSE 0 END)"),
			));
			
			if(isset($data['data']['periode_create']) and $data['data']['periode_create'] != ''){
				$select->where(array(
					'periode_create' => $data['data']['periode_create']
				));
			}
			
			if(isset($data['data']['order_type']) and $data['data']['order_type'] != ''){
				$select->where(array(
					'order_type' => $data['data']['order_type']
				));
			}
			
			if(isset($data['data']['order_status']) and $data['data']['order_status'] != ''){
				$select->where(array(
					'order_status' => $data['data']['order_status']
				));
			}
			
			if(isset($data['data']['divisi']) and $data['data']['divisi'] != ''){
				$select->where(array(
					'divisi' => $data['data']['divisi']
				));
			}
			
			if(isset($data['data']['segmen']) and $data['data']['segmen'] != ''){
				$select->where(array(
					'segmen' => $data['data']['segmen']
				));
			}
			
			if(isset($data['data']['am']) and $data['data']['am'] != ''){
				$select->where(array(
					'am' => $data['data']['am']
				));
			}
			
			if(isset($data['data']['umur_order']) and $data['data']['umur_order'] != ''){
				$select->where(array(
					'umur_order' => $data['data']['umur_order']
				));
			}
			
			if(isset($data['data']['umur_status_order']) and $data['data']['umur_status_order'] != ''){
				$select->where(array(
					'umur_order_status' => $data['data']['umur_status_order']
				));
			}
			
			$select->group(array(
				$this->__('AM'),
				$this->__('PROCESS'),
				$this->__('ID_SUBPROCESS'),
				$this->__('ORDER_SUBPROCESS'),
			));
			
			$select->order(array($this->__('PROCESS'),$this->__('AM')));
			
			//echo str_replace('"','',$select->getSqlString());
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
        
	public function loadquote($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_quote']);
			
			$select->columns(array(
				'STATUS_QUOTE' => $this->_('STATUS_QUOTE'),
				'DBS' => new Expression("sum(CASE WHEN DIVISI = 'DBS' THEN n_quote ELSE 0 END)"),
				'DCS' => new Expression("sum(CASE WHEN DIVISI = 'DCS' THEN n_quote ELSE 0 END)"),
				'DGS' => new Expression("sum(CASE WHEN DIVISI = 'DGS' THEN n_quote ELSE 0 END)"),
			));
			
			$select->group(array(
					$this->__('STATUS_QUOTE'),
			));
			
			$select->order($this->__('STATUS_ID'));
			
			//echo str_replace('"','',$select->getSqlString());
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
        
	public function periode_create($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_ogp']);
			
			$select->columns(array(
				'periode_create' => $this->_('periode_create'),
			));
			
			$select->group(array(
					$this->__('periode_create'),
			));
			
			$select->order($this->__('periode_create'));
			
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
        
	public function order_type($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_ogp']);
			
			$select->columns(array(
				'order_type' => $this->_('order_type'),
			));
			
			$select->group(array(
					$this->__('order_type'),
			));
			
			$select->order($this->__('order_type'));
			
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
        
	public function order_status($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_ogp']);
			
			$select->columns(array(
				'order_status' => $this->_('order_status'),
			));
			
			$select->group(array(
					$this->__('order_status'),
			));
			
			$select->order($this->__('order_status'));
			
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
        
	public function divisi($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_ogp']);
			
			$select->columns(array(
				'divisi' => $this->_('divisi'),
			));
			
			$select->group(array(
					$this->__('divisi'),
			));
			
			$select->order($this->__('divisi'));
			
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
        
	public function segmen($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_ogp']);
			
			$select->columns(array(
				'segmen' => $this->_('segmen'),
			));
			
			$select->group(array(
					$this->__('segmen'),
			));
			
			$select->order($this->__('segmen'));
			
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
        
	public function am($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_ogp']);
			
			$select->columns(array(
				'am' => $this->_('am'),
			));
			
			$select->group(array(
					$this->__('am'),
			));
			
			$select->order($this->__('am'));
			
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
        
	public function status_quote($code = null, $guid = null, $param=array()) {
		try {
			$select = $this->select();
			
			$select->from($this->_tables['ncx_quote']);
			
			$select->columns(array(
				'status_quote' => $this->_('status_quote'),
			));
			
			$select->group(array(
					$this->__('status_quote'),
			));
			
			$select->order($this->__('status_quote'));
			
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
	
}
