<?php

namespace Webit\WFirmaSDK\Entity;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Webit\WFirmaSDK\AbstractTestCase;
use Webit\WFirmaSDK\Auth\BasicAuth;
use Webit\WFirmaSDK\Entity\Infrastructure\Buzz\BuzzRequestExecutorFactory;

abstract class AbstractApiTestCase extends AbstractTestCase
{
    /**
     * @return EntityApi
     */
    protected function entityApi()
    {
        try {
            $factory = new EntityApiFactory(
                new BuzzRequestExecutorFactory(
                    null,
                    null,
                    $this->logger()

                )
            );
        } catch (\Exception $e) {
            throw new \RuntimeException('Cannot create EntityApiFactory', 0, $e);
        }

        return $factory->create($this->basicAuth(), $this->companyId());
    }

    private function basicAuth()
    {
        $auth = new BasicAuth(getenv('wFirma.username'), getenv('wFirma.password'));
        if ($auth->isEmpty()) {
            $this->markTestSkipped('Set wFirma.username and wFirma.password in your phpunit.xml file.');
        }

        return $auth;
    }

    /**
     * @return null|int
     */
    private function companyId()
    {
        $id = getenv('wFirma.company_id');
        if ($id) {
            return (int)$id;
        }

        return null;
    }

    private function logger()
    {
        $logToStdOut = getenv('wFirma.log_to_stdout') == 1;
        if ($logToStdOut) {
            return new Logger(
                'API',
                array(
                    new StreamHandler('php://stdout')
                )
            );
        }

        return null;
    }
}
