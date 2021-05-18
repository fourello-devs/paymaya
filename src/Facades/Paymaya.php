<?php

namespace FourelloDevs\Paymaya\Facades;

use Illuminate\Support\Facades\Facade;

class Paymaya extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'paymaya';
    }
}
