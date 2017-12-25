<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\MongoDB\DocumentManager;

use Doctrine\MongoDB\Connection;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ArrayCache;
use PHPUnit\Framework\TestCase;

abstract class DoctrineMongoTestCase extends TestCase
{
    protected function setUp()
    {
        if (!class_exists('Mongo')) {
            $this->markTestSkipped('Mongo PHP/PECL Extension is not available.');
        }

        if (!class_exists('Doctrine\\Common\\Version')) {
            $this->markTestSkipped('Doctrine is not available.');
        }
    }

    /**
     * @return EntityManager
     */
    public static function createTestDocumentManager($paths = array())
    {
        $config = new Configuration();
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyDir(\sys_get_temp_dir());
        $config->setHydratorDir(\sys_get_temp_dir());
        $config->setProxyNamespace('GenemuFormBundleTests\Doctrine');
        $config->setHydratorNamespace('GenemuFormBundleTests\Doctrine');
        $config->setMetadataDriverImpl(new AnnotationDriver(new AnnotationReader(), $paths));
        $config->setMetadataCacheImpl(new ArrayCache());

        return DocumentManager::create(new Connection(), $config);
    }
}
