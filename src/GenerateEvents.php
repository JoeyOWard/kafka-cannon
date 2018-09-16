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

    protected $dataToSend;
    protected $broker;
    protected $ammo;
    protected $yaml;

    public function __construct(){

    }


    public function GenerateKafkaData(){


        $this->readYaml();

        var_dump($this->dataToSend);

        for ($x = 0; $x <= $this->ammo; $x++) {

            foreach($this->dataToSend as $data){
                $this->PushToKafka($data);
            }

        }

        printf("Fired " .$this->ammo ." times \n");

    }



    public function PushToKafka($data){


        $service = New KafkaService();
        
        $service->payload($data->payload);
        $service->broker($this->broker);
        $service->topic($data->topic);
        $service->produce();


        printf("Fired a " . $data->topic ." at " . $this->broker . "\n");

    }


    public function readYaml()
    {

        $yaml = (Yaml::parseFile(getcwd() . '/kafka-cannon.yml'));

        $this->yaml = $yaml;
        $this->generateKafkaEvent($this->yaml['topics']);
        $this->broker = $yaml['broker'];

        printf("Kafka-Cannon.yml read successfully...\n");

    }



    public function generateKafkaEvent($array){



        foreach ($array as $topic=>$data){

            $kafkaData = new KafkaData();
            $kafkaData->topic($topic);
            $enabled = false;
            $random = false;

            if($data['random-data'] == 'true'){
                $random = true;
            }

            foreach($data as $datatype=>$values){

                if($datatype == 'enabled' && $values == 'true') {

                    $enabled = true;
                }


                if ($datatype == 'values') {

                    foreach($values as $valueType=>$data){

                        if($random == true){

                            if(!(isset($data))){

                                $values[$valueType] = rand();
                            }
                        }
                    }

                    $valueArray = $values;


                }

                if ($datatype == 'attribute-type') {

                    $kafkaData->type($values);
                }
            }

        if($enabled == true) {

            $attributes = [
                'type' => $kafkaData->type,
                'url' => '/services/data/v37.0/sobjects/' . $kafkaData->type . '/' . $valueArray['Id']
            ];

            $valueArray['attributes'] = $attributes;

            $json = json_encode($valueArray);

            $kafkaData->payload($json);

            $this->dataToSend[] = $kafkaData;
        }

        }

    }


}