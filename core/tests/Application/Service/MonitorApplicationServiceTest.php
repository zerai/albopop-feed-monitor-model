<?php

declare(strict_types=1);

namespace Core\Tests\Application\Service;


use Core\Application\MonitorApplicationService;
use Core\Application\Service\RssReader\RssReaderResultInterface;
use Core\Infrastructure\Services\FeedIoReader\FeedIoReader;
use PHPUnit\Framework\TestCase;

class MonitorApplicationServiceTest extends TestCase
{

    private $monitorApplicationService;
    private $feedReader;

    protected function setUp()
    {
        $this->feedReader = new FeedIoReader();

        $this->monitorApplicationService = new MonitorApplicationService($this->feedReader);
    }


    /** @test */
    public function it_can_check_albo(): void
    {
        $url = 'http://feeds.ricostruzionetrasparente.it/albi_pretori/Muccia_feed.xml';

        self::assertInstanceOf(RssReaderResultInterface::class, $this->monitorApplicationService->checkAlbo($url));
    }



    /** @test */
    public function it_can_check_multiple_albo(): void
    {
        $monitorResult = $this->monitorApplicationService->checkAll();


        self::assertInternalType("array", $monitorResult);

        self::assertInstanceOf(RssReaderResultInterface::class, $monitorResult[0]);
    }

}