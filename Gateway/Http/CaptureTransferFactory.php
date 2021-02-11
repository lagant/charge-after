<?php

namespace Chargeafter\Payment\Gateway\Http;

use Magento\Payment\Gateway\Http\TransferInterface;

class CaptureTransferFactory extends TransferFactory
{
    /**
     * @inheritDoc
     */
    public function create(array $request): TransferInterface
    {
        return $this->_transferBuilder
            ->setUri($this->_apiHelper->getApiUrl("/post-sale/charges/$request[chargeId]/settles", $request['storeId']))
            ->setMethod('POST')
            ->setHeaders([
                'Authorization'=>'Bearer ' . $this->_apiHelper->getPrivateKey($request['storeId'])
            ])
            ->setBody($request['payload'])
            ->build();
    }
}
