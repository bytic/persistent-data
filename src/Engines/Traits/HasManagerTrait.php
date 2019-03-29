<?php

namespace ByTIC\PersistentData\Engines\Traits;

use Nip\Records\Locator\ModelLocator;

/**
 * Class HasManagerTrait
 * @package ByTIC\PersistentData\Engines\Traits
 */
trait HasManagerTrait
{
    protected $managerName = null;

    /**
     * @return null
     */
    public function getManagerName()
    {
        return $this->managerName;
    }

    /**
     * @param null $managerName
     */
    public function setManagerName($managerName)
    {
        $this->managerName = $managerName;
    }

    /**
     * @return \Nip\Records\AbstractModels\RecordManager
     */
    public function getManager()
    {
        return ModelLocator::get($this->getManagerName());
    }
}
