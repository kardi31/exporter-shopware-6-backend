<?php
/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ExporterShopware6\Infrastructure\Mapper\CustomField;

use Ergonode\Attribute\Domain\Entity\AbstractAttribute;
use Ergonode\Attribute\Domain\Entity\Attribute\AbstractNumericAttribute;
use Ergonode\Channel\Domain\Entity\Export;
use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\ExporterShopware6\Domain\Entity\Shopware6Channel;
use Ergonode\ExporterShopware6\Infrastructure\Mapper\CustomFieldMapperInterface;
use Ergonode\ExporterShopware6\Infrastructure\Model\AbstractShopware6CustomField;
use Ergonode\ExporterShopware6\Infrastructure\Model\Basic\Shopware6CustomFieldConfig;

class CustomFieldConfigNumericMapper implements CustomFieldMapperInterface
{
    private const TYPE = 'number';
    private const NUMBER_TYPE = 'float';

    public function map(
        Shopware6Channel $channel,
        Export $export,
        AbstractShopware6CustomField $shopware6CustomField,
        AbstractAttribute $attribute,
        ?Language $language = null
    ): AbstractShopware6CustomField {

        if ($attribute->getType() === AbstractNumericAttribute::TYPE) {
            $shopware6CustomField->setType(self::TYPE);
            $shopware6CustomField->getConfig()->setType(self::TYPE);
            $shopware6CustomField->getConfig()->setCustomFieldType(self::TYPE);
            if ($shopware6CustomField->getConfig() instanceof Shopware6CustomFieldConfig) {
                $shopware6CustomField->getConfig()->setNumberType(self::NUMBER_TYPE);
            }
        }

        return $shopware6CustomField;
    }
}
