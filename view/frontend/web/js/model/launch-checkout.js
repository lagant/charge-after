/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
    'jquery',
    'Chargeafter_Payment/js/model/error-processor',
], function ($, errorProcessor) {
    'use strict';

    return function (options, messageContainer) {

        return $.Deferred(function (deferred){
            options.callback = function (token, data, error) {
                if(error){
                    deferred.reject(error);
                }else{
                    deferred.resolve({token, data});
                }
            };
            ChargeAfter.checkout.present(options);
        }).fail(
            function (error) {
                errorProcessor.process(error, messageContainer);
            }
        )

    };
});
