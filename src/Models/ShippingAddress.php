<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class ShippingAddress
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class ShippingAddress extends BillingAddress
{

    /**
     * @example "John"
     *
     * @var string
     */
    public $firstName;

    /**
     * @example "Paul"
     *
     * @var string
     */
    public $middleName;

    /**
     * @example "Doe"
     *
     * @var string
     */
    public $lastName;

    /**
     * @example "+639181008888"
     *
     * @var string
     */
    public $phone;

    /**
     * @example "merchant@merchantsite.com"
     *
     * @var string
     */
    public $email;

    /**
     * Set Contact Person
     *
     * @param Buyer $buyer
     */
    public function setContactPerson(Buyer $buyer): void
    {
        $this->firstName = $buyer->firstName;
        $this->middleName = $buyer->middleName;
        $this->lastName = $buyer->lastName;
        $this->phone = $buyer->contact->phone;
        $this->email = $buyer->contact->email;
    }
}
