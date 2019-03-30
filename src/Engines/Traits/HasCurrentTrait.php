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
        $this->current = $this->generateCurrentModel();
    }

    /**
     * @return bool
     */
    protected function generateCurrentModel()
    {
        $data = $this->getData();
        $model = $this->findModelFromData($data);
        if (!$this->validateModelFoundFromData($model)) {
            return false;
        }

        return $model;
    }

    /**
     * @param $model
     * @return bool
     */
    protected function validateModelFoundFromData($model)
    {
        return is_object($model);
    }

    /**
     * @param $data
     * @return boolean|Record
     */
    protected function findModelFromData($data)
    {
        $recordId = $this->parseDataForModelFindParams($data);
        if ($recordId > 0) {
            return $this->getManager()->findOne($recordId);
        }

        return false;
    }

    /**
     * @param $data
     * @return bool|int
     */
    protected function parseDataForModelFindParams($data)
    {
        if (!is_array($data) || !isset($data['id']) || empty($data['id'])) {
            return false;
        }

        return intval($data['id']);
    }

    abstract public function removeCurrentModel();
}
