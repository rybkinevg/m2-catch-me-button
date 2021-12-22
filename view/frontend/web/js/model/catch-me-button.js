/**
 * CyberHULL_CatchMeButton
 *
 * @copyright Copyright (c) 2021 CyberHULL (https://www.cyberhull.com)
 * @author    Evgeniy Rybkin <evgeniy.rybkin@cyberhull.com>
 */

define([
    'jquery',
    'Magento_Ui/js/model/messageList',
    'mage/translate'
], function (
    $,
    messageList,
    $t
) {
    'use strict';

    var buttonClass = '.catch-me',
        activeClass = 'active',
        bodyClass   = 'catch-me-active';

    return {
        /**
         * Initiallizes catch me button
         *
         * @return {void}
         */
        initCatchMeButton: function () {
            if (this.isCatchMeButtonEnabled) {
                this.addBodyClass();
                this.initFloating();
                this.initCatchMe();
            }
        },

        /**
         * Checks is CyberHULL_CatchMeButton module enable
         *
         * @return {boolean}
         */
        isCatchMeButtonEnabled: function () {
            return window
                .checkoutConfig
                .catchMeButtonData
                .isModuleEnable;
        },

        /**
         * Retunrs array with button phrases
         *
         * @return {Array.<string>}
         */
        getButtonPhrases: function () {
            let phrases = window
                .checkoutConfig
                .catchMeButtonData
                .buttonPhrases;

            let formattedPhrases = [];

            if (phrases) {
                Object
                    .keys(phrases)
                    .map(function (key) {
                        formattedPhrases.push(phrases[key].phrase);
                    });
            }

            return formattedPhrases;
        },

        /**
         * Adds class to body node, to init styles
         *
         * @return {void}
         */
        addBodyClass: function () {
            $('body').addClass(bodyClass);
        },

        /**
         * Initiallizes catch me button floating
         *
         * @return {void}
         */
        initFloating: function () {
            $(document).on("mousemove", function (e) {
                $(buttonClass).each(function () {
                    $(this)
                        .addClass(activeClass)
                        .css({
                            marginLeft: -e.pageX / 100 + 50,
                            marginTop: -e.pageY / 100 + 50,
                        });
                });
            });
        },

        /**
         * Initiallizes catch me button behavior
         *
         * @return {void}
         */
        initCatchMe: function () {
            let getRandomInt = (min, max) => {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            let phrases = this.getButtonPhrases();

            $(buttonClass).each(function () {
                $(this).hover(function () {
                    $(this).css({
                        top: getRandomInt(0, 80) + "%",
                        left: getRandomInt(0, 80) + "%"
                    });

                    if (phrases) {
                        let index = getRandomInt(0, phrases.length);

                        $(this)
                            .find('span')
                            .text(phrases[index]);
                    }
                });
            });
        },

        /**
         * Executes clicked action
         *
         * @return {boolean}
         */
        doClickedAction: function () {
            let clickedActionType = window
                .checkoutConfig
                .catchMeButtonData
                .clickedActionType;

            let clickedAction = window
                .checkoutConfig
                .catchMeButtonData
                .clickedAction;

            if (clickedActionType && clickedAction) {
                if (clickedActionType == 'redirect') {
                    window.location.replace(clickedAction);
                } else if (clickedActionType == 'exception') {
                    let message = {message: $t(clickedAction)};

                    messageList.addErrorMessage(message);
                }

                return true;
            } else {
                return false;
            }
        },
    }
});
