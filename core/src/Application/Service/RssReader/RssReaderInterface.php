<?php

declare(strict_types=1);

namespace Core\Application\Service\RssReader;

interface RssReaderInterface
{
    public function execute(): array;
}
