<?php

namespace Paytic\Omnipay\PlatiOnline\Utils;

/**
 * Class Urls
 * @package Paytic\Omnipay\PlatiOnline\Utils
 */
class Urls
{
    public static $url = 'https://secure.plationline.ro/';

    // any call
    public static $requestXml = 'https://secure.plationline.ro/xml_validation/po.request.v5.xsd';

    // auth
    public static $authXml = 'https://secure.plationline.ro/xml_validation/f_message.auth.v5.xsd';

    // auth url
    public static $authUrlXml = 'https://secure.plationline.ro/xml_validation/auth.url.response.v5.xsd';

    // auth response
    public static $authResponseXml = 'https://secure.plationline.ro/xml_validation/auth.response.v5.xsd';

    // auth response soap
    public static $authResponse_soapXml = 'https://secure.plationline.ro/xml_validation/auth.soap.response.v5.xsd';

    // itsn
    public static $itsnXml = 'https://secure.plationline.ro/xml_validation/itsn.v5.xsd';

    // query
    public static $queryXml = 'https://secure.plationline.ro/xml_validation/f_message.query.v5.xsd';

    // query response
    public static $queryResponseXml = 'https://secure.plationline.ro/xml_validation/query.response.v5.xsd';

    // query by date
    public static $queryByDateXml = 'https://secure.plationline.ro/xml_validation/f_message.query-by-date.v5.xsd';

    // query response
    public static $queryByDateResponseXml = 'https://secure.plationline.ro/xml_validation/query-by-date.response.v5.xsd';

    // sale-by-token
    public static $saleTokenXml = 'https://secure.plationline.ro/xml_validation/v5/f_message-sale-by-token.xsd';

    // sale-by-token response
    public static $saleTokenResponseXml = 'https://secure.plationline.ro/xml_validation/po-auth-by-token-response.xsd';

    // settle
    public static $settleXml = 'https://secure.plationline.ro/xml_validation/f_message.settle.v5.xsd';

    // settle response
    public static $settleResponseXml = 'https://secure.plationline.ro/xml_validation/settle.response.v5.xsd';

    // void
    public static $voidXml = 'https://secure.plationline.ro/xml_validation/f_message.void.v5.xsd';

    // void response
    public static $voidResponseXml = 'https://secure.plationline.ro/xml_validation/void.response.v5.xsd';

    // refund
    public static $refundXml = 'https://secure.plationline.ro/xml_validation/f_message.refund.v5.xsd';

    // refund response
    public static $refundResponseXml = 'https://secure.plationline.ro/xml_validation/refund.response.v5.xsd';

    // paylink
    public static $paylinkXml = 'https://secure.plationline.ro/xml_validation/v5/f_message.paylink.xsd';

    // paylink response
    public static $paylinkResponseXml = 'https://secure.plationline.ro/xml_validation/v5/pay.link.by.trxid.url.response.xsd';
}
