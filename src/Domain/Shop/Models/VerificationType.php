<?php

namespace Domain\Shop\Models;

/**
 * @property string $key
 * @property string $name
 */
class VerificationType extends Model
{
    const ACTIVATION = 1;

    const PASSWORD_RECOVERY = 2;
}
