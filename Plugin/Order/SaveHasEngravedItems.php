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
