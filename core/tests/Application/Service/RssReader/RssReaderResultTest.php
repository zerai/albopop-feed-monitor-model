<?php

declare(strict_types=1);

namespace Core\Tests\Application\Service\RssReader;


use Core\Application\Service\RssReader\RssReaderResult;
use Core\Application\Service\RssReader\RssReaderResultInterface;
use PHPUnit\Framework\TestCase;

class RssReaderResultTest extends TestCase
{

    /** @test */
    public function it_can_be_created(): void
    {
        $rssReaderResult = new RssReaderResult(true);

        self::assertInstanceOf(RssReaderResultInterface::class, $rssReaderResult);
    }


    /** @test */
    public function it_return_http_status(): void
    {
        $httpStatus = true;

        $rssReaderResult = new RssReaderResult($httpStatus);

        self::assertEquals($httpStatus, $rssReaderResult->httpStatus());
    }
}