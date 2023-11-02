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
