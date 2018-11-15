<?php
namespace Neuron\Application\Ncxtools\Controller;

use Zend\View\Model\ViewModel;
use Neuron\Application\Ncxtools\Test;
use Neuron\Application\Ncxtools\Data as DataModel;

class Index extends Controller {

    /* sample action with view */
    public function indexAction() {

        $cData = new DataModel(DataModel\Storage::factory($this->getDb($module = __NAMESPACE__, 'primary'), $this->getConfig()));
        $result = $cData->userActivity();
		
		$test = new Test();
        $view = new ViewModel();
        $view->setVariables(array(
            'name' => $test->getName(),
            'title' => $test->getTitle(),
            'tagline' => $test->getTagline(),
        ));

        return $view;
    }

    /* sample action with JSON output */
    public function jsonAction() {

        $test = new Test();
        $result = $test->getResult();

        return $this->getREST()->getResponse($result);
    }
	
    public function ogpdashboardAction() {

        $view = new ViewModel();

        return $view;
    }
}