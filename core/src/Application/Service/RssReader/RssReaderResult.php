<?php

declare(strict_types=1);

namespace Core\Application\Service\RssReader;


class RssReaderResult implements RssReaderResultInterface
{

    /** @var int */
    private $httpStatusCode;

    /**
     * RssReaderResult constructor.
     * @param int $httpStatusCode
     */
    public function __construct(int $httpStatusCode)
    {
        $this->httpStatusCode = $httpStatusCode;
    }


    public function httpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}