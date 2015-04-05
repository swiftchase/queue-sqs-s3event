<?php

namespace S3EventQueue\Queue;

use S3EventQueue\Options\S3EventQueueOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * SqsQueueFactory
 */
class S3EventQueueFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = '', $requestedName = '')
    {
        $parentLocator    = $serviceLocator->getServiceLocator();
        $sqsClient        = $parentLocator->get('Aws')->get('Sqs');
        $jobPluginManager = $parentLocator->get('SlmQueue\Job\JobPluginManager');

        // Let's see if we have options for this specific queue
        $config = $parentLocator->get('Config');
        $config = $config['slm_queue']['queues'];

        $options = new S3EventQueueOptions(isset($config[$requestedName]) ? $config[$requestedName] : []);

        return new S3EventQueue($sqsClient, $options, $requestedName, $jobPluginManager);
    }
}
