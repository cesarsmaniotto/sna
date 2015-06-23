<?php

namespace sna\tests\model\entity\mappers{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\entity\Category;
use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;
use comunic\social_network_analyzer\model\util\IdMongoGenerator;

class CategoryToArrayTest extends PHPUnit_Framework_TestCase{


    public function testeInvoke(){

        $category = new Category();
        $idMongo=new IdMongoGenerator();
        $catId = $idMongo();
        $category->setId($catId);
        $category->setName("FooCategory");
        $category->setKeywords(array("FooKw", "BarKw"));

        $expectedArray = array(
            "_id" => new \MongoId($catId),
            "name" => "FooCategory",
            "keywords" => array("FooKw", "BarKw"),
            "included" => null,
            "excluded" => null
            );

        $fCategoryToArray = new CategoryToArray();

        $this->assertEquals($expectedArray, $fCategoryToArray($category));

    }

}

}

?>