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
use Magento\Sales\Api\OrderRepositoryInterface;

/**
 * Class SaveHasEngravedItems
 *
 * Used to save has_engraved_items extension attribute.
 */
class SaveHasEngravedItems
{
    /**
     * @param HasEngravedItemsManagementInterface $hasEngravedItemsManagement
     */
    public function __construct(
        private readonly HasEngravedItemsManagementInterface $hasEngravedItemsManagement
    ) {
    }

    /**
     * Save has_engraved_items extension attribute.
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     *
     * @return OrderInterface[]
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSave(
        OrderRepositoryInterface $subject,
        OrderInterface $order
    ): array {
        $this->hasEngravedItemsManagement->saveToOrder($order);

        return [$order];
    }
}
