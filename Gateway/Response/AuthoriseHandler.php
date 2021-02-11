<?php
namespace Chargeafter\Payment\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;

/**
 * Class AuthoriseHandler
 * @package Chargeafter\Payment\Gateway\Response
 */
class AuthoriseHandler implements HandlerInterface
{

    /**
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        $payment = $handlingSubject['payment']->getPayment();
        $payment->setAdditionalInformation('lender', $response['offer']['lender']['name']);
        $payment->setAdditionalInformation('chargeId', $response['id']);
        $payment->setTransactionId($response['id']);
        $payment->setIsTransactionClosed(false);
    }
}
