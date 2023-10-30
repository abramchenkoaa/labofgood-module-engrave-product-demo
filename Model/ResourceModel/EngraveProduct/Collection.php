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

namespace Labofgood\EngraveProduct\Model\ResourceModel\EngraveProduct;

use Labofgood\EngraveProduct\Model\ResourceModel\EngraveProduct as EngraveProductResourceModel;
use Labofgood\EngraveProduct\Model\Data\EngraveProduct as EngraveProductModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * EngraveProduct Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize resource
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(EngraveProductModel::class, EngraveProductResourceModel::class);
    }
}
