<?php

namespace sna\tests\model\entity\mappers{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\entity\Category;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;
use comunic\social_network_analyzer\model\util\IdMongoGenerator;

class ArrayToCategoryTest extends PHPUnit_Framework_TestCase{


    public function testeInvoke(){

        $expectedObj = new Category();
        $idMongo=new IdMongoGenerator();
        $catId = $idMongo();
        $expectedObj->setId($catId);
        $expectedObj->setName("FooCategory");
        $expectedObj->setKeywords(array("FooKw", "BarKw"));

        $arrayData = array(
            "_id" => new \MongoId($catId),
            "name" => "FooCategory",
            "keywords" => array("FooKw", "BarKw"),
            "included" => null,
            "excluded" => null
            );

        $fArrayToCategory = new ArrayToCategory();

        $this->assertEquals($expectedObj, $fArrayToCategory($arrayData));

    }

}

}

?>