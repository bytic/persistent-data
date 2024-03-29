<?php
declare(strict_types=1);

namespace ByTIC\PersistentData\Engines;

/**
 * Class SessionEngine
 * @package ByTIC\PersistentData\Engines
 */
class SessionEngine extends AbstractEngine
{
    protected $name = 'session';

    /**
     * @return mixed
     */
    protected function generateData()
    {
        $varName = $this->getVarName();

        return $_SESSION[$varName] ?? null;
    }

    /**
     * @param $data
     */
    protected function saveData($data)
    {
        $varName = $this->getVarName();
        $_SESSION[$varName] = $data;
    }

    public function removeCurrentModel()
    {
        $varName = $this->getVarName();
        unset($_SESSION[$varName]);
    }
}
