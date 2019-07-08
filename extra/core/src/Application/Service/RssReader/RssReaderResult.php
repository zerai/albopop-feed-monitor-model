<?php

declare(strict_types=1);

namespace Core\Application\Service\RssReader;


class RssReaderResult implements RssReaderResultInterface
{
    /** @var bool */
    private $httpStatus;

    /** @var string */
    private $httpError;


    /**
     * RssReaderResult constructor.
     * @param bool $httpStatus
     */
    public function __construct( bool $httpStatus )
    {
        $this->httpStatus = $httpStatus;
    }


    public function httpStatus(): bool
    {
        return $this->httpStatus;
    }


    public function setHttpError(string $httpError): void
    {
        $this->httpError = $httpError;
    }


    public function httpError(): string
    {
        return $this->httpError;
    }

}