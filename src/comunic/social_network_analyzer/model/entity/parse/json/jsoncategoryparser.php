<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\entity\Category;

    class JsonCategoryParser implements IObjectParser{

        public function parse($text){

            $jsonCat = \json_decode($text);
            $category = new Category();

            if(isset($jsonCat->id)){
                $category->setId($jsonCat->id);
            }

            if(isset($jsonCat->name)){
                $category->setName($jsonCat->name);
            }

            if(isset($jsonCat->keywords)){
                $category->setKeywords($jsonCat->keywords);
            }

            if(isset($jsonCat->included)){
                $category->setIncluded($jsonCat->included);
            }

            if(isset($jsonCat->excluded)){
                $category->setExcluded($jsonCat->excluded);
            }

            return $category;

        }



    }


}




?>