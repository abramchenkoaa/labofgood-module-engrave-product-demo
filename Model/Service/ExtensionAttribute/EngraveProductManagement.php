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

namespace Labofgood\EngraveProduct\Model\Service\ExtensionAttribute;

use Labofgood\EngraveProduct\Api\Data\EngraveProductInterfaceFactory;
use Labofgood\EngraveProduct\Api\EngraveProductManagementInterface;
use Labofgood\EngraveProduct\Api\EngraveProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Quote\Api\Data\CartItemExtensionFactory;
use Magento\Quote\Model\Quote\Item as QuoteItem;
use Magento\Quote\Model\ResourceModel\Quote\Item\Collection as QuoteItemCollection;
use Magento\Sales\Api\Data\OrderItemExtensionFactory;
use Magento\Sales\Api\Data\OrderItemInterface;

/**
 * Class EngraveProductManagement
 *
 * Used to manage engrave_product extension attribute.
 */
class EngraveProductManagement implements EngraveProductManagementInterface
{
    /**
     * @var int[]
     */
    private array $quoteItemsIds = [];

    /**
     * @param CartItemExtensionFactory $cartItemExtensionFactory
     * @param EngraveProductInterfaceFactory $engraveProductInterfaceFactory
     * @param EngraveProductRepositoryInterface $engraveProductRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param OrderItemExtensionFactory $orderItemExtensionFactory
     */
    public function __construct(
        private readonly CartItemExtensionFactory $cartItemExtensionFactory,
        private readonly EngraveProductInterfaceFactory $engraveProductInterfaceFactory,
        private readonly EngraveProductRepositoryInterface $engraveProductRepository,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly OrderItemExtensionFactory $orderItemExtensionFactory
    ) {
    }
    /**
     * Set engrave data to quote item as extension attribute.
     *
     * @param array{text: string} $engraveProductData
     * @param QuoteItem $item
     *
     * @return void
     */
    public function setToQuoteItem(array $engraveProductData, QuoteItem $item): void
    {
        $extensionAttributes = $item->getExtensionAttributes() ?: $this->cartItemExtensionFactory->create();
        $engraveProduct = $this->engraveProductInterfaceFactory
            ->create(['data' => $engraveProductData]);
        $engraveProducts = $extensionAttributes->getEngraveProducts() ?? [];
        $engraveProducts[] = $engraveProduct;

        $extensionAttributes->setEngraveProducts($engraveProducts);
        $item->setExtensionAttributes($extensionAttributes);
    }

    /**
     * Load engrave products data to quote items collection.
     *
     * @param QuoteItemCollection $collection
     * @param bool $useCache
     *
     * @return void
     */
    public function loadToQuoteItemsCollection(QuoteItemCollection $collection, bool $useCache = true): void
    {
        $quoteItems = $collection->getItems();
        $quoteItemsIds = array_map(static function ($item) {
            return $item->getItemId();
        }, $quoteItems);

        $newQuoteItemsIds = array_diff($quoteItemsIds, $this->quoteItemsIds);

        if ($useCache && !$newQuoteItemsIds) {
            return;
        }

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('quote_item_id', $useCache ? $newQuoteItemsIds : $quoteItemsIds, 'in')
            ->create();

        $engraveProductList = $this->engraveProductRepository
            ->getList($searchCriteria)
            ->getItems();

        $indexedEngraveProductList = [];
        foreach ($engraveProductList as $engraveProduct) {
            $indexedEngraveProductList[$engraveProduct->getQuoteItemId()][] = $engraveProduct;
        }

        foreach ($quoteItems as $quoteItem) {
            $engraveProducts = $indexedEngraveProductList[$quoteItem->getItemId()] ?? [];

            if ($engraveProducts) {
                $extensionAttributes = $quoteItem->getExtensionAttributes()
                    ?: $this->cartItemExtensionFactory->create();
                $extensionAttributes->setEngraveProducts($engraveProducts);
                $quoteItem->setExtensionAttributes($extensionAttributes);
            }
        }

        $this->quoteItemsIds = array_merge($this->quoteItemsIds, array_keys($indexedEngraveProductList));
    }

    /**
     * Copy engrave product data from quote item to order item.
     *
     * @param OrderItemInterface $orderItem
     * @param QuoteItem $quoteItem
     *
     * @return void
     */
    public function copyToOrderItem(OrderItemInterface $orderItem, QuoteItem $quoteItem): void
    {
        $extensionAttributes = $quoteItem->getExtensionAttributes() ?: $this->cartItemExtensionFactory->create();
        $engraveProducts = $extensionAttributes->getEngraveProducts();

        if ($engraveProducts) {
            $orderItemExtensionAttributes = $orderItem->getExtensionAttributes()
                ?: $this->orderItemExtensionFactory->create();
            $orderItemExtensionAttributes->setEngraveProducts($engraveProducts);
        }
    }

    /**
     * Link engrave product data to quote item and save it to database.
     *
     * @param QuoteItem $quoteItem
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function saveToQuoteItem(QuoteItem $quoteItem): void
    {
        $extensionAttributes = $quoteItem->getExtensionAttributes() ?: $this->cartItemExtensionFactory->create();
        $engraveProducts = $extensionAttributes->getEngraveProducts();

        if ($engraveProducts === null) {
            return;
        }

        foreach ($engraveProducts as $engraveProduct) {
            $engraveProduct->setQuoteItemId((int) $quoteItem->getItemId());
            $this->engraveProductRepository->save($engraveProduct);
        }
    }

    /**
     * Link engrave product data to order item and save it to database.
     *
     * @param OrderItemInterface $orderItem
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function saveToOrderItem(OrderItemInterface $orderItem): void
    {
        $extensionAttributes = $orderItem->getExtensionAttributes() ?: $this->orderItemExtensionFactory->create();
        $engraveProducts = $extensionAttributes->getEngraveProducts();

        if ($engraveProducts === null) {
            return;
        }

        foreach ($engraveProducts as $engraveProduct) {
            $engraveProduct->setOrderItemId((int) $orderItem->getItemId());
            $this->engraveProductRepository->save($engraveProduct);
        }
    }
}
