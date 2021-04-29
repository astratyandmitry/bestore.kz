<?php

namespace Domain\CMS\Actions;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
interface ActionInterface
{
    /**
     * @return void
     */
    public function execute(): void;
}
