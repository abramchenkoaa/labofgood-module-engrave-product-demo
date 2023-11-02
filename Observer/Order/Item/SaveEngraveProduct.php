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

namespace Labofgood\EngraveProduct\Observer\Order\Item;

use Labofgood\EngraveProduct\Api\EngraveProductManagementInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Sales\Model\Order\Item;

/**
 * Class SaveEngraveProduct
 *
 * This class is utilized to link engraved products with an order item.
 */
class SaveEngraveProduct implements ObserverInterface
{
    /**
     * @param EngraveProductManagementInterface $engraveProductManagement
     */
    public function __construct(
        private readonly EngraveProductManagementInterface $engraveProductManagement
    ) {
    }

    /**
     * Update engrave product data in database after order item was saved.
     *
     * @param Observer $observer
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute(Observer $observer): void
    {
        /** @var Item $orderItem */
        $orderItem = $observer->getEvent()->getDataObject();
        $this->engraveProductManagement->saveToOrderItem($orderItem);
    }
}
