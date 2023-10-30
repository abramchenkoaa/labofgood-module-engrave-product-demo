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

namespace Labofgood\EngraveProduct\Model\ResourceModel;

use Labofgood\EngraveProduct\Api\Data\EngraveProductInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class EngraveProduct.
 *
 * EngraveProduct sync resource model.
 */
class EngraveProduct extends AbstractDb
{
    /**
     * Define Table name for resource entity.
     */
    public const TABLE_NAME = 'labofgood_engrave_product';

    /**
     * Initialize strategic resource model.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::TABLE_NAME, EngraveProductInterface::ENTITY_ID);
    }
}
