<?php


namespace FourelloDevs\Paymaya\Models;

use FourelloDevs\MrSpeedy\Models\BaseModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class Checkout
 * @package FourelloDevs\Paymaya\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class Checkout extends BaseModel
{
    /**
     * Paymaya Order ID
     *
     * @var string|null
     */
    public $id;

    /**
     * Paymaya Checkout URL
     *
     * @var string|null
     */
    public $url;

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

    /**
     * @var Buyer
     */
    public $buyer;

    /**
     * @param Buyer|array $buyer
     */
    public function setBuyer($buyer): void
    {
        $this->buyer = is_array($buyer) ? new Buyer($buyer) : $buyer;
    }

    /**
     * @var Item[]
     */
    public $items;

    /**
     * @param Item[]|array $items
     */
    public function setItems(array $items): void
    {
        if (empty($items) === FALSE) {
            if ($items[0] instanceof Item) {
                $this->items = $items;
            }
            else {
                foreach ($items as $item) {
                    $this->items[] = new Item($item);
                }
            }
        }
    }

    /**
     * @var array|null
     */
    public $redirectUrl;

    /**
     * @var
     */
    public $requestReferenceNumber;

    /**
     * @var array|null
     */
    public $metadata;

    /**
     * @example "2019-02-26T14:23:57.000Z"
     *
     * @var string|null
     */
    public $createdAt;

    /**
     * @example "2019-02-26T14:25:51.000Z"
     *
     * @var string|null
     */
    public $updatedAt;

    /**
     * @example "2019-02-26T14:40:47.000Z"
     *
     * @var string|null
     */
    public $expiredAt;

    /**
     * @example "master-card"
     *
     * @var string|null
     */
    public $paymentScheme;

    /**
     * @example true
     *
     * @var bool|null
     */
    public $expressCheckout;

    /**
     * @example 0
     *
     * @var float|null
     */
    public $refundedAmount;

    /**
     * @example false
     *
     * @var bool|null
     */
    public $canPayPal;

    /**
     * @example "COMPLETED"
     *
     * @var string|null
     */
    public $status;

    /**
     * @example "PAYMENT_SUCCESS"
     *
     * @var string|null
     */
    public $paymentStatus;

    /**
     * Payment Details
     *
     * @var array|null
     */
    public $paymentDetails;

    /**
     * Merchant Information
     *
     * @var Merchant|null
     */
    public $merchant;

    /**
     * @param Merchant|array $merchant
     */
    public function setMerchant($merchant): void
    {
        $this->merchant = is_array($merchant) ? new Merchant($merchant) : $merchant;
    }

    /**
     * Actions to perform prior to serialization.
     *
     * @return void
     */
    public function performBeforeSerialize(): void
    {
        // TODO: Implement performBeforeSerialize() method.
    }

    /**
     * Execute the Checkout
     *
     * @throws \JsonException
     */
    public function execute(): Checkout
    {
        $data = json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        $response = paymaya()->makeCheckoutRequest(TRUE, 'checkout/v1/checkouts', $data);
        if ($response->ok()) {
            $this->id = $response->json('checkoutId');
            $this->url = $response->json('redirectUrl');
        }

        return $this;
    }

    /**
     * Retrieve Checkout Details
     */
    public function retrieve(): Checkout
    {
        $append = 'checkout/v1/checkouts/' . $this->id;
        $response = paymaya()->makeCheckoutRequest(FALSE, $append);
        if ($response->ok()) {
            $this->parse($response);
        }

        return $this;
    }
}
