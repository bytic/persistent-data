<?php

namespace ByTIC\PersistentData\Engines\Traits;

use Nip\Records\Record;

/**
 * Class HasCurrentTrait
 * @package ByTIC\PersistentData\Engines\Traits
 */
trait HasCurrentTrait
{
    protected $current = null;


    /**
     * @return false|Record
     */
    public function getCurrentModel()
    {
        if ($this->current === null) {
            $this->initCurrentModel();
        }

        return $this->current;
    }

    /**
     * @param $model
     */
    public function saveCurrentModel($model)
    {
        $this->current = $model;
        $data = $this->generateDataFromModel($model);
        $this->setSaveData($data);
    }

    /**
     * @return bool
     */
    protected function initCurrentModel()
    {
        $data = $this->getData();
        $model = $this->findModelFromData($data);
        if ($model) {
            return $model;
        }

        return false;
    }

    /**
     * @param $data
     * @return boolean|Record
     */
    protected function findModelFromData($data)
    {
        if (is_array($data)) {
            if (isset($data['id']) && !empty($data['id'])) {
                $recordId = intval($data['id']);

                return $this->getManager()->findOne($recordId);
            }
        }

        return false;
    }

    abstract public function removeCurrentModel();
}
