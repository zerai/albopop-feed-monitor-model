<?php
declare(strict_types=1);

namespace Core\Infrastructure\Services\FeedIoReader;


use Core\Application\Service\RssReader\RssReaderInterface;
use Core\Application\Service\RssReader\RssReaderResult;
use Core\Application\Service\RssReader\RssReaderResultInterface;
use FeedIo\FeedIo;
use FeedIo\Reader\ReadErrorException;
use FeedIo\Reader\Result;
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


    public function execute(): RssReaderResultInterface
    {
        if ($this->targetUrl === null) {
            throw new InvalidArgumentException('RssReaderService without target url.');
        }

        $downloadedFeeds = $this->readRss();

       // $rssReaderResult = $this->resultTrasformer($downloadedFeeds);

        return $downloadedFeeds;

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


    public function readRss()
    {
        try {
            $result = $this->feedIo->read($this->targetUrl);

            $transformerResult = $this->resultTrasformer($result);

            return $transformerResult;

        } catch (ReadErrorException $exception) {

            // TODO log in file?
            // TODO put in STDOUT
            //$this->logger->error('Error appear during user creation. Reason: ' . $exception->getMessage());
            //echo 'Error ...... ';

            $rssReaderResult = new RssReaderResult(false);
            $rssReaderResult->setHttpError($exception->getMessage());

            return $rssReaderResult;
        }
    }


    /**
     * @param Result $result
     * @return RssReaderResult
     */
    public function resultTrasformer(Result $result): RssReaderResult
    {

        //TODO remove param
        $rssReaderResult = new RssReaderResult( true);

        return $rssReaderResult;
    }

}