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

use Labofgood\EngraveProduct\Api\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ConfigProvider
 *
 * Module configurations provider.
 */
class ConfigProvider implements ConfigProviderInterface
{
    /**
     * Mapping configuration xml paths.
     */
    private const XML_PATH_DISPLAY_ENGRAVING_OPTION = 'engrave_product/general/display_engraving_option';

    /**
     * @var int|null
     */
    private ?int $storeId = null;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly StoreManagerInterface $storeManager
    ) {
    }

    /**
     * Get current store id.
     *
     * @return int
     * @throws NoSuchEntityException
     */
    private function getStoreId(): int
    {
        if ($this->storeId === null) {
            $this->setStoreId(
                (int) $this->storeManager
                    ->getStore()
                    ->getId()
            );
        }

        return $this->storeId;
    }

    /**
     * Set storeId for getting correct store configurations.
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

    /**
     * When the configuration is enabled, it becomes possible to add engravings for the (PDP).
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isDisplayEngravingOption(): bool
    {
        return (bool) $this->scopeConfig->getValue(
            self::XML_PATH_DISPLAY_ENGRAVING_OPTION,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }
}
