<?php

declare(strict_types=1);

namespace Core\Application\Service\RssReader;


interface RssReaderResultInterface
{
    public function httpStatusCode(): int;


}