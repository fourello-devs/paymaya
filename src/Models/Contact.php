<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class Contact
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class Contact extends BaseModel
{
    /**
     * @example "+639181008888"
     *
     * @var string|null
     */
    public $phone;

    /**
     * @example "merchant@merchantsite.com"
     *
     * @var string|null
     */
    public $email;
}
