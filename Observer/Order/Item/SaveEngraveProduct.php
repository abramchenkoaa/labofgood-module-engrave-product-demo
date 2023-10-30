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
