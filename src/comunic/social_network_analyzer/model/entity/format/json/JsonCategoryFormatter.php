<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

    use \comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;

    class JsonCategoryFormatter extends BasicObjectFormatter{

        public function toMap($obj){

            $funcCategoryToArray = new CategoryToArray();

            $dados=$funcCategoryToArray($obj);

            return $dados;

        }

    }




}


?>