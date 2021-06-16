<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class Merchant
 * @package FourelloDevs\Paymaya\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class Merchant extends BaseModel
{
    /**
     * @example "PHP"
     *
     * @var
     */
    public $currency;

    /**
     * @example "paymentgatewayteam@paymaya.com"
     *
     * @var
     */
    public $email;

    /**
     * @example "en"
     *
     * @var
     */
    public $locale;

    /**
     * @example "http://www.paymaya.com"
     *
     * @var
     */
    public $homepageUrl;

    /**
     * @example "false"
     *
     * @var
     */
    public $isEmailToMerchantEnabled;

    /**
     * @example "false"
     *
     * @var
     */
    public $isEmailToBuyerEnabled;

    /**
     * @example "false"
     *
     * @var
     */
    public $isPaymentFacilitator;

    /**
     * @example "false"
     *
     * @var
     */
    public $isPageCustomized;

    /**
     * @example "Mastercard"
     *
     * @var
     */
    public $supportedSchemes;

    /**
     * @example false
     *
     * @var
     */
    public $canPayPal;

    /**
     * @example "null"
     *
     * @var
     */
    public $payPalEmail;

    /**
     * @example "null"
     *
     * @var
     */
    public $payPalWebExperienceId;

    /**
     * @example true
     *
     * @var
     */
    public $expressCheckout;

    /**
     * @example "PayMaya Developers Portal"
     *
     * @var
     */
    public $name;
}
