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

namespace Labofgood\EngraveProduct\Plugin\Order;

use Labofgood\EngraveProduct\Api\HasEngravedItemsManagementInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderManagementInterface;

/**
 * Class SaveHasEngravedItems
 *
 * Get order items and check if there are any engraved items
 * if yes, set has_engraved_items flag to order.
 */
class SetHasEngravedItems
{
    /**
     * @param HasEngravedItemsManagementInterface $hasEngravedItemsManagement
     */
    public function __construct(
        private readonly HasEngravedItemsManagementInterface $hasEngravedItemsManagement
    ) {
    }

    /**
     * Set has_engraved_items flag to order.
     *
     * @param OrderManagementInterface $subject
     * @param OrderInterface $order
     *
     * @return OrderInterface[]
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforePlace(
        OrderManagementInterface $subject,
        OrderInterface $order
    ): array {
        $this->hasEngravedItemsManagement->setToOrder($order);

        return [$order];
    }
}
