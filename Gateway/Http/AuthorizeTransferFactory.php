<?php

namespace Chargeafter\Payment\Gateway\Http;

use Magento\Payment\Gateway\Http\TransferInterface;

class AuthorizeTransferFactory extends TransferFactory
{
    /**
     * @inheritDoc
     */
    public function create(array $request): TransferInterface
    {
        return $this->_transferBuilder
            ->setUri($this->_apiHelper->getApiUrl('/payment/charges', $request['storeId']))
            ->setMethod('POST')
            ->setHeaders([
                'Authorization'=>'Bearer ' . $this->_apiHelper->getPrivateKey($request['storeId'])
            ])
            ->setBody($request['payload'])
            ->build();
    }
}
