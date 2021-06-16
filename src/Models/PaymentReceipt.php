<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class PaymentReceipt
 * @package FourelloDevs\Paymaya\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-06-16
 */
class PaymentReceipt extends BaseModel
{
    /**
     * @example 1908f154-0447-41e4-92fc-a5e390e4ca52
     *
     * @var string
     */
    public $transactionId;

    /**
     * @example c3b6b0d97e4a
     *
     * @var string
     */
    public $receiptNo;

    /**
     * @example 00001234
     *
     * @var string
     */
    public $approval_code;

    /**
     * @example 00001234
     *
     * @var string
     */
    public $approvalCode;
}
