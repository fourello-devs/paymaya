<?php


namespace FourelloDevs\Paymaya\Models;

use Exception;
use Illuminate\Support\Collection;

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
     * @var Collection|null
     */
    public $items;

    /**
     * @param Item[]|array $items
     */
    public function setItems(array $items): void
    {
        if (empty($items) === FALSE) {
            if ($items[0] instanceof Item) {
                $this->items = collect($items);
            }
            else {
                $this->items = collect();
                foreach ($items as $item) {
                    $this->items->add(new Item($item));
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
     * @var Collection|null
     */
    public $paymentDetails;

    /**
     * @return void
     */
    public function setPaymentDetails(): void
    {
        $this->paymentDetails = collect(Payment::findByRRN($this->requestReferenceNumber));
    }

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
     * Execute the Checkout
     *
     * @return $this|array|mixed
     * @throws \JsonException
     */
    public function execute()
    {
        $data = json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        $response = paymaya()->makeRequest(TRUE, 'checkout/v1/checkouts', $data);
        if ($response->ok()) {
            $this->id = $response->json('checkoutId');
            $this->url = $response->json('redirectUrl');
            return $this;
        }

        return $response->json();
    }

    /**
     * Retrieve Checkout Details
     *
     * @return $this|array|mixed
     */
    public function retrieve()
    {
        $append = 'checkout/v1/checkouts/' . $this->id;
        $response = paymaya()->makeRequest(FALSE, $append, [], TRUE);
        if ($response->ok()) {
            $this->parse($response);
            if (is_null($this->url)) {
                $this->url = paymaya()->getCheckoutOutputURL() . $this->id;
            }
            return $this;
        }

        return $response->json();
    }

    /**
     * @param string $reason
     * @return array|PaymentVoid|mixed
     */
    public function void(string $reason)
    {
        $data = get_defined_vars();

        $append = 'payments/v1/payments/' . $this->id . '/voids';

        $response = paymaya()->makeRequest(TRUE, $append, $data, TRUE);

        if ($response->ok()) {
            return new PaymentVoid($response);
        }

        return $response->json();
    }

    /**
     * @param string $reason
     * @param Amount $totalAmount
     * @return array|PaymentRefund|mixed
     * @throws \JsonException
     */
    public function refund(string $reason, Amount $totalAmount)
    {
        $totalAmount = json_decode(json_encode($totalAmount, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

        $requestReferenceNumber = $this->requestReferenceNumber;

        $data = get_defined_vars();

        $append = 'payments/v1/payments/' . $this->id . '/refunds';

        $response = paymaya()->makeRequest(TRUE, $append, $data, TRUE);

        if ($response->ok()) {
            return new PaymentRefund($response);
        }

        return $response->json();
    }

    /**
     * Find Checkout Details
     *
     * @param string $id
     * @return array|mixed|static
     */
    public static function find(string $id)
    {
        $append = 'checkout/v1/checkouts/' . $id;
        $response = paymaya()->makeRequest(FALSE, $append, [], TRUE);

        $checkout = new static();

        if ($response->ok()) {
            $checkout->parse($response);
            if (is_null($checkout->url)) {
                $checkout->url = paymaya()->getCheckoutOutputURL() . $checkout->id;
            }
            return $checkout;
        }

        return $response->json();
    }
}
