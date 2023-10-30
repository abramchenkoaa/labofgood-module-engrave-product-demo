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

use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Labofgood\EngraveProduct\Api\HasEngravedItemsManagementInterface;

/**
 * Class LoadHasEngravedItems
 *
 * Used to load has_engraved_items extension attribute.
 */
class LoadHasEngravedItems
{
    /**
     * @param HasEngravedItemsManagementInterface $hasEngravedItemsManagement
     */
    public function __construct(
        private readonly HasEngravedItemsManagementInterface $hasEngravedItemsManagement
    ) {
    }

    /**
     * Add has_engraved_items to "get" repository method output
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $resultOrder
     *
     * @return OrderInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    ): OrderInterface {
        $this->hasEngravedItemsManagement->loadToOrder($resultOrder);

        return $resultOrder;
    }

    /**
     * Add has_engraved_items to "getList" repository method output
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $resultOrder
     *
     * @return OrderSearchResultInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetList(
        OrderRepositoryInterface $subject,
        OrderSearchResultInterface $resultOrder
    ): OrderSearchResultInterface {
        foreach ($resultOrder->getItems() as $order) {
            $this->afterGet($subject, $order);
        }

        return $resultOrder;
    }
}
