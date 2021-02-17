<?php

namespace Chargeafter\Payment\Observer;

use Chargeafter\Payment\Registry\CurrentProductRegistry;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Api\Data\ProductInterface;


class ProductInitAfter implements ObserverInterface
{
    /**
     * @var CurrentProductRegistry
     */
    private $currentProductRegistry;

    public function __construct(
        CurrentProductRegistry $currentProductRegistry
    ) {
        $this->currentProductRegistry = $currentProductRegistry;
    }
    public function execute(Observer $observer)
    {
        /**
         * @var ProductInterface
         */
        $product = $observer->getData('product');
        $this->currentProductRegistry->set($product);
    }
}
