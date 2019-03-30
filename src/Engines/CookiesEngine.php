<?php

namespace ByTIC\PersistentData\Engines;

use Nip\Cookie\Jar as CookieJar;
use Nip\Records\Record;

/**
 * Class SessionEngine
 * @package ByTIC\PersistentData\Engines
 */
class CookiesEngine extends AbstractEngine
{
    protected $name = 'cookies';

    /**
     * @param $data
     * @return bool|int
     */
    protected function parseDataForModelFindParams($data)
    {
        if (empty($data)) {
            return false;
        }
        return intval($data);
    }

    /**
     * @param Record $model
     * @return mixed
     */
    protected function generateDataFromModel($model)
    {
        return $model->getPrimaryKey();
    }

    /**
     * @return mixed
     */
    protected function generateData()
    {
        $varName = $this->getVarName();

        return isset($_COOKIE[$varName]) ? $_COOKIE[$varName] : null;
    }

    /**
     * @param $data
     */
    protected function saveData($data)
    {
        $varName = $this->getVarName();
        CookieJar::instance()->newCookie()
            ->setName($varName)
            ->setValue($data)
            ->save();
    }

    public function removeCurrentModel()
    {
        $varName = $this->getVarName();
        CookieJar::instance()
            ->newCookie()->setName($varName)
            ->setValue(0)
            ->setExpire(time() - 1000)->save();
    }
}
