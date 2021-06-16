<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class Item
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class Item extends BaseModel
{

    /**
     * @example "Canvas Slip Ons"
     *
     * @var string
     */
    public $name;

    /**
     * @example 1
     *
     * @var int
     */
    public $quantity;

    /**
     * @example "CVG-096732"
     *
     * @var string
     */
    public $code;

    /**
     * @example "Shoes"
     *
     * @var string
     */
    public $description;

    /**
     * @var Amount
     */
    public $amount;

    /**
     * @param Amount|array $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = is_array($amount) ? new Amount($amount) : $amount;
    }

    /**
     * @var Amount
     */
    public $totalAmount;

    /**
     * @param Amount|array $totalAmount
     */
    public function setTotalAmount($totalAmount): void
    {
        $this->totalAmount = is_array($totalAmount) ? new Amount($totalAmount) : $totalAmount;
    }
}
