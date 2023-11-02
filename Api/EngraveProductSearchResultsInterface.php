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

use Labofgood\EngraveProduct\Api\Data\EngraveProductInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * EngraveProduct search result interface
 *
 * @interface EngraveProductSearchResultInterface.
 * @api
 */
interface EngraveProductSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get result items.
     *
     * @return EngraveProductInterface[]
     */
    public function getItems(): array;

    /**
     * Set result items.
     *
     * @param EngraveProductInterface[] $items
     *
     * @return EngraveProductSearchResultsInterface
     */
    public function setItems(array $items): EngraveProductSearchResultsInterface;
}
