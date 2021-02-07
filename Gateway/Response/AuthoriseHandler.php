<?php
namespace Chargeafter\Payment\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;

class AuthoriseHandler implements HandlerInterface
{

    /**
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        $payment = $handlingSubject['payment']->getPayment();
        $payment->setAdditionalInformation('lender', $response['data']->offer->lender->name);
    }
}
