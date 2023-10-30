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

namespace Labofgood\EngraveProduct\Api;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Module configurations provider.
 *
 * @interface ConfigProvider.
 * @api
 */
interface ConfigProviderInterface
{
    /**
     * Set storeId for getting correct store configurations.
     *
     * @param int $storeId
     *
     * @return $this
     */
    public function setStoreId(int $storeId): self;

    /**
     * When the configuration is enabled, it becomes possible to add engravings for the (PDP).
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isDisplayEngravingOption(): bool;
}
