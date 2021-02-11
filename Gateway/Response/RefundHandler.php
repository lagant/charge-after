<?php
namespace Chargeafter\Payment\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;

/**
 * Class RefundHandler
 * @package Chargeafter\Payment\Gateway\Response
 */
class RefundHandler implements HandlerInterface
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
