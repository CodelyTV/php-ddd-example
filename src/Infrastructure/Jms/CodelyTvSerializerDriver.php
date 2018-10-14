<?php

namespace CodelyTv\Infrastructure\Jms;

use InvalidArgumentException;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Metadata\PropertyMetadata;
use Metadata\Driver\DriverInterface;
use ReflectionClass;

abstract class CodelyTvSerializerDriver implements DriverInterface
{
    private $baseMetadata  = [];
    private $fileResources = [__FILE__];

    abstract public function getMetadata();

    final public function getDriverMetadata()
    {
        return array_merge($this->getBaseMetadata(), $this->getMetadata());
    }

    public function getBaseMetadata()
    {
        return $this->baseMetadata;
    }

    public function loadMetadataForClass(ReflectionClass $refClass)
    {
        $metadata = $this->getClassConfiguration($refClass);

        return $this->createMetadata($refClass->getName(), $metadata);
    }

    protected function addResourceFile($file)
    {
        $this->fileResources[] = $file;
    }

    private function getClassConfiguration(ReflectionClass $refClass)
    {
        $metadata = $this->getDriverMetadata();

        if (!isset($metadata[$refClass->getName()])) {
            throw new InvalidArgumentException(
                sprintf('The serializer configuration for the class "%s" does not exist.', $refClass->getName())
            );
        }

        return $metadata[$refClass->getName()];
    }

    private function createMetadata($className, array $config)
    {
        $metadata = new ClassMetadata($className);

        $this->addThisFileAsMetadataResourceToBeInvalidatedOnChanges($metadata);
        $this->addPropertiesToMetadata($config, $metadata);

        return $metadata;
    }

    private function addThisFileAsMetadataResourceToBeInvalidatedOnChanges(ClassMetadata $metadata)
    {
        $metadata->fileResources = array_merge($metadata->fileResources, $this->fileResources);
    }

    private function addPropertiesToMetadata(array $config, ClassMetadata $metadata)
    {
        foreach ($config as $propertyName => $propertyAttributes) {
            $propertyMetadata = new PropertyMetadata($metadata->name, $propertyName);
            $metadata->addPropertyMetadata($propertyMetadata);

            foreach ($propertyAttributes as $attribute => $value) {
                if ('type' === $attribute) {
                    $propertyMetadata->setType($value);
                } else {
                    $propertyMetadata->$attribute = $value;
                }
            }
        }
    }
}
