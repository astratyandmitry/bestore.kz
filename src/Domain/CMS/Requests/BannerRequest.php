<?php

namespace Domain\CMS\Requests;

class BannerRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addRules([
                'title' => 'required|max:500',
                'about' => 'nullable|max:1000',
                'image' => 'required',
                'active' => 'boolean',
            ]);
    }
}
