<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Dawul\NewUsers;
use App\Nova\Metrics\LiveUsers;
use App\Nova\Metrics\NewSubscribers;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersPerLevel;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
        ];
    }
}
