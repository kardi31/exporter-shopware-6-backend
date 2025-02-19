<?php
/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ExporterShopware6\Infrastructure\Connector\Action\Media;

use Ergonode\ExporterShopware6\Infrastructure\Connector\AbstractAction;
use Ergonode\ExporterShopware6\Infrastructure\Model\Shopware6Media;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class GetMedia extends AbstractAction
{
    private const URI = '/api/v2/media/%s';

    private string $mediaId;

    public function __construct(string $mediaId)
    {
        $this->mediaId = $mediaId;
    }

    public function getRequest(): Request
    {
        return new Request(
            HttpRequest::METHOD_GET,
            $this->getUri(),
            $this->buildHeaders(),
        );
    }

    /**
     * @throws \JsonException
     */
    public function parseContent(?string $content): ?Shopware6Media
    {
        if (null === $content) {
            return null;
        }

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        return new Shopware6Media($data['data']['id'], $data['data']['attributes']['fileName']);
    }

    private function getUri(): string
    {
        return sprintf(self::URI, $this->mediaId);
    }
}
