<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\Dataset;
    use comunic\social_network_analyzer\model\util\IdGenerator;

    class JsonDatasetParser extends BasicObjectParser{

        private $idGenerator;

        function __construct($idGenerator){

            $this->idGenerator = $idGenerator;
        }

        protected function createObject($arrayData){
            $dataset = new Dataset();

             if (isset($arrayData['id'])) {
                $dataset->setId($arrayData['id']);
            }else{

                $dataset->setId($this->idGenerator);
            }

            if (isset($arrayData['name'])) {
                $dataset->setName($arrayData['name']);
            }

            return $dataset;
        }

    }

}

?>