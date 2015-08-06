<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\Dataset;
    use comunic\social_network_analyzer\model\util\IdGenerator;

    class JsonDatasetParser extends BasicObjectParser{

        private $idGenerator;


        protected function createObject($arrayData){
            $dataset = new Dataset();

             if (isset($arrayData['id'])) {
                $dataset->setId($arrayData['id']);
            }

            if (isset($arrayData['name'])) {
                $dataset->setName($arrayData['name']);
            }

            if (isset($arrayData['hasTweets'])) {
                $dataset->setHasTweets($arrayData['hasTweets']);
            }

            return $dataset;
        }

    }

}

?>