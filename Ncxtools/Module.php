<?php
namespace Neuron\Application\Ncxtools;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {

    public function onBootstrap(MvcEvent $e) {

        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        /* trigger onstart */
        if ($manager = \Neuron\Application\Framework\Hook\Manager::get()) {
            $manager->trigger()->onStart();
        }
    }

    public function getConfig() {

        /* load global config */
        $file = __DIR__ . '/config/autoload/global.php';
        if (file_exists($file)) {
            $global = include($file);
        } else {
            $global = array();
        }
        /* return config */
        if (is_array($global)) {
            return array_merge_recursive($global, include(__DIR__ . '/config/module.config.php'));
        } else {
            return include(__DIR__ . '/config/module.config.php');
        }
    }

    public function getAutoloaderConfig() {

        /* Definisikan autoloader untuk controller spesifik aplikasi dan model aplikasi */
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ . '\Controller' => __DIR__ . '/controller',
                    __NAMESPACE__ => __DIR__ . '/model',
                ),
            ),
        );
    }

}