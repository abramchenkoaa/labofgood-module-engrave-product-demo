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

namespace Labofgood\EngraveProduct\Plugin\Quote\ToOrderItem;

use Labofgood\EngraveProduct\Api\EngraveProductManagementInterface;
use Magento\Quote\Model\Quote\Address\Item as AddressItem;
use Magento\Quote\Model\Quote\Item;
use Magento\Quote\Model\Quote\Item\ToOrderItem;
use Magento\Sales\Api\Data\OrderItemInterface;

/**
 * Class CopyEngraveProduct
 *
 * Class for copying engrave product data from quote item extension attribute
 * to order item extension attribute.
 */
class CopyEngraveProduct
{
    /**
     * @param EngraveProductManagementInterface $engraveProductManagement
     */
    public function __construct(
        private readonly EngraveProductManagementInterface $engraveProductManagement,
    ) {
    }

    /**
     * Copy engrave product data from quote item to order item.
     *
     * @param ToOrderItem $subject
     * @param OrderItemInterface $result
     * @param AddressItem|Item $item
     * @param array $data
     *
     * @return OrderItemInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterConvert(
        ToOrderItem $subject,
        OrderItemInterface $result,
        $item,
        $data = []
    ): OrderItemInterface {
        if ($item instanceof AddressItem) {
            return $result;
        }

        $this->engraveProductManagement->copyToOrderItem($result, $item);

        return $result;
    }
}
