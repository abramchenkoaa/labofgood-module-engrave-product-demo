<?php
/**
 * Copyright © 2023 Anton Abramchenko. All rights reserved.
 *
 * Redistribution and use permitted under the BSD-3-Clause license.
 * For full details, see COPYING.txt.
 *
 * @author    Anton Abramchenko <anton.abramchenko@labofgood.com>
 * @copyright 2023 Anton Abramchenko
 * @license   See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Labofgood\EngraveProduct\Model\Data;

use Labofgood\EngraveProduct\Api\Data\EngraveProductInterface;
use Labofgood\EngraveProduct\Model\ResourceModel\EngraveProduct as EngraveProductResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class EngraveProduct.
 *
 * Engrave product data model. Also used as extension attribute for order and quote items.
 */
class EngraveProduct extends AbstractModel implements EngraveProductInterface
{
    /**
     * Magento DB model initialization
     */
    protected function _construct()
    {
        $this->_init(EngraveProductResource::class);
    }

    /**
     * Get entity id.
     *
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Get engraving text value.
     *
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->getData(self::TEXT);
    }

    /**
     * Get quote item id.
     *
     * @return int
     */
    public function getQuoteItemId(): int
    {
        return (int) $this->getData(self::QUOTE_ITEM_ID);
    }

    /**
     * Get order item id.
     *
     * @return int
     */
    public function getOrderItemId(): int
    {
        return (int) $this->getData(self::ORDER_ITEM_ID);
    }

    /**
     * Set engraving text.
     *
     * @param string|null $textValue
     *
     * @return void
     */
    public function setText(?string $textValue): void
    {
        $this->setData(self::TEXT, $textValue);
    }

    /**
     * Set quote item id.
     *
     * @param int|null $quoteItemId
     *
     * @return void
     */
    public function setQuoteItemId(?int $quoteItemId): void
    {
        $this->setData(self::QUOTE_ITEM_ID, $quoteItemId);
    }

    /**
     * Set order item id.
     *
     * @param int|null $orderItemId
     *
     * @return void
     */
    public function setOrderItemId(?int $orderItemId): void
    {
        $this->setData(self::ORDER_ITEM_ID, $orderItemId);
    }
}
