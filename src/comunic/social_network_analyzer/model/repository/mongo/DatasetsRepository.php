<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

    use comunic\social_network_analyzer\model\repository\IDatasetsRepository;
    use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;
    use comunic\social_network_analyzer\model\repository\mongo\mappers\ObjectToArrayWithMongoId;
    use comunic\social_network_analyzer\model\repository\mongo\mappers\ArrayWithMongoIdToObject;

    class DatasetsRepository implements IDatasetsRepository{

        private $collection;

        function __construct($connectionType){
            $conn = new ConnectionMongo();
            $conn = $conn->getConnection($connectionType);
            $this->collection = $conn->selectCollection("projects");
        }

        public function insert($object,$projectId){

            try {
                $fObjToArrayWithMongoId = new ObjectToArrayWithMongoId();

                $arrayData=$fObjToArrayWithMongoId($object, new DatasetToArray());

                return $this->collection->update(array('_id' => new \MongoId($projectId)), array('$addToSet' => array("datasets" => $arrayData)), $options=array());

            } catch (\MongoCursorException $e) {

                echo $e->getMessage();

            }catch (\MongoException $e) {

                echo $e->getMessage();
            }

        }



        public function update($object, $projectId){

            $this->delete($object->getId(), $projectId);

            $this->insert($object, $projectId);

        }

        public function delete($id, $projectId){

            return $this->collection->update(array('_id' => new \MongoId($projectId)), array('$pull' => array("datasets" => array("_id" => new \MongoId($id)))), $options=array());

        }

        public function findById($id){


            $arrayData=$this->collection->findOne(array('datasets._id' => new \MongoId($id)), array("datasets.$" => true, "_id" => false), $fields=array());

            $fArrayWithMongoIdToObj = new ArrayWithMongoIdToObject();

            return $fArrayWithMongoIdToObj($arrayData["datasets"][0], new ArrayToDataset());
        }

        public function listAll($projectId){

            return $this->mongoch->find(new ArrayToDataset());
        }

    }

}


?>