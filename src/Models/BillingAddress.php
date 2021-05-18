<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class BillingAddress
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class BillingAddress extends BaseModel
{
    /**
     * @example "6F Launchpad"
     *
     * @var string
     */
    public $line1;

    /**
     * @example "Reliance Street"
     *
     * @var string
     */
    public $line2;

    /**
     * @example "Mandaluyong City"
     *
     * @var string
     */
    public $city;

    /**
     * @example "Metro Manila"
     *
     * @var string
     */
    public $state;

    /**
     * @example "1552"
     *
     * @var string
     */
    public $zipCode;

    /**
     * @example "PH"
     *
     * @var string
     */
    public $countryCode;

    /**
     * Actions to perform prior to serialization.
     *
     * @return void
     */
    public function performBeforeSerialize(): void
    {
        // TODO: Implement performBeforeSerialize() method.
    }
}
