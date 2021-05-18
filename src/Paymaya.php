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
     * Paymaya Checkout API Token
     *
     * @var string
     */
    protected $checkoutApiToken;

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
     * Paymaya constructor.
     */
    public function __construct()
    {

        $this->checkoutSecretKey = config('paymaya.checkout.key.secret');
        $this->setCheckoutPublicKey(config('paymaya.checkout.key.public'));
        $this->environment = config('paymaya.environment', 'SANDBOX');
    }

    /**
     * Get Checkout API Token
     *
     * @return string
     */
    public function getCheckoutApiToken(): string
    {
        return $this->checkoutApiToken;
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
        $this->checkoutApiToken = base64_encode($this->checkoutPublicKey . ':');
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
        if (strtoupper($this->environment) === 'PRODUCTION') {
            return self::PRODUCTION_URL;
        }

        return self::SANDBOX_URL;
    }

    /**
     * @param bool $is_post_method
     * @param string $append_url
     * @param array $data
     * @return PromiseInterface|Response
     */
    public function makeCheckoutRequest(bool $is_post_method = FALSE, string $append_url = '', array $data = [])
    {
        // Prepare URL

        $url = $this->getBaseUrl();

        if(empty(trim($append_url)) === FALSE) {
            $url .= '/' . $append_url;
        }

        // Prepare Data

        $data = array_filter_recursive($data);

        $response = Http::withHeaders(['Authorization' => 'Basic ' . $this->getCheckoutApiToken()])->bodyFormat('json');
        if ($is_post_method) {
            $response = $response->post($url, $data);
        }
        else {
            $response = $response->get($url, $data);
        }
        return $response;
    }
}
