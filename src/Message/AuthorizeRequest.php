<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\PlatiOnline\Utils\Urls;
use Omnipay\Common\Item;
use Omnipay\Common\ItemBag;

/**
 * Class AuthorizeRequest
 * @package ByTIC\Omnipay\PlatiOnline\Message
 *
 * @method AuthorizeResponse send
 */
class AuthorizeRequest extends AbstractRequest
{

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validateWithSecurityParams('amount', 'card');
        $this->validateCard(
            'BillingPhone', 'FirstName', 'LastName', 'BillingCountry', 'BillingCity',
            'ShippingPhone', 'ShippingCountry', 'ShippingCity'
        );

        $data = [];


        $data['f_website'] = $this->getWebsite();

        $data['f_order_number'] = $this->getTransactionId();
        $data['f_order_string'] = $this->getDescription();
        $data['f_amount'] = $this->getAmount();
        $data['f_currency'] = $this->getCurrency();

        // 0 - waiting forever, 20 - default (in minutes)
        $data['f_auth_minutes'] = 20;
        $data['f_language'] = $this->getLang(); // RO / EN / HU / IT / FR / DE / ES

        $data['customer_info'] = $this->generateCustomerInfo();
        $data['shipping_info'] = $this->generateShippingInfo();
        $data['transaction_relay_response'] = $this->generateRelayResponse();

        //$f_request['tracking_script'] = 'tracking script';

        $data['f_order_cart'] = $this->generateOrderCart();


//shipping
//        $shipping = array();
//        $shipping['name'] = substr('Shipping 1', 0, 250);
//        $shipping['price'] = (float)15.5;
//        $shipping['pimg'] = 0;
//        $shipping['vat'] = (float)2.5;
//
//        $f_request['f_order_cart']['shipping'] = $shipping;


        return $data;
    }

    protected function generateCustomerInfo(): array
    {
        $card = $this->getCard();

        $customerInfo = [];

        // must not be empty. If empty don't send this tag, it will be filled in PO interface
        $customerInfo['contact']['f_email'] = $card->getEmail();

        // must not be empty, minimum 4 characters. If empty don't send this tag, it will be filled in PO interface
        $customerInfo['contact']['f_phone'] = $card->getBillingPhone();
        $customerInfo['contact']['f_mobile_number'] = $card->getBillingPhone();

        // 1 - sms client notification 0 - no notification
        $customerInfo['contact']['f_send_sms'] = 1;

        // must not be empty. If empty don't send this tag, it will be filled in PO interface
        $customerInfo['contact']['f_first_name'] = $card->getBillingFirstName();
        $customerInfo['contact']['f_last_name'] = $card->getBillingLastName();
        //$customer_info['contact']['f_middle_name'] 	 = '';

//invoice
//        $customer_info['invoice']['f_company'] = 'Test company';        // optional
//        $customer_info['invoice']['f_cui'] = '111111';            // optional
//        $customer_info['invoice']['f_reg_com'] = 'J55/99/2000';        // optional
//        $customer_info['invoice']['f_cnp'] = '9999999999999';        // optional
//        $customer_info['invoice']['f_zip'] = '999999';            // optional

        // must not be empty. If empty don't send this tag, it will be filled in PO interface
        $customerInfo['invoice']['f_country'] = $card->getBillingCountry();

        // must not be empty. If empty don't send this tag, it will be filled in PO interface
        $customerInfo['invoice']['f_state'] = $card->getBillingState();

        // must not be empty. If empty don't send this tag, it will be filled in PO interface
        $customerInfo['invoice']['f_city'] = $card->getBillingCity();

        // must not be empty. If empty don't send this tag, it will be filled in PO interface
        $customerInfo['invoice']['f_address'] = $card->getBillingAddress1();

        return $customerInfo;
    }

    protected function generateShippingInfo(): array
    {
        $card = $this->getCard();

        $shipping_info = [];

        // 0 - different info, 1- same info as customer_info
        $shipping_info['same_info_as'] = 0;

        //contact
        $shipping_info['contact']['f_email'] = $card->getEmail();
        $shipping_info['contact']['f_phone'] = $card->getShippingPhone();
        $shipping_info['contact']['f_mobile_number'] = $card->getShippingPhone();

        // 1 - sms client notification 0 - no notification
        $shipping_info['contact']['f_send_sms'] = 1;
        $shipping_info['contact']['f_first_name'] = $card->getShippingFirstName();
        $shipping_info['contact']['f_last_name'] = $card->getShippingLastName();
//$shipping_info['contact']['f_middle_name'] 	 = '';

        //address
        $shipping_info['address']['f_company'] = $card->getShippingCompany();
        $shipping_info['address']['f_zip'] = $card->getShippingPostcode();
        $shipping_info['address']['f_country'] = $card->getShippingCountry();
        $shipping_info['address']['f_state'] = $card->getShippingState();
        $shipping_info['address']['f_city'] = $card->getShippingCity();
        $shipping_info['address']['f_address'] = substr($card->getShippingAddress1(), 0, 100);

        return $shipping_info;
    }

    protected function generateRelayResponse(): array
    {
        $card = $this->getCard();

        $relayResponse = [];
        $relayResponse['f_relay_response_url'] = $this->getNotifyUrl();

        // INFO f_relay_method
        // PTOR, POST_S2S_PO_PAGE, POST_S2S_MT_PAGE, SOAP_PO_PAGE, SOAP_MT_PAGE
        $relayResponse['f_relay_method'] = 'POST_S2S_PO_PAGE';

        // Valoarea = 1	(default value; sistemul PO trimite rezultatul la f_relay_response_url prin metoda f_relay_method)
        // Valoarea = 0	(systemul PO trimite rezultatul doar pentru tranzactiile "Autorizate" si "In curs de verificare" la <f_relay_response_url> prin metoda <f_relay_method>)
        $relayResponse['f_post_declined'] = 1;

        // default 1
        $relayResponse['f_relay_handshake'] = 1;

        return $relayResponse;
    }

    protected function generateOrderCart(): array
    {
        /** @var Item[]|ItemBag $items */
        $items = $this->getItems();
        $orderCart = [];

        if (!($items instanceof ItemBag)) {
            $itemData['prodid'] = 0;
            $itemData['name'] = substr($this->getDescription(), 0, 250);
            $itemData['description'] = substr($this->getDescription(), 0, 250);
            $itemData['qty'] = 1;

            // price WITOUT VAT for 1 piece of the product
            $itemData['itemprice'] = (float)$this->getAmount();

            // VAT for 1 piece of the product * $item['qty']
            $itemData['vat'] = (float)0;

            $itemData['stamp'] = date('Y-m-d');
            $itemData['prodtype_id'] = 0;

            $orderCart[] = $itemData;

            return $orderCart;
        }

        foreach ($items as $item) {
            $itemData = [];

            $itemData['prodid'] = 0;
            $itemData['name'] = substr($item->getName(), 0, 250);
            $itemData['description'] = substr($item->getDescription(), 0, 250);
            $itemData['qty'] = $item->getQuantity();

            // price WITOUT VAT for 1 piece of the product
            $itemData['itemprice'] = (float)$item->getPrice();

            // VAT for 1 piece of the product * $item['qty']
            $itemData['vat'] = (float)0;

            $itemData['stamp'] = date('Y-m-d');
            $itemData['prodtype_id'] = 0;

            $orderCart[] = $itemData;
        }
        return $orderCart;
    }

    /**
     * @param \SoapClient $soapClient
     * @param array $data
     */
    protected function runTransaction($soapClient, $data)
    {
        $data['f_action'] = 2;

        return $this->runSoapRequest($soapClient, $data, 'po_auth_request', Urls::$authXml);
    }
}
