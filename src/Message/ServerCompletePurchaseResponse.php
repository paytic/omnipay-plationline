<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

use Paytic\Omnipay\PlatiOnline\Models\Responses\QueryResponse;

/**
 * Class ServerCompletePurchaseResponse
 * @package Paytic\Omnipay\PlatiOnline\Message
 *
 * @method QueryResponse getNotification()
 */
class ServerCompletePurchaseResponse extends AbstractResponse
{
    use Traits\RelayResponseTrait;

    public function send()
    {
        header('Content-type: application/xml');
        echo $this->getContent();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $response = '0';

        $status1 = $this->getStatus1();
        if (in_array($status1, ['13', '1', '2', '8', '3', '6', '7', '9', '10', '16', '17'])) {
            $response = '1';
        } elseif ($status1 == 5) {
            $status2 = $this->getStatus2();
            if (in_array($status2, ['1', '2', '3', '4'])) {
                $response = '1';
            }
        }

        $stare1 = '<f_response_code>1</f_response_code>';

        $content = '<?xml version="1.0" encoding="UTF-8" ?>';
        $content .= '<itsn>';
        $content .= '<x_trans_id>' . $this->getTransactionReference() . '</x_trans_id>';
        $content .= '<merchServerStamp>' . date("Y-m-d H:m:s") . '</merchServerStamp>';
        $content .= '<f_response_code>' . $response . '</f_response_code>';
        $content .= '</itsn>';
        return $content;
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getTransactionReference()
    {
        return $this->getNotification()->getTransactionReference();
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getTransactionId()
    {
        return $this->getNotification()->getTransactionId();
    }

    public function getMessage()
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function getStatus1()
    {
        if ($this->hasDataProperty('status1') === false) {
            $this->data['status1'] = (string) $this->getNotification()->getStatus1();
        }
        return $this->getDataProperty('status1');
    }

    /**
     * @inheritDoc
     */
    public function getStatus2()
    {
        if ($this->hasDataProperty('status2') === false) {
            $this->data['status2'] = (string) $this->getNotification()->getStatus2();
        }
        return $this->getDataProperty('status2');
    }

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        $status1 = $this->getStatus1();
        $status2 = $this->getStatus2();
        if ($this->getStatus1() == 2) {
            return true;
        }

        if ($status1 == 3 && $status2 == 4) {
            return true;
        }

        if ($status1 == 5 && $status2 == 4) {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function isPending()
    {
        return $this->getStatus1() == 1;
    }

    /**
     * @inheritdoc
     */
    public function isCancelled(): bool
    {
        $canceledStatuses = [
            6, // Pending void
            7, // Transaction voided
            9, // Transaction expired in 5/7/30 days (according to MasterCardVisa)
        ];
        foreach ($canceledStatuses as $status) {
            if ($this->getStatus1() == $status) {
                return true;
            }
        }
        return false;
    }
}
