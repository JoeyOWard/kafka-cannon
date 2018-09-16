Kafka Cannon

Why?
----------------

TBA

Installing
----------------

```bash
$> composer require entanet-qa/kafka-cannon
```


Ensure that you have setup kafka-cannon.yml as below

Topics have topic name underneath  

Payload information is stored within values  

attribute-type is the type which is also used in the url  

enabled signifies if to include the topic for testing, true/false value  

random-data signifies if you want to seed your blank payload values with random data. true/false value  

broker is the kafka url  

ammo is how many times you want the topics to be published 

  



```yaml
topics:
    test_topic:
            values:
                  Id: 123
                  Name: testname
                  testfield:
                  morefields:
                  andmorefields:
                  andmore:
            attribute-type: test
            enabled: true
            random-data: true
    my_other_topic:
            values:
                  Id: 456
                  Name: testname2
                  otherfield:
                  lotsofdata:
            attribute-type: test2
            enabled: true
            random-data: true
broker: 1
ammo: 5

```
      
Use
----------------

Call kafka-fire from project root 

```bash
$> vendor/joeward/kafka-cannon/src/kafka-fire.php
```




Known Issues
----------------

Not in bin, needs different fire modes.
 

Notes
----------------

