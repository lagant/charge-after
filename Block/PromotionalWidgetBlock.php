<?php

namespace Chargeafter\Payment\Block;

use Chargeafter\Payment\Registry\CurrentProductRegistry;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\View\Element\Template;


/**
 * Class PromotionalWidgetBlock
 * @package Chargeafter\Payment\ViewModel
 */
class PromotionalWidgetBlock extends Template
{
    /**
     * @var CurrentProductRegistry
     */
    private $currentProductRegistry;

    /**
     * CurrentProduct constructor.
     * @param CurrentProductRegistry $currentProductRegistry
     */
    public function __construct(
        CurrentProductRegistry $currentProductRegistry
    ) {
        $this->currentProductRegistry = $currentProductRegistry;
    }
    public function getProduct(): ProductInterface
    {
        return $this->currentProductRegistry->get();
    }
}
