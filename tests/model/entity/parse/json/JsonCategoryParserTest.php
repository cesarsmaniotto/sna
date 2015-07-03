<?php

namespace sna\tests\model\entity\mappers{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\entity\Category;
use comunic\social_network_analyzer\model\entity\parse\json\JsonCategoryParser;
use comunic\social_network_analyzer\model\util\IdMongoGenerator;

class JsonCategoryParserTest extends PHPUnit_Framework_TestCase{

    public function testParse(){

        $category = new Category();
        $idMongo=new IdMongoGenerator();
        $catId = $idMongo();
        $category->setId($catId);
        $category->setName("FooCategory");
        $category->setKeywords(array("FooKw", "BarKw"));

        $category2 = new Category();
        $catId2 = $idMongo();
        $category2->setId($catId2);
        $category2->setName("FooCategory");
        $category2->setKeywords(array("FooKw", "BarKw"));

        $jsonCategory = '[{"name":"FooCategory","keywords":["FooKw","BarKw"],"included":null,"excluded":null,"id":"'.$catId.'"},{"name":"FooCategory","keywords":["FooKw","BarKw"],"included":null,"excluded":null,"id":"'.$catId2.'"}]';

        $parser = new JsonCategoryParser();

        $this->assertEquals(array($category, $category2), $parser->parse($jsonCategory));


    }

}

}

?>