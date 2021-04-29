<?php

namespace Domain\Shop\Common;

use Domain\Shop\Models\City;
use Domain\Shop\Models\Model;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\AimSection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class Layout
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $meta_description;

    /**
     * @var string
     */
    public $meta_keywords;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var boolean
     */
    public $withBreadcrumbs = true;

    /**
     * @var boolean
     */
    public $withTitle = true;

    /**
     * @var array
     */
    public $breadcrumbs = [];

    /**
     * @var bool
     */
    protected $forCity = false;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->setupData();
    }

    /**
     * @return void
     */
    private function setupData(): void
    {
        $this->data['cities'] = City::query()->get();
        $this->data['aims'] = AimSection::query()->get();
        $this->data['categories'] = Category::query()->whereNull('parent_id')->with('children')->get();
    }

    /**
     * @param string|null $title
     * @return \Domain\Shop\Common\Layout
     */
    public function setTitle(?string $title = null): Layout
    {
        $this->title = $title;

        if ($this->forCity === true) {
            $this->title .= ' в '.$this->getCity()->name.' купить';
        }

        return $this;
    }

    /**
     * @param \Domain\Shop\Models\Model $model
     * @return \Domain\Shop\Common\Layout
     */
    public function setMeta(Model $model): Layout
    {
        foreach (['meta_description', 'meta_keywords'] as $metaAttribute) {
            if (property_exists($model, $metaAttribute)) {
                $this->{$metaAttribute} = $model->getAttribute($metaAttribute);
            }
        }

        return $this;
    }

    /**
     * @return \Domain\Shop\Models\City
     */
    public function getCity(): City
    {
        return $this->getCities()->where('id', Session::get('shop.city_id'))->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Domain\Shop\Models\City[]
     */
    public function getCities(): Collection
    {
        return $this->data['cities'];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Domain\Shop\Models\AimSection[]
     */
    public function getAims(): Collection
    {
        return $this->data['aims'];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Domain\Shop\Models\Category[]
     */
    public function getCategories(): Collection
    {
        return $this->data['categories'];
    }

    /**
     * @return \Domain\Shop\Common\Layout
     */
    public function hideBreadcrumbs(): Layout
    {
        $this->withBreadcrumbs = false;

        return $this;
    }

    /**
     * @return \Domain\Shop\Common\Layout
     */
    public function hideTitle(): Layout
    {
        $this->withTitle = false;

        return $this;
    }

    /**
     * @param string $breadcrumb
     * @param string $url
     * @return \Domain\Shop\Common\Layout
     */
    public function addBreadcrumb(string $breadcrumb, string $url = '#'): Layout
    {
        $this->breadcrumbs[$url] = $breadcrumb;

        return $this;
    }

    /**
     * @return \Domain\Shop\Common\Layout
     */
    public function addCatalogBreadcrumb(): Layout
    {
        $this->breadcrumbs[route('shop::categories')] = 'Каталог';

        return $this;
    }

    /**
     * @param array $breadcrumbs
     * @return \Domain\Shop\Common\Layout
     */
    public function setBreadcrumbs(array $breadcrumbs): Layout
    {
        $this->breadcrumbs = $breadcrumbs;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasBreadcrumbs(): bool
    {
        return count($this->breadcrumbs) > 0;
    }

    /**
     * @return \Domain\Shop\Common\Layout
     */
    public function forCity(): Layout
    {
        $this->forCity = true;

        return $this;
    }
}
