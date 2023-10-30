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
