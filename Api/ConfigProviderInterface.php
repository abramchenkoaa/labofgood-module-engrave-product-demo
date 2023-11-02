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
