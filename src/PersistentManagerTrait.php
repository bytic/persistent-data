<?php

namespace ByTIC\PersistentData;

use ByTIC\PersistentData\Engines\HasEnginesTrait;
use ByTIC\PersistentData\Legacy\PersistentManagerTrait as LegacyPersistentManagerTrait;
use Nip\Records\Record as Record;

/**
 * Trait PersistentManagerTrait
 * @package ByTIC\PersistentData
 */
trait PersistentManagerTrait
{
    use HasEnginesTrait;
    use LegacyPersistentManagerTrait;

    /**
     * Persistant record
     *
     * @var Record
     */
    protected $current;

    /**
     * Get current Persisted record
     *
     * @return Record
     */
    public function getCurrent()
    {
        if ($this->current === null) {
            $this->initCurrent();
        }

        return $this->current;
    }

    protected function initCurrent()
    {
        $this->current = false;

        $item = $this->getPersistentDataEngines()->getCurrentModel();

        if ($item && $this->checkAccessCurrent($item)) {
            $this->beforeSetCurrent($item);
            $this->setAndSaveCurrent($item);
        } else {
            $this->setCurrent($this->getCurrentDefault());
        }
    }

    /**
     * Set the curent item in class
     *
     * @param Record|boolean $item Model to be persisted
     *
     * @return $this
     */
    public function setCurrent($item = false)
    {
        $this->current = $item;

        return $this;
    }

    /**
     * Check if the current user has access to model persisted
     *
     * @param Record $item Model to be persisted
     *
     * @return bool
     */
    public function checkAccessCurrent($item)
    {
        return is_object($item);
    }

    /**
     * Set and save persisted model
     *
     * @param Record|boolean $item
     *
     * @return $this
     */
    public function setAndSaveCurrent($item = false)
    {
        $this->setCurrent($item);
        $this->savePersistCurrent($item);

        return $this;
    }

    /**
     * @param Record|boolean $item
     * @return $this
     */
    public function savePersistCurrent($item)
    {
        if (is_object($item)) {
            $this->getPersistentDataEngines()->saveCurrentModel($item);
        } else {
            $this->getPersistentDataEngines()->removeCurrentModel();
        }

        return $this;
    }

    /**
     * Returns current default Persisted Record
     *
     * @return bool|mixed
     */
    public function getCurrentDefault()
    {
        return false;
    }

    /**
     * Method triggered before setting current model
     *
     * @param Record $item Model to be persisted
     *
     * @return void
     */
    public function beforeSetCurrent($item)
    {
    }
}
