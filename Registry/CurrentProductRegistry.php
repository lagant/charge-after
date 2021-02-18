<?php

namespace Chargeafter\Payment\Registry;

use Magento\Catalog\Api\Data\ProductInterface;

class CurrentProductRegistry
{
    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @return ProductInterface||null
     */
    public function get(): ?ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     */
    public function set(ProductInterface $product): void
    {
        $this->product = $product;
    }
}
