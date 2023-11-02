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
