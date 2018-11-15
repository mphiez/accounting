<?php
namespace Neuron\Application\Ncxtools\Controller;
use Neuron\Access;

class Controller extends \Neuron\Application\Framework\Controller\Controller {
	
	protected $_session = null;
	
	public function getSession($start = true) {

        if ($this->_session)
            return $this->_session;

        /* get session config */
        $config = $this->getConfig();
        if (isset($config['session'])) {
            $config = $config['session'];
        } else {
            $config = array();
        }

        /* session name */
        $name = isset($config['name']) ? $config['name'] : 'NEURON';

        /* mode */
        $mode = isset($config['mode']) ? $config['mode'] : '';
        if ($mode == 'database') {
            $config['adapter'] = $this->getDb();
            $mode = Access\Session::MODE_DATABASE;
        } elseif ($mode == 'cache') {
            $mode = Access\Session::MODE_CACHE;
        } else {
            $mode = Access\Session::MODE_DEFAULT;
        }

        /* new session */
        $session = new Access\Session($name, $mode, $config);
        if ($start) {
            $session->start();
        }
        $this->_session = $session;

        /* return */
        return $session;
    }
	
	public function getDb($module = __NAMESPACE__, $channel = 'primary') {
        return parent::getDb($module, $channel);
    }
	
	public function getServerConfig() {
		$config = array(
					'server_prosedure' 	=> $this->getConfig()['server'],
					'server_table' 		=> $this->getConfig()['table'],
					'server_update' 	=> $this->getConfig()['user_update'],
					'server_order'	 	=> $this->getConfig()['data_order'],
					'server_termin' 	=> $this->getConfig()['data_termin'],
					'server_data' 		=> $this->getConfig()['from_data'],
					);
		return $config;
    }
}