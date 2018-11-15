<?php
namespace Neuron\Application\Ncxtools\Controller;

use Zend\View\Model\ViewModel;
use Neuron\Application\Ncxtools\Test;
use Neuron\Application\Ncxtools\Data as DataModel;

class Tools extends Controller {

    /* sample action with view */
    public function searchAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
    public function uploadAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
    public function formAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
    public function reportAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
    public function DashboardAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
    public function CreateAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
    public function DetailAction() {
		$id = $this->params('id_detail');
        $view = new ViewModel();
		
		$view->setVariables(array(
			'detail_id'     => $id,
        ));

        return $view;
    }
	
	public function UpdateCaAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function UpdateBaAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function UpdateSaAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function MergeCaAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function MergeBaAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function MergeSaAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function MasterAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function TerminAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function OrderAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function ogpdashboardAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function ogpdetailAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function bulkupdateAction() {
        $view = new ViewModel();

        return $view;
    }
	
	public function bulkMoveAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function bulkMergeAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function bulkTerminAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function bulkOrderAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function downloadDetailAction() {
		$this->layout('layout/layoutblank');
        $view = new ViewModel();

        return $view;
    }
	
	public function sequenceAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function detailSequenceAction() {
		
        $view = new ViewModel();

        return $view;
    }

     public function inboxAction() {
        
        $view = new ViewModel();

        return $view;
    }
	
	public function billingAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function detailbillingAction() {
		
        $view = new ViewModel();

        return $view;
    }
	
	public function caCustrefAction() {
		
		$cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));
        return $view;
    }
	
	public function baAccnumAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function cabaCustrefaacnumAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function tibsNcxAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function billcomNcxTibsAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function tibsNcxBillcomAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsSidAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsPrinceAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsBilldateAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsPpnAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsTopAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function businessAreaAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function tanggalContractAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function cpAddressAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function latlongAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleSidAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleNoparentAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function missingBillingAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleAoAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleMoAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleMrcAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function rekonAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function caCustrefDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function baAccnumDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function cabaCustrefaacnumDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function tibsNcxDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function billcomNcxTibsDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function tibsNcxBillcomDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsSidDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsPrinceDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsBilldateDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsPpnDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function ncxTibsTopDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function businessAreaDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function tanggalContractDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function cpAddressDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function latlongDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleSidDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleNoparentDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function missingBillingDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleAoDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleMoDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function doubleMrcDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function sidNcxNossAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function sidNcxNossDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function sidNcxNossAssetAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function sidNcxNossAssetDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function baNcxTremsAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function baNcxTremsDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function falloutNosAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function revCodeAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function revCodeDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function baTibsTremsAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function baTibsTremsDetailAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function serviceAddrNcxAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function orderDateAgreementAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
	
	public function rekonDownloadAction() {
		
        $cData = new DataModel(DataModel\Storage::factory($this->getDb(), $this->getConfig()));
            
        $result = $cData->getMenu();

		$result->data;        
		
		$view = new ViewModel();
		$view->setVariables(array(
			'menu_rekon'     => $result->data,
        ));

        return $view;
    }
}