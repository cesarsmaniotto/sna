<?php

namespace comunic\social_network_analyzer\model\entity\parse\csv{

    use \comunic\social_network_analyzer\model\entity\parse\csv\BasicCSVObjectParser;
    use \comunic\social_network_analyzer\model\entity\Category;


    class CSVCategoryParser extends BasicCSVObjectParser{


        protected function arrayToObject($arrayData){
            $category = new Category();

            $category->setName($arrayData['name']);
            $category->setKeywords(\explode(",", $arrayData['keywords']));

            return $category;
        }
    }

}



?>