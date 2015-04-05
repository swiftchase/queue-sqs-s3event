<?php

namespace S3EventQueue\Job;


use SlmQueue\Job\AbstractJob;

abstract class AbstractS3EventJob extends AbstractJob
{
    /**
     * @return string
     */
    public function getEventVersion()
    {
        return $this->content['eventVersion'];
    }

    /**
     * @return string The AWS region name
     */
    public function getAwsRegion()
    {
        return $this->content['awsRegion'];
    }

    /**
     * @return \DateTime Time the event took place
     */
    public function getEventTime()
    {
        return new \DateTime($this->content['eventTime']);
    }

    /**
     * @return string Name of the event
     */
    public function getEventName()
    {
        return $this->content['eventName'];
    }

    /**
     * @return string IP Address of the uploader
     */
    public function getSourceIpAddress()
    {
        return $this->content['requestParameters']['sourceIPAddress'];
    }

    /**
     * @return mixed The Configuration ID
     */
    public function getConfigurationId()
    {
        return $this->content['s3']['configurationId'];
    }

    /**
     * @return string The bucket name
     */
    public function getBucketName()
    {
        return $this->content['s3']['bucket']['name'];
    }

    /**
     * @return string The object name
     */
    public function getObjectKey()
    {
        /*
         * Spaces are '+', seems to be urlencoded?
         */
        return urldecode($this->content['s3']['object']['key']);
    }

    /**
     * @return string The object size
     */
    public function getObjectSize()
    {
        return $this->content['s3']['object']['size'];
    }
}