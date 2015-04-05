<?php

namespace S3EventQueue\Options;


use SlmQueueSqs\Options\SqsQueueOptions;

/**
 * Queue options for the S3EventQueue
 *
 * @package S3EventQueue\Options
 */
class S3EventQueueOptions extends SqsQueueOptions
{
    /**
     * @var string
     */
    protected $jobClass;

    /**
     * @return string
     */
    public function getJobClass()
    {
        return $this->jobClass;
    }

    /**
     * @param string $jobClass
     */
    public function setJobClass($jobClass)
    {
        $this->jobClass = $jobClass;
    }


}