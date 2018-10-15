<?php

namespace Artgris\MaintenanceBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Maintenance Test.
 *
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class MaintenanceTest extends WebTestCase
{
    public function testMaintenance()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        static::assertEquals(
            Response::HTTP_SERVICE_UNAVAILABLE,
            $client->getResponse()->getStatusCode());
    }
}
