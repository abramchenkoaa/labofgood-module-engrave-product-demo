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
