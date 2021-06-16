<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class AmountDetails
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class AmountDetails extends BaseModel
{
    /**
     * This field may be used to ask PayMaya Payment Gateway (PG) to reconcile the values under totalAmount.details with totalAmount.value.
     * PG will not allow the creation of the checkout record if the sum of numeric values in totalAmount.details does not equal to totalAmount.value.
     *
     * @var bool|null
     */
    public $strict = FALSE;

    /**
     * Discount
     *
     * @var string|null
     */
    public $discount;

    /**
     * Service Charge
     *
     * @var string|null
     */
    public $serviceCharge;

    /**
     * Shipping Fee
     *
     * @var string|null
     */
    public $shippingFee;

    /**
     * Tax
     *
     * @var string|null
     */
    public $tax;

    /**
     * Subtotal
     *
     * @var string|null
     */
    public $subtotal;
}
