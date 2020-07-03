<?php

declare(strict_types=1);

namespace App\Tests;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\Common\DataFixtures\Loader;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

abstract class WebTestCase extends BaseWebTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var ORMExecutor
     */
    private $executor;

    /**
     * @var KernelBrowser
     */
    protected static $client;

    protected function setUp(): void
    {
        if (null === self::$client) {
            self::$client = static::createClient();
        }

        $this->entityManager = self::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->executor = new ORMExecutor($this->entityManager, new ORMPurger());

        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->updateSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
    }

    /**
     * @param $fixture
     */
    protected function loadFixture($fixture): void
    {
        $loader = new Loader();
        $fixtures = is_array($fixture) ? $fixture : [$fixture];

        foreach ($fixtures as $item) {
            $loader->addFixture($item);
        }

        $this->executor->execute($loader->getFixtures());
    }

    protected function tearDown(): void
    {
        (new SchemaTool($this->entityManager))->dropDatabase();
    }
}
