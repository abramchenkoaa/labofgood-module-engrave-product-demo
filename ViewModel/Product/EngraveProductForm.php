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

namespace Labofgood\EngraveProduct\ViewModel\Product;

use Labofgood\EngraveProduct\Api\ConfigProviderInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class EngraveProductForm
 *
 * View model for product engraving form.
 */
class EngraveProductForm implements ArgumentInterface
{
    /**
     * @param ConfigProviderInterface $configProvider
     */
    public function __construct(
        private readonly ConfigProviderInterface $configProvider
    ) {
    }

    /**
     * Get product engraving option display status.
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isDisplayEngravingOption(): bool
    {
        return $this->configProvider->isDisplayEngravingOption();
    }
}
