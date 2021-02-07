<?php

namespace Chargeafter\Payment\Gateway\Validator;
use Magento\Payment\Gateway\Validator\AbstractValidator;
class AuthorizeResponseValidator extends AbstractValidator
{

    public function validate(array $validationSubject)
    {
        $response = $validationSubject['response']['data'];

        $isValid = true;
        $errorMessages = [];
        $errorCodes = [];

        foreach ($this->getResponseValidators() as $validator) {
            $validationResult = $validator($response);

            if (!$validationResult[0]) {
                $isValid = $validationResult[0];
                $errorMessages = array_merge($errorMessages, $validationResult[1]);
            }
        }

        return $this->createResult($isValid, $errorMessages, $errorCodes);
    }

    /**
     * @return array
     */
    protected function getResponseValidators()
    {
        return [
            function ($response) {
                return [
                    property_exists($response, 'state') && $response->state === 'AUTHORIZED',
                    [$response->message ?? __('Braintree error response.')]
                ];
            }
        ];
    }
}
