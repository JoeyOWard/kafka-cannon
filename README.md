Kafka Cannon

Why?
----------------

TBA

Installing
----------------

```bash
$> composer require joeward/kafka-cannon
```


Ensure that you have setup kafka-cannon.yml as below

Topics: Have topic name underneath  

Payload: Information is stored within payload. These can be hard coded or left as blank/used with the random-data option    

Attribute-type: Is the type which is also used in the url  

Enabled: Signifies if to include the topic for testing, true/false value  

Random-data: signifies if you want to seed your blank payload values with random data. true/false value  

Broker: Is the kafka url

Order: Choose between sequential or random. Sequential fires the topics as displayed in the yaml, random means order is random    

Ammo: How many times you want the topics to be published/fired   

  



```yaml
topics:
    test_topic:
            payload:
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
            payload:
                  Id: 456
                  Name: testname2
                  otherfield:
                  lotsofdata:
            attribute-type: test2
            enabled: true
            random-data: true
broker: 1
order: sequential
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

Not in bin
 

Notes
----------------

