<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class Buyer
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class Buyer extends BaseModel
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
     * @example "1995-10-24"
     *
     * @var string
     */
    public $birthday;

    /**
     * @example "1995-10-24"
     *
     * @var string
     */
    public $customerSince;

    /**
     * @example "M"
     *
     * @var string
     */
    public $sex;

    /**
     * @var Contact|null
     */
    public $contact;

    /**
     * @param Contact|array $contact
     */
    public function setContact($contact): void
    {
        $this->contact = is_array($contact) ? new Contact($contact) : $contact;
    }

    /**
     * @var ShippingAddress|null
     */
    public $shippingAddress;

    /**
     * @param BillingAddress|ShippingAddress|array|null $shippingAddress
     * @throws \JsonException
     */
    public function setShippingAddress($shippingAddress): void
    {
        if ($shippingAddress instanceof BillingAddress) {
            $shippingAddress = json_decode(json_encode($shippingAddress, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        }
        $this->shippingAddress = is_array($shippingAddress) ? new ShippingAddress($shippingAddress) : $shippingAddress;
    }

    /**
     * @var BillingAddress|null
     */
    public $billingAddress;

    /**
     * @param BillingAddress|ShippingAddress|array|null $billingAddress
     * @throws \JsonException
     */
    public function setBillingAddress($billingAddress): void
    {
        if ($billingAddress instanceof ShippingAddress) {
            $billingAddress = json_decode(json_encode($billingAddress, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        }
        $this->billingAddress = is_array($billingAddress) ? new BillingAddress($billingAddress) : $billingAddress;
    }

    /**
     * @example "125.60.148.241"
     *
     * @var
     */
    public $ipAddress;
}
