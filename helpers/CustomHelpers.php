<?php

use FourelloDevs\Paymaya\Paymaya;

if (! function_exists('paymaya')) {

    /**
     * @return Paymaya
     */
    function paymaya(): Paymaya
    {
        return resolve('paymaya');
    }
}
