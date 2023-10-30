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

namespace Labofgood\EngraveProduct\Model\Service\ExtensionAttribute;

use Labofgood\EngraveProduct\Api\HasEngravedItemsManagementInterface;
use Magento\Sales\Api\Data\OrderExtension;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;

/**
 * Class HasEngravedItemsManagement
 *
 * Used to manage has_engraved_items extension attribute.
 */
class HasEngravedItemsManagement implements HasEngravedItemsManagementInterface
{
    /**
     * @param OrderExtensionFactory $orderExtensionFactory
     */
    public function __construct(
        private readonly OrderExtensionFactory $orderExtensionFactory
    ) {
    }

    /**
     * Load has_engraved_items flag and set it to order extension attributes.
     *
     * @param OrderInterface $order
     *
     * @return void
     */
    public function loadToOrder(OrderInterface $order): void
    {
        $extensionAttributes = $order->getExtensionAttributes();

        if ($extensionAttributes && $extensionAttributes->getHasEngravedItems() !== null) {
            return;
        }

        /** @var OrderExtension $orderExtension */
        $orderExtension = $extensionAttributes ?: $this->orderExtensionFactory->create();
        $orderExtension->setHasEngravedItems($order->getHasEngravedItems());
        $order->setExtensionAttributes($orderExtension);
    }

    /**
     * Save has_engraved_items flag from order extension attributes.
     *
     * @param OrderInterface $order
     *
     * @return void
     */
    public function saveToOrder(OrderInterface $order): void
    {
        $extensionAttributes = $order->getExtensionAttributes();

        if ($extensionAttributes !== null) {
            $value = $order->getExtensionAttributes()->getHasEngravedItems();

            if ($value !== null) {
                $order->setHasEngravedItems($value);
            }
        }
    }

    /**
     * Set has_engraved_items flag to order extension attributes.
     *
     * @param OrderInterface $order
     *
     * @return void
     */
    public function setToOrder(OrderInterface $order): void
    {
        foreach ($order->getItems() as $item) {
            $itemExtensionAttributes = $item->getExtensionAttributes();
            if ($itemExtensionAttributes && $itemExtensionAttributes->getEngraveProducts()) {
                $extensionAttributes = $order->getExtensionAttributes() ?: $this->orderExtensionFactory->create();
                $extensionAttributes->setHasEngravedItems(true);
                $order->setExtensionAttributes($extensionAttributes);

                break;
            }
        }
    }
}
