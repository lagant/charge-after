<?php

namespace Chargeafter\Payment\Gateway\Http;

use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Payment\Gateway\Http\ClientException;
use Magento\Payment\Gateway\Http\ClientInterface;

use Magento\Payment\Gateway\Http\ConverterException;
use Magento\Payment\Gateway\Http\ConverterInterface;
use Magento\Payment\Gateway\Http\TransferInterface;
use Zend_Http_Client_Exception;

class Client implements ClientInterface
{
    /**
     * @var ZendClientFactory
     */
    private $clientFactory;

    /**
     * @var ConverterInterface | null
     */
    private $converter;

    /**
     * Client constructor.
     * @param ZendClientFactory $clientFactory
     * @param ConverterInterface|null $converter
     */
    public function __construct(
        ZendClientFactory $clientFactory,
        ConverterInterface $converter = null
    ) {
        $this->clientFactory = $clientFactory;
        $this->converter = $converter;
    }

    /**
     * @param TransferInterface $transferObject
     * @return array
     * @throws ClientException
     * @throws ConverterException
     */
    public function placeRequest(TransferInterface $transferObject): array
    {
        try {
            $client = $this->clientFactory->create(['uri'=>$transferObject->getUri()])
            ->setHeaders($transferObject->getHeaders())
            ->setMethod($transferObject->getMethod());
            if ($transferObject->getMethod()===$client::POST && $transferObject->getBody()) {
                $client->setRawData(json_encode($transferObject->getBody()), 'application/json');
            }

            $response = $client->request();

            $result = $this->converter
                ? $this->converter->convert($response->getBody())
                : json_decode($response->getBody(), true);
        } catch (Zend_Http_Client_Exception $e) {
            throw new ClientException(
                __($e->getMessage())
            );
        } catch (ConverterException $e) {
            throw $e;
        }
        return $result;
    }
}
