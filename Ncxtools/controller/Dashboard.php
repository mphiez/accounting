<?php
namespace Neuron\Application\Ncxtools\Controller;

use Zend\View\Model\ViewModel;
use Neuron\Application\Ncxtools\Test;
use Neuron\Application\Ncxtools\Data as DataModel;

class Dashboard extends Controller {

    /* sample action with view */
    public function indexAction() {

        $cData = new DataModel(DataModel\Storage::factory($this->getDb($module = __NAMESPACE__, 'secondary'), $this->getConfig()));
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
}