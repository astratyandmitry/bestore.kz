<?php

namespace Domain\Shop\Models;

/**
 * @property string $key
 * @property string $name
 * @property string $css_color
 */
class OrderStatus extends Model
{
    const CREATED = 1;

    const COMPLETED = 2;

    const CANCELED = 3;

    /**
     * @return string
     */
    public function getCssColorAttribute(): string
    {
        switch ($this->id) {
            case self::CREATED:
                return 'info';
                break;
            case self::COMPLETED:
                return 'success';
                break;
            case self::CANCELED:
                return 'danger';
                break;
            default:
                return '';
                break;
        }
    }
}
