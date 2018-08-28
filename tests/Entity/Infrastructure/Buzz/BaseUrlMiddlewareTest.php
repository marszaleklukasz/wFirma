<?php

namespace Webit\WFirmaSDK\Entity\Infrastructure\Buzz;

use GuzzleHttp\Psr7\Request;
use Webit\WFirmaSDK\AbstractTestCase;

class BaseUrlMiddlewareTest extends AbstractTestCase
{
    /**
     * @test
     */
    public function it_sets_host_on_request()
    {
        $listener = new BaseUrlMiddleware($baseUrl = $this->faker()->url);
        /** @var Request $newRequest */
        $newRequest = $listener->handleRequest(
            new Request('GET', $path = '/some-uri?query=xyz'),
            function ($r) {return $r;}
        );

        $this->assertEquals($baseUrl . $path, $newRequest->getUri());
    }

    /**
     * @test
     */
    public function it_sets_wfirma_host_by_default()
    {
        $listener = new BaseUrlMiddleware();
        /** @var Request $newRequest */
        $newRequest = $listener->handleRequest(new Request('GET', $path = '/some-uri?query=xyz'), function ($r) {return $r;});

        $this->assertEquals('https://api2.wfirma.pl'.$path, $newRequest->getUri());
    }
}
