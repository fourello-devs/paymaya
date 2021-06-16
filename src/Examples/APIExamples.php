<?php


namespace FourelloDevs\Paymaya\Examples;

use FourelloDevs\Paymaya\Models\Amount;
use FourelloDevs\Paymaya\Models\AmountDetails;
use FourelloDevs\Paymaya\Models\BaseModel;
use FourelloDevs\Paymaya\Models\BillingAddress;
use FourelloDevs\Paymaya\Models\Buyer;
use FourelloDevs\Paymaya\Models\Checkout;
use FourelloDevs\Paymaya\Models\Contact;
use FourelloDevs\Paymaya\Models\Item;

class APIExamples
{
    /**
     * @throws \JsonException
     */
    public function checkoutTest()
    {
        $itemCheckout = new Checkout();

        // Define Buyer
        $buyer = new Buyer();
        $buyer->firstName = 'James Carlo';
        $buyer->middleName = 'Sebial';
        $buyer->lastName = 'Luchavez';

        // Define Contact
        $contact = new Contact();
        $contact->phone = "+63(2)1234567890";
        $contact->email = "paymayabuyer1@gmail.com";

        // Define Address
        $address = new BillingAddress();
        $address->line1 = "9F Robinsons Cybergate 3";
        $address->line2 = "Pioneer Street";
        $address->city = "Mandaluyong City";
        $address->state = "Metro Manila";
        $address->zipCode = "12345";
        $address->countryCode = "PH";

        // Set Contact and Address
        $buyer->contact = $contact;
        $buyer->shippingAddress = $address;
        $buyer->billingAddress = $address;

        $itemCheckout->buyer = $buyer;

        // Define Item
        $item = new Item();
        $item->name = "Leather Belt";
        $item->code = "pm_belt";
        $item->description = "Medium-sized belt made from authentic leather";
        $item->quantity = "1";

        // Define Item Amount
        $itemAmount = new Amount();
        $itemAmount->value = "100.00";

        // Define Item Amount Details
        $itemAmountDetails = new AmountDetails();
        $itemAmountDetails->shippingFee = "14.00";
        $itemAmountDetails->tax = "5.00";
        $itemAmountDetails->subtotal = "10000.00";

        // Set Item Amount and Amount Details
        $item->amount = $itemAmount;
        $item->totalAmount = $itemAmount;
        $itemAmount->details = $itemAmountDetails;

        // Add Items Array to Checkout
        $itemCheckout->items = array($item);

        // Set Total Amount as Item Total Amount (since only one item)
        $itemCheckout->totalAmount = $itemAmount;

        // Set RRN from Order ID
        $itemCheckout->requestReferenceNumber = "987654321";

        // Set Redirect URLs for SUCCESS, FAILURE, and CANCEL
        $itemCheckout->redirectUrl = array(
            "success" => url()->to('/api/test/paymaya/success'),
            "failure" => url()->to('/api/test/paymaya/failure'),
            "cancel" => url()->to('/api/test/paymaya/cancel')
        );

        // Execute Checkout
        return $itemCheckout->execute();
    }

    public function getCheckOutDetails(): Checkout
    {
        $itemCheckout = new Checkout;
        $itemCheckout->id = '6bba889e-9abc-4310-83dc-bdbe95d3dce6';
        return $itemCheckout->retrieve();
    }
}
