<?php

namespace S3EventQueue\Queue;


use S3EventQueue\Job\AbstractS3EventJob;
use S3EventQueue\Options\S3EventQueueOptions;
use SlmQueue\Queue\QueueAwareInterface;
use SlmQueueSqs\Queue\SqsQueue;

class S3EventQueue extends SqsQueue
{

    /**
     * @var S3EventQueueOptions
     */
    protected $queueOptions;

    /**
     * We override unserialization of the job since S3/SNS/SQS dictates the event format
     *
     * @param string $string
     * @param array $metadata
     * @return \SlmQueue\Job\JobInterface
     */
    public function unserializeJob($string, array $metadata = [])
    {
        $data = json_decode($string, true);

        if (count($data['Records']) !== 1) {
            throw new \RuntimeException('More than one event in the job. This is unexpected.');
        }

        $job = $this->getJobPluginManager()->get($this->queueOptions->getJobClass());
        /** @var $job AbstractS3EventJob */

        $job->setContent($data['Records'][0]);
        $job->setMetadata($metadata);

        if ($job instanceof QueueAwareInterface) {
            /** @var $job QueueAwareInterface */
            $job->setQueue($this);
        }

        return $job;
    }

}