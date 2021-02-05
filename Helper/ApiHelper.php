<?php

namespace Chargeafter\Payment\Helper;
use Magento\Payment\Gateway\ConfigInterface;
class ApiHelper
{
    protected $_config;
    public function __construct(
        ConfigInterface $config
    ) {
        $this->_config = $config;
    }

    public function getCdnUrl($storeId = null)
    {
        return $this->_config->getValue('environment', $storeId)==='sandbox' ? \Chargeafter\Payment\Model\Ui\ConfigProvider::SANDBOX_CDN_URL : \Chargeafter\Payment\Model\Ui\ConfigProvider::PRODUCTION_CDN_URL;
    }

    public function getPublicKey($storeId = null)
    {
        return $this->_config->getValue('environment', $storeId)==='sandbox' ? $this->_config->getValue('sandbox_public_key', $storeId) : $this->_config->getValue('production_public_key', $storeId);
    }

    public function getPrivateKey($storeId = null)
    {
        return $this->_config->getValue('environment', $storeId)==='sandbox' ? $this->_config->getValue('sandbox_private_key', $storeId) : $this->_config->getValue('production_private_key', $storeId);
    }
}
