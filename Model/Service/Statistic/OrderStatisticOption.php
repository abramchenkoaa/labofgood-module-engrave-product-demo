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
