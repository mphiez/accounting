<?php
namespace Neuron\Application\Skeleton\Model\Storage;

use Neuron\Application\Skeleton\Model;
use Neuron\Db\Storage;

class Mysql extends Storage
{
    public function save(Model $model, $update = false)
    {
        try {
            if ($update) {
                $update = $this->update();
                $update->table($this->_tables['models']);
                $update->set($this->__($model->pull(Model::PULL_EXCLUDE)));
                $update->where($this->__(array('model_id' => $model->id)));
                // error_log('$update => ' . str_replace('"', '', $update->getSqlString()));
                if ($this->execute($update)) {
                    return $model->id;
                }
            } else {
                $insert = $this->insert();
                $insert->into($this->_tables['models']);
                $insert->autoincrement($this->_('model_id'));
                $insert->values($this->__($model->pull(Model::PULL_EXCLUDE)));
                // error_log('$insert => ' . str_replace('"', '', $insert->getSqlString()));
                if ($id = $this->execute($insert)) {
                    return $id;
                }
            }

            return false;

        } catch (\Exception $ex) {
            return false;
        }
    }

    public function load($id, $mode = Model\Storage::LOADBY_ID)
    {
        try {
            $select = $this->select();
            $select->from(array('a' => $this->_tables['models']));

            switch ($mode) {
                case Model\Storage::LOADBY_ID:
                    $select->where($this->__(array('model_id' => $id)));
                    break;
                case Model\Storage::LOADBY_NAME:
                    $select->where($this->__(array('LOWER(a.name) = \'' . strtolower($id) . '\'')));
                    break;
                default:
                    $select->where($this->__(array('model_id' => $id)));
            }
            // error_log('$select => ' . str_replace('"', '', $select->getSqlString()));
            return $this->fetchRow($select);

        } catch (\Exception $ex) {
            return false;
        }
    }
}
