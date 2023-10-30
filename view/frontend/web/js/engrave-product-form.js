/**
 * Copyright © 2023 Labofgood. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author    Anton Abramchenko <anton.abramchenko@labofgood.com>
 * @copyright 2023 Labofgood
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
define(['jquery', 'domReady!'], function($) {
    'use strict';

    let EngraveProductForm = function (options) {
        let that = this;

        /**
         * EngraveProductForm default options.
         * @type {{displayCheckboxSelector: string, wrapperSelector: string, addToCartFormSelector: string, engraveTextareaSelector: string}}
         */
        that.defaults = {
            wrapperSelector: '.product-info-main',
            displayCheckboxSelector: '.engrave-product-display',
            engraveTextareaSelector: '.engrave-product-textarea',
            addToCartFormSelector: '#product_addtocart_form'
        };

        /**
         * Init options
         * @type {Object}
         */
        that.opt = $.extend(that.default, options);

        /**
         * Toggle engrave textarea
         */
        function toggleEngraveTextarea() {
            $(this)
                .closest(that.opt.wrapperSelector)
                .find(that.opt.engraveTextareaSelector)
                .toggle();
        }

        /**
         * Add engrave data to "add to cart" form
         */
        function addEngraveDataToAddToCartForm() {
            let form = $(that.opt.addToCartFormSelector),
                engraveText = $(this).val();

            if (engraveText) {
                if ($('.engrave-text-value').length) {
                    form.find('.engrave-text-value').val(engraveText);
                } else {
                    form.append('<input type="hidden" class="engrave-text-value" ' +
                        'name="engrave_product[text]" value="' + engraveText + '">');
                }
            }
        }

        /**
         * Clean engraved data
         */
        function cleanEngravedData() {
            $(that.opt.engraveTextareaSelector + ' textarea').val('');
            $('.engrave-text-value').val('');
            $(that.opt.displayCheckboxSelector)
                .prop('checked', false)
                .trigger('change');
        }

        /**
         * Bind events
         */
        $(document).on('change', that.opt.displayCheckboxSelector, toggleEngraveTextarea);
        $(document).on('change', that.opt.engraveTextareaSelector + ' textarea', addEngraveDataToAddToCartForm);
        $(document).on('ajax:addToCart:error', cleanEngravedData);
        $(document).on('ajax:addToCart', cleanEngravedData);
    }

    return function(config) {
        new EngraveProductForm(config);
    };
});

