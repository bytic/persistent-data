<?php

namespace ByTIC\PersistentData\Engines;

use Nip\Collections\Collection;
use Nip\Records\Record;

/**
 * Class EngineCollection
 * @package ByTIC\PersistentData\Engines
 */
class EngineCollection extends Collection
{
    /**
     * @return bool|Record
     */
    public function getCurrentModel()
    {
        foreach ($this as $engine) {
            $model = $engine->getCurrentModel();
            if ($model) {
                return $model;
            }
        }

        return false;
    }

    /**
     * @param $model
     */
    public function saveCurrentModel($model)
    {
        foreach ($this as $engine) {
            $engine->saveCurrentModel($model);
        }
    }

    public function removeCurrentModel()
    {
        foreach ($this as $engine) {
            $engine->removeCurrentModel();
        }
    }

    /**
     * @param string $type
     * @return AbstractEngine
     */
    public function addByEngineType($type)
    {
        $class = (strpos($type, '\\')) ? $type : '\ByTIC\PersistentData\Engines\\' . ucfirst($type) . 'Engine';
        $engine = new $class();
        $this->addEngine($engine);

        return $engine;
    }

    /**
     * @param string $name
     */
    public function setManagerName($name)
    {
        foreach ($this as $engine) {
            /** @var AbstractEngine $engine */
            $engine->setManagerName($name);
        }
    }

    /**
     * @param AbstractEngine $engine
     */
    public function addEngine(AbstractEngine $engine)
    {
        $this->add($engine, $engine->getName());
    }
}
