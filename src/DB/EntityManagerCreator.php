<?php

    namespace Webjump\Doctrine\DB;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\ORMSetup;

    class EntityManagerCreator
    {
        public static function createEntityManager(): EntityManager
        {
            // Create a simple "default" Doctrine ORM configuration for Annotations
            $isDevMode = true;
            $proxyDir = null;
            $cache = null;
            $useSimpleAnnotationReader = false;
            $config = ORMSetup::createAttributeMetadataConfiguration(array(__DIR__."/.."), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
            // or if you prefer YAML or XML
            // $config = ORMSetup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
            // $config = ORMSetup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

            // database configuration parameters
            $conn = array(
                'driver' => 'pdo_sqlite',
                'path' => __DIR__ . '/../../db.sqlite',
            );

            // obtaining the entity manager
            return EntityManager::create($conn, $config);
        }
    }