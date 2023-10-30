<?php
/**
 * Copyright © 2023 Labofgood. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author    Anton Abramchenko <anton.abramchenko@labofgood.com>
 * @copyright 2023 Labofgood
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
declare(strict_types=1);

namespace Labofgood\EngraveProduct\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Quote\Model\Quote\Item as QuoteItem;
use Magento\Quote\Model\ResourceModel\Quote\Item\Collection as QuoteItemCollection;
use Magento\Sales\Api\Data\OrderItemInterface;

/**
 * Used to manage engrave_product extension attribute.
 *
 * @interface EngraveProductManagementInterface
 * @api
 */
interface EngraveProductManagementInterface
{
    /**
     * Set engrave data to quote item as extension attribute.
     *
     * @param array{text: string} $engraveProductData
     * @param QuoteItem $item
     *
     * @return void
     */
    public function setToQuoteItem(array $engraveProductData, QuoteItem $item): void;

    /**
     * Load engrave products data to quote items collection.
     *
     * @param QuoteItemCollection $collection
     * @param bool $useCache
     *
     * @return void
     */
    public function loadToQuoteItemsCollection(QuoteItemCollection $collection, bool $useCache = true): void;

    /**
     * Copy engrave product data from quote item to order item.
     *
     * @param OrderItemInterface $orderItem
     * @param QuoteItem $quoteItem
     *
     * @return void
     */
    public function copyToOrderItem(OrderItemInterface $orderItem, QuoteItem $quoteItem): void;

    /**
     * Link engrave product data to quote item and save it to database.
     *
     * @param QuoteItem $quoteItem
     *
     * @return void
     */
    public function saveToQuoteItem(QuoteItem $quoteItem): void;

    /**
     * Link engrave product data to order item and save it to database.
     *
     * @param OrderItemInterface $orderItem
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function saveToOrderItem(OrderItemInterface $orderItem): void;
}
