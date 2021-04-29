<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\AimSectionsRepository;
use Illuminate\View\View;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class AimSectionController extends Controller
{
    /**
     * @param string $hru
     * @param \Domain\Shop\Repositories\AimSectionsRepository $repository
     * @return \Illuminate\View\View
     */
    public function __invoke(string $hru, AimSectionsRepository $repository): View
    {
        $aimSection = $repository->findByHru($hru);

        $this->layout
            ->setTitle($aimSection->title)
            ->setMeta($aimSection)
            ->addBreadcrumb($aimSection->name);

        return $this->view('aim_section.show', [
            'aim_section' => $repository->findByHru($hru),
        ]);
    }
}
