<?php

namespace Chargeafter\Payment\Gateway\Http;

use Chargeafter\Payment\Helper\ApiHelper;
use Magento\Framework\HTTP\ZendClient;

use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Payment\Gateway\Http\ClientInterface;

use Magento\Payment\Gateway\Http\ConverterInterface;
use Magento\Payment\Gateway\Http\TransferInterface;

class Client implements ClientInterface
{
    private $clientFactory;

    /**
     * @var ConverterInterface | null
     */
    private $converter;

    public function __construct(
        ZendClientFactory $clientFactory,
        ConverterInterface $converter = null
    ) {
        $this->clientFactory = $clientFactory;
        $this->converter = $converter;
    }

    public function placeRequest(TransferInterface $transferObject)
    {
        /** @var ZendClient $client */
        $client = $this->clientFactory->create(['uri'=>$transferObject->getUri()])
            ->setHeaders($transferObject->getHeaders())
            ->setMethod('POST')
            ->setRawData(json_encode($transferObject->getBody()), 'application/json');
        try {
            $response = $client->request();

            $result = $this->converter
                ? $this->converter->convert($response->getBody())
                : ['data'=>json_decode($response->getBody())];
        } catch (\Zend_Http_Client_Exception $e) {
            throw new \Magento\Payment\Gateway\Http\ClientException(
                __($e->getMessage())
            );
        } catch (\Magento\Payment\Gateway\Http\ConverterException $e) {
            throw $e;
        }


        return $result;
    }
}
