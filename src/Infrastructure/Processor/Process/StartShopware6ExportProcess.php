<?php
/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ExporterShopware6\Infrastructure\Processor\Process;

use Ergonode\Channel\Domain\Entity\Export;
use Ergonode\ExporterShopware6\Domain\Entity\Shopware6Channel;
use Ergonode\ExporterShopware6\Infrastructure\Synchronizer\SynchronizerInterface;

class StartShopware6ExportProcess
{
    /**
     * @var SynchronizerInterface[]
     */
    private array $synchronizerCollection;

    public function __construct(SynchronizerInterface ...$synchronizerCollection)
    {
        $this->synchronizerCollection = $synchronizerCollection;
    }

    public function process(Export $export, Shopware6Channel $channel): void
    {
        foreach ($this->synchronizerCollection as $synchronizer) {
            $synchronizer->synchronize($export, $channel);
        }
    }
}
