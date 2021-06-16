<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class PaymentRefund
 * @package FourelloDevs\Paymaya\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-06-16
 */
class PaymentRefund extends BaseModel
{
    /**
     * @example b998121a-6000-48b4-8d28-ea90e597ff65
     *
     * @var string
     */
    public $id;

    /**
     * @example Item unavailable
     *
     * @var string
     */
    public $reason;

    /**
     * @example 50
     *
     * @var string
     */
    public $amount;

    /**
     * @example PHP
     *
     * @var string
     */
    public $currency;

    /**
     * @example SUCCESS
     *
     * @var string
     */
    public $status;

    /**
     * @example db279754-b9b5-4af1-b3bd-02d04006e784
     *
     * @var string
     */
    public $payment;

    /**
     * @example 987654321
     *
     * @var string
     */
    public $requestReferenceNumber;

    /**
     * @example 2021-06-16T07:57:19.000Z
     *
     * @var string
     */
    public $refundAt;

    /**
     * @example 2021-06-16T07:57:19.000Z
     *
     * @var string
     */
    public $createdAt;

    /**
     * @example 2021-06-16T07:57:19.000Z
     *
     * @var string
     */
    public $updatedAt;
}
