<?php

namespace Chargeafter\Payment\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;

class AuthorizeBuilder implements BuilderInterface
{

    public function build(array $buildSubject)
    {
        $payment = $buildSubject['payment']->getPayment();
        $order = $buildSubject['payment']->getOrder();

        return [
            'storeId'=>$order->getStoreId(),
            'data'=>[
                'confirmationToken'=>$payment->getAdditionalInformation('token'),
                'merchantOrderId'=>$order->getOrderIncrementId(),
            ],
        ];
    }
}
