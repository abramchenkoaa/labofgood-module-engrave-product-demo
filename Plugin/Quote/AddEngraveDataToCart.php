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

namespace Labofgood\EngraveProduct\Plugin\Quote;

use Labofgood\EngraveProduct\Api\EngraveProductManagementInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type\AbstractType;
use Magento\Framework\DataObject;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Item;

/**
 * Class AddEngraveDataToCart
 *
 * Add engrave data from http request to cart item as extension attribute.
 */
class AddEngraveDataToCart
{
    /**
     * @param EngraveProductManagementInterface $engraveProductManagement
     */
    public function __construct(
        private readonly EngraveProductManagementInterface $engraveProductManagement
    ) {
    }

    /**
     * After product was added to cart, add engrave data to cart item as extension attribute.
     *
     * @param Quote $subject
     * @param Item|string $result
     * @param Product $product
     * @param null|float|DataObject $request
     * @param null|string $processMode
     *
     * @return Item|string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterAddProduct(
        Quote $subject,
        Item|string $result,
        Product $product,
        $request = null,
        $processMode = AbstractType::PROCESS_MODE_FULL
    ): Item|string {
        if (!($result instanceof Item) || !($request instanceof DataObject)) {
            return $result;
        }

        $engravedData = $request->getData('engrave_product');

        if ($engravedData) {
            $this->engraveProductManagement->setToQuoteItem(
                $engravedData,
                $result
            );
        }

        return $result;
    }
}
