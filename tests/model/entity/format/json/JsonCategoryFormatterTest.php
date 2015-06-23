<?php

namespace sna\tests\model\entity\mappers{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\entity\Category;
use comunic\social_network_analyzer\model\entity\format\json\JsonCategoryFormatter;
use comunic\social_network_analyzer\model\util\IdMongoGenerator;

class JsonCategoryFormatterTest extends PHPUnit_Framework_TestCase{

    public function testFormat(){

        $category = new Category();
        $idMongo=new IdMongoGenerator();
        $catId = $idMongo();
        $category->setId($catId);
        $category->setName("FooCategory");
        $category->setKeywords(array("FooKw", "BarKw"));

        $jsonExpected = '{"name":"FooCategory","keywords":["FooKw","BarKw"],"included":null,"excluded":null,"id":"'.$catId.'"}';

        $formatter = new JsonCategoryFormatter();

        $this->assertEquals($jsonExpected, $formatter->format($category));


    }

}

}

?>