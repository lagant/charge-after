<?php

namespace Chargeafter\Payment\Gateway\Validator;
/**
 * Class AuthorizeResponseValidator
 * @package Chargeafter\Payment\Gateway\Validator
 */
class AuthorizeResponseValidator extends ResponseValidator
{
    /**
     * @return array
     */
    protected function getResponseValidators(): array
    {
        return [
            function ($validationSubject) {
                $response = $validationSubject['response'];
                return [
                    key_exists('state', $response) && $response['state'] === 'AUTHORIZED',
                    [$response['message'] ?? __('Braintree error response.')]
                ];
            }
        ];
    }
}
