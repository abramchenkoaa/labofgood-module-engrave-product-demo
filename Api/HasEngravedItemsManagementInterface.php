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

namespace Labofgood\EngraveProduct\Api;

use Magento\Sales\Api\Data\OrderInterface;

/**
 * Used to manage has_engraved_items extension attribute.
 *
 * @interface HasEngravedItemsManagementInterface
 * @api
 */
interface HasEngravedItemsManagementInterface
{
    /**
     * Load has_engraved_items flag and set it to order extension attributes.
     *
     * @param OrderInterface $order
     *
     * @return void
     */
    public function loadToOrder(OrderInterface $order): void;

    /**
     * Save has_engraved_items flag from order extension attributes.
     *
     * @param OrderInterface $order
     *
     * @return void
     */
    public function saveToOrder(OrderInterface $order): void;

    /**
     * Set has_engraved_items flag to order extension attributes.
     *
     * @param OrderInterface $order
     *
     * @return void
     */
    public function setToOrder(OrderInterface $order): void;
}
