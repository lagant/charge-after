<?php

namespace Chargeafter\Payment\Gateway\Validator;

use Magento\Payment\Gateway\Validator\AbstractValidator;
use Magento\Payment\Gateway\Validator\ResultInterfaceFactory;
use Chargeafter\Payment\Helper\ApiHelper;

class AvailabilityValidator extends AbstractValidator
{
    protected $_helper;

    public function __construct(
        ResultInterfaceFactory $resultFactory,
        ApiHelper $helper
    ) {
        parent::__construct($resultFactory);
        $this->_helper = $helper;
    }

    /**
     * @inheritDoc
     */
    public function validate(array $validationSubject)
    {
        $storeId = $validationSubject['storeId'];

        $publicKey = $this->_helper->getPublicKey($storeId);
        $privateKey = $this->_helper->getPrivateKey($storeId);

        if (empty($publicKey) || empty($privateKey)) {
            return $this->createResult(false, [__('Chargeafter API Credentials are required')]);
        }

        return $this->createResult(true);
    }
}
