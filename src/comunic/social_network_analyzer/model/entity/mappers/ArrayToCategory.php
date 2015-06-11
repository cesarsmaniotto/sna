<?php

namespace comunic\social_network_analyzer\model\entity\mappers{


use \comunic\social_network_analyzer\model\entity\Category;

    class ArrayToCategory{

        public function __invoke($arrayData){
            $category = new Category();

            if (isset($arrayData['_id']->{'$id'})) {
                  $category->setId($arrayData['_id']->{'$id'});
            }

            if (isset($arrayData['name'])) {
                 $category->setName($arrayData['name']);
            }

            if (isset($arrayData['keywords'])) {
                 $category->setKeywords($arrayData['keywords']);
            }

            if (isset($arrayData['included'])) {
                  $category->setIncluded($arrayData['included']);
            }

            if (isset($arrayData['excluded'])) {
                  $category->setExcluded($arrayData['excluded']);
            }

            return $category;

        }


    }



}



?>