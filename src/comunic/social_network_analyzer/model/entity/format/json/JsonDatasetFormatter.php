<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;

    class JsonDatasetFormatter extends BasicObjectFormatter{


        protected function toMap($dataset){

            $fDatasetToArray = new DatasetToArray();

            $arrayData = $fDatasetToArray($dataset);
            unset($arrayData["_id"]);
            $arrayData["id"] = $dataset->getId();

            return $arrayData;
        }

    }

}


?>