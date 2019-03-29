<?php

namespace ByTIC\PersistentData\Legacy;

use Nip\Records\Record as Record;

/**
 * Trait PersistentManagerTrait
 * @package ByTIC\PersistentData\Legacy
 */
trait PersistentManagerTrait
{

    /**
     * Get persisted Record from Session
     *
     * @return bool|Record
     * @deprecated Rely only on engine methods
     */
    public function getFromSession()
    {
        return $this->getPersistentDataEngine('session')->getCurrentModel();
    }

    /**
     * Get persistent record from Cookie
     *
     * @return bool|Record
     * @deprecated Rely only on engine methods
     */
    public function getFromCookie()
    {
        return $this->getPersistentDataEngine('cookies')->getCurrentModel();
    }
}
