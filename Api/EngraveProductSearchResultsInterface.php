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
