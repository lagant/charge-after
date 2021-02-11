<?php

namespace Chargeafter\Payment\Helper;

use Magento\Payment\Gateway\ConfigInterface;

class ApiHelper
{
    const PRODUCTION_CDN_URL = "https://cdn.chargeafter.com";
    const SANDBOX_CDN_URL = "https://cdn-sandbox.ca-dev.co";
    const SANDBOX_API_URL = "https://api-sandbox.ca-dev.co/v1";
    const PRODUCTION_API_URL = "https://api.chargeafter.com/v1";

    protected $_config;
    public function __construct(
        ConfigInterface $config
    ) {
        $this->_config = $config;
    }

    public function getCdnUrl($storeId = null)
    {
        return $this->_config->getValue('environment', $storeId)==='sandbox' ? self::SANDBOX_CDN_URL : self::PRODUCTION_CDN_URL;
    }

    public function getApiUrl($urn=null, $storeId = null)
    {
        return ($this->_config->getValue('environment', $storeId)==='sandbox' ? self::SANDBOX_API_URL : self::PRODUCTION_API_URL) . $urn;
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
