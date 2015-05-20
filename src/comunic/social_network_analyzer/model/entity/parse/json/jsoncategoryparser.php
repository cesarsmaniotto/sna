<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\entity\Category;

    class JsonCategoryParser implements IObjectParser{

        public function parse($text){

            $jsonCat = \json_decode($text);


            if(is_array($jsonCat)){

                $categories = array();

            foreach ($jsonCat as $cat) {

                $categories[] = $this->createObject($cat);
            }

            return $categories;

            }

            return $this->createObject($jsonCat);

        }

        private function createObject($jsonObj){
            $category = new Category();

            if(isset($jsonObj->id)){
                $category->setId($jsonObj->id);
            }

            if(isset($jsonObj->name)){
                $category->setName($jsonObj->name);
            }

            if(isset($jsonObj->keywords)){
                $category->setKeywords($jsonObj->keywords);
            }

            if(isset($jsonObj->included)){
                $category->setIncluded($jsonObj->included);
            }

            if(isset($jsonObj->excluded)){
                $category->setExcluded($jsonObj->excluded);
            }

            return $category;
        }


    }


}




?>