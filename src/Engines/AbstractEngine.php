<?php

namespace ByTIC\PersistentData\Engines;

/**
 * Class AbstractEngine
 * @package ByTIC\PersistentData\Engines
 */
abstract class AbstractEngine
{
    use Traits\HasManagerTrait;
    use Traits\HasCurrentTrait;
    use Traits\HasVarNameTrait;
    use Traits\HasDataTrait;

    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
