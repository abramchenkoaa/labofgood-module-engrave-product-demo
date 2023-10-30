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

namespace Labofgood\EngraveProduct\Observer\Quote\Item;

use Labofgood\EngraveProduct\Api\EngraveProductManagementInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Quote\Model\Quote\Item;

/**
 * Class SaveEngraveProduct
 *
 * Class for saving engrave product data to cart item.
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
     * Save engrave product data to database after quote item was saved.
     *
     * @param Observer $observer
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute(Observer $observer): void
    {
        /** @var Item $quoteItem */
        $quoteItem = $observer->getEvent()->getDataObject();
        $this->engraveProductManagement->saveToQuoteItem($quoteItem);
    }
}
