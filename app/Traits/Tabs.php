<?php

namespace App\Traits;

use App\Models\Front\DrProfile;

trait Tabs
{
    public $tabs;
    public $activeTab;

    public function mountTabs()
    {
        $this->tabs = DrProfile::TABS;
        $routeSegments = request()->segments();
        $this->activeTab = end($routeSegments);
    }
}