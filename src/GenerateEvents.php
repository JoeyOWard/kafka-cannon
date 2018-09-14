<?php
/**
 * Created by PhpStorm.
 * User: joeward
 * Date: 14/09/2018
 * Time: 13:50
 */

namespace KafkaCannon;

use Symfony\Component\Yaml\Yaml;

class GenerateEvents
{

    protected $topic;
    protected $broker;
    protected $payload;
    protected $ontUrl;
    protected $ammo;
    protected $yaml;
    protected $ontTopic;
    protected $conTopic;

    public function __construct(){

    }


    public function GenerateKafkaData(){

        $this->readYaml();

        for ($x = 0; $x <= $this->ammo; $x++) {

            $this->CreateOnt();
            $this->PushToKafka();

        }

        printf("Fired " .$this->ammo ." ONTS \n");


        for ($x = 0; $x <= $this->ammo; $x++) {

            $this->CreateConnection();
            $this->PushToKafka();

        }

        printf("Fired " .$this->ammo ." Connections \n");

    }



    public function PushToKafka(){


        $service = New KafkaService();
        
        $service->payload($this->payload);
        $service->broker($this->broker);
        $service->topic($this->topic);
        $service->produce();


    }


    public function readYaml(){


        $yaml = (Yaml::parseFile(getcwd().'/kafka-cannon.yml'));

        $this->yaml = $yaml;
        $this->parseYaml();

        printf("Kafka-Cannon.yml read successfully...\n");

    }


    public function parseYaml(){

        $this->ontTopic = $this->yaml['ont-topic'];
        $this->conTopic = $this->yaml['connection-topic'];
        $this->broker = $this->yaml['broker'];
        $this->ammo = $this->yaml['ammo'];

    }


    public function CreateConnection(){


         $id = rand();

         $con = [
                'Id' => rand(),
                 'Name' => 'CO'. rand(),
                 'sVLAN_Restriction__c' => rand(),
                 'Status__c' => 'In Service' ,
                 'B_Port__c' => rand(),
                 'B_Device__c' => rand(),
                 'A_Port__c' =>rand(),
                 'A_Device__c' =>rand()
                ];

          $attributes = [
                    'type' => 'connection__c',
                    'url' => '/services/data/v37.0/sobjects/connection__c/' . $id
          ];

          $con['attributes'] = $attributes;

          $json = json_encode($con);

          $this->topic = $this->conTopic;
          $this->payload = $json;


    }

    public function CreateOnt(){

        $id = rand();

        $ont = [
            'Id' => $id,
            'Name' => 'ONT'. rand(),
            'FSAN__c' => rand(),
            'OLT__c' => rand(),
            'OLT_Port__c' => '20/10',
            'Property__c' => rand(),
            'Serial_Number__c' =>rand()
        ];

        $attributes = [
            'type' => 'ONT__c',
            'url' => '/services/data/v37.0/sobjects/ONT__c/' . $id
        ];

        $ont['attributes'] = $attributes;

        $json = json_encode($ont);

        $this->topic = $this->ontTopic;
        $this->payload = $json;


    }



}