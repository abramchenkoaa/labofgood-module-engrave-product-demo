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

/**
 * Used for collecting orders statistic.
 *
 * @interface OrderStatisticCollectorInterface
 * @api
 */
interface OrderStatisticCollectorInterface
{
    /**
     * Get order statistic.
     *
     * @return int
     */
    public function execute(): int;
}
