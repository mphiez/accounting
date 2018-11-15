<?php

namespace Neuron\Application\Ncxtools\Data;

class Storage {

    public static function factory(\Zend\Db\Adapter\Adapter $adapter, $config = array()) {

        /* Oracle? Buat storage Oci8, selain itu pakai MySQL */
        if ($adapter->getDriver() instanceof \Zend\Db\Adapter\Driver\Oci8\Oci8) {
            return new Storage\Oci8($adapter, $config);
        } else {
            return new Storage\Mysql($adapter, $config);
        }
    }

}
