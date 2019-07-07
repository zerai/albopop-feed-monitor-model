<?php

declare(strict_types=1);

namespace Core\Tests\Infrastructure\Service\FeedIoReader;


use Core\Application\Service\RssReader\RssReaderInterface;
use Core\Infrastructure\Services\FeedIoReader\FeedIoReader;
use PHPUnit\Framework\TestCase;

class FeedIoReaderTest extends TestCase
{
    private const FEED_URL = 'http://feeds.ricostruzionetrasparente.it/albi_pretori/Muccia_feed.xml';
    private const OTHER_FEED_URL = 'http://feeds.ricostruzionetrasparente.it/albi_pretori/other_feed.xml';


    /** @test */
    public function it_can_be_created(): void
    {
        $rssReader = new FeedIoReader();

        self::assertInstanceOf(RssReaderInterface::class, $rssReader);
    }


    /** @test */
    public function it_can_be_created_with_target_url(): void
    {
        $rssReader = new FeedIoReader(self::FEED_URL);

        self::assertInstanceOf(RssReaderInterface::class, $rssReader);
    }


    /** @test */
    public function it_can_change_target_url(): void
    {
        $rssReader = new FeedIoReader(self::FEED_URL);

        $rssReader->setTargetUrl(self::OTHER_FEED_URL);

        self::assertEquals(self::OTHER_FEED_URL, $rssReader->getTargetUrl());
    }


    /**
     * @test
     * @expectedException  \InvalidArgumentException
     */
    public function invalid_target_url_throw_exception(): void
    {
        $rssReader = new FeedIoReader();

        // TODO use a dataProvider check all case empty|no schema|invalid path
        $rssReader->setTargetUrl('www.invalid.url');
    }


    /**
     * @test
     * @expectedException \LogicException
     */
    public function execution_with_empty_target_url_throw_exception(): void
    {
        $rssReader = new FeedIoReader();

        $rssReader->execute();
    }


    /** @test */
    public function it_handle_http_exception(): void
    {
        $rssReader = new FeedIoReader('http://feeds.ricostruzionetrasparente.it/albi_pretori/Muccia_feed.xmll');

        $readerResult = $rssReader->readRss();

        self::assertFalse($readerResult->httpStatus());
        self::assertNotNull($readerResult->httpError());
    }


    /** @test */
    public function it_handle_http_exception_in_response(): void
    {
        self::markTestSkipped('rimuover in seguito: usare mock nella risposta http');
        $rssReader = new FeedIoReader('http://dev.albopop.it/comune/agira/');

        $readerResult = $rssReader->readRss();

        self::assertFalse($readerResult->httpStatus());
        self::assertNotNull($readerResult->httpError());
        //var_dump($readerResult->httpError());
    }
}