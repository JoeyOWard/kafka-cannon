<?php
/**
 * Created by PhpStorm.
 * User: joeward
 * Date: 16/09/2018
 * Time: 16:28
 */

namespace KafkaCannon;


class KafkaData
{

    public $topic;
    public $type;
    public $broker;
    public $payload;


    public function topic($data){

        $this->topic = $data;
    }

    public function type($data){

        $this->type = $data;

    }

    public function payload($data){

        $this->payload = $data;

    }

}