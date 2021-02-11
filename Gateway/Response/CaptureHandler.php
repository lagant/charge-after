<?php
namespace Chargeafter\Payment\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;

/**
 * Class CaptureHandler
 * @package Chargeafter\Payment\Gateway\Response
 */
class CaptureHandler implements HandlerInterface
{

    /**
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        $payment = $handlingSubject['payment']->getPayment();
        $payment->setTransactionId($response['id']);
    }
}
