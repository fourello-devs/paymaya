<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class Amount
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class Amount extends BaseModel
{
    /**
     * Currency
     * @example "PHP"
     *
     * @var string
     */
    public $currency = "PHP";

    /**
     * Value
     * @example "1100.00"
     *
     * @var string
     */
    public $value;


    /**
     * Amount
     * @example "1100.00
     *
     * @var string
     */
    public $amount;

    /**
     * Amount Details
     *
     * @var AmountDetails
     */
    public $details;

    /**
     * @param AmountDetails|array $details
     */
    public function setDetails($details): void
    {
        $this->details = is_array($details) ? new AmountDetails($details) : $details;
    }
}
