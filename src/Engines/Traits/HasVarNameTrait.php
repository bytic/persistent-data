<?php

namespace ByTIC\PersistentData\Engines\Traits;

/**
 * Class HasVarNameTrait
 * @package ByTIC\PersistentData\Engines\Traits
 */
trait HasVarNameTrait
{
    protected $varName;

    /**
     * @return mixed
     */
    public function getVarName()
    {
        return $this->varName;
    }

    /**
     * @param mixed $varName
     */
    public function setVarName($varName)
    {
        $this->varName = $varName;
    }
}
