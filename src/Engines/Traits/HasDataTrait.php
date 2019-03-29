<?php

namespace ByTIC\PersistentData\Engines\Traits;

use Nip\Records\Record;

/**
 * Class HasDataTrait
 * @package ByTIC\PersistentData\Engines\Traits
 */
trait HasDataTrait
{
    protected $data = null;

    /**
     * @return null
     */
    public function getData()
    {
        if ($this->data === null) {
            $this->initData();
        }

        return $this->data;
    }

    /**
     * @param null $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param null $data
     */
    public function setSaveData($data)
    {
        $this->setData($data);
        $this->saveData($data);
    }

    protected function initData()
    {
        $this->data = $this->generateData();
    }

    /**
     * @param Record $model
     * @return mixed
     */
    protected function generateDataFromModel($model)
    {
        $method = 'generatePersistentData'.ucfirst($this->getName());
        if (method_exists($model, $method)) {
            return $model->$method();
        }
        if (method_exists($model, 'toArray')) {
            return $model->toArray();
        }

        return $model->getPrimaryKey();
    }

    /**
     * @return mixed
     */
    abstract protected function generateData();

    /**
     * @param $data
     */
    abstract protected function saveData($data);
}
