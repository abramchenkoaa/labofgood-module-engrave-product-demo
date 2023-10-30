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
 * Used to provided options for collecting orders statistic.
 *
 * @interface OrderStatisticOptionInterface
 * @api
 */
interface OrderStatisticOptionInterface
{
    /**
     * Is engraved option enabled.
     *
     * @return bool
     */
    public function isEngraved(): bool;

    /**
     * Is not shipped option enabled.
     *
     * @return bool
     */
    public function isNotShipped(): bool;
}
