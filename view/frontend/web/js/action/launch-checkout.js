/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
    'Magento_Checkout/js/model/quote',
    'Magento_Customer/js/model/customer',
    'Chargeafter_Payment/js/model/launch-checkout',
], function (quote, customer, launchCheckoutService) {
    'use strict';

    return function (messageContainer) {

        const billingAddress = quote.billingAddress();
        const shippingAddress = quote.shippingAddress();

        const consumerDetails = {
            firstName: billingAddress.firstname,
            lastName: billingAddress.lastname,
            mobilePhoneNumber: billingAddress.telephone,
            shippingAddress: {
                city: shippingAddress.city,
                zipCode: shippingAddress.postcode,
                state: shippingAddress.regionCode
            },
            billingAddress: {
                city: billingAddress.city,
                zipCode: billingAddress.postcode,
                state: billingAddress.regionCode
            }
        };

        shippingAddress.street.forEach((line,index)=>consumerDetails.shippingAddress[`line${++index}`]=line);
        billingAddress.street.forEach((line,index)=>consumerDetails.billingAddress[`line${++index}`]=line);

        if(customer.isLoggedIn()){
            consumerDetails.email=customer.customerData.email;
            consumerDetails.merchantConsumerId=customer.customerData.id;
        }else{
            consumerDetails.email=quote.guestEmail;
        }

        const totals = quote.totals();

        const cartDetails = {
            /*discounts: [
                {
                    name: "Birthday discount",
                    amount: 20
                }
            ],*/
            taxAmount: totals.tax_amount,
            shippingAmount: totals.shipping_amount,
            totalAmount: quote.getCalculatedTotal()
        };

        cartDetails.items = quote.getItems().map(item=>({
            name: item.name,
            price: parseFloat(item.price),
            sku: item.sku,
            quantity: item.qty,
            //leasable: true,
            //productCategory: "Product category",
            /*warranty: {
                name: "Awesome Warranty",
                price: 100.0,
                sku: "AWSMWRNTY"
            }*/
        }));

        const options =  {
            consumerDetails,

            cartDetails,

            onDataUpdate(updatedData, callback) {
                callback();
            },

        };

        return launchCheckoutService(options, messageContainer);
    };
});