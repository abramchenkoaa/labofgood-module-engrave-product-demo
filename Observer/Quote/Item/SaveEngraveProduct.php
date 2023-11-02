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
