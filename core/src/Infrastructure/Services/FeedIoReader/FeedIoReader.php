<?php
declare(strict_types=1);

namespace Core\Infrastructure\Services\FeedIoReader;


use Core\Application\Service\RssReader\RssReaderInterface;
use FeedIo\FeedIo;
use InvalidArgumentException;

class FeedIoReader implements RssReaderInterface
{
    /** @var FeedIo */
    private $feedIo;

    /** @var string */
    private $targetUrl;


    /**
     * FeedIoReader constructor.
     * @param string $targetUrl
     */
    public function __construct(string $targetUrl = null)
    {
        $this->feedIo = \FeedIo\Factory::create()->getFeedIo();

        if (!$targetUrl == null)
            $this->targetUrl = $targetUrl;
    }


    public function execute(): array
    {
        if ($this->targetUrl === null) {
            throw new InvalidArgumentException('RssReaderService without target url.');
        }

        $downloadedFeeds = $this->readRss();

        // TODO Define response object

        return [];

    }

    /**
     * @param string $targetUrl
     */
    public function setTargetUrl(string $targetUrl): void
    {
        if (!filter_var($targetUrl, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid target url in RssReaderService. Url was: ' . $targetUrl);
        }

        $this->targetUrl = $targetUrl;
    }

    /**
     * @return string
     */
    public function getTargetUrl(): string
    {
        return $this->targetUrl;
    }

    /**
     * @return \FeedIo\Reader\Result
     */
    public function readRss()
    {
        //TODO trow exception if this->targetUrl null|empty
        return $this->feedIo->read($this->targetUrl);
    }

}