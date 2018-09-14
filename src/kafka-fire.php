#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: joeward
 * Date: 14/09/2018
 * Time: 15:03
 */

use KafkaCannon\GenerateEvents;

if (is_file($autoload = getcwd() . '/vendor/autoload.php')) {
    require $autoload;
}



$generate = new GenerateEvents();
$generate->GenerateKafkaData();