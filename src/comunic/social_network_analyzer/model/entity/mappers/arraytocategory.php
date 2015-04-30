<?php

namespace comunic\social_network_analyzer\model\entity\mappers{


use \comunic\social_network_analyzer\model\entity\Category;

    class ArraytoCategory{

        public function __invoke($arrayData){
            $category = new Category();

            $category->setId($arrayData['_id']->{'$id'});
            $category->setName($arrayData['name']);
            $category->setKeywords($arrayData['keywords']);

            return $category;

        }


    }



}



?>