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
