<?php

namespace ByTIC\PersistentData\Engines;

/**
 * Trait HasEnginesTrait
 * @package ByTIC\PersistentData\Engines
 */
trait HasEnginesTrait
{
    protected $pdEngines = null;

    /**
     * @return EngineCollection
     */
    public function getPersistentDataEngines()
    {
        if ($this->pdEngines === null) {
            $this->initPersistentDataEngines();
        }

        return $this->pdEngines;
    }

    /**
     * @param string $name
     * @return AbstractEngine
     */
    public function getPersistentDataEngine($name)
    {
        return $this->getPersistentDataEngines()->get($name);
    }

    protected function initPersistentDataEngines()
    {
        $this->pdEngines = $this->generatePersistentDataEngines();
    }

    /**
     * @return EngineCollection
     */
    protected function generatePersistentDataEngines()
    {
        $collection = new EngineCollection();
        $engineTypes = $this->getPersistentDataEnginesTypes();
        foreach ($engineTypes as $type) {
            $engine = $collection->addByEngineType($type);

            $class = get_class($this);
            $engine->setManagerName($class);
            $varName = method_exists($this, 'getTable') ? $this->getTable() : basename($class);
            $engine->setVarName($varName);
        }

        return $collection;
    }

    /**
     * @return array
     */
    protected function getPersistentDataEnginesTypes()
    {
        return ['session', 'cookies'];
    }
}
