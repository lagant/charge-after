<?php

namespace Chargeafter\Payment\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;

class AuthorizeBuilder implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $payment = $buildSubject['payment']->getPayment();
        $order = $buildSubject['payment']->getOrder();

        return [
            'storeId'=>$order->getStoreId(),
            'payload'=>[
                'confirmationToken'=>$payment->getAdditionalInformation('token'),
                'merchantOrderId'=>$order->getOrderIncrementId(),
            ],
        ];
    }
}
