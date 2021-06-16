<?php

namespace FourelloDevs\Paymaya;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Class Paymaya
 * @package FourelloDevs\Paymaya
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-19
 */
class Paymaya
{
    /**
     * Paymaya Checkout Public Key
     *
     * @var string
     */
    protected $checkoutPublicKey;

    /**
     * Paymaya Checkout Secret Key
     *
     * @var string
     */
    protected $checkoutSecretKey;

    /**
     * Paymaya Checkout Public API Token
     *
     * @var string
     */
    protected $checkoutPublicApiToken;

    /**
     * Paymaya Checkout Secret API Token
     *
     * @var string
     */
    protected $checkoutSecretApiToken;

    /**
     * Paymaya Environment
     * @var string
     */
    protected $environment;

    /**
     * Paymaya Production URL
     */
    public const PRODUCTION_URL = 'https://pg.paymaya.com';

    /**
     * Paymaya Sandbox URL
     */
    public const SANDBOX_URL = 'https://pg-sandbox.paymaya.com';

    /**
     * Paymaya Checkout Production URL Pattern
     */
    public const CHECKOUT_PRODUCTION_OUTPUT_URL = 'https://payments-web-sandbox.paymaya.com/v2/checkout?id=';

    /**
     * Paymaya Checkout Sandbox URL Pattern
     */
    public const CHECKOUT_SANDBOX_OUTPUT_URL = 'https://payments-web-sandbox.paymaya.com/v2/checkout?id=';

    /**
     * Paymaya constructor.
     */
    public function __construct()
    {

        $this->setCheckoutSecretKey(config('paymaya.checkout.key.secret'));
        $this->setCheckoutPublicKey(config('paymaya.checkout.key.public'));
        $this->environment = config('paymaya.environment', 'SANDBOX');
    }

    /**
     * Get Checkout API Token
     *
     * @return string
     */
    public function getCheckoutPublicApiToken(): string
    {
        return $this->checkoutPublicApiToken;
    }

    /**
     * Get Checkout API Public Key
     *
     * @return string
     */
    public function getCheckoutPublicKey(): string
    {
        return $this->checkoutPublicKey;
    }

    /**
     * @param string $checkoutPublicKey
     */
    public function setCheckoutPublicKey(string $checkoutPublicKey): void
    {
        $this->checkoutPublicKey = $checkoutPublicKey;
        $this->checkoutPublicApiToken = base64_encode($this->checkoutPublicKey . ':');
    }

    /**
     * @return string
     */
    public function getCheckoutSecretApiToken(): string
    {
        return $this->checkoutSecretApiToken;
    }

    /**
     * Get Checkout Secret Key
     *
     * @return string
     */
    public function getCheckoutSecretKey(): string
    {
        return $this->checkoutSecretKey;
    }

    /**
     * @param string $checkoutSecretKey
     */
    public function setCheckoutSecretKey(string $checkoutSecretKey): void
    {
        $this->checkoutSecretKey = $checkoutSecretKey;
        $this->checkoutSecretApiToken = base64_encode($checkoutSecretKey . ':');
    }

    /**
     * Get Application Environment
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * Get URL for HTTP Requests
     * @return string
     */
    public function getBaseUrl(): string
    {
        if (strtoupper(trim($this->environment)) === 'PRODUCTION') {
            return self::PRODUCTION_URL;
        }

        return self::SANDBOX_URL;
    }

    /**
     * Get Checkout URL Pattern
     *
     * @return string
     */
    public function getCheckoutOutputURL(): string
    {
        if (strtoupper(trim($this->environment)) === 'PRODUCTION') {
            return self::CHECKOUT_PRODUCTION_OUTPUT_URL;
        }

        return self::CHECKOUT_SANDBOX_OUTPUT_URL;
    }

    /**
     * @param bool $is_post_method
     * @param string $append_url
     * @param array $data
     * @param bool $use_secret_api_token
     * @return PromiseInterface|Response
     */
    public function makeRequest(bool $is_post_method = FALSE, string $append_url = '', array $data = [], bool $use_secret_api_token = FALSE)
    {
        // Prepare URL

        $url = $this->getBaseUrl();

        if(empty(trim($append_url)) === FALSE) {
            $url .= '/' . $append_url;
        }

        // Prepare Data

        $data = array_filter_recursive($data);

        $token = $use_secret_api_token ? $this->getCheckoutSecretApiToken() : $this->getCheckoutPublicApiToken();

        $response = Http::withHeaders(['Authorization' => 'Basic ' . $token])->bodyFormat('json');
        if ($is_post_method) {
            $response = $response->post($url, $data);
        }
        else {
            $response = $response->get($url, $data);
        }
        return $response;
    }
}
