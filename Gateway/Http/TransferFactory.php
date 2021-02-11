<?php

namespace Chargeafter\Payment\Gateway\Http;

use Chargeafter\Payment\Helper\ApiHelper;
use Magento\Payment\Gateway\Http\TransferBuilder;
use Magento\Payment\Gateway\Http\TransferFactoryInterface;

abstract class TransferFactory implements TransferFactoryInterface
{
    /**
     * @var TransferBuilder
     */
    protected $_transferBuilder;
    /**
     * @var ApiHelper
     */
    protected $_apiHelper;

    /**
     * @param TransferBuilder $transferBuilder
     * @param ApiHelper $apiHelper
     */
    public function __construct(
        TransferBuilder $transferBuilder,
        ApiHelper $apiHelper
    ) {
        $this->_transferBuilder=$transferBuilder;
        $this->_apiHelper = $apiHelper;
    }
}
