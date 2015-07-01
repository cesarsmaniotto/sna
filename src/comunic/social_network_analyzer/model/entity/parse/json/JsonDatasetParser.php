<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\Dataset;
    use comunic\social_network_analyzer\model\util\IdGenerator;

    class JsonDatasetParser extends BasicObjectParser{

        private $idGenerator;

        function __construct($idGenerator){

            $this->idGenerator = $idGenerator;
        }

        protected function createObject($jsonObj){
            $dataset = new Dataset();

             if (isset($jsonObj->id)) {
                $dataset->setId($jsonObj->id);
            }else{

                $dataset->setId($this->idGenerator);
            }

            if (isset($jsonObj->name)) {
                $dataset->setName($jsonObj->name);
            }

            return $dataset;
        }

    }

}

?>