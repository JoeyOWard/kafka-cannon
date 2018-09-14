<?php
/**
 * Created by PhpStorm.
 * User: joeward
 * Date: 14/09/2018
 * Time: 14:22
 */

namespace KafkaCannon;


class KafkaService
{

    protected $broker;
    protected $topic;
    protected $payload;

    public function broker($broker)
    {
        $this->broker = $broker;
    }
    public function topic($topic)
    {
        $this->topic = $topic;
    }
    public function payload($payload)
    {
        $this->payload = $payload;
    }
    public function produce()
    {
        $rk = new \RdKafka\Producer();
        $rk->addBrokers($this->broker);
        $topic = $rk->newTopic($this->topic);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $this->payload);
    }





}