<?php

namespace Chargeafter\Payment\Gateway\Http;

use Chargeafter\Payment\Helper\ApiHelper;
use Magento\Payment\Gateway\Http\TransferBuilder;
use Magento\Payment\Gateway\Http\TransferFactoryInterface;

class AuthorizeTransferFactory implements TransferFactoryInterface
{
    private $transferBuilder;
    private $apiHelper;

    /**
     * @param TransferBuilder $transferBuilder
     */
    public function __construct(
        TransferBuilder $transferBuilder,
        ApiHelper $apiHelper
    ) {
        $this->transferBuilder=$transferBuilder;
        $this->apiHelper = $apiHelper;
    }

    /**
     * @inheritDoc
     */
    public function create(array $request)
    {
        $storeId=$request['storeId']??null;
        return $this->transferBuilder
            ->setUri($this->apiHelper->getApiUrl($storeId) . '/payment/charges')
            ->setHeaders([
                'Authorization'=>'Bearer ' . $this->apiHelper->getPrivateKey($storeId)
            ])
            ->setBody($request['data'])
            ->build();
    }
}
