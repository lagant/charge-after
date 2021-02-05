<?php
namespace Chargeafter\Payment\Model\Ui;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\View\Asset\Repository as AssetRepository;
use Magento\Payment\Model\MethodInterface;
use Chargeafter\Payment\Helper\ApiHelper;

class ConfigProvider implements ConfigProviderInterface
{
    const CODE = 'chargeafter';
    const PRODUCTION_CDN_URL = "https://cdn.chargeafter.com";
    const SANDBOX_CDN_URL = "https://cdn-sandbox.ca-dev.co";

    protected $_method;
    protected $_assetRepo;
    protected $_helper;

    public function __construct(
        MethodInterface $method,
        AssetRepository $assetRepo,
        ApiHelper $helper
    ) {
        $this->_method = $method;
        $this->_assetRepo = $assetRepo;
        $this->_helper = $helper;
    }

    public function getConfig()
    {
        return [
            'payment'=>[
                self::CODE=>[
                    'description'=>$this->_method->getConfigData('description'),
                    'logo'=> ($logo = $this->_method->getConfigData('logo')) ? $this->_assetRepo->getUrl("Chargeafter_Payment::images/" . $logo . ".svg") : null,
                    'cdnUrl' => $this->_helper->getCdnUrl(),
                    'publicKey' => $this->_helper->getPublicKey()
                ]
            ]
        ];
    }
}
