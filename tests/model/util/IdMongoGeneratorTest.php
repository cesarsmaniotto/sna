<?php

namespace sna\tests\model\entity\mappers{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\util\IdMongoGenerator;

class IdMongoGeneratorTest extends PHPUnit_Framework_TestCase{


    public function testeInvoke(){

        $idMongo=new IdMongoGenerator();

        $generateId = $idMongo();

        $mongoId = new \MongoId($generateId);

        $this->assertEquals($generateId, $mongoId->{'$id'});

    }

}

}

?>