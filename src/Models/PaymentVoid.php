<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class PaymentVoid
 * @package FourelloDevs\Paymaya\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-06-16
 */
class PaymentVoid extends BaseModel
{
    /**
     * @example "2fdf609f-39e1-4cfa-9986-0623bf527575"
     *
     * @var string
     */
    public $id;

    /**
     * @example "c493766c-ad8f-4304-a8cc-4cccaf094b30"
     *
     * @var string
     */
    public $payment;

    /**
     * @example "SUCCESS"
     *
     * @var string
     */
    public $status;

    /**
     * @example "Incorrect item"
     *
     * @var string
     */
    public $reason;

    /**
     * @example null
     *
     * @var string
     */
    public $requestReferenceNumber;

    /**
     * @example "2021-06-16T07:05:57.000Z"
     *
     * @var string
     */
    public $voidAt;

    /**
     * @example "2021-06-16T07:05:57.000Z"
     *
     * @var string
     */
    public $createdAt;

    /**
     * @example "2021-06-16T07:05:57.000Z"
     *
     * @var string
     */
    public $updatedAt;
}
