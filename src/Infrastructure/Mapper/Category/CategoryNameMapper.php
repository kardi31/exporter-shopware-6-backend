<?php
/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ExporterShopware6\Infrastructure\Mapper\Category;

use Ergonode\Category\Domain\Entity\AbstractCategory;
use Ergonode\Channel\Domain\Entity\Export;
use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\ExporterShopware6\Domain\Entity\Shopware6Channel;
use Ergonode\ExporterShopware6\Infrastructure\Mapper\CategoryMapperInterface;
use Ergonode\ExporterShopware6\Infrastructure\Model\Shopware6Category;
use Ergonode\SharedKernel\Domain\Aggregate\CategoryId;

class CategoryNameMapper implements CategoryMapperInterface
{
    public function map(
        Shopware6Channel $channel,
        Export $export,
        Shopware6Category $shopware6Category,
        AbstractCategory $category,
        ?CategoryId $parentCategoryId = null,
        ?Language $language = null
    ): Shopware6Category {
        $name = $category->getName()->get($language ?: $channel->getDefaultLanguage());
        if ($name) {
            $shopware6Category->setName($name);
        }

        if (null === $language && null === $name) {
            $shopware6Category->setName($category->getCode()->getValue());
        }

        return $shopware6Category;
    }
}
