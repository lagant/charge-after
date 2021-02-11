<?php

namespace Chargeafter\Payment\Gateway\Validator;

/**
 * Class ResponseValidator
 * @package Chargeafter\Payment\Gateway\Validator
 */
class ResponseValidator extends AbstractResponseValidator
{
    /**
     * @return array
     */
    protected function getResponseValidators():array
    {
        return [
            function ($validationSubject) {
                $response = $validationSubject['response'];
                return [
                    !key_exists('code', $response),
                    [$response['message'] ?? __('Braintree error response.')]
                ];
            }
        ];
    }
}
