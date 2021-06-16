<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class Payment
 * @package FourelloDevs\Paymaya\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-06-16
 */
class Payment extends BaseModel
{

    /**
     * @example ee74312e-04a5-4b89-a1d1-52d160a98f38
     *
     * @var string|null
     */
    public $id;

    /**
     * @example true
     *
     *
     * @var bool|null
     */
    public $isPaid;

    /**
     * @example PAYMENT_SUCCESS
     *
     * @var string|null
     */
    public $status;

    /**
     * @example 100
     *
     * @var string|null
     */
    public $amount;

    /**
     * @example PHP
     *
     * @var string|null
     */
    public $currency;

    /**
     * @example true
     *
     * @var string|null
     */
    public $canVoid;

    /**
     * @example true
     *
     * @var string|null
     */
    public $canRefund;

    /**
     * @example true
     *
     * @var string|null
     */
    public $canCapture;

    /**
     * @example 2021-05-24T07:57:47.000Z
     *
     * @var string|null
     */
    public $createdAt;

    /**
     * @example 2021-06-16T07:56:56.000Z
     *
     * @var string|null
     */
    public $updatedAt;

    /**
     * @example Charge for paymayabuyer1@gmail.com
     *
     * @var string|null
     */
    public $description;

    /**
     * @example RtFLi5o2YaAWMpCQ7nK4hO4VZYMZitobaM4bwwN5ckhYzTHDJMau6I6MaUcbAAChX4mdyABpclOpHOCiYSA9W41MBuNziuEhumGznL3mb6au76uf45xfBUDXIzg9LlFyf9SDILzxuhZBEZ8irKYeP9Spq4IA1uhEk2lknk1E
     *
     * @var string|null
     */
    public $paymentTokenId;

    /**
     * @var FundSource|null
     */
    public $fundSource;

    /**
     * @param FundSource|array $fundSource
     */
    public function setFundSource($fundSource): void
    {
        $this->fundSource = is_array($fundSource) ? new FundSource($fundSource) : $fundSource;
    }

    /**
     * @var PaymentReceipt|null
     */
    public $receipt;

    /**
     * @param PaymentReceipt|array $receipt
     */
    public function setReceipt($receipt): void
    {
        $this->receipt = is_array($receipt) ? new PaymentReceipt($receipt) : $receipt;
    }

    /**
     * @example
     *
     * @var string|null
     */
    public $approvalCode;

    /**
     * @example
     *
     * @var string|null
     */
    public $receiptNumber;

    /**
     * @example
     *
     * @var string|null
     */
    public $requestReferenceNumber;

    /**
     * @param string $requestReferenceNumber
     * @return static[]
     */
    public static function findByRRN(string $requestReferenceNumber): array
    {
        $append = 'payments/v1/payment-rrns/' . $requestReferenceNumber;

        $response = paymaya()->makeRequest(FALSE, $append, [], TRUE);

        $result = [];

        if ($response->ok()) {
            $payments = $response->json();
            if (empty($payments) === FALSE) {
                foreach ($payments as $payment){
                    $result[] = new static($payment);
                }
            }
        }

        return $result;
    }
}
