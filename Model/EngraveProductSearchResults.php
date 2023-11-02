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

namespace Labofgood\EngraveProduct\Model;

use Labofgood\EngraveProduct\Api\EngraveProductSearchResultsInterface;
use Labofgood\EngraveProduct\Api\Data\EngraveProductInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * EngraveProductSearchResults
 *
 * Search result class for EngraveProduct
 */
class EngraveProductSearchResults implements EngraveProductSearchResultsInterface
{
    /**
     * @var EngraveProductInterface[]
     */
    private array $items = [];

    /**
     * @var SearchCriteriaInterface
     */
    private SearchCriteriaInterface $searchCriteria;

    /**
     * @var int
     */
    private int $totalCount;

    /**
     * Get result items.
     *
     * @return EngraveProductInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Set result items.
     *
     * @param EngraveProductInterface[] $items
     *
     * @return EngraveProductSearchResultsInterface
     */
    public function setItems(array $items): EngraveProductSearchResultsInterface
    {
        $this->items = $items;
        $this->setTotalCount(count($this->items));

        return $this;
    }

    /**
     * Get search criteria.
     *
     * @return SearchCriteriaInterface
     */
    public function getSearchCriteria(): SearchCriteriaInterface
    {
        return $this->searchCriteria;
    }

    /**
     * Set search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return EngraveProductSearchResultsInterface
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria): EngraveProductSearchResultsInterface
    {
        $this->searchCriteria = $searchCriteria;

        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     *
     * @return EngraveProductSearchResultsInterface
     */
    public function setTotalCount($totalCount): EngraveProductSearchResultsInterface
    {
        $this->totalCount = $totalCount;

        return $this;
    }
}
