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
