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

namespace Labofgood\EngraveProduct\Model\Service\Statistic;

use Labofgood\EngraveProduct\Api\OrderStatisticOptionInterface;

/**
 * Class OrderStatisticOption
 *
 * Used to provided options for collecting orders statistic.
 */
class OrderStatisticOption implements OrderStatisticOptionInterface
{
    /**
     * @param bool $isEngraved
     * @param bool $isNotShipped
     */
    public function __construct(
        private readonly bool $isEngraved,
        private readonly bool $isNotShipped,
    ) {
    }

    /**
     * Is engraved option enabled.
     *
     * @return bool
     */
    public function isEngraved(): bool
    {
        return $this->isEngraved;
    }

    /**
     * Is not shipped option enabled.
     *
     * @return bool
     */
    public function isNotShipped(): bool
    {
        return $this->isNotShipped;
    }
}
