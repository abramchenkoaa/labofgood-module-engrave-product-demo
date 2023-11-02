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

namespace Labofgood\EngraveProduct\Plugin\Quote;

use Labofgood\EngraveProduct\Api\EngraveProductManagementInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\ResourceModel\Quote\Item\Collection;

/**
 * Class LoadEngraveProduct
 *
 * Class for loading engrave product data to quote items collection.
 */
class LoadEngraveProduct
{
    /**
     * @param EngraveProductManagementInterface $engraveProductManagement
     */
    public function __construct(
        private readonly EngraveProductManagementInterface $engraveProductManagement
    ) {
    }

    /**
     * Load engrave product data to quote items collection.
     *
     * @param Quote $subject
     * @param Collection $result
     * @param bool $useCache
     *
     * @return Collection
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetItemsCollection(
        Quote $subject,
        Collection $result,
        $useCache = true
    ): Collection {
        $this->engraveProductManagement->loadToQuoteItemsCollection($result, $useCache);

        return $result;
    }
}
