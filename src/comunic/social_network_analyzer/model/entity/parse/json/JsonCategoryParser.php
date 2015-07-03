<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\Category;

    class JsonCategoryParser extends BasicObjectParser{

        protected function createObject($arrayData){
            $category = new Category();

            if(isset($arrayData['id'])){
                $category->setId($arrayData['id']);
            }

            if(isset($arrayData['name'])){
                $category->setName($arrayData['name']);
            }

            if(isset($arrayData['keywords'])){
                $category->setKeywords($arrayData['keywords']);
            }

            if(isset($arrayData['included'])){
                $category->setIncluded($arrayData['included']);
            }

            if(isset($arrayData['excluded'])){
                $category->setExcluded($arrayData['excluded']);
            }

            return $category;
        }


    }


}


?>