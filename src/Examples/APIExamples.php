<?php


namespace FourelloDevs\Paymaya\Examples;

use FourelloDevs\Paymaya\Models\Amount;
use FourelloDevs\Paymaya\Models\AmountDetails;
use FourelloDevs\Paymaya\Models\BillingAddress;
use FourelloDevs\Paymaya\Models\Buyer;
use FourelloDevs\Paymaya\Models\Checkout;
use FourelloDevs\Paymaya\Models\Contact;
use FourelloDevs\Paymaya\Models\Item;

/**
 * Class APIExamples
 * @package FourelloDevs\PaymayaWrapper\Examples
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class APIExamples
{
    public function checkoutTest(): Checkout
    {
        $itemCheckout = new Checkout();

        // Checkout Address
        $address = new BillingAddress();
        $address->line1 = "9F Robinsons Cybergate 3";
        $address->line2 = "Pioneer Street";
        $address->city = "Mandaluyong City";
        $address->state = "Metro Manila";
        $address->zipCode = "12345";
        $address->countryCode = "PH";

        // Checkout Buyer
        $buyer = new Buyer();
        $buyer->firstName = 'James Carlo';
        $buyer->middleName = 'Sebial';
        $buyer->lastName = 'Luchavez';

        // Contact
        $contact = new Contact();
        $contact->phone = "+63(2)1234567890";
        $contact->email = "paymayabuyer1@gmail.com";

        $buyer->contact = $contact;

        $buyer->shippingAddress = $address;
        $buyer->billingAddress = $address;

        $itemCheckout->buyer = $buyer;

        // Item
        $itemAmountDetails = new AmountDetails();
        $itemAmountDetails->shippingFee = "14.00";
        $itemAmountDetails->tax = "5.00";
        $itemAmountDetails->subtotal = "10000.00";
        $itemAmount = new Amount();
        $itemAmount->currency = "PHP";
        $itemAmount->value = "100.00";
        $itemAmount->details = $itemAmountDetails;
        $item = new Item();
        $item->name = "Leather Belt";
        $item->code = "pm_belt";
        $item->description = "Medium-sized belt made from authentic leather";
        $item->quantity = "1";
        $item->amount = $itemAmount;

        $itemCheckout->items = array($item);
        $itemCheckout->totalAmount = $itemAmount;
        $itemCheckout->requestReferenceNumber = "123456789";
        $itemCheckout->redirectUrl = array(
            "success" => url()->to('/api/test/paymaya/success'),
            "failure" => url()->to('/api/test/paymaya/failure'),
            "cancel" => url()->to('/api/test/paymaya/cancel')
        );

        return $itemCheckout->execute();
    }

    public function getCheckOutDetails(): Checkout
    {
        $itemCheckout = new Checkout;
        $itemCheckout->id = '6bba889e-9abc-4310-83dc-bdbe95d3dce6';
        return $itemCheckout->retrieve();
    }
}
