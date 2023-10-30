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
