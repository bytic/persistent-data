<?php
declare(strict_types=1);

namespace ByTIC\PersistentData\Engines;

use Nip\Http\Request;

/**
 * Class RequestEngine
 * @package ByTIC\PersistentData\Engines
 */
class RequestEngine extends AbstractEngine
{
    protected $name = 'request';

    protected Request $request;

    public function __construct()
    {
        $this->request = request();
    }


    /**
     * @return mixed
     */
    protected function generateData()
    {
        $varName = $this->getVarName();

        return $this->request->attributes->get($varName);
    }

    /**
     * @param $data
     */
    protected function saveData($data)
    {
        $varName = $this->getVarName();
        $this->request->attributes->set($varName, $data);
    }

    public function removeCurrentModel()
    {
        $varName = $this->getVarName();
        $this->request->attributes->remove($varName);
    }
}
