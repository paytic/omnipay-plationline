<?php

namespace Paytic\Omnipay\PlatiOnline\Tests\Models\Responses;

use Nip\Utility\Xml;
use Paytic\Omnipay\PlatiOnline\Models\Responses\QueryResponse;
use Paytic\Omnipay\PlatiOnline\Tests\AbstractTest;
use SimpleXMLElement;

/**
 *
 */
class QueryResponseTest extends AbstractTest
{
    public function test_fromXML()
    {
        $data = json_decode(file_get_contents(TEST_FIXTURE_PATH.'/responses/ServerCompletePurchase/itns_authorized.json'), true);

        $xml = Xml::fromArray(['notification' => $data]);

        $response = QueryResponse::fromXml($xml);
        self::assertInstanceOf(QueryResponse::class, $response);
        self::assertSame('2', $response->getStatus1());
        self::assertSame('6917422', $response->getTransactionReference());
    }

    public function test_json_encode()
    {
        $json = file_get_contents(TEST_FIXTURE_PATH.'/responses/ServerCompletePurchase/itns_authorized.json');
        $data = json_decode($json, true);

        $xml = Xml::fromArray(['notification' => $data]);

        $response = QueryResponse::fromXml($xml);
        self::assertInstanceOf(QueryResponse::class, $response);

        self::assertJsonStringEqualsJsonString($json, json_encode($response));
    }
}