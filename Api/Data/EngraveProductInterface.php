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

namespace Labofgood\EngraveProduct\Api\Data;

/**
 * This interface allows for personalized engraving to be added
 * as an extension attribute to both order and quote items.
 *
 * @interface EngraveProductInterface
 * @api
 */
interface EngraveProductInterface
{
    /**
     * List of fields that are used in data interface.
     */
    public const ENTITY_ID = 'entity_id';
    public const TEXT = 'text';
    public const QUOTE_ITEM_ID = 'quote_item_id';
    public const ORDER_ITEM_ID = 'order_item_id';

    /**
     * Get entity id.
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Get engraving text value.
     *
     * @return string|null
     */
    public function getText(): ?string;

    /**
     * Get quote item id.
     *
     * @return int
     */
    public function getQuoteItemId(): int;

    /**
     * Get order item id.
     *
     * @return int
     */
    public function getOrderItemId(): int;

    /**
     * Set engraving text.
     *
     * @param string|null $textValue
     *
     * @return void
     */
    public function setText(?string $textValue): void;

    /**
     * Set quote item id.
     *
     * @param int|null $quoteItemId
     *
     * @return void
     */
    public function setQuoteItemId(?int $quoteItemId): void;

    /**
     * Set order item id.
     *
     * @param int|null $orderItemId
     *
     * @return void
     */
    public function setOrderItemId(?int $orderItemId): void;
}
