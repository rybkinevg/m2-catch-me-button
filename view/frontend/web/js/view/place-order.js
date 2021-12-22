/**
 * CyberHULL_CatchMeButton
 *
 * @copyright Copyright (c) 2021 CyberHULL (https://www.cyberhull.com)
 * @author    Evgeniy Rybkin <evgeniy.rybkin@cyberhull.com>
 */

define([
    'jquery',
    'underscore',
    'uiComponent',
    'CyberHULL_CatchMeButton/js/model/catch-me-button'
], function (
    $,
    _,
    Component,
    catchMeButton
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: {
                name: 'CyberHULL_CatchMeButton/place-order',
                afterRender: function () {
                    catchMeButton.initCatchMeButton();
                }
            }
        },

        /**
         * Initiallizes component
         *
         * @return {void}
         */
        initialize: function () {
            this._super();
        },

        /**
         * Place order action
         *
         * @return {void}
         */
        placeOrder: function () {
            if (catchMeButton.isCatchMeButtonEnabled()) {
                // if clicked action type = placeOrder
                if (!catchMeButton.doClickedAction()) {
                    this.triggerPlaceOrder();
                }
            } else {
                this.triggerPlaceOrder();
            }
        },

        /**
         * Triggers active payment method button click
         *
         * @return {void}
         */
        triggerPlaceOrder: function () {
            $('.payment-method._active')
                .find('.actions-toolbar button.action')
                .trigger('click');
        },
    });
});
