<?php

namespace Domain\CMS\Models;

/**
 * @property string $key
 * @property string $name
 */
class ManagerRole extends Model
{
    const ADMIN = 1;

    const MANAGER = 2;

    /**
     * @return bool
     */
    public function admin(): bool
    {
        return $this->id === self::ADMIN;
    }

    /**
     * @return bool
     */
    public function manager(): bool
    {
        return $this->id === self::MANAGER;
    }
}
