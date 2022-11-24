<?php
declare(strict_types=1);

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
     */
    protected function initCurrentModel(): void
    {
        $this->current = $this->generateCurrentModel();
    }

    /**
     * @return null|Record
     */
    protected function generateCurrentModel()
    {
        $data = $this->getData();
        if (is_object($data)) {
            $model = $this->getManager()->getModel();
            if ($data instanceof $model) {
                return $data;
            }
        }

        $model = $this->findModelFromData($data);
        if (!$this->validateModelFoundFromData($model)) {
            return null;
        }

        return $this->mergeDataIntoCurrentModel($model, $data);
    }

    /**
     * @param Record $model
     * @param array $data
     * @return Record
     */
    protected function mergeDataIntoCurrentModel($model, $data)
    {
        foreach ($data as $key => $value) {
            if (!isset($model->{$key})) {
                $model->{$key} = $value;
            }
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
