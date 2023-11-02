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

namespace Labofgood\EngraveProduct\Model\Service\Statistic;

use Labofgood\EngraveProduct\Api\OrderStatisticCollectorInterface;
use Labofgood\EngraveProduct\Api\OrderStatisticOptionInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

/**
 * Class OrderStatisticCollector
 *
 * Class for collecting order statistic.
 */
class OrderStatisticCollector implements OrderStatisticCollectorInterface
{
    /**
     * @param CollectionFactory $orderCollectionFactory
     * @param OrderStatisticOptionInterface $statisticOption
     */
    public function __construct(
        private readonly CollectionFactory $orderCollectionFactory,
        private readonly OrderStatisticOptionInterface $statisticOption
    ) {
    }

    /**
     * Get order statistic.
     *
     * @return int
     */
    public function execute(): int
    {
        $collection = $this->orderCollectionFactory->create();

        if ($this->statisticOption->isEngraved()) {
            $collection->addFieldToFilter('has_engraved_items', ['eq' => 1]);
        }

        if ($this->statisticOption->isNotShipped()) {
            $collection->getSelect()
                ->joinLeft(
                    ['s' => $collection->getTable('sales_shipment')],
                    'main_table.entity_id = s.order_id',
                    []
                )
                ->where('s.entity_id IS NULL');
        }

        return (int) $collection->getSize();
    }
}
