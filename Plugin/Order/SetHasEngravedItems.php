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
