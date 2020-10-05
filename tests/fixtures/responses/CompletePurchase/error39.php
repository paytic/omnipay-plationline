<?php

$xml = '<po_auth_response>
<f_login><![CDATA[DEMO CLUBUL SPORTIV YZO GYM]]></f_login>
<f_website><![CDATA[register.42km.ro]]></f_website>
<f_test_request>1</f_test_request>
<f_timestamp>2020-10-05T19:54:59+03:00</f_timestamp>
<f_order_number><![CDATA[]]></f_order_number>
<f_action>2</f_action><f_amount>12.34</f_amount>
<f_currency>RON</f_currency>
<x_response_code>8</x_response_code>
<x_response_reason_code>39</x_response_reason_code>
<x_response_reason_text><![CDATA[Tipul cardului nu este cunoscut]]></x_response_reason_text>
<x_auth_code>POTEST</x_auth_code>
<x_action_code>CI</x_action_code>
<x_trans_id>6895990</x_trans_id>
</po_auth_response>';

return simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);