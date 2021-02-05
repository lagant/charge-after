<?php

namespace Chargeafter\Payment\Observer;

use Chargeafter\Payment\Helper\ApiHelper;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class PaymentMethodIsActive implements ObserverInterface
{
    protected $_apiHelper;

    public function __construct(ApiHelper $apiHelper)
    {
        $this->_apiHelper = $apiHelper;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $methodInstance = $observer->getData('method_instance');

        if ($methodInstance->getCode() === 'chargeafter') {
            $quote = $observer->getData('quote');
            $storeId = $quote ? $quote->getStoreId() : null;
            if (!($this->_apiHelper->getPublicKey($storeId) && $this->_apiHelper->getPrivateKey($storeId))) {
                $result = $observer->getData('result');
                $result->setData('is_available', false);
            }
        }
    }
}
