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
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Repository to perform CRUD operations on engrave product data.
 *
 * @interface EngraveProductSearchResultInterface.
 * @api
 */
interface EngraveProductRepositoryInterface
{
    /**
     * Save EngraveProduct Record.
     *
     * @param EngraveProductInterface $engraveProduct
     *
     * @return EngraveProductInterface
     * @throws CouldNotSaveException
     */
    public function save(EngraveProductInterface $engraveProduct): EngraveProductInterface;

    /**
     * Load EngraveProduct data by given id
     *
     * @param int $entityId
     *
     * @return EngraveProductInterface
     * @throws NoSuchEntityException
     */
    public function get(int $entityId): EngraveProductInterface;

    /**
     * Find EngraveProducts by SearchCriteria
     *
     * @param SearchCriteriaInterface $criteria
     *
     * @return EngraveProductSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): EngraveProductSearchResultsInterface;

    /**
     * Delete EngraveProduct record
     *
     * @param EngraveProductInterface $engraveProduct
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function delete(EngraveProductInterface $engraveProduct): void;
}
