<?php

declare(strict_types=1);

namespace Core\Application;


use Core\Application\Service\RssReader\RssReaderResultInterface;
use Core\Infrastructure\Services\FeedIoReader\FeedIoReader;

class MonitorApplicationService
{
    /** FeedIoReader */
    private $feedReader;

    /**
     * MonitorApplicationService constructor.
     * @param FeedIoReader $feedReader
     */
    public function __construct(FeedIoReader $feedReader)
    {
        $this->feedReader = $feedReader;
    }


    public function checkAlbo(string $alboUrl): RssReaderResultInterface
    {
        $this->feedReader->setTargetUrl($alboUrl);
        return $this->feedReader->execute();
    }

    public function checkAll(): array
    {
        $resultCollection = [];

        //TODO il catalogo degli albi dovrebbe essere gestito separatamente
        // qui usare chiamata Catalog->getAll()  inject CatalogService nella classe

        $catalog = [
            'http://feeds.ricostruzionetrasparente.it/albi_pretori/Accumoli_feed.xml',
            'http://feeds.ricostruzionetrasparente.it/albi_pretori/Acquasanta%20Terme_feed.xml',
            'http://feeds.feedburner.com/AlbopopAgira'
        ];

        $otherCatalog = [
            'http://dev.albopop.it/comune/accumoli/',
            'http://dev.albopop.it/comune/acquasantaterme/',
            'http://dev.albopop.it/comune/agira/'
        ];

        foreach ($catalog as $alboItem) {

            $resultCollection[] = $this->checkAlbo($alboItem);
        }

        return $resultCollection;
    }

}