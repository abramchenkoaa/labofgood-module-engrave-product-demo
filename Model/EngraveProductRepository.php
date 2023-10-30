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

use Labofgood\EngraveProduct\Api\Data\EngraveProductInterface;
use Labofgood\EngraveProduct\Api\Data\EngraveProductInterfaceFactory;
use Labofgood\EngraveProduct\Api\EngraveProductRepositoryInterface;
use Labofgood\EngraveProduct\Api\EngraveProductSearchResultsInterface;
use Labofgood\EngraveProduct\Api\EngraveProductSearchResultsInterfaceFactory;
use Labofgood\EngraveProduct\Model\ResourceModel\EngraveProduct as EngraveProductResourceModel;
use Labofgood\EngraveProduct\Model\ResourceModel\EngraveProduct\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class EngraveProductRepository.
 *
 * Repository to perform CRUD operations on engrave product data.
 */
class EngraveProductRepository implements EngraveProductRepositoryInterface
{
    /**
     * Local instances cache.
     *
     * @var EngraveProductInterface[]
     */
    private array $instances = [];

    /**
     * EngraveProductRepository constructor.
     *
     * @param EngraveProductResourceModel $engraveProductResourceModel
     * @param EngraveProductInterfaceFactory $engraveProductFactory
     * @param CollectionFactory $engraveProductCollectionFactory
     * @param EngraveProductSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        private readonly EngraveProductResourceModel $engraveProductResourceModel,
        private readonly EngraveProductInterfaceFactory $engraveProductFactory,
        private readonly CollectionFactory $engraveProductCollectionFactory,
        private readonly EngraveProductSearchResultsInterfaceFactory $searchResultsFactory,
        private readonly CollectionProcessorInterface $collectionProcessor,
    ) {
    }

    /**
     * Save EngraveProduct Record.
     *
     * @param EngraveProductInterface $engraveProduct
     *
     * @return EngraveProductInterface
     * @throws CouldNotSaveException
     */
    public function save(EngraveProductInterface $engraveProduct): EngraveProductInterface
    {
        try {
            $this->engraveProductResourceModel->save($engraveProduct);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('EngraveProduct model could not be saved.'),
                $exception
            );
        }

        return $engraveProduct;
    }

    /**
     * Load EngraveProduct data by given id
     *
     * @param int $entityId
     * @param bool $force
     *
     * @return EngraveProductInterface
     * @throws NoSuchEntityException
     */
    public function get(int $entityId, bool $force = false): EngraveProductInterface
    {
        if (!$force && array_key_exists($entityId, $this->instances)) {
            return $this->instances[$entityId];
        }

        $engraveProduct = $this->engraveProductFactory->create();
        $this->engraveProductResourceModel->load($engraveProduct, $entityId);

        if (!$engraveProduct->getEntityId()) {
            throw new NoSuchEntityException(
                __('EngraveProduct with id %1 does not exist.', $entityId)
            );
        }

        $this->instances[$entityId] = $engraveProduct;

        return $engraveProduct;
    }

    /**
     * Find EngraveProducts by SearchCriteria
     *
     * @param SearchCriteriaInterface $criteria
     *
     * @return EngraveProductSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): EngraveProductSearchResultsInterface
    {
        $collection = $this->engraveProductCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        /** @var EngraveProductInterface[] $items */
        $items = $collection->getItems();
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->count());

        return $searchResults;
    }

    /**
     * Delete EngraveProduct record
     *
     * @param EngraveProductInterface $engraveProduct
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function delete(EngraveProductInterface $engraveProduct): void
    {
        try {
            $this->engraveProductResourceModel->delete($engraveProduct);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('EngraveProduct model could not be deleted.'),
                $exception
            );
        }
    }
}
